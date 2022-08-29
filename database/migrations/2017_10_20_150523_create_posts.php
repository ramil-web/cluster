<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePosts extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('posts', function (Blueprint $table) {
            $table->increments('id');
            $table->string('alias')->nullable()->comment('URL поста');
            $table->string('title')->nullable()->comment('Название поста');
            $table->text('short_text')->nullable()->comment('Короткий текст поста');
            $table->tinyInteger('is_show')->default(1)->comment('Флаг показа');
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
        //
    }
}
