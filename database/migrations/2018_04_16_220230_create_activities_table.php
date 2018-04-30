<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateActivitiesTable extends Migration 
{
	public function up()
	{
		Schema::create('activities', function(Blueprint $table) {
            $table->increments('id');
            $table->integer('area')->unsigned()->index()->default(0);
            $table->string('title')->index();
            $table->text('content');
            $table->timestamps();
        });
	}

	public function down()
	{
		Schema::drop('activities');
	}
}
