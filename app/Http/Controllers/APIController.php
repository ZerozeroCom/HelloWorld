<?php

namespace App\Http\Controllers;

use App\Http\Services\KeywordServe;
use App\Http\Services\LogServe;
use App\Models\Device;
use App\Models\Sms_list;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Illuminate\Validation\Rule;
use Illuminate\Validation\ValidationException;

class APIController extends Controller
{
    public function __construct(LogServe $logServe)
    {
        $this->log = $logServe;
    }

    public function newSMSIn(Request $request,$id,KeywordServe $keywordServe){

        //驗證裝置名稱
        try {
            $data= $request->validate([
                'sms_sendtime' => 'required|date',
                'name' => 'nullable|string',
                'UID' => 'exists:App\Models\Device,UID|required|string',
                'send_number' => 'required|string|max:255',
                'sms_content' => 'required|string',
                'status' => 'nullable|string',
            ]);
        } catch (ValidationException $exception) {
            $validatorInstance = $exception->validator;
            $errorMessageData = $validatorInstance->getMessageBag();
            $errorMessages = $errorMessageData->getMessages();
            $word='';
            foreach($errorMessages as $key => $value){
                $word=$word.$key.': ';
                foreach($value as $a){
                    $word=$word.$a.' ';
                }
            }
            return $word;
        }
        //處理重複簡訊
        $dev=Device::where('UID',$data['UID'])->first();
        $sms=Sms_list::where('device_id',$dev->id)->where('sms_content',$data['sms_content'])->orderByDesc('sms_sendtime')->first();
        if($sms!=null){
            if(isset($data['status'])){
            }else{
                $data['status']='0';
            }
            if(abs(strtotime($sms->sms_sendtime)-strtotime($data['sms_sendtime']))<=60 || (abs(strtotime($sms->sms_sendtime)-strtotime($data['sms_sendtime']))<=350 && strlen($sms->status)==1 && $sms->status!=$data['status'])){
                Sms_list::where('smsid',$sms->smsid)->update(['status'=>$sms->status.$data['status']]);
                return '已重複';
            }
        }
        //檢查關鍵字並處理資料
        $data = $keywordServe->checkSMSKeyword($data);
        $this->log->newDataLog('sms',$id,$data);
        unset($data['UID']);
        unset($data['name']);
        Sms_list::create($data);
        return response('ok',200);
    }

    public function addNewDev(Request $request){

        $user = $request->user()->id;
        //資料驗證
        try {
            $dev= $request->validate([
                'name' => 'required|string|max:40',
                'UID' => 'unique:App\Models\Device,UID|required|string|max:255',
                'number' => 'nullable|string',
                'note' => 'nullable|string',
            ]);
        } catch (ValidationException $exception) {
            $validatorInstance = $exception->validator;
            $errorMessageData = $validatorInstance->getMessageBag();
            $errorMessages = $errorMessageData->getMessages();
            $word='';
            foreach($errorMessages as $key => $value){
                $word=$word.$key.': ';
                foreach($value as $a){
                    $word=$word.$a.' ';
                }
            }
            return $word;
        }
        $this->log->newDataLog('dev',$user,$dev);
        Device::create($dev);
        return response('ok',200);
    }

    public function uploadLog(Request $request){
        if($request->isMethod('POST')){
            //var_dump($_FILES);
            $file = $request->file;
            //var_dump($file);
            //dd($file);
            //檔案是否上傳成功
            if($file->isValid()){
                //獲取原檔名
                $originalName= $file->getClientOriginalName();
                //獲取檔案拓展名
                $ext= $file->getClientOriginalExtension();
                //$type= $file->getClientMimeType();
                //獲取檔案臨時絕對路徑
                $realPath = $file->getRealPath();
                //自定義檔案儲存的名稱
                $fileName = date('Y-m-d-H-i-s').'-'.$originalName;

                //$bool=
                Storage::disk('uploads')->put($fileName,file_get_contents($realPath));
                //var_dump($bool);
                return 'file ok';
            }
            return 'no file';
        }

        $files = Storage::files('uploads');

        return view('logwatch',['files'=>$files]);
    }
    public function allLogDownload(){
        $uploads=Storage::files('uploads');

        $zip = new \ZipArchive();
        $zip->open('storage/upload.zip', \ZipArchive::CREATE | \ZipArchive::OVERWRITE);


        foreach ($uploads as $upload){
            $zip->addFile($upload,$upload);
        }

        $zip->close();

        return Storage::download('public/upload.zip');
    }
    public function allLogDelete(){
        try{
            $uploads=Storage::files('uploads');
            Storage::delete($uploads);
            return 'ok';
        }catch(Exception $e){

            return $e;
        }

    }

}
