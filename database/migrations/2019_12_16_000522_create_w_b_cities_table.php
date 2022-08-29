<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateWBCitiesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('w_b_cities', function (Blueprint $table) {
            $table->increments('id');

            $table->string('stock')->nullable()->comment('Название склада');
            $table->string('city')->nullable()->comment('Название города');
            $table->string('cookie')->nullable()->comment('Куки');

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
        Schema::dropIfExists('w_b_cities');
    }
}
