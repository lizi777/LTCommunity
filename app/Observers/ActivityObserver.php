<?php

namespace App\Observers;

use App\Models\Activity;

// creating, created, updating, updated, saving,
// saved,  deleting, deleted, restoring, restored

class ActivityObserver
{
    public function creating(Activity $activity)
    {
        
    }

    public function saving(Activity $activity)
    {
    	$activity->content = clean($activity->content, 'user_topic_body');
        $activity->excerpt = make_excerpt(clean($activity->content, 'activity_excerpt'));
    }

    public function updating(Activity $activity)
    {

    }
}