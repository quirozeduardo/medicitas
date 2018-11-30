<?php

namespace App\Http\Controllers;

use App\Models\Notification;
use Illuminate\Http\Request;

class NotificationsController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {

    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('home');
    }
    public static function getNotifications($user_id)
    {
        $notofications = Notification::where('user_id',$user_id)
            ->where('is_seen',false)->get();
        return $notofications;
    }
    public function open($id)
    {
        $notificaton = Notification::where('id',$id)->first();
        $notificaton->is_seen = true;
        $notificaton->save();
        return redirect(route($notificaton->redirect,$notificaton->redirect_param_1));
    }
}
