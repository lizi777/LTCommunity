<?php

namespace App\Policies;

use App\Models\User;
use App\Models\Reply;
use App\Models\Topic;

class ReplyPolicy extends Policy
{
    public function update(User $user, Reply $reply)
    {
        // return $reply->user_id == $user->id;
        return true;
    }

    public function destroy(User $user, Reply $reply)
    {
        return true;
    }

    public function showDelete(User $user, Reply $reply ,Topic $topic)
    {
        return $user->isAuthorOf($topic) || $user->isAuthorOf($reply);
    }
}
