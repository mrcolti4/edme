<?php

use App\Models\Booking;
use App\Models\Course;
use App\Models\User;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create((new Booking())->getTable(), function (Blueprint $table) {
            $table->id();
            $table->string('status')->default('pending');
            $table->string('session_id');
            $table->string('price');
            $table->foreignIdFor(User::class, "user_id");
            $table->foreignIdFor(Course::class);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists((new Booking())->getTable());
    }
};
