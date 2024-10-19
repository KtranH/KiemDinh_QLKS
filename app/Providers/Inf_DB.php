<?php

namespace App\Providers;

use App\QueryDB;
use Illuminate\Support\Facades\Cookie;
use Illuminate\Support\Facades\View;
use Illuminate\Support\ServiceProvider;

class Inf_DB extends ServiceProvider
{
    use QueryDB;
    /**
     * Register services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap services.
     */
    public function boot(): void
    {
        //
        View::composer('header', function ($view) {
            $user = $this->Inf_User(Cookie::get('tokenLogin'));
            $view->with('user', $user);
        });
    }
}
