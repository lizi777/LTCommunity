<?php

use Illuminate\Database\Seeder;
use App\Models\Activity;

class ActivitysTableSeeder extends Seeder
{
    public function run()
    {
        $activitys = factory(Activity::class)->times(50)->make()->each(function ($activity, $index) {
            if ($index == 0) {
                // $activity->field = 'value';
            }
        });

        Activity::insert($activitys->toArray());
    }

}

