<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Ad;

class AdController extends Controller
{
    public function getAd() {
        $ad = Ad::first();

        if (empty($ad)) {
            return response()->json([
                'status' => 'error',
                'message' => 'Ad Details not found',
            ], 404);
        }

        return response()->json([
            'status' => 'success',
            'message' => 'Ad Details retrieved successfully',
            'data' => $ad,
        ], 200);

    }
}
