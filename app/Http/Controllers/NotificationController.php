<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\NotificationSetting;
use App\Models\DeviceToken;
use App\Models\Notification;

class NotificationController extends Controller
{
    public function index() {
        $data['headerTitle'] = 'Notification';

        return view('backend.admin.notification.notification', $data);
    }

    public function send(Request $request)
    {
        // Validation rules and messages
        $rules = [
            'title' => 'required',
            'message' => 'required',
        ];

        $messages = [
            'title.required' => 'Title is required',
            'message.required' => 'Message is required',
        ];

        // Validate request data
        $this->validate($request, $rules, $messages);

        // Prepare data for notification
        $notificationData = [
            'title' => $request->title,
            'message' => $request->message,
            'url' => $request->url ?: '', // Provide a default value when the 'url' field is empty
            'image_url' => $request->image_url ?: '', // Provide a default value when the 'image_url' field is empty
        ];

        // Send notification
        return $this->sendNotification($notificationData);
    }

    public function sendNotification(array $notificationData)
    {
        $notificationSetting = NotificationSetting::find(1);
        $FCM_SERVER_API_KEY = $notificationSetting->fcm_server_key;
        
        $deviceTokensObj = DeviceToken::get('device_token');
        $deviceTokenArray = $deviceTokensObj->pluck('device_token')->toArray();

        $data = [
            "registration_ids" => $deviceTokenArray,
            "notification" => [
                "body" => $notificationData['message'],
                "title" => $notificationData['title'],
                "image" => $notificationData['image_url'],
                "click_action" => 'com.askrobo.app.ui.activity.SplashActivity',
                'metadata' => [
                    'key1' => 'value1',
                    'key2' => 'value2',
                    'key3' => 'value3',
                ]
            ],

            "data" =>["url" =>  $notificationData['url']]

        ];
        
        $dataString = json_encode($data);

        $headers = [
            'Authorization: key=' . $FCM_SERVER_API_KEY,
            'Content-Type: application/json',
        ];

        $ch = curl_init();

        curl_setopt($ch, CURLOPT_URL, 'https://fcm.googleapis.com/fcm/send');
        curl_setopt($ch, CURLOPT_POST, true);
        curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
        // curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_POSTFIELDS, $dataString);

        $response = curl_exec($ch);

        if (curl_errno($ch)) {
            $error_msg = curl_error($ch);
        }

        curl_close($ch);

        if (isset($error_msg)) {
            return redirect()->back()->with("error", "Failed to send notification.");
        } else {
            $notification = new Notification();
            $notification->title = $notificationData['title'];
            $notification->message = $notificationData['message'];
            $notification->url = $notificationData['url'];
            $notification->image_url = $notificationData['image_url'];
            $notification->save();
            
            return redirect()->back()->with("success", "Notification successfully sent.");
        }

    }
}
