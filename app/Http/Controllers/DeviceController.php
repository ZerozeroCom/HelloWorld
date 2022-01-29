<?php

namespace App\Http\Controllers;

use App\DataTables\DevicesDataTable;
use App\Models\Device;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class DeviceController extends Controller
{
    public function index(DevicesDataTable $dataTable){

        return $dataTable->render('devices');
    }

    //log用轉字串
    public function tranStr($data){
        $dataA=(string)$data;
        return $dataA;
    }

    public function addNewDev(Request $request){

        $user = $request->user();
        $data=[ 'name'=> $request->name,
                'number'=> $request->number,
                'UID'=> $request->UID,
                'note'=> $request->note,
                'noti_keywords'=> $request->noti_keywords,
                'unnoti_keywords'=> $request->unnoti_keywords];
        //重複裝置
        $dev=Device::where('UID',$data['UID'])->first();
        if($dev != null){
            return response('重複登記',400);
        }

        Log::channel('change_dev')->info('NewData',['userid'=>$user->id,'data'=> $data] );
        Device::create($data);
        return response('ok',200);
    }


    public function editDev(Request $request,$id){
        $user = $request->user();
        $data=Device::find($id);
            //若有資料 進行驗證
        $dev = collect($request->validate([
            'name' => 'nullable|string|max:40',
            'number' => 'nullable|string|max:20|min:9',
            'UID' => 'nullable|string|max:255',
        ]))->filter();
        Log::channel('change_dev')->info('beforeData',['userid'=>$user->id,'data'=> $this->tranStr($data)] );
        $data->update($dev->all());
        Log::channel('change_dev')->info('AfterData',['userid'=>$user->id,'data'=> $this->tranStr($data)] );
        return response('ok',200);
    }


    public function delete(Request $request,$id){
        $user =$request->user()->id;
        $data=Device::find($id);
        $dataA= $data;
        $data->toArray();
        Log::channel('delete_dev')->info('deleteData',['userid'=>$user,'data'=> $data] );
        $dataA->delete();
        return response('ok',200);
    }
}
