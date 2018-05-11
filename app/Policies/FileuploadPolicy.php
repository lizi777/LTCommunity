<?php

namespace App\Policies;

use App\Models\User;
use App\Models\Fileupload;

class FileuploadPolicy extends Policy
{
    public function update(User $user)
    {
        return $user->is_teacher;
    }

    public function destroy(User $user, Fileupload $fileupload)
    {
        return $user->is_teacher;
    }
}
