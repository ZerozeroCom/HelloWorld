<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class Sms_list extends Model
{
    use HasApiTokens;
    use HasFactory;
    use Notifiable;

    //Model自訂日期必備
    protected $casts = [
        'sms_sendtime' => 'datetime',
     ];
    public $timestamps = FALSE;
    protected $guarded = [''];

    public function device(){
        return $this->belongsTo(Device::class);
    }

}
