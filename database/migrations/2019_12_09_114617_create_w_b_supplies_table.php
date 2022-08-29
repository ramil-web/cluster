<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateWBSuppliesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('w_b_supplies', function (Blueprint $table) {
            $table->increments('id');

            $table->integer('nmId')->nullable()->comment('Код WB');
            $table->string('warehouseName')->nullable()->comment('Название склада');
            $table->string('supplierArticle')->nullable()->comment('Ваш артикул');
            $table->string('techSize')->nullable()->comment('Размер');
            $table->integer('quantity')->nullable()->comment('Количество');
            $table->string('totalPrice')->nullable()->comment('Цена из УПД');
            $table->string('number')->nullable()->comment('Номер УПД');
            $table->integer('incomeId')->nullable()->comment('Номер поставки');
            $table->string('barcode')->nullable()->comment('Штрих-код');
            $table->string('date')->nullable()->comment('Дата поступления');
            $table->string('lastChangeDate')->nullable()->comment('Дата и время обновления информации в сервисе');
            $table->string('dateClose')->nullable()->comment('Дата принятия(закрытия) в WB');

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
        Schema::dropIfExists('w_b_supplies');
    }
}
