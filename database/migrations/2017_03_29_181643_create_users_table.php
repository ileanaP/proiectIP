<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUsersTable extends Migration
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
            $table->string('user')->unique();
            $table->string('password');
            $table->string('email')->unique();
            $table->string('name');
            $table->string('surname');
            $table->boolean('active');
            $table->integer('type')->unsigned();
            $table->rememberToken();
            $table->timestamps();
        });

        Schema::enableForeignKeyConstraints();

        Schema::table('users', function (Blueprint $table) {
            //$table->engine('InnoDB');
            $table->foreign('type')->references('id')->on('types')->onDelete('cascade')->onUpdate('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('users');
    }
}
