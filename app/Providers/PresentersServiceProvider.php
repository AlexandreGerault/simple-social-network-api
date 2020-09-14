<?php

namespace App\Providers;

use App\Presenters\Auth\EditProfilePresenter;
use App\Presenters\Auth\LoginPresenter;
use App\Presenters\Post\CreatePostPresenter;
use App\Presenters\Post\DeletePostPresenter;
use App\Presenters\Post\EditPostPresenter;
use App\Presenters\Post\ShowNewsfeedPresenter;
use App\Presenters\Users\FollowUserPresenter;
use App\Presenters\Users\SearchUserPresenter;
use App\Presenters\Users\ShowUserPresenter;
use App\Presenters\Users\UnfollowUserPresenter;
use Domain\SSN\Auth\UseCases\EditProfile\EditProfilePresenterInterface;
use Domain\SSN\Auth\UseCases\Login\LoginPresenterInterface;
use Domain\SSN\Posts\UseCases\CreatePost\CreatePostPresenterInterface;
use Domain\SSN\Posts\UseCases\DeletePost\DeletePostPresenterInterface;
use Domain\SSN\Posts\UseCases\EditPost\EditPostPresenterInterface;
use Domain\SSN\Posts\UseCases\ShowNewsfeed\ShowNewsfeedPresenterInterface;
use Domain\SSN\Users\UseCases\FollowUser\FollowUserPresenterInterface;
use Domain\SSN\Users\UseCases\SearchUser\SearchUserPresenterInterface;
use Domain\SSN\Users\UseCases\ShowUser\ShowUserPresenterInterface;
use Domain\SSN\Users\UseCases\UnfollowUser\UnfollowUserPresenterInterface;
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
        $this->app->bind(EditProfilePresenterInterface::class, EditProfilePresenter::class);
        $this->app->bind(SearchUserPresenterInterface::class, SearchUserPresenter::class);
        $this->app->bind(ShowUserPresenterInterface::class, ShowUserPresenter::class);
        $this->app->bind(FollowUserPresenterInterface::class, FollowUserPresenter::class);
        $this->app->bind(UnfollowUserPresenterInterface::class, UnfollowUserPresenter::class);
        $this->app->bind(CreatePostPresenterInterface::class, CreatePostPresenter::class);
        $this->app->bind(EditPostPresenterInterface::class, EditPostPresenter::class);
        $this->app->bind(DeletePostPresenterInterface::class, DeletePostPresenter::class);
        $this->app->bind(ShowNewsfeedPresenterInterface::class, ShowNewsfeedPresenter::class);
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
