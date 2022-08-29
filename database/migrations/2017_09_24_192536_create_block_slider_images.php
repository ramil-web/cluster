<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateBlockSliderImages extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('blc_slider_images', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('blc_slider_id')->unsigned()->index()->comment('ID блока слайдера');
            $table->string('path')->comment('Путь изображения');
            $table->string('ext')->comment('Расширение изображения');
            $table->foreign('blc_slider_id')->references('id')->on('blc_sliders');
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
