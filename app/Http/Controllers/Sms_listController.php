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
        /*
        //驗證裝置號碼
        $data= $request->validate([
            'name' => 'exists:App\Models\Device,name|required|string',
            'send_number' => 'required|string|max:20|min:9',
            'sms_content' => 'required|string|max:255',
        ]);
        //檢查關鍵字並處理資料
        $data = $keywordServe->checkSMSKeyword($data);
        $this->log->newDataLog('sms',$id,$data);
        Sms_list::create($data);
        return response('ok',200);*/
    }

    public function delete(Request $request,$id){
        $auth = $request->user();
        $user = $auth->id;
        if( $auth->type != 'admin'){
            return response(['message'=>'權限不足'],403);
        }
        $data=Sms_list::where('smsid',$id);
        $this->log->deleteLog('sms',$user,$data);
        $data->delete();
        return response('ok',200);
    }

    public function deleteMany(Request $request){
        $auth = $request->user();
        $id=$request->id;
        $user = $auth->id;
        if( $auth->type != 'admin'){
            return response(['message'=>'權限不足'],403);
        }
        $data=Sms_list::whereIn('smsid',$id);
        $this->log->deleteManyLog('sms',$user,$data);
        foreach($id as $value){
            Sms_list::where('smsid',$value)->delete();
        }
        return response('ok',200);
    }
}
