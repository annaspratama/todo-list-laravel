<?php

namespace Tests\Feature;

use Database\Seeders\UserSeeder;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class UserControllerTest extends TestCase
{
    /**
     * Test displaying login page.
     * 
     * @return void
     */
    public function testLoginPage(): void
    {
        $this->get(uri: '/login')
            ->assertSeeText(value: "Login");
    }

    /**
     * Test login for member.
     * 
     * @return void
     */
    public function testLoginPageForMember()
    {
        $this->withSession(data: [
            'username' => "annas"
        ])
            ->get(uri: '/login')
            ->assertRedirect(uri: '/');
    }

    /**
     * Test login success.
     * 
     * @return void
     */
    public function testLoginSuccess(): void
    {
        $this->seed(class: UserSeeder::class);

        $this->post(uri: '/login', data: [
            'username' => "annas@mail.com",
            'password' => "admin123"
        ])
            ->assertRedirect(uri: '/')
            ->assertSessionHas(key: 'username', value: "annas@mail.com");
    }

    /**
     * Test already login for authorized user.
     * 
     * @return void
     */
    public function testLoginForUserAlreadyLogin(): void
    {
        $this->withSession(data: [
            'username' => "annas"
        ])->post(uri: '/login', data: [
            'email' => "annas@mail.com",
            'password' => "admin123"
        ])->assertRedirect("/");
    }

    /**
     * Test login validation error.
     * 
     * @return void
     */
    public function testLoginValidationError(): void
    {
        $this->post(uri: "/login", data: [])
            ->assertSeeText(value: "Username or password is required");
    }

    /**
     * Test login is failed.
     * 
     * @return void
     */
    public function testLoginFailed(): void
    {
        $this->post(uri: '/login', data: [
            'username' => "anas",
            'password' => "admin123"
        ])->assertSeeText("Username or password is wrong");
    }

    /**
     * Test logout for authorized user.
     * 
     * @return void
     */
    public function testLogout(): void
    {
        $this->withSession(data: [
            'username' => "annas"
        ])
            ->post(uri: '/logout')
            ->assertRedirect(uri: '/login')
            ->assertSessionMissing(key: 'username');
    }

    /**
     * Test logout for guest.
     * 
     * @return void
     */
    public function testLogoutGuest(): void
    {
        $this->post(uri: '/logout')
            ->assertRedirect(uri: '/login');
    }
}