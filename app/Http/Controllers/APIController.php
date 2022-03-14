<?php

namespace App\Http\Controllers;

use App\Http\Services\KeywordServe;
use App\Http\Services\LogServe;
use App\Models\Device;
use App\Models\Sms_list;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;


class APIController extends Controller
{
    public function __construct(LogServe $logServe)
    {
        $this->log = $logServe;
    }

    public function newSMSIn(Request $request,$id,KeywordServe $keywordServe){

        //驗證裝置名稱
        $data= $request->validate([
            'sms_sendtime' => 'required|date',
            'name' => 'exists:App\Models\Device,name|required|string',
            'send_number' => 'required|string|max:255',
            'sms_content' => 'required|string',
        ]);
        //檢查關鍵字並處理資料
        $data = $keywordServe->checkSMSKeyword($data);
        $this->log->newDataLog('sms',$id,$data);
        Sms_list::create($data);
        return response('ok',200);
    }
}
