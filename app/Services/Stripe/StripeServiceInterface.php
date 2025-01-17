<?php

namespace App\Services\Stripe;

use App\DTOs\CreateCouponCommand;
use App\Models\Course;
use Stripe\Checkout\Session;
use Stripe\Coupon;

interface StripeServiceInterface
{
    public function createCheckoutSession(Course $course): Session;

    public function getCheckoutSessionById(string $sessionId): Session;
    
    public function validateCheckoutSession(string $sessionId): ?array;
    
    public function getCustomerCards(string $customerId);

    public function createPromotionCode(array $params): void;

    public function getPromotionCodeList(): array;

    public function createCoupon(CreateCouponCommand $params): Coupon;

    public function getCouponsList(): array;
}