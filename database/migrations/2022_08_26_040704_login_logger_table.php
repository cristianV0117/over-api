<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('login_logger', function (Blueprint $table) {
            $table->increments('id');
            $table->tinyInteger('type');
            $table->integer('user_id')->unsigned();
            $table->string('ip', 25);
            $table->string('browser', 25);
            $table->string('os', 25);
            $table->timestamps();
            $table->foreign('user_id')->references('id')->on('users');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('login_logger');
    }
};
