<?php

namespace Tests\Feature\Filament;

use App\Enums\Stripe\CouponAmountType;
use App\Filament\Clusters\Coupons\Resources\CouponResource;
use App\Models\Coupon;
use App\Models\User;
use Livewire\Livewire;
use Tests\TestCase;

class CouponsResourceTest extends TestCase
{
    /** @test */
    public function coupon_resource_can_be_created()
    {
        $this->actingAs(User::factory()->create());

        $coupon = Coupon::factory()->make();
        $this->get(CouponResource::getUrl('create'));

        Livewire::test(CouponResource\Pages\CreateCoupon::class)
            ->fillForm([
                'name' => $coupon->name,
                'type' => CouponAmountType::PERCENTAGE->value,
                'amount' => $coupon->percent_off,
                'duration' => 'once',
            ])
            ->call('create')
            ->assertHasNoFormErrors();

        $this->assertDatabaseHas('coupons', [
            'name' => $coupon->name,
            'amount_off' => $coupon->amount_off,
            'duration' => 'once',
        ]);
    }

    /** @test */
    public function coupon_resource_can_be_updated()
    {
        $this->mockStripe();
        $this->actingAs(User::factory()->create());

        $coupon = Coupon::factory()->create();
        $newName = 'New name';

        Livewire::test(CouponResource\Pages\EditCoupon::class, ['record' => $coupon->getRouteKey()])
            ->fillForm([
                'name' => $newName,
            ])
            ->call('save')
            ->assertHasNoFormErrors();

        $coupon = $coupon->refresh();

        $this->assertEquals($newName, $coupon->name);

        $this->assertDatabaseHas('coupons', [
            'name' => $newName,
            'amount_off' => $coupon->amount_off,
            'duration' => 'once',
        ]);
    }
}
