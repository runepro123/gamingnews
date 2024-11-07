<?php

namespace App\Http\Controllers\Api\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use Validator;
use Mail;
use App\Mail\PasswordResetOTPMail;
use Hash;

class PasswordResetController extends Controller
{
    public function sendOtpEmail(Request $request)
    {
        try {
            $validator = Validator::make($request->all(), [
                'email' => 'required|email|exists:users,email'
            ]);

            if ($validator->fails()) {
                return response()->json([
                    'status' => 'error',
                    'message' => 'Validation failed or invalid email address',
                    'errors' => $validator->errors()
                ], 422);
            }

            $user = User::where('email', $request->email)->first();

            // Generate and save OTP
            $otp = random_int(100000, 999999);
            $user->otp_secret = bcrypt($otp); // Store hashed OTP for better security
            $user->save();

            // Send email with OTP
            $mailSent = $this->sendOtpEmailNotification($user, $otp);

            if ($mailSent) {
                return response()->json([
                    'status' => 'success',
                    'message' => 'OTP successfully sent.',
                ], 200);
            }
        } catch (\Exception $e) {
            return response()->json([
                'status' => 'error',
                'message' => 'Something went wrong while sending OTP.',
                'error' => $e->getMessage()
            ], 500);
        }
    }

    public function sendOtpEmailNotification($user, $otp)
    {
        try {
            $data = [
                'user' => $user,
                'otp' => $otp
            ];

            Mail::to($user->email)->send(new PasswordResetOTPMail($data));

            return true;

        } catch (\Exception $e) {
            // Rollback OTP changes in case of mail sending failure
            $user->otp_secret = null;
            $user->save();

            throw $e; // Re-throw exception to handle at the calling method
        }
    }

    public function verifyOtp(Request $request)
    {
        try {
            $validator = Validator::make($request->all(), [
                'email' => 'required|email|exists:users,email',
                'otp' => 'required|integer'
            ]);

            if ($validator->fails()) {
                return response()->json([
                    'status' => 'error',
                    'message' => 'Validation failed',
                    'errors' => $validator->errors()
                ], 422);
            }

            $user = User::where('email', $request->email)->first();

            if (!$user || !Hash::check($request->otp, $user->otp_secret)) {
                return response()->json([
                    'status' => 'error',
                    'message' => 'Invalid OTP.',
                ], 422);
            }

            return response()->json([
                'status' => 'success',
                'message' => 'OTP verified successfully',
            ], 200);
        } catch (\Exception $e) {
            return response()->json([
                'status' => 'error',
                'message' => 'Something went wrong while verifying OTP.',
                'error' => $e->getMessage()
            ], 500);
        }
    }

    public function changePassword(Request $request)
    {
        try {
            $validator = Validator::make($request->all(), [
                'email' => 'required|email|exists:users,email',
                'password' => 'required|string|min:8'
            ]);

            if ($validator->fails()) {
                return response()->json([
                    'status' => 'error',
                    'message' => 'Validation failed',
                    'errors' => $validator->errors()
                ], 422);
            }

            $user = User::where('email', $request->email)->first();

            if (!$user || !$user->otp_secret) {
                return response()->json([
                    'status' => 'error',
                    'message' => 'Please verify OTP before changing the password'
                ], 422);
            }
            
            // Update password
            $user->password = Hash::make($request->password);
            $user->save();

            // Clear OTP after password change
            $user->otp_secret = null;
            $user->save();

            return response()->json([
                'status' => 'success',
                'message' => 'Password changed successfully.'
            ], 200);
        } catch (\Exception $e) {
            return response()->json([
                'status' => 'error',
                'message' => 'Something went wrong while changing the password.',
                'error' => $e->getMessage()
            ], 500);
        }
    }


}
