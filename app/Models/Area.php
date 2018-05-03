<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Area extends Model
{
    public function users()
    {
        return $this->hasMany(User::class,'area_id','id');
    }

    public function Klasses()
    {
        return $this->hasMany(Klasse::class,'area','id');
    }

    public function hasManyActivity()
    {
        return $this->hasMany(Activity::class,'area','id');
    }
}
