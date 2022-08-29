<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePageTypeSidebar extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('page_type_sidebar', function (Blueprint $table) {
            $table->integer('sidebar_id')->unsigned()->nullable();
            $table->integer('page_type_id')->unsigned()->nullable();
            $table->unique(['sidebar_id', 'page_type_id'], 'unique_pair');
            $table->foreign('sidebar_id')->references('id')->on('sidebars');
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
