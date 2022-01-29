<?php

namespace App\Http\Controllers;

use App\DataTables\Sms_listsDataTable;
use App\Models\Sms_list;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class Sms_listController extends Controller
{
    public function index(Sms_listsDataTable $dataTable){

        return $dataTable->render('sms_lists');
    }

    public function newSMSIn(Request $request,$id){

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
