<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Advertisement;
use App\Models\NotificationSetting;
use App\Models\GeneralSetting;

class SettingsController extends Controller
{
    // Advertisement Methods
    public function showAdvertisementForm() {
        $data['headerTitle'] = 'Advertisement';
        
        $data['advertisement'] = Advertisement::first();

        return view('backend.admin.settings.advertisement', $data);
    }

    public function updateAdvertisementInfo(Request $request) {
        $advertisement = Advertisement::first();
        $advertisement->admob_inter = $request->admob_inter;
        $advertisement->admob_banner = $request->admob_banner;
        $advertisement->admob_native = $request->admob_native;
        $advertisement->admob_reward = $request->admob_reward;
        $advertisement->admob_open_ads = $request->admob_open_ads;
        $advertisement->ios_inter = $request->ios_inter;
        $advertisement->ios_banner = $request->ios_banner;
        $advertisement->ios_native = $request->ios_native;
        $advertisement->ios_reward = $request->ios_reward;
        $advertisement->ios_open_ads = $request->ios_open_ads;
        $advertisement->facebook_inter = $request->facebook_inter;
        $advertisement->facebook_banner = $request->facebook_banner;
        $advertisement->facebook_native = $request->facebook_native;
        $advertisement->facebook_reward = $request->facebook_reward;
        $advertisement->unity_appId_gameId = $request->unity_appId_gameId;
        $advertisement->iron_appKey = $request->iron_appKey;
        $advertisement->appnext_placementId = $request->appnext_placementId;
        $advertisement->startapp_appId = $request->startapp_appId;
        $advertisement->industrial_interval = $request->industrial_interval;
        $advertisement->native_ads = $request->native_ads;
        $advertisement->ads_type = $request->ads_type;
        $advertisement->save();

        return redirect()->back()->with("success", "Advertisement Info successfully updated.");
    }

    // Notification Methods
    public function showNotificationSettingsForm() {
        $data['headerTitle'] = 'Notification Settings';
        
        $data['notificationSetting'] = NotificationSetting::first();

        return view('backend.admin.settings.notification', $data);
    }

    public function updateNotificationSettings(Request $request) {
        $this->validate($request, [
            'fcm_server_key' => 'required',
        ]);

        $notificationSetting = NotificationSetting::find(1);
        $notificationSetting->fcm_server_key = $request->fcm_server_key;
        $notificationSetting->save();

        return redirect()->back()->with("success", "FCM server key successfully updated.");
    }

    // General Settings Methods
    public function showGeneralSettingsForm() {
        $data['headerTitle'] = 'General Settings';
        
        $data['generalSettings'] = GeneralSetting::first();

        return view('backend.admin.settings.general', $data);
    }

    public function updateGeneralSettings(Request $request) {
        $generalSettings = GeneralSetting::find(1);
        $generalSettings->app_version = $request->app_version;
        $generalSettings->zoom_control = $request->zoom_control;
        $generalSettings->about_us_url = $request->about_us_url;
        $generalSettings->contact_us_url = $request->contact_us_url;
        $generalSettings->privacy_policy_url = $request->privacy_policy_url;
        $generalSettings->terms_and_condition_url = $request->terms_and_condition_url;
        $generalSettings->rate_us_url = $request->rate_us_url;
        $generalSettings->one_single = $request->one_single;
        $generalSettings->privacy_policy = $request->privacy_policy;
        $generalSettings->save();

        return redirect()->back()->with("success", "General Settings successfully updated.");
    }
}
