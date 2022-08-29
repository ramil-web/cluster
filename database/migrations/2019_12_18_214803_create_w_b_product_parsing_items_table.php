<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateWBProductParsingItemsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('w_b_product_parsing_items', function (Blueprint $table) {
            $table->increments('id');

            $table->integer('nmId')->nullable()->comment('Код WB');
            $table->string('warehouseName')->nullable()->comment('Название склада');
            $table->integer('quantity')->nullable()->comment('Количество доступное для продажи(all sizes)');
            $table->integer('quantityFull')->nullable()->comment('Количество полное(all sizes)');
            $table->integer('quantityNotInOrders')->nullable()->comment('Количество не в заказе(all sizes)');
            $table->integer('inWayToClient')->nullable()->comment('В пути к клиенту(all sizes)');
            $table->integer('inWayFromClient')->nullable()->comment('В пути от клиента(all sizes)');
            $table->integer('category_place')->nullable()->comment('Позиция в выдаче по категории');
            $table->integer('search_place')->nullable()->comment('Позиция в поисковой выдаче');
            $table->string('category_title')->nullable()->comment('Название категории');
            $table->string('search_word')->nullable()->comment('Поисковое слово');
            $table->string('date_rfc3339')->nullable()->comment('Дата парсинга в формате Rfc3339');

            $table->double('lower_price')->nullable()->comment('Текущая цена товара');
            $table->double('old_price')->nullable()->comment('Старая цена товара');
            $table->double('price_sale')->nullable()->comment('Скидка на товар');
            $table->integer('comments_count')->nullable()->comment('Кол-во комментариев');
            $table->integer('stars_count')->nullable()->comment('Рейтинг');

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
        Schema::dropIfExists('w_b_product_parsing_items');
    }
}
