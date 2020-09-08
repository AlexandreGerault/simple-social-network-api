<?php

namespace App\Http\Controllers\Users;

use App\Http\Controllers\Controller;
use App\JsonViews\UserCollectionJsonView;
use Domain\SSN\Auth\Gateway\UserGateway;
use Domain\SSN\Users\UseCases\SearchUser\SearchUser;
use Domain\SSN\Users\UseCases\SearchUser\SearchUserPresenterInterface;
use Domain\SSN\Users\UseCases\SearchUser\SearchUserRequest;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class SearchUserController extends Controller
{
    private SearchUser $useCase;
    private UserGateway $gateway;
    private SearchUserPresenterInterface $presenter;

    /**
     * SearchUserController constructor.
     * @param UserGateway $gateway
     * @param SearchUserPresenterInterface $presenter
     */
    public function __construct(UserGateway $gateway, SearchUserPresenterInterface $presenter)
    {
        $this->gateway = $gateway;
        $this->presenter = $presenter;
        $this->useCase = new SearchUser($this->gateway);
    }


    /**
     * Handle the incoming request.
     *
     * @param Request $request
     * @return JsonResponse
     */
    public function __invoke(Request $request)
    {
        $searchRequest = new SearchUserRequest($request->get('search'));
        $this->useCase->execute($searchRequest, $this->presenter);
        return new JsonResponse(new UserCollectionJsonView($this->presenter->getViewModel()), 200);
    }
}
