<?php

namespace App\Policies;

use App\Models\User;
use App\Models\Activity;

class ActivityPolicy extends Policy
{
    public function update(User $user, Activity $activity)
    {
        // return $activity->user_id == $user->id;
        return true;
    }

    public function destroy(User $user, Activity $activity)
    {
        return true;
    }
}
