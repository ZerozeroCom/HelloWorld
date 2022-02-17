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

        //判斷線上用戶
        $user = DB::table('sessions')->select('user_id')->distinct()->get()->map(function ($value, $key) {
            $key = ['id' => $value->user_id];
            return $key;
        });
        $users = User::find($user);

        //通知線上用戶
        if($sms_list->noticode){
            foreach($users as $value){
                $value->notify(new SMSCheck($sms_list->keyword,$dev));
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
