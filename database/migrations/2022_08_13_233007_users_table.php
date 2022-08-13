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
        Schema::create('users', function (Blueprint $table) {
            $table->increments('id');
            $table->string('user_name', 45);
            $table->string('first_name', 45);
            $table->string('second_name', 45)->nullable();
            $table->string('first_last_name', 45);
            $table->string('second_last_name', 45)->nullable();
            $table->string('email', 125)->unique();
            $table->string('cellphone', 12)->nullable();
            $table->string('password', 125);
            $table->integer('state_id')->unsigned();
            $table->timestamps();
            $table->foreign('state_id')->references('id')->on('states');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('users');
    }
};
