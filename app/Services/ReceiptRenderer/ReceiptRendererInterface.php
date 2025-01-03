<?php

namespace App\Services\ReceiptRenderer;

use App\Models\Course;
use App\Models\User;
use App\View\Receipt;
use Spatie\LaravelPdf\PdfBuilder;

interface ReceiptRendererInterface
{
    public function render(Receipt $receipt, Course $course, User $customer): PdfBuilder;
}