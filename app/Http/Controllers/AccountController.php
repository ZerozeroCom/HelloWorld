<?php

namespace App\Http\Controllers;

use App\Actions\Fortify\CreateNewUser;
use App\Actions\Jetstream\DeleteUser;
use App\DataTables\UsersDataTable;
use App\Http\Services\LogServe;
use App\Models\Allow_list;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Log;
use PhpParser\ErrorHandler\Collecting;

class AccountController extends Controller
{
    public function __construct(LogServe $logServe)
    {
        $this->log = $logServe;
    }

    //顯示頁面
    public function index(UsersDataTable $dataTable){
        $allow_group_list = DB::table('allow_lists')->select('allow_group')->distinct()->get();
        return $dataTable->render('accounts',['allow_group_list' => $allow_group_list]);
    }
    public function logincheck(Request $request){
        $user =$request->user();
            $logins=User::find($user->id);
            $login=$logins->logins+1;
            $logins->update(['logins'=> $login,'ip_address'=> $request->ip()]);
            return redirect('/devices');
    }


    //log用刪除多餘字串
    public function deleStr($data){
        $dataA=(string)$data;
        $dataA = substr_replace($dataA,'',stripos($dataA,',"current_team_id"',1))."}";
        return $dataA;
    }


    public function addNewAcc(Request $request,CreateNewUser $createNewUser){
        //新增帳號 驗證使用原生機制
        $createNewUser->create($request->all());

        $user = $request->user()->id;
        $data=['type'=> $request->type,'name'=> $request->name, 'email'=> $request->email,'allow_group' => $request->allow_group,];
        $this->log->newDataLog("ac",$user,$data);

        return response('ok',200);
    }


    //修改帳號
    public function editAcc(Request $request,$id){
        $user = $request->user()->id;
        $data=User::find($id);
            //若有資料 進行驗證
        $acc = collect($request->validate([
            'type' => 'nullable|string|max:25',
            'name' => 'nullable|string|max:255',
            'email' => 'nullable|string|email|max:255',
            'password' => 'nullable|string|confirmed|min:8|max:255',
            'allow_group' => 'nullable|string|max:255|exists:App\Models\allow_list,allow_group',
        ]))->filter();

            //若改變密碼 加密 並額外處理
            if($acc->has('password')){
                $acc->put('password' , bcrypt($acc->get('password')));

                $data->forceFill([
                    'password' => $acc->get('password'),
                ])->save();
                $acc->pull('password','password_confirmation');
            }

        $this->log->editBeforeLog('ac',$user,$this->deleStr($data));

        //套用原生並選擇性修改用戶資訊
        foreach ($acc as $key => $value){
            $data->forceFill([
                $key => $value
            ])->save();
        }
        $this->log->editAfterLog('ac',$user,$this->deleStr($data));
        return response('ok',200);
    }


    //刪除帳號
    public function deleteAcc(Request $request,DeleteUser $deleteUser,$id){
            $user = $request->user()->id;
            $data=User::find($id);

            //刪除相依白名單
            $dataA=Allow_list::where('user_id',$id);
            $this->log->deleteLog("al",$user,$dataA->get()->toArray());
            $dataA->delete();
            //刪除使用者
            $this->log->deleteLog('dev',$user,$this->deleStr($data));
            $deleteUser->delete($data);
            return response('ok',200);
    }

}
