<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Advertisement;
use App\Models\NotificationSetting;
use App\Models\GeneralSetting;

class SettingsController extends Controller
{
    // Advertisement
    public function getAdvertisementDetails() {
        $advertisement = Advertisement::first();

        if (empty($advertisement)) {
            return response()->json([
                'status' => 'error',
                'message' => 'Advertisement Details not found',
            ], 404);
        }

        return response()->json([
            'status' => 'success',
            'message' => 'Advertisement Details retrieved successfully',
            'data' => $advertisement,
        ], 200);

    }

    // Notification
    public function getNotificationSettingsDetails() {
        $notification = NotificationSetting::first();

        if (empty($notification)) {
            return response()->json([
                'status' => 'error',
                'message' => 'Notification Details not found',
            ], 404);
        }

        return response()->json([
            'status' => 'success',
            'message' => 'Notification Details retrieved successfully',
            'data' => $notification,
        ], 200);

    }

    // General Settings
    public function getGeneralSettingsDetails() {
        $generalSettings = GeneralSetting::first();

        if (empty($generalSettings)) {
            return response()->json([
                'status' => 'error',
                'message' => 'General Settings Details not found',
            ], 404);
        }

        return response()->json([
            'status' => 'success',
            'message' => 'General Settings Details retrieved successfully',
            'data' => $generalSettings,
        ], 200);

    }
}
