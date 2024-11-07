<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\DeviceToken;

class DeviceTokenController extends Controller
{
    public function updateDeviceToken(Request $request) {
        $this->validate($request, [
            'device_token' => 'required',
        ]);
        
        $deviceToken = new DeviceToken;
        $deviceToken->device_token = $request->device_token;
        $deviceToken->save();

        return response()->json([
            'status' => 'success',
            'message' => 'Device Token successfully updated.',
        ], 404);
    }
}
