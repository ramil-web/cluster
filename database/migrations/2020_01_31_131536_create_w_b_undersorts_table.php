<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateWBUndersortsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('w_b_undersorts', function (Blueprint $table) {
            $table->increments('id');

            $table->string('title')->nullable()->comment('Название подсортировки');
            $table->string('alias')->nullable()->comment('Для XML');

            $table->date('start_at')->nullable()->comment('Дата старта выборки');
            $table->date('end_at')->nullable()->comment('Дата окончания выборки');
            $table->dateTime('undersort_at')->nullable()->comment('Дата проведения');

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
        Schema::dropIfExists('w_b_undersorts');
    }
}
