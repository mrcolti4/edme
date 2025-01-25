<?php

namespace App\DTOs;

class UpdateCouponCommand
{
    public function __construct(
        public string $id,
        public string $name,
    ) {}
    
    public function toArray(): array
    {
        return [
            'name' => $this->name,
        ];
    }
}