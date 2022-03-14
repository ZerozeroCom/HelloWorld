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
            'number' => 'nullable|string',
            'UID' => 'unique:App\Models\Device,UID|string|max:255',
            'businesses' => 'nullable|string|max:255',
            'noti_keywords' => 'nullable|string|max:255',
            'unnoti_keywords' => 'nullable|string|max:255',
            'note' => 'nullable|string|max:255',
        ]);
        //商戶 關鍵字固定順序存入
        $dev=$this->sortWord($dev);
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
            //'number' => 'nullable|string|max:20|min:9',
            'UID' => 'nullable|string|max:255',
            'businesses' => 'nullable|string|max:255',
            'noti_keywords' => 'nullable|string|max:255',
            'unnoti_keywords' => 'nullable|string|max:255',
            'note' => 'nullable|string|max:255',
        ]))->filter();
        //商戶 關鍵字固定順序存入
        $dev=$this->sortWord($dev);
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
        //商戶 關鍵字固定順序存入
        $dev=$this->sortWord($dev);
        $id = $request->id;
        $data=Device::findMany($id);
        $this->log->editManyBeforeLog('dev',$user,$data);

        foreach($id as $value){
            Device::find($value)->update($dev->all());
        }

        $this->log->editManyAfterLog('dev',$user,$id,$dev);
        return response('ok',200);
    }

    public function delete(Request $request,$id){
        $auth = $request->user();
        $user = $auth->id;
        if( $auth->type != 'admin'){
            return response(['message'=>'權限不足'],403);
        }
        $data=Device::find($id);
        $this->log->deleteLog('dev',$user,$data);
        $data->delete();
        return response('ok',200);
    }

    protected function sortWord($dev){

        if(isset($dev['businesses'])){
            $dev['businesses']=$this->sortSomeThing($dev['businesses']);
        }
        if(isset($dev['noti_keywords'])){
            $dev['noti_keywords']=$this->sortSomeThing($dev['noti_keywords']);
        }
        if(isset($dev['unnoti_keywords'])){
            $dev['unnoti_keywords']=$this->sortSomeThing($dev['unnoti_keywords']);
        }
        return $dev;
    }
    protected  function sortSomeThing($data){
        //連續空格只保留一個
        $data=preg_replace("/\s(?=\s)/","\\1",$data);
        //以空格切割陣列
        $businesses =explode(' ',$data);
        //重新排序並放回
        sort($businesses);
        $data=implode(' ',$businesses);
    return $data;
    }
}
