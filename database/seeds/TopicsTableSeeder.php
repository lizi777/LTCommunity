<?php

use Illuminate\Database\Seeder;
use App\Models\Topic;
use App\Models\User;
use App\Models\Area;
use App\Models\Klasse;

class TopicsTableSeeder extends Seeder
{
    public function run()
    {
        // 所有用户 ID 数组，如：[1,2,3,4]
        $user_ids = User::all()->pluck('id')->toArray();
        $area_ids = Area::all()->pluck('id')->toArray();
        // 所有班级 ID 数组，如：[1,2,3,4]

        // 获取 Faker 实例
        $faker = app(Faker\Generator::class);

        $topics = factory(Topic::class)
                        ->times(100)
                        ->make()
                        ->each(function ($topic, $index)
                            use ($user_ids, $area_ids, $faker)
        {
            // 从用户 ID 数组中随机取出一个并赋值
            $topic->user_id = $faker->randomElement($user_ids);
            $topic->area_id = $faker->randomElement($area_ids);
            // 班级
            $topic->class_id = User::where('id', $topic->user_id)->first()->class_id;
        });

        // 将数据集合转换为数组，并插入到数据库中
        Topic::insert($topics->toArray());
    }
}