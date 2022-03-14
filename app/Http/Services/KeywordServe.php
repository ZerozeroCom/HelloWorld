<?php
namespace App\Http\Services;

use App\Models\Device;

class KeywordServe{

    public function checkSMSKeyword($data){

        //將號碼改為裝置id
        $dev=Device::where('name',$data['name'])->first();

        //判斷是否通知
            //物件轉換為陣列 以空格為判斷分隔
            $notikeyword =explode(' ',$dev->noti_keywords);
            $unnotikeyword =explode(' ',$dev->unnoti_keywords);
        //含忽略關鍵字則優先不通知
        $code = true;
        $content = $data['sms_content'];
        $keyword ="";
        foreach($unnotikeyword as $value){
            if(substr_count($content,$value) != 0){
                $code =false;
                $keyword =$value;
                break;
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
        unset($data['name']);

        return $data;
    }
}
