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

    public function getDownload(){
    $file= public_path(). "/storage/app-debugV1.5.apk";

    $headers = [
        'Content-Type: application/apk',
    ];

    return response()->download($file, 'app-debugV1.5.apk', $headers);
    }
    public function getDownloadmp4(){
        $file= public_path(). "/storage/demonstration.mp4";

        $headers = [
            'Content-Type: application/mp4',
        ];

        return response()->download($file, 'demonstration.mp4', $headers);
        }

}
