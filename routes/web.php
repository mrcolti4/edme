<?php

use Illuminate\Support\Facades\Route;
use \App\Livewire\WelcomePage;
use Livewire\Volt\Volt;

Route::get("/", WelcomePage::class)->name("home");
Route::name("categories.")->prefix("categories")->group(function () {
    Volt::route("/", "pages.app.category.index")->name("index");
    Volt::route("/{category}", "pages.app.category.show")->name("show");
});

require __DIR__ . '/auth.php';
