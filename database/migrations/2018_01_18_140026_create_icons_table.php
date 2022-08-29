<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateIconsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('icons', function (Blueprint $table) {            
            $table->increments('id');
            $table->string('name')->nullable()->comment('Название');
            $table->string('alias')->nullable()->comment('Псевдоним')->unique();
            $table->string('image')->nullable()->comment('Путь');
            $table->tinyInteger('is_active')->default(1)->comment('Флаг - активности');
            $table->tinyInteger('readonly')->default(0)->comment('Флаг - только чтение');
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
        Schema::dropIfExists('icons');
    }
}
