<?php

namespace App\Http\Controllers;

use App\Http\Requests\NewImageRequest;
use App\Http\Requests\UpdateImageRequest;
use App\Models\ActivityLog;
use App\Models\Image;
use DateTime;
use illuminate\Support\Str;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Response;
use GuzzleHttp\Promise\Create;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class ImageController extends Controller
{
    public function store(NewImageRequest $request)
    {
        if ($request->hasFile("path")) {
            $file = $request->file("path");
            $extension=$file->extension();
            $imageName = Str::slug($request->title).".".$extension;
            $file->move('img/', $imageName);
            $path = public_path('img/'. $imageName);

            $owner = auth()->id();
            $img = [
                'title'=>$request->title,
                'users_id'=>$owner,
                'description'=>$request->description,
                'path'=>$path,
                'image'=>$imageName,
                'disk'=>config('filesystems.default'),
            ];

            $image = Image::create($img);
            $message = [
                'message'=> 'You have uploaded your image successfully, now you can see it in your gallery'
            ];
            $activity= [
                'users_id'=>$owner,
                'description'=>'You have created a new image: '. $image->image
            ];
            $activities = ActivityLog::create($activity);

            return response()->json($message,201);
        }
    }

    public function index()
    {
        $image = Image::all();
        return response()->json($image);
    }
    public function show($id)
    {

        $image=Image::where("images.id", '=',$id)
                        ->select(
                            'images.id',
                            'images.title',
                            'images.users_id',
                            'images.description',
                            'images.path',
                            'images.image',
                            'images.disk',
                            'users.name AS users'
                        )
                        ->join("users","images.users_id","=","users.id")
                        ->first();

        if ($image== null){
            $mensaje= array('error'=>'Image not found');
            return response()->json($mensaje,404);
            }
        return response()->json($image);
    }

    public function showImage(Request $request)
    {
        $imageName = Str::slug($request->title);
        $path = public_path('img/'. $imageName);
        if(file_exists($path) == false){
            abort(404);
        }
        $img = File::get($path);
        $type = File::mimeType($path);
        $response=Response::make($img,200);
        $response->header("Content-Type", $type);
        return $response;
    }

    public function update(UpdateImageRequest $request,$id)
    {
        $changes=0;
        $current = new DateTime();

        $image= Image::where("id", $id)->first();

        if ($request->title != null){
            $image->title = $request->title;
            $changes++;
        }
        if ($request->description != null){
            $image->description = $request->description;
            $changes++;
        }

        if ($request->has('path') != null){
            $file = $request->file("path");
            $extension=$file->extension();
            $imageName = Str::slug($request->title).".".$extension;
            $file->move('img/', $imageName);
            $path = public_path('img/'. $imageName);
            $image->path = $path;
            $image->image=$imageName;
            $changes++;
        }
        if ($changes>0){
            $image->updated_at = $current;
            $image->disk= config('filesystems.default');
            }

        $image->save();
        $owner = auth()->id();
        $activity= [
            'users_id'=>$owner,
            'description'=>'You have updated a image: '. $image->title
        ];
        $activities = ActivityLog::create($activity);

        $message =array(
            'message'=> "Successful update",
            'image'=>$image
        );


        return response()->json($message);
    }

    public function delete($id)
    {
        $image = Image::findOrFail($id);
        Storage::disk(config('filesystems.default'))->delete($image->image);
        $image->delete();

        $owner = auth()->id();
        $activity= [
            'users_id'=>$owner,
            'description'=>'You have deleted a image: '. $image->title
        ];

        $activities = ActivityLog::create($activity);

        $message=[
            'data' => $image,
            'message' => 'Record Deleted',
        ];

        return response()->json($message);
    }
}
