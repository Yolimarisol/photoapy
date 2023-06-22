<?php

namespace Tests\Feature;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class PasswordTest extends TestCase
{
    /** @test */
    public function test_users_can_loguot()
    {
        $user = User::factory()->create();

        $response = $this->post('/api/user/login', [
            'email' => $user->email,
            'password' => 'password',
        ]);
        $attributes = $user->email;
        $this->get('/api/user/forgot-password')->assertOk();
    }
}
