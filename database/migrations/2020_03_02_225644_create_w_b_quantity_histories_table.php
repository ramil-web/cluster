<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateWBQuantityHistoriesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('w_b_quantity_histories', function (Blueprint $table) {
            $table->bigIncrements('id');

            $table->integer('wb_product_id')->comment('ID товара(WB)');
            $table->string('warehouseName')->nullable()->comment('Название склада');
            $table->string('barcode')->nullable()->comment('Штрих-код');

            $table->integer('q')->nullable()->comment('Количество доступное для продажи');
            $table->integer('qf')->nullable()->comment('Количество полное');
            $table->integer('qnio')->nullable()->comment('Количество не в заказе');
            $table->integer('iwtc')->nullable()->comment('В пути к клиенту(штук)');
            $table->integer('iwfc')->nullable()->comment('В пути от клиента(штук)');

            $table->date('parsed_at')->nullable()->comment('Дата парсинга');

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
        Schema::dropIfExists('w_b_quantity_histories');
    }
}
