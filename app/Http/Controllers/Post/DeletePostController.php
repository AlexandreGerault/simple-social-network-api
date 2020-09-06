<?php

namespace App\Http\Controllers\Post;

use App\Http\Controllers\Controller;
use Domain\SSN\Posts\Exceptions\PostNotFoundException;
use Domain\SSN\Posts\Gateway\PostGateway;
use Domain\SSN\Posts\UseCases\DeletePost\DeletePost;
use Domain\SSN\Posts\UseCases\DeletePost\DeletePostPresenterInterface;
use Domain\SSN\Posts\UseCases\DeletePost\DeletePostRequest;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Ramsey\Uuid\Uuid;

class DeletePostController extends Controller
{
    private DeletePost $useCase;
    private DeletePostPresenterInterface $presenter;

    public function __construct(PostGateway $gateway, DeletePostPresenterInterface $presenter)
    {
        $this->presenter = $presenter;
        $this->useCase = new DeletePost($gateway);
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
            $this->useCase->execute(
                new DeletePostRequest(Uuid::fromString($request->id)),
                $this->presenter
            );
            return new JsonResponse(null, 204);
        } catch (PostNotFoundException $exception) {
            return new JsonResponse(null, 404);
        }
    }
}
