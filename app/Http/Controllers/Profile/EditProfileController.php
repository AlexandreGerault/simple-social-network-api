<?php

namespace App\Http\Controllers\Profile;

use App\Http\Controllers\Controller;
use App\Http\Requests\EditProfileFormRequest;
use App\JsonViews\UserJsonView;
use Domain\SSN\Auth\Gateway\UserGateway;
use Domain\SSN\Auth\UseCases\EditProfile\EditProfile;
use Domain\SSN\Auth\UseCases\EditProfile\EditProfilePresenterInterface;
use Domain\SSN\Auth\UseCases\EditProfile\EditProfileRequest;
use Illuminate\Http\JsonResponse;
use Ramsey\Uuid\Uuid;

class EditProfileController extends Controller
{
    private EditProfile $useCase;
    private EditProfilePresenterInterface $presenter;

    /**
     * EditProfileController constructor.
     * @param UserGateway $gateway
     * @param EditProfilePresenterInterface $presenter
     */
    public function __construct(UserGateway $gateway, EditProfilePresenterInterface $presenter)
    {
        $this->presenter = $presenter;
        $this->useCase = new EditProfile($gateway);
    }

    /**
     * Handle the incoming request.
     *
     * @param EditProfileFormRequest $request
     * @return JsonResponse
     */
    public function __invoke(EditProfileFormRequest $request)
    {
        $updateProfileRequest = new EditProfileRequest(
            Uuid::fromString($request->id),
            $request->get('username'),
            $request->get('email')
        );
        $this->useCase->execute($updateProfileRequest, $this->presenter);

        return new JsonResponse(
            new UserJsonView($this->presenter->getViewModel()),
            200
        );
    }
}
