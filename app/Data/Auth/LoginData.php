<?php

namespace App\Data\Auth;

use Spatie\LaravelData\Data;

class LoginData extends Data
{
    public function __construct(
        public readonly string $email,
        public readonly string $password
    ) {}

    public static function fromRequest($request): self
    {
        return new self(
            $request->input('email'),
            $request->input('password')
        );
    }
}
