<?php

namespace App\Services\Stripe;

use App\DTOs\CreateCouponCommand;
use App\DTOs\CreatePromoCodeCommand;
use App\Exceptions\PaymentFailed;
use App\Models\Booking;
use App\Models\Course;
use App\View\Receipt;
use Stripe\Checkout\Session;
use Stripe\Customer;
use Stripe\PaymentIntent;
use Stripe\Stripe;
use Stripe\Coupon;
use Stripe\PaymentMethod;
use Stripe\PromotionCode;

// TODO: save only one card after checkout, without duplicates
class StripeService implements StripeServiceInterface
{
    public function __construct()
    {
        Stripe::setApiKey(env('STRIPE_SECRET'));
    }
    public function createCheckoutSession(Course $course): Session   
    {
        $user = auth()->user();
        $user->createOrGetStripeCustomer();

        $session = Session::create([
            'line_items' => [
                [
                    'price_data' => [
                        'currency' => 'usd',
                        'product_data' => [
                            'name' => $course->name,
                        ],
                        'unit_amount' => $course->price * 100,
                    ],
                    'quantity' => 1,
                ],
            ],
            'mode' => 'payment',
            'customer' => $user->stripe_id,
            'payment_intent_data' => [
                'setup_future_usage' => 'on_session',
            ],
            'success_url' => route('booking.success') . '?session_id={CHECKOUT_SESSION_ID}',
            'cancel_url' => route('booking.cancel'),
            'metadata' => ['course_id' => $course->id, 'user_id' => auth()->id()],
        ]);

        return $session;
    }

    public function getCheckoutSessionById(string $sessionId): Session
    {
        return Session::retrieve($sessionId);
    }
    public function createCheckoutSessionWithCoupon(Course $course, string $code): Session 
    {
        $user = auth()->user();
        $user->createOrGetStripeCustomer();
        $codeId = '';

        if(null !== $code && '' !== $code) {
            $code = PromotionCode::all(['code' => $code])->first();
            $codeId = $code['id'];
        }

        $session = Session::create([
            'line_items' => [
                [
                    'price_data' => [
                        'currency' => 'usd',
                        'product_data' => [
                            'name' => $course->name,
                        ],
                        'unit_amount' => $course->price * 100,
                    ],
                    'quantity' => 1,
                ],
            ],
            'mode' => 'payment',
            'customer' => $user->stripe_id,
            'payment_intent_data' => [
                'setup_future_usage' => 'on_session',
            ],
            'success_url' => route('booking.success') . '?session_id={CHECKOUT_SESSION_ID}',
            'cancel_url' => route('booking.cancel'),
            'metadata' => ['course_id' => $course->id, 'user_id' => auth()->id()],
            'discounts' => [
                [
                    'promotion_code' => $codeId
                ],
            ]
        ]);
 
        return $session;
    }

    public function validateCheckoutSession(string $sessionId): ?array
    {
        $checkoutSession = Session::retrieve($sessionId);
        
        if ($checkoutSession->payment_status == 'paid') {
            $this->updateStatusInDb($sessionId);
            // Set default payment method
            Customer::update(
                $checkoutSession->customer,
                [
                    'default_payment_method' => $checkoutSession->payment_method
                ]
            );
            // Get charge
            $paymentIntent = PaymentIntent::retrieve($checkoutSession->payment_intent);

            $paymentMethod = PaymentMethod::retrieve($paymentIntent->payment_method);
            $receipt = new Receipt(
                courseId: $checkoutSession->metadata['course_id'],
                customerId: $checkoutSession->customer,
                date: (new \DateTimeImmutable())->setTimestamp($paymentIntent->created),
                card: $paymentMethod->card,
            );
            return $receipt->render();
        } else {
            throw new PaymentFailed('Payment failed! Something went wrong.');
        }
    }

    public function getCustomerCards(string $customerId)
    {
        $customer = \Stripe\Customer::retrieve($customerId);

        $cards = $customer->default_source; 

        return $customer;
    }

    public function createPromotionCode(CreatePromoCodeCommand $command): PromotionCode 
    {
        return PromotionCode::create($command->toArray());
    }

    public function getPromotionCodeList(): array
    {
        return PromotionCode::all()->data;
    }

    public function createCoupon(CreateCouponCommand $command): Coupon 
    {
        $data = [
            "name" => $command->name,
            "duration" => $command->duration->value,
            "redeem_by" => $command->redeemByDate?->getTimestamp(),
            "max_redemptions" => $command->redeemByCount,
        ];

        if($command->amountType->value === 'percent_off') {
            $data['percent_off'] = $command->amountValue;
        } else {
            $data['amount_off'] = $command->amountValue * 100;
            $data['currency'] = 'usd';
        }

        return Coupon::create($data);
    }

    public function getCouponsList(): array
    {
        return Coupon::all()->data;
    }
    private function updateStatusInDb(string $sessionId): void 
    {
        $booking = Booking::where('session_id', $sessionId)->first();
        $booking->update(['status' => 'paid']);
    }
}