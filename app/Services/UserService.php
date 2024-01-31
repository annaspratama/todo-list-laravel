<?php

namespace App\Services;

interface UserService
{
    /**
     * Logging in authorized user.
     * 
     * @param string $username
     * @param string $password
     * @return bool
     */
    public function login(string $email, string $password): bool;
}