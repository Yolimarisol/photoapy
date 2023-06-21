<?php

namespace Tests\Feature;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Support\Str;
use Tests\TestCase;

class RegisterUserTest extends TestCase
{
    use WithFaker;
   // use RefreshDatabase;

    /** @test */
    public function user_can_register()
    {
        $this->withoutExceptionHandling();
        $attributes = [
            'name' => fake()->name(),
            'email' => fake()->unique()->safeEmail(),
            'password' => 'password',
        ];

        $this->post('api/user/register', $attributes)->assertCreated();
    }

}
