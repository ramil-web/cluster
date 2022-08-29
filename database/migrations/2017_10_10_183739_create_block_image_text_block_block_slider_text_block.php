<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateBlockImageTextBlockBlockSliderTextBlock extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('blc_image_text_blc_slider_text', function (Blueprint $table) {
            $table->integer('blc_image_text_id')->unsigned()->nullable();
            $table->integer('blc_slider_text_id')->unsigned()->nullable();
            $table->unique(['blc_image_text_id', 'blc_slider_text_id'], 'unique_pair');
            $table->foreign('blc_image_text_id')->references('id')->on('blc_image_texts');
            $table->foreign('blc_slider_text_id')->references('id')->on('blc_slider_texts');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
       
    }
}
