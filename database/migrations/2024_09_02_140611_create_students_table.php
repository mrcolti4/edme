<?php

use App\Models\Contact;
use App\Models\Profile;
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
        Schema::create((new Student())->getTable(), function (Blueprint $table) {
            $table->id();
            $table->foreignIdFor(Profile::class);
            $table->foreignIdFor(Contact::class);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists((new Student())->getTable());
    }
};
