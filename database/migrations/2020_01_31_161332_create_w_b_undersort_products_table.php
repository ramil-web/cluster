<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateWBUndersortProductsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('w_b_undersort_products', function (Blueprint $table) {
            $table->increments('id');

            $table->integer('undersort_id')->nullable()->comment('ID подсортировки');
            $table->integer('base_product_id')->nullable()->comment('ID w_b_base_product');
            $table->integer('nmId')->nullable()->comment('Код WB');
            $table->string('barcode')->nullable()->comment('Штрих-код');
            $table->string('warehouseName')->nullable()->comment('Название склада');
            $table->string('supplierArticle')->nullable()->comment('Ваш артикул');
            $table->string('techSize')->nullable()->comment('Размер');
            $table->double('conversion')->default(0)->nullable()->comment('Конверсия за год');
            $table->integer('estimated_balance')->default(0)->nullable()->comment('Расчетный остаток');
            $table->integer('days_on_site')->default(0)->nullable()->comment('Кол.во дней на сайте(б\п)');
            $table->integer('orders')->default(0)->nullable()->comment('Заказы за (б\п)');
            $table->integer('sales')->default(0)->nullable()->comment('Продажи за (б\п)');
            $table->integer('orders_last_year')->default(0)->nullable()->comment('Заказы за год');
            $table->integer('sales_last_year')->default(0)->nullable()->comment('Продажи за год');
            $table->integer('product_need')->default(0)->nullable()->comment('Потребность в товаре');
            $table->integer('undersort_count')->default(0)->nullable()->comment('Товар к подсортировке');

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
        Schema::dropIfExists('w_b_undersort_products');
    }
}
