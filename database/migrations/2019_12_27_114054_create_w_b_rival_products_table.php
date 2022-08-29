<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateWBRivalProductsTable extends Migration
{
    /**
     * Run the migrations.
     *


    lower_price
    old_price
    price_sale
    comments_count
    stars_count
    parsed_at
     *
     * @return void
     */
    public function up()
    {
        Schema::create('w_b_rival_products', function (Blueprint $table) {
            $table->increments('id');

            $table->integer('nmId')->index()->nullable()->comment('Код WB');
            $table->integer('category_id')->nullable()->comment('ID категории парсинга');
            $table->integer('category_place')->nullable()->comment('Место в выдаче по категории');
            $table->string('brand_name')->nullable()->comment('Название бренда');
            $table->double('lower_price')->nullable()->comment('Текущая цена товара');
            $table->double('old_price')->nullable()->comment('Старая цена товара');
            $table->double('price_sale')->nullable()->comment('Скидка на товар');
            $table->integer('comments_count')->nullable()->comment('Кол-во комментариев');
            $table->integer('stars_count')->nullable()->comment('Рейтинг');
            $table->text('sizes')->nullable()->comment('Размеры');
            $table->timestamp('parsed_at')->nullable()->comment('Дата парсинга');

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
        Schema::dropIfExists('w_b_rival_products');
    }
}
