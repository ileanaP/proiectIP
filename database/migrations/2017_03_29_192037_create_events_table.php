<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateEventsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('events', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name');
            $table->integer('category')->unsigned();
            $table->string('location');
            $table->integer('price');
            $table->text('desc');
            $table->string('picture');
            $table->string('link');
            $table->time('data');
            $table->integer('org_id')->unsigned();
            $table->timestamps();
        });

        Schema::enableForeignKeyConstraints();

        Schema::table('events', function (Blueprint $table) {
            $table->foreign('org_id')->references('id')->on('org')->onDelete('cascade')->onUpdate('cascade');
            $table->foreign('category')->references('id')->on('categories')->onDelete('cascade')->onUpdate('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('events');
    }
}
