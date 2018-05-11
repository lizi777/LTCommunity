<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddReferences extends Migration
{
    public function up()
    {
        Schema::table('topics', function (Blueprint $table) {

            // 当 user_id 对应的 users 表数据被删除时，删除词条
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
            $table->foreign('class_id')->references('id')->on('klasses')->onDelete('cascade');
        });

        Schema::table('users', function (Blueprint $table) {

            $table->foreign('class_id')->references('id')->on('klasses')->onDelete('cascade');
            $table->foreign('area_id')->references('id')->on('areas')->onDelete('cascade');
        });

        Schema::table('klasses', function (Blueprint $table) {

            $table->foreign('area')->references('id')->on('areas')->onDelete('cascade');

        });

        Schema::table('replies', function (Blueprint $table) {

            // 当 user_id 对应的 users 表数据被删除时，删除此条数据
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');

            // 当 topic_id 对应的 topics 表数据被删除时，删除此条数据
            $table->foreign('topic_id')->references('id')->on('topics')->onDelete('cascade');
        });
    }

    public function down()
    {
        Schema::table('topics', function (Blueprint $table) {
            // 移除外键约束
            $table->dropForeign(['user_id']);
            $table->dropForeign(['class_id']);
        });
        Schema::table('users', function (Blueprint $table) {
            // 移除外键约束
            $table->dropForeign(['class_id']);
            $table->dropForeign(['area_id']);
        });
        Schema::table('klasses', function (Blueprint $table) {
            // 移除外键约束
            $table->dropForeign(['area']);
        });
        Schema::table('replies', function (Blueprint $table) {
            $table->dropForeign(['user_id']);
            $table->dropForeign(['topic_id']);
        });

    }
}