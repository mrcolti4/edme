<?php

use Illuminate\Support\Facades\Route;
use \App\Livewire\WelcomePage;

Route::get("/", WelcomePage::class)->name("home");

require __DIR__ . '/auth.php';
