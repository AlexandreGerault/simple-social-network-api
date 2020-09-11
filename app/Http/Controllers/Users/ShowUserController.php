<?php

namespace App\Http\Controllers\Users;

use App\Http\Controllers\Controller;
use App\JsonViews\Errors\UserNotFoundJsonView;
use App\JsonViews\UserWithPostsJsonView;
use Domain\SSN\Auth\Exceptions\UserNotFoundException;
use Domain\SSN\Auth\Gateway\UserGateway;
use Domain\SSN\Users\UseCases\ShowUser\ShowUser;
use Domain\SSN\Users\UseCases\ShowUser\ShowUserPresenterInterface;
use Domain\SSN\Users\UseCases\ShowUser\ShowUserRequest;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Ramsey\Uuid\Uuid;

class ShowUserController extends Controller
{
    private ShowUser $useCase;
    private UserGateway $gateway;
    private ShowUserPresenterInterface $presenter;

    /**
     * ShowUserController constructor.
     * @param UserGateway $gateway
     * @param ShowUserPresenterInterface $presenter
     */
    public function __construct(UserGateway $gateway, ShowUserPresenterInterface $presenter)
    {
        $this->presenter = $presenter;
        $this->gateway = $gateway;
        $this->useCase = new ShowUser($this->gateway);
    }

    /**
     * Handle the incoming request.
     *
     * @param Request $request
     * @return JsonResponse
     */
    public function __invoke(Request $request)
    {
        $showUserRequest = new ShowUserRequest(Uuid::fromString($request->id));

        try {
            $this->useCase->execute($showUserRequest, $this->presenter);
        } catch (UserNotFoundException $e) {
            return new JsonResponse(["errors" => [ new UserNotFoundJsonView()]], 404);
        }

        return new JsonResponse(new UserWithPostsJsonView($this->presenter->getViewModel()), 200);
    }
}
