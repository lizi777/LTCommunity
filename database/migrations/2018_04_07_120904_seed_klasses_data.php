<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class SeedKlassesData extends Migration
{
    public function up()
    {
        $klasses = [
            [
                'name'        => '英语1班',
                'area' => '1',
            ],
            [
                'name'        => '竞赛数学1班',
                'area' => '1',
            ],
            [
                'name'        => '生物1班',
                'area' => '1',
            ],
            [
                'name'        => '期末提高班1班',
                'area' => '1',
            ],

            [
                'name'        => '物理1班',
                'area' => '2',
            ],
            [
                'name'        => '小升初1班',
                'area' => '2',
            ],
            [
                'name'        => '数学1班',
                'area' => '2',
            ],
            [
                'name'        => '语文1班',
                'area' => '2',
            ],
        ];

        DB::table('klasses')->insert($klasses);
    }

    public function down()
    {
        DB::table('klasses')->truncate();
    }
}