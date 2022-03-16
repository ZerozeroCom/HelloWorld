<?php

namespace App\Http\Controllers;

use App\Http\Services\KeywordServe;
use App\Http\Services\LogServe;
use App\Models\Device;
use App\Models\Sms_list;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\ValidationException;

class APIController extends Controller
{
    public function __construct(LogServe $logServe)
    {
        $this->log = $logServe;
    }

    public function newSMSIn(Request $request,$id,KeywordServe $keywordServe){

        //驗證裝置名稱
        try {
            $data= $request->validate([
                'sms_sendtime' => 'required|date',
                'name' => 'exists:App\Models\Device,name|required|string',
                'send_number' => 'required|string|max:255',
                'sms_content' => 'required|string',
            ]);
        } catch (ValidationException $exception) {
            $validatorInstance = $exception->validator;
            $errorMessageData = $validatorInstance->getMessageBag();
            $errorMessages = $errorMessageData->getMessages();
            $word="";
            foreach($errorMessages as $key => $value){
                $word=$word.$key.": ";
                foreach($value as $a){
                    $word=$word.$a." ";
                }
            }
            return $word;
        }
        //檢查關鍵字並處理資料
        $data = $keywordServe->checkSMSKeyword($data);
        $this->log->newDataLog('sms',$id,$data);
        Sms_list::create($data);
        return response('ok',200);
    }

    public function addNewDev(Request $request){

        $user = $request->user()->id;
        //資料驗證
        try {
            $dev= $request->validate([
                'name' => 'unique:App\Models\Device,name|required|string|max:40',
                'number' => 'nullable|string',
                'UID' => 'string|max:255',
            ]);
        } catch (ValidationException $exception) {
            $validatorInstance = $exception->validator;
            $errorMessageData = $validatorInstance->getMessageBag();
            $errorMessages = $errorMessageData->getMessages();
            $word="";
            foreach($errorMessages as $key => $value){
                $word=$word.$key.": ";
                foreach($value as $a){
                    $word=$word.$a." ";
                }
            }
            return $word;
        }
        $this->log->newDataLog("dev",$user,$dev);
        Device::create($dev);
        return response('ok',200);
    }


}
