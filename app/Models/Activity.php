<?php

namespace App\Models;

use App\Observers\ActivityObserver;
class Activity extends Model
{

    protected $fillable = ['area', 'title', 'content'];

    public function belongsToArea()
    {
        return $this->belongsTo(Area::class,'area','id');
    }

}
