<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateBlockTypePageType extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('block_type_page_type', function (Blueprint $table) {
            $table->integer('block_type_id')->unsigned()->nullable();
            $table->integer('page_type_id')->unsigned()->nullable();
            $table->unique(['block_type_id', 'page_type_id'], 'unique_pair');
            $table->foreign('block_type_id')->references('id')->on('block_types');
            $table->foreign('page_type_id')->references('id')->on('page_types');
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
