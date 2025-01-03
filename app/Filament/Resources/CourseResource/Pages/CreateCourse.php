<?php

namespace App\Filament\Resources\CourseResource\Pages;

use App\Filament\Resources\CourseResource;
use Filament\Resources\Pages\CreateRecord;
use Stripe\StripeClient;

class CreateCourse extends CreateRecord
{
    protected static string $resource = CourseResource::class;
}
