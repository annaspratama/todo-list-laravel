<?php

namespace Tests\Feature;

use App\Services\UserService;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class UserServiceTest extends TestCase
{
    private UserService $userService;

    /**
     * Setup the test.
     * 
     * @return void
     */
    protected function setUp(): void
    {
        parent::setUp();

        $this->userService = $this->app->make(UserService::class);
    }

    /**
     * Test login success.
     * 
     * @return void
     */
    public function testLoginSuccess(): void
    {
        self::assertTrue($this->userService->login(username: "annas", password: "admin123"));
    }

    /**
     * Test login user that is user not found.
     * 
     * @return void
     */
    public function testLoginUserNotFound(): void
    {
        self::assertFalse($this->userService->login(username: "anas", password: "admin123"));
    }

    /**
     * Test login user that is password is wrong.
     * 
     * @return void
     */
    public function testLoginWrongPassword(): void
    {
        self::assertFalse($this->userService->login(username: "annas", password: "admin124"));
    }
}
