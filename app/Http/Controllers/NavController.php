<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Notifications\DatabaseNotification;
use Illuminate\Support\Facades\Auth;

class NavController extends Controller
{
    public function getNoti(Request $request){
        $notifications = Auth::user()->unreadNotifications;
        $countSer=$notifications->count();
        if($countSer == $request->count){
            return response(['notifications'=>'nonew','countSer'=>$countSer]);
        }
        return response(['notifications'=>$notifications,'countSer'=>$countSer]);

    }
    public function readOne(Request $request){
        $id = $request->all()['id'];
        //預設的押上已讀函式
        DatabaseNotification::find($id)->markAsRead();
        return response(['result'=>true]);

    }
    public function readAll(Request $request){
        $user= $request->user();
        $user->unreadNotifications->markAsRead();
        return response(['result'=>true]);
    }

}
