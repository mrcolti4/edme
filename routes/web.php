<?php

use App\Http\Controllers\BookingCourseController;
use Illuminate\Support\Facades\Route;
use \App\Livewire\WelcomePage;
use Livewire\Volt\Volt;

Route::get("/", WelcomePage::class)->name("home");
Route::name("categories.")->prefix("categories")->group(function () {
    Volt::route("/", "pages.app.category.index")->name("index");
    Volt::route("/{category}", "pages.app.category.show")->name("show");
});

Route::name("courses.")->prefix("courses")->group(function () {
    Volt::route("/", "pages.app.courses.index")->name("index");
    Volt::route("/{course}", "pages.app.courses.show")->name("show");
    Route::post("/{course}", BookingCourseController::class)->name("book");
});

Route::name("teachers.")->prefix("teacher")->group(function () {
});

require __DIR__ . '/auth.php';
