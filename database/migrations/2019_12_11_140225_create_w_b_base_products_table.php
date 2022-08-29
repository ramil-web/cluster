<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateWBBaseProductsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('w_b_base_products', function (Blueprint $table) {
            $table->increments('id');

            $table->integer('nmId')->nullable()->comment('Код WB');
            $table->bigInteger('tvc_flow_id')->nullable()->index()->comment('ID(Flow)');
            $table->string('supplierArticle')->nullable()->comment('Ваш артикул');
            $table->string('brand')->nullable()->comment('Бренд');
            $table->string('category')->nullable()->comment('Категория');
            $table->string('subject')->nullable()->comment('Предмет');

            $table->integer('quantity')->nullable()->comment('Количество доступное для продажи (все размеры)');
            $table->integer('quantityFull')->nullable()->comment('Количество полное (все размеры)');
            $table->integer('quantityNotInOrders')->nullable()->comment('Количество не в заказе (все размеры)');
            $table->integer('inWayToClient')->nullable()->comment('В пути к клиенту(штук) (все размеры)');
            $table->integer('inWayFromClient')->nullable()->comment('В пути от клиента(штук) (все размеры)');
            $table->integer('orders_count')->nullable()->comment('Количество заказов(все размеры)');
            $table->integer('sales_count')->nullable()->comment('Количество продаж(все размеры)');

            $table->double('d_cat_pl')->nullable()->comment('Текущая позиция по выдаче в категории');
            $table->double('w_cat_avg_pl')->nullable()->comment('Средняя позиция по выдаче в категории(7 дней)');
            $table->double('w_cat_min_pl')->nullable()->comment('Мин. позиция по выдаче в категории(7 дней)');
            $table->double('w_cat_max_pl')->nullable()->comment('Макс. позиция по выдаче в категории(7 дней)');
            $table->double('w_cat_vl_prc')->nullable()->comment('Волатильность по позициям выдачи в категории(7 дней)');
            $table->double('d_src_pl')->nullable()->comment('Текущая позиция по поисковой выдаче');
            $table->double('w_src_min_pl')->nullable()->comment('Средняя позиция по поисковой выдаче (7 дней)');
            $table->double('w_src_avg_pl')->nullable()->comment('Мин. позиция по поисковой выдаче (7 дней)');
            $table->double('w_src_max_pl')->nullable()->comment('Макс. позиция по поисковой выдаче(7 дней)');
            $table->double('w_src_vl_prc')->nullable()->comment('Волатильность по позициям поисковой выдачи(7 дней)');

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
        Schema::dropIfExists('w_b_base_products');
    }
}
