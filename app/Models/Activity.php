<?php

namespace App\Models;

class Activity extends Model
{

    protected $fillable = ['area', 'title', 'content'];

    public function area()
    {
        return $this->belongsTo(Area::class);
    }
}
