<?php

use App\Models\Booking;
use App\Models\Course;
use App\Models\Student;
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
            $table->boolean("is_verified")->default(false);
            $table->foreignIdFor(Student::class);
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
