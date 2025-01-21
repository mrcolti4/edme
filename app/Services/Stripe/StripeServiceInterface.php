<?php

namespace App\Services\Stripe;

use App\DTOs\CreateCouponCommand;
use App\DTOs\CreatePromoCodeCommand;
use App\Models\Course;
use Stripe\Checkout\Session;
use Stripe\Coupon;
use Stripe\PromotionCode;

interface StripeServiceInterface
{
    public function createCheckoutSession(Course $course): Session;

    public function getCheckoutSessionById(string $sessionId): Session;
    
    public function validateCheckoutSession(string $sessionId): ?array;
    
    public function getCustomerCards(string $customerId);

    public function createPromotionCode(CreatePromoCodeCommand $command): PromotionCode;

    public function getPromotionCodeList(): array;

    public function createCoupon(CreateCouponCommand $params): Coupon;

    public function getCouponsList(): array;
}