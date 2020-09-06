<?php

namespace App\Providers;

use App\Presenters\Auth\LoginPresenter;
use App\Presenters\Post\CreatePostPresenter;
use App\Presenters\Post\DeletePostPresenter;
use App\Presenters\Post\EditPostPresenter;
use Domain\SSN\Auth\UseCases\Login\LoginPresenterInterface;
use Domain\SSN\Posts\UseCases\CreatePost\CreatePostPresenterInterface;
use Domain\SSN\Posts\UseCases\DeletePost\DeletePostPresenterInterface;
use Domain\SSN\Posts\UseCases\EditPost\EditPostPresenterInterface;
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
        $this->app->bind(EditPostPresenterInterface::class, EditPostPresenter::class);
        $this->app->bind(DeletePostPresenterInterface::class, DeletePostPresenter::class);
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
