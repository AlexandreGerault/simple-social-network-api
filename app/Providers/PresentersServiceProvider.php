<?php

namespace App\Providers;

use App\Presenters\Auth\LoginPresenter;
use App\Presenters\Post\CreatePostPresenter;
use Domain\SSN\Auth\UseCases\Login\LoginPresenterInterface;
use Domain\SSN\Posts\UseCases\CreatePost\CreatePostPresenterInterface;
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
        $this->app->bind(CreatePostPresenterInterface::class, CreatePostPresenter::class);
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
