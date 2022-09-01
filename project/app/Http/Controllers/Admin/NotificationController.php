<?php

namespace App\Http\Controllers\Admin;

use App\Models\Notification;
use App\Http\Controllers\Controller;

class NotificationController extends Controller
{
    public function readAll()
    {
        $notifications = Notification::where('read_at', null)->get();
        foreach($notifications as $notification)
        {
            $notification->update(['read_at'=>now()]);
        }
    }
}
