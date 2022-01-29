<?php

namespace App\Http\Controllers;

use App\DataTables\Allow_listsDataTable;
use App\Models\Allow_list;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class Allow_listController extends Controller
{
    public function index(Allow_listsDataTable $dataTable){

        return $dataTable->render('allow_lists');
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
