<?php

namespace App\Http\Controllers;

use App\Models\ActivityLog;
use Illuminate\Http\Request;

class ActivityLogController extends Controller
{
    public function listmyactivities()
    {
        $user = auth()->id();
        $activities = ActivityLog::where("users.id", '=',$user)
        ->select(
            'activity_logs.users_id',
            'activity_logs.description',
            'activity_logs.created_at',
            'activity_logs.updated_at',
            'users.name AS users'
        )
        ->orderBy('created_at', 'desc')
        ->join("users","activity_logs.users_id","=","users.id");
        $activities= $activities->get();
            return response()->json($activities);
    }
}
