<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCProductsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('c_products', function (Blueprint $table) {
            $table->increments('id');

            $table->bigInteger('tv_flow_id')->nullable()->index()->comment('ID(Flow)');
            $table->bigInteger('tvc_flow_id')->nullable()->index()->comment('ID(Flow)');
            $table->bigInteger('product_type_flow_id')->nullable()->index()->comment('ID типа товара(Flow)');
            $table->bigInteger('maincolor_flow_id')->nullable()->index()->comment('ID цвета(Flow)');
            $table->bigInteger('brand_flow_id')->nullable()->index()->comment('ID бренда(Flow)');
            $table->bigInteger('gender_flow_id')->nullable()->index()->comment('ID пола(Flow)');
            $table->bigInteger('line_flow_id')->nullable()->index()->comment('ID линии(Flow)');
            $table->bigInteger('season_flow_id')->nullable()->index()->comment('ID сезона(Flow)');
            $table->bigInteger('product_part_flow_id')->nullable()->index()->comment('ID компоновки(Flow)');
            $table->bigInteger('product_sizerange_flow_id')->nullable()->index()->comment('ID размерного ряда(Flow)');

            $table->tinyInteger('has_full_options')->default(0)->comment('Флаг что товар имеет все опции для вывода в каталоге(остатки, цену, изображения), обновляется после импорта');

            $table->string('image')->nullable()->comment('Изображение');
            $table->string('title')->nullable()->comment('Название');
            $table->string('alias')->nullable()->comment('Псевдоним');
            $table->text('description')->nullable()->comment('Описание(Flow)');

            $table->integer('rating')->nullable()->default(1)->comment('Рейтинг');
            $table->integer('views_count')->nullable()->default(0)->comment('Кол-во просмотров');
            $table->integer('orders_count')->nullable()->default(0)->comment('Кол-во заказов');
            $table->integer('special')->nullable()->default(0)->comment('Special(Flow)');

            $table->string('art')->nullable()->comment('Артикул(Flow)');
            $table->double('weight')->nullable()->comment('Вес(Flow)');
            $table->string('material')->nullable()->comment('Материал(Flow)');

            $table->double('price')->nullable()->comment('Цена(Flow)');
            $table->double('old_price')->nullable()->comment('Старая цена(Flow)');

            $table->integer('price_type')->nullable()->comment('Тип цены спец(18)\склад(7) (Flow)');
            $table->tinyInteger('is_new')->default(0)->comment('Новинка(Flow)');

            $table->dateTime('imported_at')->nullable()->comment('Дата последнего импорта');
            $table->date('modified_at')->nullable()->comment('Дата изменения(Flow)');
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
        Schema::dropIfExists('c_products');
    }
}
