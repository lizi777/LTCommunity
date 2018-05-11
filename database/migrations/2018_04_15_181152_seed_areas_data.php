<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class SeedAreasData extends Migration
{
    public function up()
    {
        $Areas = [
            [
                'name'        => '罗湖翠竹分校',
                'address' => '罗湖区文锦中路2092号怡泰大厦三楼（翠园中学高中部左侧）',
            ],
            [
                'name'        => '龙华绿景分校',
                'address' => '深圳市龙华区梅龙大道绿景公馆1866北区二楼蓝天教育（华润万家超市）',
            ],
            [
                'name'        => '龙岗吉祥分校',
                'address' => '龙岗区龙岗中心城吉祥北路与龙平路交叉口紫悦龙庭红笔智慧城3楼',
            ],
            [
                'name'        => '南山文心分校',
                'address' => '南山区文心二路88号美墅蓝山家园裙楼二楼',
            ],
            [
                'name'        => '南山蛇口分校',
                'address' => '南山区南海大道1069号联合大厦二楼全层',
            ],
            [
                'name'        => '宝安建安分校',
                'address' => '宝安区宝城二十九区多宝利市场二楼（建安小学对面',
            ],
            [
                'name'        => '南山后海分校',
                'address' => '南山区后海大道与龙城路交叉口瑞铧苑1—2楼',
            ],
            [
                'name'        => '福田景田分校',
                'address' => '福田区景田北二街宏浩花园裙楼二楼',
            ],
            [
                'name'        => '福田百花分校小学部',
                'address' => '福田区百花二路百花园一期裙楼二楼北门',
            ],
            [
                'name'        => '福田百花分校初中部',
                'address' => '深圳市福田区百花二路百花新天地A座3楼',
            ],
        ];

        DB::table('areas')->insert($Areas);
    }

    public function down()
    {
        DB::table('areas')->truncate();
    }
}
