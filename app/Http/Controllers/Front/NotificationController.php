<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use App\Models\Notification;
use Illuminate\Http\Request;

class NotificationController extends Controller
{
    public function destroy(Notification $notification)
    {
        $notification->delete();

        return response()->json(['message' => 'Notification deleted successfully']);
    }
}
