<?php

namespace App\Filament\Resources\CourseResource\Pages;

use App\Filament\Resources\CourseResource;
use Filament\Resources\Pages\CreateRecord;
use Stripe\StripeClient;

class CreateCourse extends CreateRecord
{
    protected static string $resource = CourseResource::class;

    protected function afterCreate(): void
    {
        $data = $this->record;

        $client = new StripeClient(env('STRIPE_SECRET'));

        $product = $client->products->create([
            'name' => $data['name'],
            'id' => $data['id'],
        ]);

        $price = $client->prices->create([
            'currency' => env('CASHIER_CURRENCY'),
            'product' => $product->id,
            'unit_amount' => $data['price'] * 100,
        ]);
    }
}
