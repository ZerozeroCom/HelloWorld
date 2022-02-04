<?php
namespace App\Http\Services;

use Illuminate\Support\Facades\Log;

class LogServe {


    public function newDataLog(string $name,$id,$data){
        Log::channel("change_$name")->info('NewData',['userid'=>$id,'data'=> collect($data)->filter()->toArray()] );
    }

    public function editBeforeLog(string $name,$id,$data){
        Log::channel("change_$name")->info('beforeData',['userid'=>$id,'data'=> collect($data)->filter()->toArray()] );
    }

    public function editAfterLog(string $name,$id,$data){
        Log::channel("change_$name")->info('AfterData',['userid'=>$id,'data'=> collect($data)->filter()->toArray()] );
    }

    public function deleteLog(string $name,$id,$data){
        Log::channel("delete_$name")->info('deleteData',['userid'=>$id,'data'=> collect($data)->filter()->toArray()] );
    }
}
