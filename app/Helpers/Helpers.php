<?php

namespace App\Helpers;

use App\Models\Notification;
use Illuminate\Http\UploadedFile;

class Helpers
{
    public static function addImage(UploadedFile $image, string $path)
    {
        $filename = uniqid() . '.' . $image->getClientOriginalExtension();

        $path = $image->storeAs($path, $filename, 'public');

        return 'storage/' . $path;
    }

    public function sendNotification($title, $body, $type, $to, $save = false, $user_id = null, $image = null, $data = null)
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
    }
}
