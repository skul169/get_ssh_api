<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCloneTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('clone', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('uid', 255)->nullable();
            $table->string('first', 255)->nullable();
            $table->string('last', 255)->nullable();
            $table->string('email', 255)->nullable();
            $table->string('pass', 255)->nullable();
            $table->text('cookie')->nullable();
            $table->text('token')->nullable();
            $table->enum('sex', ['0', '1'])->nullable();
            $table->date('birthday')->nullable();
            $table->dateTime('created_at');
            $table->dateTime('updated_at');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        //
    }
}
