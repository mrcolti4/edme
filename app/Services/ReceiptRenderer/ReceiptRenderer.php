<?php

namespace App\Services\ReceiptRenderer;

use App\Models\Course;
use App\Models\User;
use App\View\Receipt;
use Spatie\LaravelPdf\PdfBuilder;
use function Spatie\LaravelPdf\Support\pdf;

class ReceiptRenderer implements ReceiptRendererInterface
{
    public function render(Receipt $receipt, Course $course, User $customer): PdfBuilder
    {
        return pdf()
            ->view('components.pdf.receipt', [
                'receipt' => $receipt->render(), 
                'course' => $course, 
                'customer' => $customer
            ])
            ->name('receipt' . date_timestamp_get(new \DateTimeImmutable) . '.pdf');
    }
}