<?php

namespace App\Services\Implements;

use App\Services\UserService;

class UserServiceImplement implements UserService
{

    private array $users = [
        "annas" => "admin123"
    ];

    public function login(string $username, string $password): bool
    {
        if (!isset($this->users[$username])) {
            return false;
        }

        $correctPassword = $this->users[$username];

        return $password == $correctPassword;
    }
}