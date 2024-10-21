<?php

use App\Http\Controllers\BookingCourseController;
use App\Http\Controllers\VerifyUserController;
use Illuminate\Support\Facades\Route;
use App\Livewire\WelcomePage;
use Livewire\Volt\Volt;

Route::get("/", WelcomePage::class)->name("home");
Route::name("categories.")->prefix("categories")->group(function () {
    Volt::route("/", "pages.app.category.index")->name("index");
    Volt::route("/{category}", "pages.app.category.show")->name("show");
});

Route::name("courses.")->prefix("courses")->group(function () {
    Volt::route("/", "pages.app.courses.index")->name("index");
    Volt::route("/{course}", "pages.app.courses.show")->name("show");
});

Route::name("teachers.")->prefix("teachers")->group(function () {
    Volt::route("/", "pages.app.teachers.index")->name("index");
    Volt::route("/{teacher}", "pages.app.teachers.show")->name("show");
});

Route::group(
    [
        'prefix' => 'booking',
        'as' => 'booking.',
        'middleware' => 'auth'
    ],
    function () {
        Volt::route("/", "pages.app.booking.index")->name("index");
        Route::post("/{course}", BookingCourseController::class)->name("course");
    }
);

require __DIR__ . '/auth.php';
