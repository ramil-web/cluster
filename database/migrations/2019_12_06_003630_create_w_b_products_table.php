<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateWBProductsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('w_b_products', function (Blueprint $table) {
            $table->increments('id');

            $table->integer('nmId')->nullable()->comment('Код WB');
            $table->bigInteger('tvc_flow_id')->nullable()->index()->comment('ID(Flow)');
            $table->string('warehouseName')->nullable()->comment('Название склада');
            $table->string('supplierArticle')->nullable()->comment('Ваш артикул');
            $table->string('techSize')->nullable()->comment('Размер');
            $table->string('brand')->nullable()->comment('Бренд');
            $table->double('conversion')->default(0)->nullable()->comment('Конверсия за год');
            $table->integer('quantity')->nullable()->comment('Количество доступное для продажи');
            $table->integer('quantityFull')->nullable()->comment('Количество полное');
            $table->integer('quantityNotInOrders')->nullable()->comment('Количество не в заказе');
            $table->string('category')->nullable()->comment('Категория');
            $table->string('subject')->nullable()->comment('Предмет');
            $table->integer('daysOnSite')->nullable()->comment('Количество дней на сайте');
            $table->string('barcode')->nullable()->comment('Штрих-код');
            $table->string('isSupply')->nullable()->comment('Договор поставки');
            $table->string('isRealization')->nullable()->comment('Договор реализации');
            $table->integer('inWayToClient')->nullable()->comment('В пути к клиенту(штук)');
            $table->integer('inWayFromClient')->nullable()->comment('В пути от клиента(штук)');
            $table->string('lastChangeDate')->nullable()->comment('Дата и время обновления информации в сервисе');
            $table->longText('quantity_history')->nullable()->comment('История количества');
            $table->longText('parser_history')->nullable()->comment('История парсинга');
            $table->integer('search_pars_new')->nullable()->comment('Новая(текущая) позиция в поисковой выдаче');
            $table->integer('search_pars_old')->nullable()->comment('Старая позиция в поисковой выдаче');
            $table->integer('category_pars_new')->nullable()->comment('Новая(текущая) позиция в выдаче по категории');
            $table->integer('category_pars_old')->nullable()->comment('Старая позиция в выдаче по категории');

            $table->integer('rating')->nullable()->default(0)->comment('Рейтинг(наш)');
            $table->tinyInteger('is_outgoing_goods')->default(0)->comment('Флаг -Уходящий товар-');
            $table->tinyInteger('is_new_goods')->default(0)->comment('Флаг -Новинка-');

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
        Schema::dropIfExists('w_b_products');
    }
}
