<?php

namespace App\Services;

use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use Tymon\JWTAuth\Facades\JWTAuth;
use Illuminate\Validation\ValidationException;
use App\Data\Auth\LoginData;
use App\Data\Auth\RegisterData;
use App\Enums\Roles;

class AuthService
{
    public function register(RegisterData $data): string
    {
        $user = User::create([
            'name' => $data->name,
            'email' => $data->email,
            'password' => Hash::make($data->password),
            'role_id' => Roles::CLIENT,
        ]);

        return Auth::login($user);
    }

    public function login(LoginData $data): string
    {
        $credentials = ['email' => $data->email, 'password' => $data->password];

        if (!JWTAuth::attempt($credentials)) {
            throw ValidationException::withMessages([
                'The provided credentials are incorrect.'
            ]);
        }

        return auth('api')
            ->claims(['role' => auth('api')->user()->role->name])
            ->attempt($credentials);
    }

    public function refresh(): string
    {
        return Auth::refresh();
    }

    public function logout(): void
    {
        Auth::logout();
    }
}
