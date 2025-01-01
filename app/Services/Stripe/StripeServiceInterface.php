<?php

namespace App\Services\Stripe;

use App\Models\Course;
use App\View\Receipt;
use Stripe\Checkout\Session;

interface StripeServiceInterface
{
    public function createCheckoutSession(Course $course): Session;
    
    public function validateCheckoutSession(string $sessionId): ?array;
    
    public function getCustomerCards(string $customerId);
}