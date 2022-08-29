<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateWBSalesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('w_b_sales', function (Blueprint $table) {
            $table->increments('id');

            $table->integer('nmId')->nullable()->comment('Код WB');
            $table->string('number')->nullable()->comment('Номер документа');
            $table->string('promoCodeDiscount')->nullable()->comment('Согласованный промокод');
            $table->string('warehouseName')->nullable()->comment('Склад отгрузки');
            $table->string('countryName')->nullable()->comment('Страна');
            $table->string('oblastOkrugName')->nullable()->comment('Округ');
            $table->string('regionName')->nullable()->comment('Регион');
            $table->string('supplierArticle')->nullable()->comment('Ваш артикул');
            $table->string('techSize')->nullable()->comment('Размер');
            $table->string('barcode')->nullable()->comment('Штрих-код');
            $table->integer('quantity')->nullable()->comment('Количество');
            $table->double('totalPrice')->nullable()->comment('Начальная розничная цена товара');
            $table->double('discountPercent')->nullable()->comment('Согласованная скидка на товар');
            $table->string('isSupply')->nullable()->comment('Договор поставки');
            $table->string('isRealization')->nullable()->comment('Договор реализации');
            $table->string('orderId')->nullable()->comment('Номер исходного заказа');
            $table->integer('incomeID')->nullable()->comment('Номер поставки');
            $table->string('saleID')->nullable()->comment('Уникальный идентификатор продажи\ возврата(SXXXX-продажа,RXXXX- возврат,DXXXX-доплата)');
            $table->string('odid')->nullable()->comment('Уникальный идентификатор позиции заказа');
            $table->string('spp')->nullable()->comment('Согласованная скидка постоянного покупателя(СПП)');
            $table->double('forPay')->nullable()->comment('К перечислению поставщику');
            $table->double('finishedPrice')->nullable()->comment('Фактическая цена из заказа(с учетом всех скидок, включая и от WB)');
            $table->double('priceWithDisc')->nullable()->comment('Цена от которой считается вознаграждение поставщика forpay(с учетом всех согласованных скидок)');
            $table->string('subject')->nullable()->comment('Предмет');
            $table->string('category')->nullable()->comment('Категория');
            $table->string('brand')->nullable()->comment('Бренд');
            $table->string('date')->nullable()->comment('Дата продажи');
            $table->string('lastChangeDate')->nullable()->comment('Дата время обновления информации в сервисе');
            $table->dateTime('sale_at')->nullable()->comment('Дата Продажи');

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
        Schema::dropIfExists('w_b_sales');
    }
}
