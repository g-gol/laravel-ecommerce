<?php

namespace App\Providers;

use Illuminate\Auth\Middleware\Authenticate;
use Illuminate\Auth\Notifications\ResetPassword;
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
        ResetPassword::createUrlUsing(function (object $notifiable, string $token) {
            return config(
                    'app.frontend_url'
                ) . "/password-reset/$token?email={$notifiable->getEmailForPasswordReset()}";
        });

        Authenticate::redirectUsing(fn($request) => route('admin.login.form'));

        Gate::before(fn($user) => $user->hasRole('admin'));
    }
}
