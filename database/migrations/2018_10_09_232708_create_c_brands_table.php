<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCBrandsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('c_brands', function (Blueprint $table) {
            $table->increments('id');

            $table->bigInteger('flow_id')->index()->comment('ID в Flow');
            $table->string('title')->nullable()->comment('Название');
            $table->string('short_title')->nullable()->comment('Короткое название');

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
        Schema::dropIfExists('c_brands');
    }
}
