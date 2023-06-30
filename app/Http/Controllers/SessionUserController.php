<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class SessionUserController extends Controller
{
    public function login(Request $request)
    {
        $credentials = request(['email','password']);
        if ( Auth::attempt($credentials)== false) {
            $message = array(
                'message'=>'Incorrect credentials'
            );
            return response()->json($message,401);
        }
        $user = User::where('email',$credentials)->firstOrFail();
        $token = $user->createToken('auth_token')->plainTextToken;

        $response= array(
            'message'=>'Hi '.$user->name,
            'accessToken'=>$token,
            'token_type'=>'Bearer',
            'user'=>$user
        );

        return response()->json($response);
    }

    public function logout()
    {
        auth()->user()->tokens()->delete();
        $message = ['message'=>'You have successfully logged out'];

        return response()->json($message);
    }
}
