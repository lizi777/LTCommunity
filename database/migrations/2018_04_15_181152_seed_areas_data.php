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
        ];

        DB::table('areas')->insert($Areas);
    }

    public function down()
    {
        DB::table('areas')->truncate();
    }
}
