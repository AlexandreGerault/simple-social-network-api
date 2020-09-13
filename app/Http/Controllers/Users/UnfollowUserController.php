<?php

namespace App\Http\Controllers\Users;

use App\Http\Controllers\Controller;
use Domain\SSN\Auth\Exceptions\UserNotFoundException;
use Domain\SSN\Auth\Gateway\AuthenticationGateway;
use Domain\SSN\Auth\Gateway\UserGateway;
use Domain\SSN\Users\UseCases\UnfollowUser\UnfollowUser;
use Domain\SSN\Users\UseCases\UnfollowUser\UnfollowUserPresenterInterface;
use Domain\SSN\Users\UseCases\UnfollowUser\UnfollowUserRequest;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Ramsey\Uuid\Uuid;

class UnfollowUserController extends Controller
{
    private UnfollowUser $useCase;
    private UnfollowUserPresenterInterface $presenter;

    /**
     * UnfollowUserController constructor.
     * @param UserGateway $userGateway
     * @param AuthenticationGateway $authenticationGateway
     * @param UnfollowUserPresenterInterface $presenter
     */
    public function __construct(
        UserGateway $userGateway,
        AuthenticationGateway $authenticationGateway,
        UnfollowUserPresenterInterface $presenter
    ) {
        $this->presenter = $presenter;
        $this->useCase = new UnfollowUser($userGateway, $authenticationGateway);
    }

    /**
     * Handle the incoming request.
     *
     * @param Request $request
     * @return JsonResponse
     */
    public function __invoke(Request $request)
    {
        try {
            $unfollowRequest = new UnfollowUserRequest(Uuid::fromString($request->id));
            $this->useCase->execute($unfollowRequest, $this->presenter);
        } catch (UserNotFoundException $exception) {
            return new JsonResponse([
                'data' => [
                    'error' => 'Vous ne pouvez pas suivre un utilisateur inexistant'
                ]
            ], 404);
        }

        return new JsonResponse([
            "data" => ["message" => "Vous suivez " . $this->presenter->getViewModel()->getUsername()]
        ], 204);
    }
}
