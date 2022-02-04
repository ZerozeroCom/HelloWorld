<?php

namespace App\Http\Controllers;

use App\DataTables\Allow_listsDataTable;
use App\Http\Services\LogServe;
use App\Models\Allow_list;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Validation\Rule;

class Allow_listController extends Controller
{
    public function __construct(LogServe $logServe)
    {
        $this->log = $logServe;
    }

    public function index(Allow_listsDataTable $dataTable){

        return $dataTable->render('allow_lists');
    }

    //資料驗證用
    public function alValidate($data){
        $this->id=$data->user_id;
        $data=$data->validate([
            'user_id' => 'exists:App\Models\User,id|required',
            'allow_ip_addr' => [
                    'required',
                    'ip',  //下行規則同ID不可重複地址
                    Rule::unique('App\Models\Allow_list')->where(function($query){
                        return $query->where('user_id',$this->id);
                    }),]
         ]);
         return $data;
    }

    public function addNewAL(Request $request){
         $user = $request->user()->id;
         //資料驗證
        $data=$this->alValidate($request);

        $this->log->newDataLog("al",$user,$data);
        Allow_list::create($data);
        return response('ok',200);
    }


    public function editAL(Request $request,$id){
        $user = $request->user()->id;
        $data=Allow_list::find($id);
        //資料驗證
        $dataA=$this->alValidate($request);

        $this->log->editBeforeLog("al",$user,$data);
        $data->update($dataA);
        $this->log->editAfterLog("al",$user,$data);
        return response('ok',200);
    }

    public function delete(Request $request,$id){
        $user =$request->user()->id;
        $data=Allow_list::find($id);
        $this->log->deleteLog("al",$user,$data);
        $data->delete();
        return response('ok',200);
    }

}
