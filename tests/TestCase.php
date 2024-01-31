<?php

namespace Tests;

use Illuminate\Foundation\Testing\TestCase as BaseTestCase;
use Illuminate\Support\Facades\DB;

abstract class TestCase extends BaseTestCase
{
    use CreatesApplication;

    /**
     * Setup for all tests.
     * 
     * @return void
     */
    protected function setUp(): void
    {
        parent::setUp();
        
        DB::delete(query: 'DELETE FROM users');
        DB::delete(query: 'DELETE FROM todos');
    }
}
