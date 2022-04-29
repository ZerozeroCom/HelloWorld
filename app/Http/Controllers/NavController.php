<?php

namespace App\Http\Controllers;

use App\Models\User;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Notifications\DatabaseNotification;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

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

        $file_path = 'storage/file.txt';

        if(file_exists($file_path)){

            $str = file_get_contents($file_path);//將整個檔案內容讀入到一個字串中
            $arr = explode(',',$str);
            $str=substr($arr[0],4);
            $file= public_path().$str;
            $filename=substr($str,9);
        }else{
            $file= public_path(). '/storage/app-debugV1.81.apk';
            $filename='app-debugV1.81.apk';
        }
    $headers = [
        'Content-Type: application/apk',
    ];

    return response()->download($file, $filename, $headers);
    }
    public function getDownloadmp4(){
        $file_path = 'storage/file.txt';

        if(file_exists($file_path)){

            $str = file_get_contents($file_path);//將整個檔案內容讀入到一個字串中
            $arr = explode(',',$str);
            $str=substr($arr[1],4);
            $file= public_path().$str;
            $filename=substr($str,9);
        }else{
            $file= public_path(). '/storage/demonstration.mp4';
            $filename='demonstration.mp4';
        }
        $headers = [
            'Content-Type: application/mp4',
        ];

        return response()->download($file,$filename, $headers);
        }

    public function  uploadApp(Request $request,$id){
        $file_path = 'storage/file.txt';
        $oldfile='';

        //路徑文件處理  路徑文件存在
        if(file_exists($file_path)){
            $str = file_get_contents($file_path);//將整個檔案內容讀入到一個字串中
            $arr = explode(',',$str);
            $arr0 = explode('=',$arr[0]);
            $arr1 = explode('=',$arr[1]);

            //檔名修改
            if($id==0){
                //APP
                $oldfile=substr($arr0[1],9);
                $arr0[1]='/storage/'.$request->apk->getClientOriginalName();
            }else{
                //MP4
                $oldfile=substr($arr1[1],9);
                $arr1[1]='/storage/'.$request->mp4->getClientOriginalName();
            }

            $fp=fopen($file_path, 'w');
            fputs($fp,$arr0[0]);
            fputs($fp,'=');
            fputs($fp,$arr0[1]);
            fputs($fp,',');
            fputs($fp,$arr1[0]);
            fputs($fp,'=');
            fputs($fp,$arr1[1]);
            fclose($fp);

        }else{
            //路徑文件不存在
            try{
                $fp=fopen($file_path, 'w');
            }catch(Exception $e){
                return '找不到檔案且建立失敗';
            }
            //檔名修改
            if($id==0){
                //APP
                fputs($fp,'APK=/storage/'.$request->apk->getClientOriginalName().',MP4=/storage/demonstration.mp4');
                fclose($fp);
            }else{
                //MP4
                fputs($fp,'APK=/storage/app-debugV1.81.apk,MP4=/storage/'.$request->mp4->getClientOriginalName());
                fclose($fp);
            }
        }
        //檔案處理
        if($id==0){
            try{
                Storage::disk('public')->delete($oldfile);
                Storage::disk('public')->put($request->apk->getClientOriginalName(),file_get_contents($request->apk->getRealPath()));
            }catch(Exception $e){
                Storage::disk('public')->delete($oldfile);
                Storage::disk('public')->put($request->apk->getClientOriginalName(),file_get_contents($request->apk->getRealPath().$request->apk->getfilename()));
                var_dump($e);
                var_dump($request->apk->getRealPath().$request->apk->getfilename());
            }


        }else{
            Storage::disk('public')->delete($oldfile);
            Storage::disk('public')->put($request->mp4->getClientOriginalName(),file_get_contents($request->mp4->getRealPath()));
        }

        return 'ok';
    }

}
