<?php

namespace Tests\Feature\Filament\PromoCodes;

use App\Filament\Clusters\Coupons\Resources\PromotionCodeResource;
use App\Models\Coupon;
use App\Models\PromotionCode;
use App\Models\User;
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
        $this->mockStripe();
        $coupon = Coupon::factory()->create();
        $this->get(PromotionCodeResource::getUrl('create'));
        
        Livewire::test(PromotionCodeResource\Pages\CreatePromotionCode::class)
            ->fillForm([
                'coupon' => $coupon->id,
                'code' => 'TESTCODE',
                'expires_at' => '',
                'max_redemptions' => 10,
                'is_active' => true
            ])
            ->call('create')
            ->assertHasNoFormErrors();
        
        $this->assertDatabaseHas('promotion_codes', [
            'code' => 'TESTCODE',
            'coupon_id' => $coupon->id,
            'max_redemptions' => 10,
            'is_active' => true
        ]);
    }

    public function test_it_can_update_a_promo_code()
    {
        $this->mockStripe();
        $promoCode = PromotionCode::factory()
            ->has(Coupon::factory())
            ->create();
        
        $this->assertEquals(true, $promoCode->is_active);

        Livewire::test(PromotionCodeResource\Pages\EditPromotionCode::class, ['record' => $promoCode->getRouteKey()])
            ->fillForm([
                'is_active' => false
            ])
            ->call('save')
            ->assertHasNoFormErrors();
        
        $promoCode = $promoCode->refresh();

        $this->assertEquals(false, $promoCode->is_active);
        
        $this->assertDatabaseHas('promotion_codes', [
            'id' => $promoCode->id,
            'is_active' => false
        ]);
    }
}