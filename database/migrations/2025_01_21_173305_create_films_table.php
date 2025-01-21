<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateFilmsTable extends Migration
{
    public function up()
    {
        Schema::create('films', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->integer('year');
            $table->string('genre');
            $table->string('country');
            $table->integer('duration');
            $table->string('img_url');
        });
    }

    public function down()
    {
        Schema::dropIfExists('films');
    }
}
