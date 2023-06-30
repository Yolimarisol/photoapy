<?php

namespace Database\Factories;

use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Image>
 */
class ImageFactory extends Factory
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
            'path'=>$this->faker->image($dir = 'img', $width = 640, $height = 480) ,
            'disk'=>config('filesystems.default'),
            'updated_at'=>now()
        ];
    }
}
