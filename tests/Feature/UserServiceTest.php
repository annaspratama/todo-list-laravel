<?php

namespace Tests\Feature;

use App\Services\UserService;
use Database\Seeders\UserSeeder;
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
        $this->seed(class: UserSeeder::class);

        self::assertTrue(condition: $this->userService->login(email: "annas@mail.com", password: "admin123"));
    }

    /**
     * Test login user that is user not found.
     * 
     * @return void
     */
    public function testLoginUserNotFound(): void
    {
        self::assertFalse($this->userService->login(email: "anas", password: "admin123"));
    }

    /**
     * Test login user that is password is wrong.
     * 
     * @return void
     */
    public function testLoginWrongPassword(): void
    {
        self::assertFalse($this->userService->login(email: "annas", password: "admin124"));
    }
}
