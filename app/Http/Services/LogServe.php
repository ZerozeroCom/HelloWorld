<?php
namespace App\Http\Services;

use Illuminate\Support\Facades\Log;

class LogServe {


    public function newDataLog(string $name,$id,$data){
        Log::channel("change_$name")->info('NewData',['userid'=>$id,'data'=> $this->arrayCheck($data)] );
    }

    public function editBeforeLog(string $name,$id,$data){
        Log::channel("change_$name")->info('beforeData',['userid'=>$id,'data'=> $this->arrayCheck($data)] );
    }
    public function editManyBeforeLog(string $name,$id,$data){
        $dataS=$data->toArray();
        foreach($dataS as $key => $value){
            unset($value['created_at']);
            unset($value['updated_at']);
            $dataS[$key]=$value;
        }
        Log::channel("change_$name")->info('manybeforeData',['userid'=>$id,'data'=> $dataS] );
    }

    public function editAfterLog(string $name,$id,$data){
        Log::channel("change_$name")->info('AfterData',['userid'=>$id,'data'=> $this->arrayCheck($data)] );
    }
    public function editManyAfterLog(string $name,$id,$many,$data){
        Log::channel("change_$name")->info('manyAfterData',['userid'=>$id,'changeId'=>$many,'data'=> $this->arrayCheck($data)] );
    }

    public function deleteManyLog(string $name,$id,$data){
        Log::channel("delete_$name")->info('manydeleteData',['userid'=>$id,'data'=> $this->arrayCheck($data)] );
    }
    public function deleteLog(string $name,$id,$data){
        Log::channel("delete_$name")->info('deleteData',['userid'=>$id,'data'=> $this->arrayCheck($data)] );
    }

    protected function arrayCheck($data){
        if(is_array($data)){
            return array_filter($data);
        }
        return collect($data)->filter()->forget(['created_at','updated_at'])->toArray();
    }
}
