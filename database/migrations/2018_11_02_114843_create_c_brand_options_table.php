<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCBrandOptionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('c_brand_options', function (Blueprint $table) {
            $table->increments('id');

            $table->bigInteger('brand_flow_id')->index()->nullable()->comment('ID бренда(Flow)');

            $table->integer('icon_id')->unsigned()->nullable()->comment('Иконка бренда');
            $table->foreign('icon_id')->references('id')->on('icons')->onDelete('set null');

            $table->string('brand_title')->nullable()->comment('Название бренда');

            $table->text('text')->nullable()->comment('Описание бренда');

            $table->string('image')->nullable()->comment('Основное изображение');

            $table->integer('sort')->nullable()->default(null)->comment('Сортировка');
            $table->tinyInteger('is_active')->nullable()->default(1)->comment('Флаг активности');
            $table->tinyInteger('for_main')->nullable()->default(0)->comment('Флаг Для главной');

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
        Schema::dropIfExists('c_brand_options');
    }
}
