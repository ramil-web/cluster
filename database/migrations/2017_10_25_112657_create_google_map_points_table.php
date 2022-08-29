<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateGoogleMapPointsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        $this->down();
        Schema::create('google_map_points', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('blc_google_map_id')->unsigned()->index()->comment('ID блока карты');
            $table->string('point_name')->comment('Название точки');
            $table->text('address')->nullable()->comment('Адрес');
            $table->string('latitude')->comment('Широта');
            $table->string('longitude')->comment('Долгота');
            $table->tinyInteger('is_center')->default(1)->comment('Установить точку центром карты');
            $table->tinyInteger('is_info')->default(1)->comment('Добавить точке инфо окно');
            $table->string('info_title')->nullable()->comment('Заголовок инфо окна');
            $table->text('info_text')->nullable()->comment('Текст инфо окна');
            $table->string('info_link_title')->nullable()->comment('Текст ссылки в инфо окне');
            $table->string('info_link_url')->nullable()->comment('Url ссылки в инфо окне');
            $table->foreign('blc_google_map_id')->references('id')->on('blc_google_maps');
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
        Schema::dropIfExists('google_map_points');
    }
}
