<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\PasswordReset;
use App\Models\SalesEmployee;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;

class ForgotPasswordController extends Controller
{
    public function showForgotPasswordForm() {
    	return view('auth.forgot_password_form');
    }

    public function sendPasswordResetLink(Request $request) {
    	$request->validate(
    		['email' => 'required|email|exists:sales_employees'],
            ['email.exists' => 'The email id is not exists']
        );
        $otp = 123456;
        
        $password_reset = PasswordReset::create([
            'email' => $request->email, 
            'otp' => $otp, 
        ]);

        if($password_reset) {
            $url = url('forgot-password-otp').'/'.$request->email;

            Mail::send('auth.email', ['otp' => $otp], function($message) use($request){
                $message->to($request->email);
                $message->subject('Reset Password');
            });
            return redirect($url)->with('message', 'We have e-mailed OTP to your mail id!');
        }
    }

    public function showOtpForm($email) {
        return view('auth.password-reset-otp', ['email' => $email]);
    }

    public function verifyOtp(Request $request) {
        $request->validate([
            'otp' => 'required|digits:6'
        ]);

        $check_otp = PasswordReset::where('email', $request->email)->where('otp', $request->otp)->exists();
        if($check_otp) {
            $set_otp_null = PasswordReset::where('email', $request->email)->where('otp', $request->otp)->update(['otp' => NULL]);
            
            if($set_otp_null) {
                $url = url('reset-password').'/'.$request->email;
                return redirect($url);
            }
            
        } else {
            return redirect()->back()->withInput()->withErrors(['otp' => "Enter valid otp"]);
        }
    }

    public function showResetPasswordForm($email) {
        return view('auth.reset-password', ['email' => $email]);
        
    }

    public function resetPassword(Request $request) {
        $this->validate($request, [
            'email' => 'required|email',
            'password' => 'required|string|min:8|confirmed'
        ]);

        $admin = SalesEmployee::where('email', $request->email)->first();
        $check_otp = PasswordReset::where('email', $request->email)->where('otp', NULL)->exists();
        
        if($check_otp) {

            $update_password = $admin->update(['password' => Hash::make($request->password)]);
            if($update_password) {
                
                return redirect(url('login'))->with('message', 'Password reset success!');
            }
        } else {
            return redirect()->back()->withInput()->withErrors(['email' => "Enter valid email"]);
        }
    }
}
