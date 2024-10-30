<?php

namespace App\Providers;

use App\Mail\ConfirmedSignUp;
use App\Models\User;
use Illuminate\Auth\Notifications\VerifyEmail;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Support\ServiceProvider;
use Laravel\Cashier\Cashier;

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
        Cashier::useCustomerModel(User::class);
        VerifyEmail::toMailUsing(function (object $notifiable, string $url) {
            return (new MailMessage())
                ->subject('Verify your email address')
                ->view('mail.confirmed-sign-up', ['url' => $url]);
        });
    }
}
