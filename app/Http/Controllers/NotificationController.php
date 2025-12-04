<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\DeviceToken;

class NotificationController extends Controller
{
    public function storeToken(Request $request)
    {
        $request->validate([
            'fcm_token' => 'required',
            'device_id' => 'required',
            'platform' => 'required'
        ]);

        // Store or update device token
        DeviceToken::updateOrCreate(
            ['device_id' => $request->device_id],
            [
                'fcm_token' => $request->fcm_token,
                'platform' => $request->platform,
                'user_id' => auth()->id() // if you have user authentication
            ]
        );

        return response()->json(['message' => 'Token stored successfully']);
    }

    public function sendNotification(Request $request)
    {
        $SERVER_API_KEY = 'YOUR_FIREBASE_SERVER_KEY';

        $data = [
            "registration_ids" => $tokens, // array of FCM tokens
            "notification" => [
                "title" => $request->title,
                "body" => $request->body,
                "sound" => "default"
            ],
            "data" => [
                "url" => $request->url, // custom data
                "type" => $request->type
            ]
        ];

        $dataString = json_encode($data);

        $headers = [
            'Authorization: key=' . $SERVER_API_KEY,
            'Content-Type: application/json',
        ];

        $ch = curl_init();

        curl_setopt($ch, CURLOPT_URL, 'https://fcm.googleapis.com/fcm/send');
        curl_setopt($ch, CURLOPT_POST, true);
        curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_POSTFIELDS, $dataString);

        $response = curl_exec($ch);

        curl_close($ch);

        return response()->json(['response' => $response]);
    }
}