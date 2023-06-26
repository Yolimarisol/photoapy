<?php

namespace App\Http\Controllers;

use App\Http\Requests\NewImageRequest;
use App\Models\Image;
use GuzzleHttp\Promise\Create;
use Illuminate\Http\Request;

class ImageController extends Controller
{
    public function store(NewImageRequest $request)
    {
        if ($request->hasFile("path")) {
            $file = $request->file("path");
            $imageName = time() . '_' . $file->getClientOriginalName();
            $path =public_path('img/');
            $file->move($path, $imageName);

            $owner = auth()->id();
            $img = [
                'title'=>$request->title,
                'users_id'=>$owner,
                'description'=>$request->description,
                'path'=>$path,
                'disk'=>config('filesystems.default'),
            ];

            $title =Image::where('title',$request->title)->first();
            $change =$img(['title']);
            $i =0;

            while ($title == $change) {
                $i = $i+1;
                $change= $change.'('.$i.')';
                $img(['title'=>$change]);
            }
            $image = Image::create($img);
            $message = [
                'message'=> 'You have uploaded your image successfully, now you can see it in your gallery'
            ];

            return response()->json($message,201);
        }
    }
}
