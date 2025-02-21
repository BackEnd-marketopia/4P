<?php

namespace App\Helpers;

use App\Models\Notification;
use Illuminate\Http\UploadedFile;
use Google\Client as GoogleClient;
use Google\Service\FirebaseCloudMessaging;
use GuzzleHttp\Client as HttpClient;
use Illuminate\Support\Facades\Http;

class Helpers
{
    public static function addImage(UploadedFile $image, string $path)
    {
        $filename = uniqid() . '.' . $image->getClientOriginalExtension();

        $path = $image->storeAs($path, $filename, 'public');

        return 'storage/' . $path;
    }

    public static function getFirebaseAccessToken()
    {
        $keyFilePath = storage_path('firebase/firebase-configuration.json');
        $googleClient = new GoogleClient();
        $googleClient->setAuthConfig($keyFilePath);
        $googleClient->addScope(FirebaseCloudMessaging::CLOUD_PLATFORM);
        $googleClient->fetchAccessTokenWithAssertion();
        return $googleClient->getAccessToken()['access_token'] ?? null;
    }

    public static function sendNotification($title, $body, $type, $to, $save = false, $user_id = null, $image = null, $data = null)
    {
        if ($save == true) {
            $notification = Notification::create([
                'title' => $title,
                'body' => $body,
                'type' => $type,
                'to' => $to,
                'user_id' => $user_id,
                'image' => $image,
                'data' => $data,
                'is_read' => false,
            ]);
        }
        $accessToken = self::getFirebaseAccessToken();
        if (!$accessToken) {
            return ['error' => 'Failed to get Firebase Access Token'];
        }

        $client = new HttpClient();
        $url = "https://fcm.googleapis.com/v1/projects/four-p-b40ac/messages:send";

        $topicOrToken = $type == 'topic' ? 'topic' : 'token';
        $payload = [
            "message" => [
                $topicOrToken => $to,
                "notification" => [
                    "title" => $title,
                    "body" => $body,
                    "image" => $image ?? "",
                ],
                "data" => $data,
            ]
        ];

        $response = Http::withHeaders([
            'Authorization' => "Bearer $accessToken",
            'Content-Type' => 'application/json',
        ])->post($url, $payload);

        return json_decode($response->getBody(), true);
    }
}
