<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateBlockImageTextBlocks extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('blc_image_texts', function (Blueprint $table) {
            $table->increments('id');
            $table->string('type')->default('image_text')->comment('Тип блока');
            $table->string('version')->comment('Вариант реализации')->default('default');
            $table->integer('page_type_id')->unsigned()->index()->comment('ID типа страницы');
            $table->integer('page_id')->unsigned()->index()->comment('ID страницы');
            $table->integer('blc_image_id')->unsigned()->index()->comment('ID блока изображения');
            $table->integer('blc_text_id')->unsigned()->index()->comment('ID текстового блока');
            $table->integer('sort')->default(0);
            $table->foreign('page_type_id')->references('id')->on('page_types');
            $table->foreign('blc_image_id')->references('id')->on('blc_images');
            $table->foreign('blc_text_id')->references('id')->on('blc_texts');
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
