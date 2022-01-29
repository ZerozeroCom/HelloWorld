<?php

namespace App\Http\Controllers;

use App\DataTables\Allow_listsDataTable;
use App\Models\Allow_list;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class Allow_listController extends Controller
{
    public function index(Allow_listsDataTable $dataTable){

        return $dataTable->render('allow_lists');
    }

    public function addNewAL(Request $request){
        dd($request->user()->id);
        Allow_list::create(['user_id'=>$request->id,'allow_ip_addr'=>'127.0.0.1']);

        return response('ok',200);
    }


    public function editAL(Request $request,$id){
        $user = $request->user();
        $data=Allow_list::find($id);
            //若有資料 進行驗證
        $dev = $request->validate([
            'allow_ip_addr' => 'required|ip|string|min:7',
        ]);
        Log::channel('change_al')->info('beforeData',['userid'=>$user->id,'data'=> $data] );
        $data->update($dev);
        Log::channel('change_al')->info('AfterData',['userid'=>$user->id,'data'=> $data] );
        return response('ok',200);
    }

    public function delete(Request $request,$id){
        $user =$request->user()->id;
        $data=Allow_list::find($id);
        $dataA= $data;
        $data->toArray();
        Log::channel('delete_al')->info('deleteData',['userid'=>$user,'data'=> $data] );
        $dataA->delete();
        return response('ok',200);
    }

}
