<?php


namespace App\Http\Controllers;


use App\ActivityLog;

class UserNotificationController extends Controller
{

    public function index()
    {
        $notifications = ActivityLog::query()
            ->where('causer_id', auth()->user()->id)
            ->latest()
            ->get();

        return view('user_notifications.index', compact('notifications'));
    }
}
