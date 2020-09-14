<?php

namespace App\Http\Controllers\Post;

use App\Http\Controllers\Controller;
use App\JsonViews\NewsfeedJsonView;
use Domain\SSN\Auth\Gateway\AuthenticationGateway;
use Domain\SSN\Posts\Gateway\PostGateway;
use Domain\SSN\Posts\UseCases\ShowNewsfeed\ShowNewsfeed;
use Domain\SSN\Posts\UseCases\ShowNewsfeed\ShowNewsfeedPresenterInterface;
use Domain\SSN\Posts\UseCases\ShowNewsfeed\ShowNewsfeedRequest;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class ShowNewsfeedController extends Controller
{
    private ShowNewsfeed $useCase;
    private PostGateway $postGateway;
    private ShowNewsfeedPresenterInterface $presenter;

    /**
     * ShowNewsfeedController constructor.
     * @param AuthenticationGateway $authenticationGateway
     * @param PostGateway $postGateway
     * @param ShowNewsfeedPresenterInterface $presenter
     */
    public function __construct(
        AuthenticationGateway $authenticationGateway,
        PostGateway $postGateway,
        ShowNewsfeedPresenterInterface $presenter
    ) {
        $this->postGateway = $postGateway;
        $this->presenter = $presenter;
        $this->useCase = new ShowNewsfeed($authenticationGateway, $postGateway);
    }

    /**
     * Handle the incoming request.
     *
     * @param Request $request
     * @return JsonResponse
     */
    public function __invoke(Request $request)
    {
        $showNewsfeedRequest = new ShowNewsfeedRequest();
        $this->useCase->execute($showNewsfeedRequest, $this->presenter);

        return new JsonResponse(new NewsfeedJsonView($this->presenter->getViewModel()), 200);
    }
}
