<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
use Illuminate\Validation\Rule;
use App\Models\Admin; 
use Mail;
use Str;
use App\Mail\PasswordResetLinkMail;
use Hash;

class AuthController extends Controller
{
    public function login() {
            if(Auth::check()) {
                // return redirect('user/dashboard');

            }elseif(Auth::guard('admin')->check()) {
                return redirect('admin/dashboard');
            }

        return view('backend.auth.login');
    }

    
    public function authLogin(Request $request) {
        $this->validate($request, [
            'email' => 'required',
            'password' => 'required|min:8|max:25',
        ]);

        $remember = !empty($request->remember) ? true : false;

        if(Auth::attempt(['email' => $request->email, 'password' => $request->password], $remember)) {
            // return redirect('user/dashboard');

        }else if(Auth::guard("admin")->attempt(['email' => $request->email, 'password' => $request->password], $remember)) {
            return redirect('admin/dashboard');

        }else {
            return redirect()->back()->with('error', 'Incorrect email or password.');
        }
 
    }

    public function showForgotPasswordForm() {
        return view('backend.auth.forgot-password');
    }

    public function forgotPassword(Request $request) {
        $this->validate($request, [
            'email' => ['required', 'email', 'max:255', Rule::exists(Admin::class, 'email')],
        ]);

        $admin = Admin::where('email', '=', $request->email)->first();

        if(!empty($admin)) {
            $admin->remember_token = Str::random(30);
            $admin->save();

            Mail::to($admin->email)->send(new PasswordResetLinkMail($admin));

            return redirect()->back()->with("success", "Password reset link sent successfully. Please check your email.");

        }else {
            return redirect()->back()->with("error", "This email doesn't exist. Enter a different email.");
        }

    }

    public function showResetPasswordForm($remember_token) {
        $admin = Admin::where('remember_token', '=', $remember_token)->first();

        if(!empty($admin)) {
            return view('backend.auth.reset-password');

        }else {
            abort(404);
        }
    }

    public function resetPassword($remember_token, Request $request) {
        $this->validate($request, [
            'password' => 'required|min:8|max:25',
            'confirm_password' => 'required|min:8|max:25',
        ]);

        if($request->password == $request->confirm_password) {
            $admin = Admin::where('remember_token', '=', $remember_token)->first();

            $admin->password = Hash::make($request->password);
            $admin->remember_token = Str::random(30);
            $admin->save();

            return redirect(url('/'))->with("success", "Your password has been changed successfully.");

        }else {
            return redirect()->back()->with("error", "The password and confirm password don't match.");
        }
    }

    public function logout() {
        if(Auth::check()) {
            Auth::logout();
            return redirect(url('/'));

        }elseif(Auth::guard('admin')->check()) {
            Auth::guard('admin')->logout();
            return redirect(url('/'));
        }
     
    }
}
