<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateBlockSliderTextBlocks extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('blc_slider_texts', function (Blueprint $table) {
            $table->increments('id');
            $table->string('type')->default('slider_text')->comment('Тип блока');
            $table->string('version')->comment('Вариант реализации')->default('default');
            $table->integer('page_type_id')->unsigned()->index()->comment('ID типа страницы');
            $table->integer('page_id')->unsigned()->index()->comment('ID страницы');
            $table->string('resize_width')->comment('Ширина изображений слайдера')->nullable();
            $table->string('resize_height')->comment('Высота изображений слайдера')->nullable();
            $table->integer('sort')->default(0);
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
