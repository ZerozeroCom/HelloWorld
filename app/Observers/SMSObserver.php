<?php

namespace App\Observers;

use App\Models\Device;
use App\Models\Sms_list;
use App\Models\User;
use App\Notifications\SMSCheck;
use Illuminate\Notifications\Notification;
use Illuminate\Support\Facades\DB;

class SMSObserver
{
    /**
     * Handle the Sms_list "created" event.
     *
     * @param  \App\Models\Sms_list  $sms_list
     * @return void
     */
    public function created(Sms_list $sms_list)
    {
        $id = $sms_list->device_id;
        $dev = Device::find($id);
        //通知線上用戶
        $user = DB::table('sessions')->select('user_id')->distinct()->get()->map(function ($value, $key) {
            $key = ['id' => $value->user_id];
            return $key;
        });
        $users = User::find($user);

        $notikeyword =explode(' ',$dev->noti_keywords);
        $unnotikeyword =explode(' ',$dev->unnoti_keywords);

        $content = $sms_list->sms_content;
        foreach($unnotikeyword as $value){
            if(substr_count($content,$value) != 0){
                return false;
            }
        }
        foreach($notikeyword as $value){
            if(substr_count($content,$value) != 0){
                foreach($users as $value){
                    $value->notify(new SMSCheck($content,$dev));
                }
            }
        }
        return false;
    }

    /**
     * Handle the Sms_list "updated" event.
     *
     * @param  \App\Models\Sms_list  $sms_list
     * @return void
     */
    public function updated(Sms_list $sms_list)
    {

    }

    /**
     * Handle the Sms_list "deleted" event.
     *
     * @param  \App\Models\Sms_list  $sms_list
     * @return void
     */
    public function deleted(Sms_list $sms_list)
    {
        //
    }

    /**
     * Handle the Sms_list "restored" event.
     *
     * @param  \App\Models\Sms_list  $sms_list
     * @return void
     */
    public function restored(Sms_list $sms_list)
    {
        //
    }

    /**
     * Handle the Sms_list "force deleted" event.
     *
     * @param  \App\Models\Sms_list  $sms_list
     * @return void
     */
    public function forceDeleted(Sms_list $sms_list)
    {
        //
    }
}
