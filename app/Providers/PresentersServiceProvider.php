<?php

namespace App\Providers;

use App\Presenters\Auth\LoginPresenter;
use Domain\SSN\Auth\UseCases\Login\LoginPresenterInterface;
use Illuminate\Support\ServiceProvider;

class PresentersServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->bind(LoginPresenterInterface::class, LoginPresenter::class);
    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        //
    }
}
