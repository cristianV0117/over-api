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
        Schema::create('tasks', function (Blueprint $table) {
            $table->increments('id');
            $table->string('task', 45);
            $table->text('description');
            $table->integer('status');
            $table->integer('priority');
            $table->dateTime('dead_line');
            $table->dateTime('closing_date')->nullable();
            $table->integer('user_id')->unsigned();
            $table->integer('categorie_task_id')->unsigned();
            $table->timestamps();
            $table->foreign('user_id')->references('id')->on('users');
            $table->foreign('categorie_task_id')->references('id')->on('categories_tasks');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('tasks');
    }
};
