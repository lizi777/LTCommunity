<?php

namespace App\Models;

class Fileupload extends Model
{
    protected $fillable = ['class_id', 'filename', 'filepath'];

    public function belongsToKlasse()
    {
        return $this->belongsTo(Klasse::class,'class_id','id');
    }
}
