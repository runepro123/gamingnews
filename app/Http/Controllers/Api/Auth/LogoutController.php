<?php

namespace App\Http\Controllers\Api\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Log;

class LogoutController extends Controller
{
    public function logout(Request $request)
    {
        try {
            // Check if the user is authenticated
            if (auth()->check()) {
                // Delete all tokens for the authenticated user
                auth()->user()->tokens()->delete();

                return response()->json([
                    'status' => 'success',
                    'message' => 'Logout successful',
                ], 200);
            } else {
                return response()->json([
                    'status' => 'error',
                    'message' => 'User not authenticated.',
                ], 401);
            }
        } catch (\Exception $e) {
            Log::error('Logout failed: ' . $e->getMessage());

            return response()->json([
                'status' => 'error',
                'message' => 'An error occurred while processing your request.',
            ], 500);
        }
    }

}
