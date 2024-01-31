<?php

namespace App\Services\Implements;

use App\Services\UserService;
use Illuminate\Support\Facades\Auth;

class UserServiceImplement implements UserService
{
    public function login(string $email, string $password): bool
    {
        return Auth::attempt(credentials: [
            'email' => $email,
            'password' => $password
        ], remember: true);
    }
}