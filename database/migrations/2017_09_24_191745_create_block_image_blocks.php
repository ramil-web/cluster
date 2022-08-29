<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateBlockImageBlocks extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('blc_images', function (Blueprint $table) {
            $table->increments('id');
            $table->string('type')->default('image')->comment('Тип блока');
            $table->string('version')->comment('Вариант реализации')->default('default');
            $table->integer('page_type_id')->unsigned()->index()->comment('ID типа страницы');
            $table->integer('page_id')->unsigned()->index()->comment('ID страницы');

            $table->string('name')->comment('Название изображения')->nullable();
            $table->string('ext')->comment('Разрешение изображения')->nullable();
            $table->string('alt')->comment('Альт текст изображения')->nullable();

            $table->string('resize_width')->comment('Ширина требуемого изображения')->nullable();
            $table->string('resize_height')->comment('Высота требуемого изображения')->nullable();
            
            $table->string('width')->comment('Ширина оригинального изображения')->nullable();
            $table->string('height')->comment('Высота оригинального изображения')->nullable();

            $table->string('x')->comment('Координаты для ресайза')->nullable();
            $table->string('y')->comment('Координаты для ресайза')->nullable();

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
