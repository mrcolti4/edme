<?php

use App\Models\Category;
use App\Models\Course;
use App\Models\Teacher;
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
        Schema::create((new Course())->getTable(), function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('description');
            $table->integer("price");
            $table->integer("students_limit");
            $table->date('start_date');
            $table->date('end_date');
            $table->foreignIdFor(Teacher::class);
            $table->foreignIdFor(Category::class);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists((new Course())->getTable());
    }
};
