<?php

namespace App\Http\Controllers;

use App\Http\Requests\ForgotPasswordRequest;
use App\Http\Requests\ResetPasswordRequest;
use App\Models\User;
use Illuminate\Auth\Events\PasswordReset;
use Illuminate\Contracts\Auth\CanResetPassword;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Password;
use Illuminate\Validation\ValidationException;


class PasswordController extends Controller
{
    public function sendResetLinkResponse(ForgotPasswordRequest $request) {
        // check if the email exists
        $user = User::where("email", $request->email)
                        ->first();
        if ($user == Null){
            $message = array(
                'message'=>'The email address is not registered'
            );
            return response()->json($message, 404);
        }


        //Store the mail in an array and send the message
        $input = array('email' => $request->email);
        $send = Password::sendResetLink($input);

        if ($send != Password::RESET_LINK_SENT){
            $message = array(
                'message' => "Could not send email to this address."
            );
            return response()->json($message, 200);
        }
        $message =array(
            'message' => "mail sent successfully"
        );

        return response()->json($message, 200);
    }

    public function reset(ResetPasswordRequest $request)
    {
        $request->validated();

        $status = Password::reset(
            $request->only('email', 'password', 'token'),
            function ($user) use ($request) {
                $user->forceFill([
                    'password' => bcrypt($request->password),
                ])->save();

                $user->tokens()->delete();

                event(new PasswordReset($user));
            }
        );

        if ($status == Password::PASSWORD_RESET) {
            return response([
                'message'=> 'Password reset successfully'
            ]);
        }

        return response([
            'message'=> __($status)
        ], 500);

    }
    public function sendResetResponse(ResetPasswordRequest $request){
        // Store the data in an array
        $input = array(
            'email' => $request->email,
            'token' => $request->token,
            'password' => $request->password,
        );

        // Make the password change
        $change = Password::reset($input, function($user, $password){
            $user->forceFill([
                'password'=>bcrypt($password)
            ])->save();
            event(new PasswordReset($user));
        });

        //Validate if the change was made
        if ($change != Password:: PASSWORD_RESET){
            $message = array(
                'message' => 'Unable to change password'
            );
            return response()->json($message,400);
        }
        $message = array(
            'message' => "Password change successful"
        );
        return response()->json($message);

    }

}
