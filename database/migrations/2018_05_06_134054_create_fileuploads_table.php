<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateFileuploadsTable extends Migration 
{
	public function up()
	{
		Schema::create('fileuploads', function(Blueprint $table) {
            $table->increments('id');
            $table->integer('class_id')->unsigned()->index();
            $table->string('filename')->index();
            $table->string('filepath');
            $table->timestamps();
        });
	}

	public function down()
	{
		Schema::drop('fileuploads');
	}
}
