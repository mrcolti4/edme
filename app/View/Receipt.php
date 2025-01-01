<?php

namespace App\View;

class Receipt
{
    public function __construct(
        public readonly string $price,
        public readonly \DateTimeImmutable $date,
        public readonly string $method,
    ) {}

    public function render()
    {
        return [
            "price" => $this->price,
            "date" => $this->date->format('d M H:i'),
            "method" => $this->method
        ];
    }
}