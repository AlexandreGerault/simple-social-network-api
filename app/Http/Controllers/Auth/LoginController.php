<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\JsonViews\UserJsonView;
use Domain\SSN\Auth\Exceptions\InvalidCredentialsException;
use Domain\SSN\Auth\Exceptions\UserNotFoundException;
use Domain\SSN\Auth\Gateway\UserGateway;
use Domain\SSN\Auth\UseCases\Login\Login;
use Domain\SSN\Auth\UseCases\Login\LoginPresenterInterface;
use Domain\SSN\Auth\UseCases\Login\LoginRequest;
use Illuminate\Auth\AuthManager;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class LoginController extends Controller
{
    private UserGateway $gateway;
    private LoginPresenterInterface $presenter;
    private Login $useCase;
    private AuthManager $auth;

    /**
     * LoginController constructor.
     * @param UserGateway $gateway
     * @param LoginPresenterInterface $presenter
     * @param AuthManager $auth
     */
    public function __construct(
        UserGateway $gateway,
        LoginPresenterInterface $presenter,
        AuthManager $auth
    ) {
        $this->gateway = $gateway;
        $this->presenter = $presenter;
        $this->useCase = new Login($this->gateway);
        $this->auth = $auth;
    }


    /**
     * Handle the incoming request.
     *
     * @param Request $request
     * @return JsonResponse
     */
    public function __invoke(Request $request): JsonResponse
    {
        $loginRequest = new LoginRequest(
            $request->get('email'),
            $request->get('password')
        );

        try {
            $this->useCase->execute($loginRequest, $this->presenter);
            $this->auth->guard()->attempt([
                'email' => $loginRequest->getEmail(),
                'password' => $loginRequest->getPlainPassword()
            ]);
            $jsonView = (new UserJsonView($this->presenter->getViewModel()))->asArray();
        } catch (InvalidCredentialsException $e) {
            return new JsonResponse(['errors' =>
                [
                    'title' => 'Invalid credentials',
                    'details' => 'No user found with these credentials',
                    'status' => 'Bad request'
                ]
            ], 401, []);
        } catch (UserNotFoundException $e) {
            return new JsonResponse(['errors' =>
                [
                    'title' => 'User not found',
                    'details' => 'No user has been found for the email ' . $loginRequest->getEmail(),
                    'status' => 'Resource not found',
                ]
            ], 404, []);
        }

        return new JsonResponse($jsonView, 200);
    }
}
