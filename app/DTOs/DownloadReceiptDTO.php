<?php

namespace App\DTOs;

use App\Http\Requests\DownloadReceiptRequest;

class DownloadReceiptDTO
{
    public function __construct(
        public readonly string $courseId,
        public readonly string $customerId,
        public readonly string $date,
        public readonly array $card,
    ) {}

    public static function fromRequest(DownloadReceiptRequest $request): self
    {
        $data = json_decode($request->validated('receipt'), true) ?? $request->validated('receipt');

        return new self(
            courseId: $data['course_id'],
            customerId: $data['customer_id'],
            date: $data['date'],
            card: $data['card']
        );
    } 
}