<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateWBOrdersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('w_b_orders', function (Blueprint $table) {
            $table->increments('id');

            $table->integer('nmId')->nullable()->comment('Код WB');
            $table->string('number')->nullable()->comment('Номер заказа WB');
            $table->string('oblast')->nullable()->comment('Область');
            $table->string('warehouseName')->nullable()->comment('Склад отгрузки');
            $table->string('supplierArticle')->nullable()->comment('Ваш артикул');
            $table->string('subject')->nullable()->comment('Предмет');
            $table->string('category')->nullable()->comment('Категория');
            $table->string('brand')->nullable()->comment('Бренд');
            $table->integer('quantity')->nullable()->comment('Количество');
            $table->string('techSize')->nullable()->comment('Размер');
            $table->double('totalPrice')->nullable()->comment('Цена до согласованной скидки\промо\спп');
            $table->double('discountPercent')->nullable()->comment('Согласованный итоговый дисконт');
            $table->string('barcode')->nullable()->comment('Штрих-код');
            $table->string('incomeID')->nullable()->comment('Номер поставки');
            $table->string('odid')->nullable()->comment('Уникальный идентификатор позиции заказа');
            $table->string('date')->nullable()->comment('Дата заказа');
            $table->string('lastChangeDate')->nullable()->comment('Дата время обновления информации в сервисе');
            $table->integer('isCancel')->nullable()->comment('isCancel');
            $table->dateTime('order_at')->nullable()->comment('Дата Заказа');

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
        Schema::dropIfExists('w_b_orders');
    }
}
