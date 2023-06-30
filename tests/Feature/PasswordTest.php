<?php

namespace Tests\Feature;

use App\Http\Requests\ResetPasswordRequest;
use App\Models\User;
use App\Notifications\ResetPasswordNotification;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Notifications\Notification;
use Laravel\Sanctum\Sanctum;
use Tests\TestCase;

class PasswordTest extends TestCase
{
    use WithFaker;

    /** @test */
    public function test_users_can_request_password_change()
    {
        $user = User::factory()->create();
        $response = $this->post('/api/user/forgot-password',['email'=> $user->email]);
        $response->assertOk();
    }

    /** @test */

    // public function test_users_cant_change_password()
    // {
    //     $user = User::factory()->create();
    //     $response = $this->post('api/user/reset-password',['email'=>$user->email, 'password' =>'sanctumla']);

    //     $response->assertUnauthorized();
    // }
}

