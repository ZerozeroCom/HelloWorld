<?php

namespace App\Http\Controllers;

use App\Actions\Fortify\CreateNewUser;
use App\Actions\Jetstream\DeleteUser;
use App\DataTables\UsersDataTable;
use App\Models\Allow_list;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Log;
use PhpParser\ErrorHandler\Collecting;

class AccountController extends Controller
{

    //顯示頁面
    public function index(UsersDataTable $dataTable){

        return $dataTable->render('accounts');
    }

    //log用刪除多餘字串
    public function deleStr($data){
        $dataA=(string)$data;
        $dataA = substr_replace($dataA,'',stripos($dataA,',"current_team_id"',1))."}";
        return $dataA;
    }

    //新增帳號 驗證使用原生機制
    public function addNewAcc(Request $request,CreateNewUser $createNewUser){
        $createNewUser->create($request->all());
        $user = $request->user();
        $data=['type'=> $request->type,'name'=> $request->name, 'email'=> $request->email];
        Log::channel('change_ac')->info('NewData',['userid'=>$user->id,'data'=> $data] );
        $user = User::where('email',$request->email)->first();
        $dataA=Allow_list::create(['user_id'=>$user->id,'allow_ip_addr'=>'127.0.0.1']);
        Log::channel('change_al')->info('NewData',['userid'=>$user->id,'data'=> $dataA] );
        return response('ok',200);
    }


    //修改帳號
    public function editAcc(Request $request,$id){
        $user = $request->user();
        $data=User::find($id);
            //若有資料 進行驗證
        $acc = collect($request->validate([
            'type' => 'nullable|string|max:25',
            'name' => 'nullable|string|max:255',
            'email' => 'nullable|string|email|max:255',
            'password' => 'nullable|string|confirmed|min:8|max:255',
        ]))->filter();

            //若改變密碼 加密 並額外處理
            if($acc->has('password')){
                $acc->put('password' , bcrypt($acc->get('password')));

                $data->forceFill([
                    'password' => $acc->get('password'),
                ])->save();
                $acc->pull('password','password_confirmation');
            }
        Log::channel('change_ac')->info('beforeData',['userid'=>$user->id,'data'=> $this->deleStr($data)] );
        foreach ($acc as $key => $value){
            $data->forceFill([
                $key => $value
            ])->save();
        }
        Log::channel('change_ac')->info('AfterData',['userid'=>$user->id,'data'=> $this->deleStr($data)] );
            return response('ok',200);
    }


    //刪除帳號
    public function deleteAcc(Request $request,DeleteUser $deleteUser,$id){
            $user = $request->user();
            $data=User::find($id);
            Log::channel('delete_ac')->info('deleteData',['userid'=>$user->id,'data'=> $this->deleStr($data)] );
            $deleteUser->delete($data);
            return response('ok',200);

    }

}
