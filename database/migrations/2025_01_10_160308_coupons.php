<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use App\Enums\Stripe\CouponDuration;

return new class extends Migration
{
    public const TABLE = 'coupons'; 
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create(self::TABLE, function (Blueprint $table) {
            $table->id();
            $table->string('stripe_id')->unique();
            $table->string('code')->unique();
            $table->string('name')->unique();
            $table->integer('percent_off')->nullable();
            $table->integer('amount_off')->nullable();
            $table->integer('redeem_by_date')->nullable();
            $table->integer('redeem_by_count')->nullable();
            $table->integer('times_redeemed')->default(0);
            $table->integer('max_redemptions')->nullable();
            $table->string('duration')->default(CouponDuration::ONCE->value);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        //
    }
};
