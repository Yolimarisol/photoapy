<?php

namespace App\Http\Controllers;

use App\Http\Requests\RegisterUserRequest;
use App\Models\User;
use Illuminate\Http\Request;

class RegisterUserController extends Controller
{
    public function register(RegisterUserRequest $request)
    {
        $data = array(
            'name'=> $request->name,
            'email'=> $request->email,
            'password'=> bcrypt($request->password),
        );
        $newUser = User::create($data);
        $message = array(
            'message'=> 'Registered user successfully'
        );

        return response()->json($message,201);
    }
}
