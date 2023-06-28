<?php

namespace App\Http\Middleware;

use App\Models\Image;
use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class Delete
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next,id): Response
    {
        Auth::check();
        $image = Image::where('id',$id);
        if (Auth::user()->id==$image->users_id) {
            return $next($request);
        } else {
            return response()->json(['message = Unauthorized'],401);
        }

    }
}
