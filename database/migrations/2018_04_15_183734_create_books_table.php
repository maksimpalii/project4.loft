<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateBooksTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
//        Schema::create('books', function (Blueprint $table) {
//            $table->increments('id');
//            $table->timestamps();
//        });
        Schema::create('categorys', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name'); //varchar 255
            $table->string('description'); //varchar 255
            $table->timestamps(); //created_at&updated_at тип datetime
            $table->softDeletes();
        });
        Schema::create('books', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name'); //varchar 255
            $table->string('description'); //varchar 255
            $table->integer('category_id')->unsigned();
            $table->integer('price'); //varchar 255
            $table->string('photo'); //varchar 255
            $table->timestamps(); //created_at&updated_at тип datetime
            $table->softDeletes();
        });
        Schema::table('books', function (Blueprint $table) {
            $table->foreign('category_id')
                ->references('id')
                ->on('categorys')
                ->onDelete('cascade')
                ->onUpdate('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('books');
        Schema::dropIfExists('categorys');
    }
}
