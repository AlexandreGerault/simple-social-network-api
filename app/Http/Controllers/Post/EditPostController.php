<?php

namespace App\Http\Controllers\Post;

use App\Http\Controllers\Controller;
use App\Http\Requests\EditPostRequest as EditPostFormRequest;
use App\JsonViews\PostJsonView;
use Domain\SSN\Posts\Exceptions\PostNotFoundException;
use Domain\SSN\Posts\Gateway\PostGateway;
use Domain\SSN\Posts\UseCases\EditPost\EditPost;
use Domain\SSN\Posts\UseCases\EditPost\EditPostPresenterInterface;
use Domain\SSN\Posts\UseCases\EditPost\EditPostRequest;
use Illuminate\Http\JsonResponse;
use Ramsey\Uuid\Uuid;

class EditPostController extends Controller
{
    private PostGateway $gateway;
    private EditPost $useCase;
    private EditPostPresenterInterface $presenter;

    public function __construct(PostGateway $gateway, EditPostPresenterInterface $presenter)
    {
        $this->gateway = $gateway;
        $this->presenter = $presenter;
        $this->useCase = new EditPost($this->gateway);
    }

    /**
     * Handle the incoming request.
     *
     * @param EditPostFormRequest $request
     * @return JsonResponse
     * @throws PostNotFoundException
     */
    public function __invoke(EditPostFormRequest $request): JsonResponse
    {
        $editPostRequest = new EditPostRequest(
            Uuid::fromString($request->id),
            $request->get('content')
        );
        $this->useCase->execute($editPostRequest, $this->presenter);

        return new JsonResponse(new PostJsonView($this->presenter->getViewModel()), 200);
    }
}
