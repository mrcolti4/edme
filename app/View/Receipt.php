<?php

namespace App\View;

use Stripe\StripeObject;

class Receipt
{
    public function __construct(
        public readonly string $courseId,
        public readonly string $customerId,
        public readonly \DateTimeImmutable $date,
        public readonly StripeObject $card,
    ) {}

    public function render()
    {
        return [
            "course_id" => $this->courseId,
            "customer_id" => $this->customerId,
            "date" => $this->date->format('d M H:i'),
            "card" => $this->card->toArray()
        ];
    }
}