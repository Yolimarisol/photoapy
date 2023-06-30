<?php

namespace App\Http\Controllers;

use App\Http\Requests\NewCollectionRequest;
use App\Http\Requests\UpdateCollectionRequest;
use App\Models\ActivityLog;
use App\Models\Collection;
use DateTime;
use Illuminate\Http\Request;

class CollectionController extends Controller
{
    public function create(NewCollectionRequest $request)
    {
        $owner = auth()->id();
        $data=[
            'title'=>$request->title,
            'description'=>$request->description,
            'users_id'=>$owner
        ];
        $newCollection=Collection::create($data);
        $activity= [
            'users_id'=>$owner,
            'description'=>'You have created a new collection: '. $request->title
        ];
        $activities = ActivityLog::create($activity);

        $message = [
            'message'=>'Collection created successfully',
        ];
        return response()->json($message,201);
    }

    public function addImage(Request $request,$id)
    {
        $collection= Collection::where("id", $id)->first();
        $collection->images()->attach($id);
    }

    public function index(Collection $collection)
    {
        return $collection->images;
    }

    public function show()
    {

    }

    public function update(UpdateCollectionRequest $request,$id)
    {
        $changes=0;
        $current = new DateTime();

        $collection= Collection::where("id", $id)->first();
        if ($request->title != null){
            $collection->title = $request->title;
            $changes++;
        }
        if ($request->description != null){
            $collection->description = $request->description;
            $changes++;
        }
        if ($changes>0){
            $collection->updated_at = $current;
        }
        $owner = auth()->id();
        $activity= [
            'users_id'=>$owner,
            'description'=>'You have updated a collection: '. $collection->title
        ];

        $activities = ActivityLog::create($activity);

        $collection->save();

        $message =array(
            'message'=> "Successful update",
            'collection'=>$collection
        );

        return response()->json($message);
    }

    public function delete($id)
    {
        $collection = Collection::findOrFail($id);

        $collection->delete();

        $owner = auth()->id();
        $activity= [
            'users_id'=>$owner,
            'description'=>'You have deleted a collection: '. $collection->title
        ];

        $activities = ActivityLog::create($activity);
        $message=[
            'data' => $collection,
            'message' => 'Record Deleted',
        ];

        return response()->json($message);
    }
}
