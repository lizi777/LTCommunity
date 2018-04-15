<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Area extends Model
{
    public function users()
    {
        return $this->hasMany(User::class,'area_id','id');
    }
}
