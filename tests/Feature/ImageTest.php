<?php

namespace Tests\Feature;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Http\UploadedFile;
use Tests\TestCase;

class ImageTest extends TestCase
{
    use WithFaker;
    /** @test */
    // public function user_can_store_image()
    // {
    //     $this->withoutExceptionHandling();
    //    // $image=UploadedFile::fake()->image('img.jpg');
    //     $attributes = [
    //         'title'=>fake()->title(),
    //         'users_id'=> function(){
    //                 return User::factory()->create()->id;
    //                 },
    //         'description'=>fake()->paragraph(),

    //         'path'=>$image,
    //         'disk'=>config('filesystems.default'),
    //     ];

    //     $this->post('api/image/store', $attributes)->assertCreated()->assertValid();
    // }
}
