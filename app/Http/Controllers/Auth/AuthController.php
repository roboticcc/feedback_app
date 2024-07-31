<?php

namespace App\Http\Controllers\Auth;

use App\Data\Auth\LoginData;
use App\Data\Auth\RegisterData;
use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\LoginRequest;
use App\Http\Requests\Auth\RegisterRequest;
use App\Services\AuthService;
use Illuminate\Http\Response;
use Symfony\Component\HttpFoundation\Response as ResponseAlias;

class AuthController extends Controller
{
    public function __construct(
        private AuthService $authService
    )
    {
        $this->middleware('auth:api', ['except' => ['login', 'register']]);
    }

    public function register(RegisterRequest $request): Response
    {
        $token = $this->authService->register(RegisterData::fromRequest($request));

        return response([
            'token' => $token,
            'type' => 'bearer',
        ]);
    }

    public function login(LoginRequest $request): Response
    {
        $token = $this->authService->login(LoginData::fromRequest($request));

        return response([
            'token' => $token,
            'type' => 'bearer',
        ]);
    }

    public function refresh(): Response
    {
        $token = $this->authService->refresh();

        return response([
            'token' => $token,
            'type' => 'bearer',
        ]);
    }

    public function logout(): Response
    {
        $this->authService->logout();

        return response(null, ResponseAlias::HTTP_NO_CONTENT);
    }
}
