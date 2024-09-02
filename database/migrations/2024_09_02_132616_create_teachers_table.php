<?php

use App\Models\Category;
use App\Models\Contact;
use App\Models\Course;
use App\Models\Profile;
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
        Schema::create((new Teacher())->getTable(), function (Blueprint $table) {
            $table->id();
            $table->foreignIdFor(Profile::class);
            $table->foreignIdFor(Contact::class);
            $table->foreignIdFor(Category::class);
            $table->foreignIdFor(Course::class);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists((new Teacher())->getTable());
    }
};
