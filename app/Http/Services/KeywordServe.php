<?php
namespace App\Http\Services;

use App\Models\Device;
use Illuminate\Support\Facades\DB;

class KeywordServe{

    public function checkSMSKeyword($data){

        //將號碼改為裝置id
        $dev=Device::where('UID',$data['UID'])->first();
        //共通通知關鍵字
        $notikeyword2=DB::table('allkeyword')->select('allkeyword')->get();
        if($dev->noti_keywords===null || $dev->noti_keywords==" " || $dev->noti_keywords==""){
            $data = array_merge(['device_id'=>$dev->id,'keyword'=>"",'noticode'=> "0"],$data);
            return $data;
        }
        //判斷是否通知
        //物件轉換為陣列 以空格為判斷分隔 加入共通通知關鍵字
        if($notikeyword2[0]=="" ||$notikeyword2[0]==null){
            $notikeyword =explode(' ',$dev->noti_keywords);
        }else{
            $notikeyword =explode(' ',$dev->noti_keywords.' '.$notikeyword2[0]->allkeyword);
        }
        $code = true;
        $content = $data['sms_content'];
        $keyword ="";
        if($dev->unnoti_keywords===null || $dev->unnoti_keywords==" " || $dev->unnoti_keywords==""){

        }else{
            //含忽略關鍵字則優先不通知
            $unnotikeyword =explode(' ',$dev->unnoti_keywords);
            foreach($unnotikeyword as $value){
                if(substr_count($content,$value) != 0){
                    $code =false;
                    $keyword =$value;
                    break;
                }
            }
        }

        if($code){
            foreach($notikeyword as $value){
                if(substr_count($content,$value) != 0){
                    $keyword=$keyword.$value." ";
                }
            }
            if($keyword == ""){
                $code =false;
            }
        }
        $data = array_merge(['device_id'=>$dev->id,'keyword'=>$keyword,'noticode'=> $code],$data);
        return $data;
    }

}
