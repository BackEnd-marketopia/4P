<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Notification;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Response;

class NotificationController extends Controller
{
    public function getNotifications()
    {
        if (auth('api')->user()) {
            $notifications = Notification::where(function ($query) {
                $query->where('type', 'user')
                    ->where('to', auth('api')->user()->id);
            })
                ->orWhere(function ($query) {
                    $query->where('type', 'topic')
                        ->where(function ($subQuery) {
                            $subQuery->where('to', 'users')
                                ->orWhere('to', auth('api')->user()->city_id);
                        });
                })
                ->paginate(10);
        } else {
            $notifications = Notification::where('type', 'topic')
                ->where('to', 'users')
                ->paginate(10);
        }

        return Response::api(__('message.Success'), 200, true, null, ['notifications' => $notifications]);
    }
}
