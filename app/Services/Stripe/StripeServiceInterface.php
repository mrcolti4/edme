<?php

namespace App\Services\Stripe;

use App\DTOs\CreateCouponCommand;
use App\DTOs\CreatePromoCodeCommand;
use App\DTOs\UpdateCouponCommand;
use App\DTOs\UpdatePromoCodeCommand;
use App\Models\Course;
use Stripe\Checkout\Session;
use Stripe\Coupon;
use Stripe\PromotionCode;

interface StripeServiceInterface
{
    public function createCheckoutSession(Course $course): array;

    public function createCheckoutSessionWithCoupon(Course $course, string $code): array;

    public function getCheckoutSessionById(string $sessionId): Session;
    
    public function validateCheckoutSession(string $sessionId): ?array;
    
    public function getCustomerCards(string $customerId);

    public function createPromotionCode(CreatePromoCodeCommand $command): PromotionCode;

    public function updatePromotionCode(UpdatePromoCodeCommand $command): PromotionCode;
    
    public function createCoupon(CreateCouponCommand $command): Coupon;

    public function updateCoupon(UpdateCouponCommand $command): Coupon;

    public function deleteCoupon(string $couponId);
}