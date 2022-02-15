<?php

namespace App\Http\Controllers;

use App\DataTables\DevicesDataTable;
use App\Http\Services\LogServe;
use App\Models\Device;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class DeviceController extends Controller
{
    public function __construct(LogServe $logServe)
    {
        $this->log = $logServe;
    }

    public function index(DevicesDataTable $dataTable){

        return $dataTable->render('devices');
    }

    public function addNewDev(Request $request){

        $user = $request->user()->id;
        //資料驗證
        $dev= $request->validate([
            'name' => 'required|string|max:40',
            'number' => 'required|string|max:20|min:9',
            'UID' => 'unique:App\Models\Device,UID|string|max:255',
            'businesses' => 'nullable|string|max:255',
            'noti_keywords' => 'nullable|string|max:255',
            'unnoti_keywords' => 'nullable|string|max:255',
            'note' => 'nullable|string|max:255',
        ]);
        $this->log->newDataLog("dev",$user,$dev);
        Device::create($dev);
        return response('ok',200);
    }


    public function editDev(Request $request,$id){
        $user = $request->user()->id;
        $data=Device::find($id);
            //若有資料 進行驗證
        $dev = collect($request->validate([
            'name' => 'nullable|string|max:40',
            'number' => 'nullable|string|max:20|min:9',
            'UID' => 'nullable|string|max:255',
            'businesses' => 'nullable|string|max:255',
            'noti_keywords' => 'nullable|string|max:255',
            'unnoti_keywords' => 'nullable|string|max:255',
            'note' => 'nullable|string|max:255',
        ]))->filter();

        $this->log->editBeforeLog('dev',$user,$data);
        $data->update($dev->all());
        $this->log->editAfterLog('dev',$user,$data);
        return response('ok',200);
    }

    public function editManyDev(Request $request){
        $user = $request->user()->id;
            //若有資料 進行驗證
        $dev = collect($request->validate([
            'id' => 'required|array|exclude',
            'businesses' => 'nullable|string|max:255',
            'noti_keywords' => 'nullable|string|max:255',
            'unnoti_keywords' => 'nullable|string|max:255',
            'note' => 'nullable|string|max:255',
        ]))->filter();
        $id = $request->id;
        $data=Device::findMany($id);
        $this->log->editBeforeLog('dev',$user,$data);

        foreach($id as $value){
            Device::find($value)->update($dev->all());
        }

        $this->log->editManyAfterLog('dev',$user,$id,$dev);
        return response('ok',200);
    }

    public function delete(Request $request,$id){
        $user =$request->user()->id;
        $data=Device::find($id);
        $this->log->deleteLog('dev',$user,$data);
        $data->delete();
        return response('ok',200);
    }
}
