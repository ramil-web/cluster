<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateBlockTextBlocks extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('blc_texts', function (Blueprint $table) {
            $table->increments('id');
            $table->string('type')->default('text')->comment('Тип блока');
            $table->string('version')->comment('Вариант реализации')->default('default');
            $table->integer('page_type_id')->unsigned()->index()->comment('ID типа страницы');
            $table->integer('page_id')->unsigned()->index()->comment('ID страницы');            
            $table->text('content')->comment('Контент страницы')->nullable();
            $table->integer('sort')->default(0);
            $table->foreign('page_type_id')->references('id')->on('page_types');
            $table->timestamps();
            $table->softDeletes();
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
