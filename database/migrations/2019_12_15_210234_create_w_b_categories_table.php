<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateWBCategoriesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('w_b_categories', function (Blueprint $table) {
            $table->increments('id');

            $table->string('title')->nullable()->comment('Название категории(поле subject)(WB)');
            $table->string('breadcrumbs')->nullable()->comment('Хлебные крошки(WB)');
            $table->string('url')->nullable()->comment('URL категории(WB)');
            $table->string('search')->nullable()->comment('Слово для поиска');

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
        Schema::dropIfExists('w_b_categories');
    }
}
