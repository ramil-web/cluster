<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateBlcGoogleMapsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('blc_google_maps', function (Blueprint $table) {
            $table->increments('id');
            $table->string('type')->default('google_map')->comment('Тип блока');
            $table->string('version')->comment('Вариант реализации')->default('default');
            $table->integer('page_type_id')->unsigned()->index()->comment('ID типа страницы');
            $table->integer('page_id')->unsigned()->index()->comment('ID страницы');
            $table->string('zoom')->comment('Масштабирование карты')->nullable();
            $table->string('height')->comment('Высота карты')->nullable();
            $table->integer('sort')->default(0);
            $table->tinyInteger('is_active')->default(1)->comment('Флаг активности');
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
        Schema::dropIfExists('blc_google_maps');
    }
}
