<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Pagination\Paginator;
use Illuminate\Support\Facades\Gate;

//use Nette\Utils\Paginator;

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
        Paginator::defaultView('pagination::default');

        Gate::define('view-users', function ($user) {
            return $user->is_admin == 1;
        });
        
        Gate::define('delete-text', function ($user, $text) {
            return $user->is_admin == 1 || $text->user_id == $user->id;
        });

    }
}
