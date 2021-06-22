<?php

namespace Modules\Admin\Http\Controllers;

use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;

class NotificationsController extends Controller
{
    public function index(Request $request)
    {
        $notifications = auth()->user()->notifications()->latest()->paginate(10);
        $count = auth()->user()->unreadNotifications()->count();
        auth()->user()->unreadNotifications->markAsRead();

        if ($request->ajax()) {
            return response()->json([
                'notifications' => $notifications,
                'count' => $count,
            ], 200);
        }

        return view('admin::pages/notifications/index', [
            'notifications' => $notifications,
            'count' => $notifications->count()
        ]);
    }

    public function delete($notification_id)
    {
        auth()->user()->notifications()->where('id', "$notification_id")->first()->delete();

        return response()->json([], 200);
    }

    public function deleteAll()
    {
        auth()->user()->notifications()->delete();

        return response()->json([], 200);
    }
}
