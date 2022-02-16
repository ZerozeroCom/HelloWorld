<?php

namespace App\Http\Controllers;


use App\DataTables\Sms_listsDataTable;
use App\Http\Services\KeywordServe;
use App\Http\Services\LogServe;
use App\Models\Device;
use App\Models\Sms_list;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class Sms_listController extends Controller
{
    public function __construct(LogServe $logServe)
    {
        $this->log = $logServe;
    }

    public function index(Sms_listsDataTable $dataTable){
        return $dataTable->render('sms_lists');
    }

    public function newSMSIn(Request $request,$id,KeywordServe $keywordServe){

        //驗證裝置號碼
        $data= $request->validate([
            'number' => 'exists:App\Models\Device,number|required|string|max:20|min:9',
            'send_number' => 'required|string|max:20|min:9',
            'sms_content' => 'required|string|max:255',
        ]);
        //檢查關鍵字並處理資料
        $data = $keywordServe->checkSMSKeyword($data);
        $this->log->newDataLog("sms",$id,$data);
        Sms_list::create($data);
        return response('ok',200);
    }

    public function delete(Request $request,$id){
        $auth = $request->user();
        $user = $auth->id;
        if( $auth->type != "admin"){
            return response(['message'=>'權限不足'],403);
        }
        $data=Sms_list::find($id);
        $this->log->deleteLog('sms',$user,$data);
        $data->delete();
        return response('ok',200);
    }
}
