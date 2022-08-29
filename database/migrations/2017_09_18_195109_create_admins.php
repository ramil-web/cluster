<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAdmins extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('admins', function (Blueprint $table) {
            $table->increments('id');
            $table->bigInteger('flow_id')->index()->nullable()->comment('ID в Flow(МЕНЕДЖЕР)');
            $table->string('name')->nullable()->comment('Имя');
            $table->string('surname')->nullable()->comment('Фамилия');
            $table->string('patronymic')->nullable()->comment('Отчество');
            $table->string('phone')->nullable()->comment('Телефон(МЕНЕДЖЕР)');
            $table->string('image')->nullable()->comment('Фото(МЕНЕДЖЕР)');
            $table->string('login')->unique();
            $table->string('email')->nullable();
            $table->string('password');
            $table->tinyInteger('is_active')->default(1)->comment('Флаг активности');
            $table->tinyInteger('orders_dispatch')->default(0)->comment('Рассылка о поступлении заказа');
            $table->tinyInteger('app_dispatch')->default(0)->comment('Рассылка о поступлении заявки');
            $table->tinyInteger('reviews_dispatch')->default(0)->comment('Рассылка о поступлении нового комментария');
            $table->rememberToken();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        //
    }
}
