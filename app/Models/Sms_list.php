<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Sms_list extends Model
{
    use HasFactory;
    protected $guarded = [''];

    public function device(){
        return $this->belongsTo(Device::class);
    }

}