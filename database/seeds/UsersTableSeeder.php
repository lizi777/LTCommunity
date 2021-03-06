<?php

use Illuminate\Database\Seeder;
use App\Models\User;
use App\Models\Klasse;

class UsersTableSeeder extends Seeder
{
    public function run()
    {
        // 获取 Faker 实例
        $faker = app(Faker\Generator::class);

        // 头像假数据
        $avatars = [
            '1','2','3','4','5','6',
        ];

        $Klasse_ids = Klasse::all()->pluck('id')->toArray();
        // 生成数据集合
        $users = factory(User::class)
                        ->times(10)
                        ->make()
                        ->each(function ($user, $index)
                            use ($faker, $avatars, $Klasse_ids)
        {
            // 从头像数组中随机取出一个并赋值
            $avatars = rand(1,5);

            $user->avatar = config('app.url').'/uploads/default/avatar'.$avatars.'.jpg';

            $user->class_id = $faker->randomElement($Klasse_ids);

            $user->area_id = 1;
        });

        // 让隐藏字段可见，并将数据集合转换为数组
        $user_array = $users->makeVisible(['password', 'remember_token'])->toArray();

        // 插入到数据库中
        User::insert($user_array);

        // 生成并插入第二个校区假数据
        $users = factory(User::class)
                        ->times(10)
                        ->make()
                        ->each(function ($user, $index)
                            use ($faker, $avatars, $Klasse_ids)
        {

            $avatars = rand(1,5);

            $user->avatar = config('app.url').'/uploads/default/avatar'.$avatars.'.jpg';

            $user->class_id = $faker->randomElement($Klasse_ids);

            $user->area_id = 2;
        });

        $user_array = $users->makeVisible(['password', 'remember_token'])->toArray();

        User::insert($user_array);

        // 单独处理第一个用户的数据
        $user = User::find(1);
        $user->name = 'Hong';
        $user->email = '605498134@google.com';
        $user->avatar = 'http://sample.test/uploads/default/FounderAvatar.jpg';
        $user->save();

        // 初始化用户角色，将 1 号用户指派为『站长』
        $user->assignRole('Founder');

        // 将 2 号用户指派为『管理员』
        $user = User::find(2);
        $user->assignRole('Maintainer');

        // 将 3 号用户指派为『老师』
        $user = User::find(2);
        $user->is_teacher = true;
        $user->save();


    }
}