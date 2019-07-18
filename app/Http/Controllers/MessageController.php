<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Nahid\Talk\Facades\Talk;
use View;

class MessageController extends Controller
{
    public function show()
    {
        Talk::setAuthUserId(Auth::user()->id);
        View::composer('partials.peoplelist', function($view) {
            $threads = Talk::threads();
            $view->with(compact('threads'));
        });
        return view('messenger', compact('messages', 'user'));
    }
    public static function lastThreads()
    {
        if(!Auth::guest()) {
            Talk::setAuthUserId(Auth::user()->id);
            $threads = Talk::threads();
            return $threads;
        }

    }
    public static function countNotReaded()
    {
        if(!Auth::guest()) {
            Talk::setAuthUserId(Auth::user()->id);
            $inbx = Talk::getInbox();
            $notRead = 0;
            foreach ($inbx as $thread)
            {
                if(!$thread->thread->is_seen)
                {
                    $notRead++;
                }
            }
            return $notRead;
        }
        return 0;
    }
    public function chatHistory($id)
    {
        Talk::setAuthUserId(Auth::user()->id);

        View::composer('partials.peoplelist', function($view) {
            $threads = Talk::threads();
            $view->with(compact('threads'));
        });
        $conversations = Talk::getMessagesByUserId($id);
        $user = '';
        $messages = [];
        if(!$conversations) {
            $user = User::find($id);
        } else {
            $user = $conversations->withUser;
            $messages = $conversations->messages;
        }

        if (count($messages) > 0) {
            $messages = $messages->sortBy('id');
            DB::table('messages')->where('user_id',$user->id)->where('is_seen',false)->update(['is_seen' => true]);
        }

        return view('messenger', compact('messages', 'user'));
    }

    public function ajaxSendMessage(Request $request)
    {
        Talk::setAuthUserId(Auth::user()->id);
        if ($request->ajax()) {
            $rules = [
                'message-data'=>'required',
                '_id'=>'required'
            ];
            $this->validate($request, $rules);
            $body = $request->input('message-data');
            $userId = $request->input('_id');
            if ($message = Talk::sendMessageByUserId($userId, $body)) {
                $html = view('ajax.newMessageHtml', compact('message'))->render();
                return response()->json(['status'=>'success', 'html'=>$html], 200);
            }
        }
    }

    public function ajaxDeleteMessage(Request $request, $id)
    {
        if ($request->ajax()) {
            if(Talk::deleteMessage($id)) {
                return response()->json(['status'=>'success'], 200);
            }

            return response()->json(['status'=>'errors', 'msg'=>'something went wrong'], 401);
        }
    }

    public function tests()
    {
        dd(Talk::channel());
    }
}
