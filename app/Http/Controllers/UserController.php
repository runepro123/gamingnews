<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;

class UserController extends Controller
{
    public function showUserLoginForm() {
        $data['headerTitle'] = 'Login';

        return view('frontend.auth.login', $data);
    }

    public function showUserRegistrationForm() {
        $data['headerTitle'] = 'Registration';

        return view('frontend.auth.registration', $data);
    }

    public function showUserForgotPasswordForm() {
        $data['headerTitle'] = 'Forgot Password';

        return view('frontend.auth.forgot-password', $data);
    }

    public function showUserVerifyOTPForm() {
        $data['headerTitle'] = 'Forgot Password';

        return view('frontend.auth.verify-otp', $data);
    }

    public function showUserResetPasswordForm() {
        $data['headerTitle'] = 'Reset Password';

        return view('frontend.auth.reset-password', $data);
    }

    public function showUserProfile() {
        $data['headerTitle'] = 'Profile';

        return view('frontend.auth.profile', $data);
    }

    public function userList() {
        $data['headerTitle'] = 'User List';
        $data['users'] = User::latest()->get();

        return view('backend.admin.users.index', $data);
    }

    public function edit($id) {
        $data['user'] = User::find($id);

        if(!empty($data['user'])) {
            $data['headerTitle'] = 'Edit User';

            return view('backend.admin.users.edit', $data);
        }else {
            abort(404);
        }
    }

    public function update(Request $request) {
        $user = User::find($request->user_id);
        
        $user->status = $request->status;
        $user->save();

        return redirect('users/list')->with("success", "User successfully updated.");
    }

    public function delete($id) {
        $user = User::find($id);
    
        if (!empty($user)) {
            $user->delete();
            
            return redirect('users/list')->with("success", "User successfully deleted.");
        } else {
            abort(404);
        }
    }

}
