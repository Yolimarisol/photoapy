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

        $this->post('api/user/register', $attributes)->assertCreated()->assertValid();;
    }

    /** @test */

    public function a_user_requires_a_name()
    {
        $attributes = User::factory()->raw(['name'=>'']);
        $this->post('api/user/register', [$attributes])->assertSessionHasErrors('name');
    }

    /** @test */

    public function a_user_requires_a_email()
    {
        $attributes = User::factory()->raw(['email'=>'']);
        $this->post('api/user/register', [$attributes])->assertSessionHasErrors('email');
    }

    /** @test */

    public function a_user_requires_a_password()
    {
        $attributes = User::factory()->raw(['password'=>'']);
        $this->post('api/user/register', [$attributes])->assertSessionHasErrors('password');
    }
}
