<?php

namespace Tests\Feature\Filament\PromoCodes;

use App\Filament\Clusters\Coupons\Resources\PromotionCodeResource;
use App\Models\PromoCode;
use App\Models\User;
use Filament\Facades\Filament;
use Livewire\Livewire;
use Tests\TestCase;

class PromoCodeResourceTest extends TestCase
{
    protected function setUp(): void
    {
        parent::setUp();

        $this->actingAs(User::factory()->create());
    }
    public function test_it_can_create_a_promo_code()
    {
        $this->get(PromotionCodeResource::getUrl('create'));

        Livewire::test(PromotionCodeResource::class)
            ->fillForm([
                
            ]);
    }
}