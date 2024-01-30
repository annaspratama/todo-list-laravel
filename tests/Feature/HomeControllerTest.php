<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class HomeControllerTest extends TestCase
{
    /**
     * Test home for guest.
     * 
     * @return void
     */
    public function testGuest(): void
    {
        $this->get(uri: '/')
            ->assertRedirect(uri: '/login');
    }

    /**
     * Test home for member.
     * 
     * @return void
     */
    public function testMember(): void
    {
        $this->withSession([
            'username' => "annas"
        ])
            ->get(uri: '/')
            ->assertRedirect(uri: '/todolist');
    }
}
