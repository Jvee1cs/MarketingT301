<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Notification;

class NotificationController extends Controller
{
    public function index()
    {
        $notifications = Notification::all(); // Assuming you want to display all notifications
        return view('notifications.index', compact('notifications'));
    }

    public function settings()
{
    $notif = Notification::first(); // Fetch the notification
    return view('notifications.settings', compact('notification'));
}


    public function updateThreshold(Request $request)
    {
        $request->validate([
            'threshold' => 'required|numeric|min:1', // Assuming threshold is in days or hours
        ]);
    
        $notification = Notification::first(); // Assuming you have only one notification setting
    
        if ($notification) {
            $notification->update([
                'threshold_days' => $request->threshold, // or threshold_hours, depending on your implementation
            ]);
    
            return response()->json(['success' => true, 'message' => 'Notification threshold updated successfully.']);
        } else {
            return response()->json(['success' => false, 'message' => 'No notification settings found.']);
        }
    }
    
}
