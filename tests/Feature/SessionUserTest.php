<?php

namespace Tests\Feature;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class SessionUserTest extends TestCase
{
    use WithFaker;
   // use RefreshDatabase;

    /** @test */
    public function test_users_can_authenticate()
    {
        $user = User::factory()->create();

        $response = $this->post('/api/user/login', [
            'email' => $user->email,
            'password' => 'password',
        ]);

        $this->assertAuthenticated($response);
        //$response->assertSuccessful();
    }
}
