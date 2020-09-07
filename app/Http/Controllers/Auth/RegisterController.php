<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\RegistrationRequest as LaravelRegistrationRequest;
use App\JsonViews\UserJsonView;
use App\Presenters\Auth\RegistrationPresenter;
use Assert\AssertionFailedException;
use Domain\SSN\Auth\Gateway\UserGateway;
use Domain\SSN\Auth\UseCases\Registration\Registration;
use Domain\SSN\Auth\UseCases\Registration\RegistrationRequest;
use Illuminate\Http\JsonResponse;

class RegisterController extends Controller
{
    private Registration $useCase;
    private RegistrationPresenter $presenter;

    /**
     * RegisterController constructor.
     * @param UserGateway $gateway
     * @param RegistrationPresenter $presenter
     */
    public function __construct(UserGateway $gateway, RegistrationPresenter $presenter)
    {
        $this->presenter = $presenter;
        $this->useCase = new Registration($gateway);
    }

    /**
     * Handle the incoming request.
     *
     * @param LaravelRegistrationRequest $request
     * @return JsonResponse
     * @throws AssertionFailedException
     */
    public function __invoke(LaravelRegistrationRequest $request): JsonResponse
    {
        $registrationRequest = new RegistrationRequest(
            $request->get('username'),
            $request->get('email'),
            $request->get('password'),
            $request->get('passwordConfirmation')
        );

        $this->useCase->execute($registrationRequest, $this->presenter);
        $jsonView = new UserJsonView($this->presenter->getViewModel());

        return new JsonResponse($jsonView, 201);
    }
}
