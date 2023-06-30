<?php

namespace Database\Factories;

use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Collection>
 */
class CollectionFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'id'=>$this->faker->uuid(),
            'title'=>$this->faker->sentence(),
            'users_id'=>User::all()->random(number:1)->first()->id,
            'description'=>$this->faker->paragraph(),
            'update_at'=>now()
        ];
    }
}
