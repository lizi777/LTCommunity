<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Klasse extends Model
{
    protected $fillable = [
    	'area', 'name',
    ];

    public function Klasses()
    {
        return $this->belongsTo(Area::class,'area','id');
    }

    public function users()
    {
        return $this->hasMany(User::class,'class_id','id');
    }
}
