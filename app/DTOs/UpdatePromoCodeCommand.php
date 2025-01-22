<?php

namespace App\DTOs;

class UpdatePromoCodeCommand
{
    public function __construct(
        public string $id,
        public bool $isActive,
    ) {}

    public function toArray(): array
    {
        return [
            'active' => $this->isActive,
        ];
    }
}