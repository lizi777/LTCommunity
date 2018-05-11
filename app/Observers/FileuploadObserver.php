<?php

namespace App\Observers;

use App\Models\Fileupload;

// creating, created, updating, updated, saving,
// saved,  deleting, deleted, restoring, restored

class FileuploadObserver
{
    public function creating(Fileupload $fileupload)
    {
        //
    }

    public function updating(Fileupload $fileupload)
    {
        //
    }

    public function deleting(Fileupload $fileupload){
    	//$fileupload->filepath
    }
}