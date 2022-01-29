<?php

namespace App\Http\Controllers;

use App\DataTables\Sms_listsDataTable;
use App\Models\Device;
use App\Models\Sms_list;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class Sms_listController extends Controller
{
    public function index(Sms_listsDataTable $dataTable){

        return $dataTable->render('sms_lists');
    }

    public function newSMSIn(Request $request,$id){

        //測試id先用userid取代
        if($id == 0){
            $id =$request->user()->id;
        }
        $data=$request->all();
        $dev=Device::where('number',$data['number'])->first();
        //驗證裝置號碼
        if($dev == null){
            return response('沒有對應的裝置',500);
        }
        $data = array_merge(['device_id'=>$dev->id],$data);
        unset($data['number']);
        Log::channel('change_sms')->info('NewData',['userid'=>$id,'data'=> $data] );
        Sms_list::create($data);
        return response('ok',200);
    }

    public function delete(Request $request,$id){
        $user =$request->user()->id;
        $data=Sms_list::find($id);
        $dataA= $data;
        $data->toArray();
        Log::channel('delete_sms')->info('deleteData',['userid'=>$user,'data'=> $data] );
        $dataA->delete();
        return response('ok',200);
    }
}
