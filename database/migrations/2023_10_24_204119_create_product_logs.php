<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('product_logs', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->integer('id_product');
            $table->string('product_name');
            
            $table->unsignedBigInteger('id_category');
            $table->foreign('id_category')->references('id')->on('categories');

            $table->double('price',11,0);
            $table->integer('stock');
            $table->double('iva',11,0);
            $table->date('date_carga');
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
        Schema::dropIfExists('product_logs');
    }
};
