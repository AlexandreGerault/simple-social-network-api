<?php

namespace App\Http\Controllers\Post;

use App\EloquentUser;
use App\Http\Controllers\Controller;
use Domain\SSN\Auth\Entity\User;
use Domain\SSN\Posts\Gateway\PostGateway;
use Domain\SSN\Posts\UseCases\CreatePost\CreatePost;
use Domain\SSN\Posts\UseCases\CreatePost\CreatePostPresenterInterface;
use Domain\SSN\Posts\UseCases\CreatePost\CreatePostRequest;
use Illuminate\Auth\AuthManager;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Ramsey\Uuid\Uuid;

class CreatePostController extends Controller
{
    private AuthManager $auth;
    private CreatePost $useCase;
    private PostGateway $gateway;
    private CreatePostPresenterInterface $presenter;

    /**
     * CreatePostController constructor.
     * @param PostGateway $gateway
     * @param CreatePostPresenterInterface $presenter
     */
    public function __construct(PostGateway $gateway, CreatePostPresenterInterface $presenter, AuthManager $auth)
    {
        $this->gateway = $gateway;
        $this->presenter = $presenter;
        $this->auth = $auth;

        $this->useCase = new CreatePost($this->gateway);
    }


    /**
     * Handle the incoming request.
     *
     * @param Request $request
     * @return JsonResponse
     */
    public function __invoke(Request $request)
    {
        /** @var EloquentUser $loggedUser */
        $loggedUser = $this->auth->guard()->user();

        $this->useCase->execute(new CreatePostRequest(
            $request->get('content'),
            new User(
                Uuid::fromString($loggedUser->id),
                $loggedUser->username,
                $loggedUser->email,
                $loggedUser->password
            )
        ), $this->presenter);

        return new JsonResponse(null, 201);
    }
}
