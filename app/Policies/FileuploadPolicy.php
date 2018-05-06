<?php

namespace App\Policies;

use App\Models\User;
use App\Models\Fileupload;

class FileuploadPolicy extends Policy
{
    public function update(User $user, Fileupload $fileupload)
    {
        // return $fileupload->user_id == $user->id;
        return true;
    }

    public function destroy(User $user, Fileupload $fileupload)
    {
        return true;
    }
}
