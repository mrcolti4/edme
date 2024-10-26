<?php

namespace App\Providers;

use App\Mail\ConfirmedSignUp;
use App\Models\Review;
use App\Policies\ReviewPolicy;
use Illuminate\Auth\Notifications\VerifyEmail;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        VerifyEmail::toMailUsing(function (object $notifiable, string $url) {
            return (new MailMessage())
                ->subject('Verify your email address')
                ->view('mail.confirmed-sign-up', ['url' => $url]);
        });
        Gate::policy(Review::class, ReviewPolicy::class);
    }
}
