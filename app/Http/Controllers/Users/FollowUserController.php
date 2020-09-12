<?php

namespace App\Http\Controllers\Users;

use App\Http\Controllers\Controller;
use Domain\SSN\Auth\Exceptions\UserNotFoundException;
use Domain\SSN\Auth\Gateway\AuthenticationGateway;
use Domain\SSN\Auth\Gateway\UserGateway;
use Domain\SSN\Users\UseCases\FollowUser\FollowUser;
use Domain\SSN\Users\UseCases\FollowUser\FollowUserPresenterInterface;
use Domain\SSN\Users\UseCases\FollowUser\FollowUserRequest;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Ramsey\Uuid\Uuid;

class FollowUserController extends Controller
{
    private FollowUser $useCase;
    private FollowUserPresenterInterface $presenter;

    /**
     * FollowUserController constructor.
     * @param FollowUserPresenterInterface $presenter
     * @param UserGateway $userGateway
     * @param AuthenticationGateway $authenticationGateway
     */
    public function __construct(
        FollowUserPresenterInterface $presenter,
        UserGateway $userGateway,
        AuthenticationGateway $authenticationGateway
    ) {
        $this->presenter = $presenter;
        $this->useCase = new FollowUser($userGateway, $authenticationGateway);
    }

    /**
     * Handle the incoming request.
     *
     * @param Request $request
     * @return JsonResponse
     */
    public function __invoke(Request $request)
    {
        $followRequest = new FollowUserRequest(Uuid::fromString($request->id));
        try {
            $this->useCase->execute($followRequest, $this->presenter);
        } catch (UserNotFoundException $e) {
            return new JsonResponse(null, 404);
        }
        return new JsonResponse(null, 204);
    }
}
