<?php

namespace App\Http\Controllers;

use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Str;

class ForgetController extends Controller
{
    /* controller for forget password page */
    function forgetPassword(){
        return view("auth/forget-password"); //get route to open forget password page
    }

    /* Controller for submit in forget password page */
    function forgetPasswordPost(Request $request){

        // Check if the email exists in the users' database if didnt exists send error messages
        $user = User::where('email', $request->email)->first();
        if (!$user) {
            return redirect()->route('forget.password')->with('warning', 'Email does not exist in our database');
        }

        // Check if a recent token already exists for the given email if not send a random token
        $existingToken = DB::table('password_reset_tokens')
            ->where('email', $request->email)
            ->first();

         // Check if a recent token exists and if the email was sent within a reasonable time frame
        if ($existingToken && Carbon::parse($existingToken->created_at)->addMinutes(config('auth.passwords.users.expire')) > now()) {
            return redirect()->route('forget.password')->with('warning', 'Reset request already sent wait 2 minute to send again');
        }

        // Generate a new token and send the reset email
        $token = $existingToken ? $existingToken->token : Str::random(64);

        DB::table("password_reset_tokens")
        ->updateOrInsert(
            ['email' => $request->email],
            ['token' => $token, 'created_at' => Carbon::now()]
        );

        // method to send email with token included -> email set in the .env
        Mail::send("email.email-password", ['token' => $token], function ($message) use ($request){
            $message->to($request->email);
            $message->subject("Reset Password");
        });

        return redirect()->route("forget.password")->with("success", "We have sent an email to reset the password."); //success messages when email sent
    }

    /* Controller for reset password page (link get from button in email message) */
    function resetPassword($token){
        // get the email from the reset token
        $email = DB::table('password_reset_tokens')
            ->where('token', $token)
            ->value('email');

        if (!$email) {
            // Handle the case where the token is invalid or expired
            return redirect()->route("forget.password")->with("error", "Invalid or expired token");
        }

        // sent the token and email value to the reset password form page
        return view("email.newPassword", compact('token', 'email'));
    }

    /* Controller for submit in reset password page */
    function resetPasswordPost(Request $request){
        $request->validate([
            "token" => "required",
            "email" => "required|email|exists:users,email",
            "password" => "required|min:6|confirmed",
        ]);

        //Get user with email as $user
        $user =  User::where("email", $request->email)->first();

        // Hash the new password
        $hashedPassword = Hash::make($request->password);

        // update password with new Hashed password
        $user->update([
            'password'=> $hashedPassword
        ]);

        // delete token
        DB::table("password_reset_tokens")->where([
            "email" => $request->email,
        ])->delete();

        return redirect()->route("login")->with("success", "Password reset successful");
    }
}
