<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Allow_list extends Model
{
    use HasFactory;
    protected $guarded = [''];

    public function allow_group(){
        return $this->hasMany(User::class);
    }
}
