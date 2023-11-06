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
        Schema::create('users', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('first_name');
            $table->string('last_name');
            $table->string('rol')->default('ADMIN');

            $table->unsignedBigInteger('id_type');
            $table->foreign('id_type')->references('id')->on('type_documents');

            $table->string('document');
            $table->string('phone');
            $table->string('email');
            $table->string('password');
            $table->enum('status',['ACTIVE','LOCKED'])->default('ACTIVE');
            $table->string('image',50)->nullable();

            $table->foreign('rol')->references('name')->on('roles');
            
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
        Schema::dropIfExists('users');
    }
};
