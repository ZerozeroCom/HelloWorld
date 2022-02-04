<?php

namespace App\Http\Controllers;

use App\DataTables\Sms_listsDataTable;
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

    public function newSMSIn(Request $request,$id){

        //測試id先用userid取代
        if($id == 0){
            $id =$request->user()->id;
        }

        //驗證裝置號碼
        $data= $request->validate([
            'number' => 'exists:App\Models\Device,number|required|string|max:20|min:9',
            'send_number' => 'required|string|max:255',
            'sms_content' => 'required|json',
        ]);
        $dev=Device::where('number',$data['number'])->first();
        $data = array_merge(['device_id'=>$dev->id],$data);
        unset($data['number']);
        $this->log->newDataLog("sms",$id,$data);
        Sms_list::create($data);
        return response('ok',200);
    }

    public function delete(Request $request,$id){
        $user =$request->user()->id;
        $data=Sms_list::find($id);
        $this->log->deleteLog('sms',$user,$data);
        $data->delete();
        return response('ok',200);
    }
}
