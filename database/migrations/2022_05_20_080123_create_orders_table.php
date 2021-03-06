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
        Schema::create('orders', function (Blueprint $table) {
            $table->id()->uni;
            $table->bigInteger('user_id')->unsigned();
            $table->bigInteger('subtotal');
            $table->integer('discount')->default(0);
            $table->integer('tax');
            $table->bigInteger('total');
            $table->integer('cost');
            $table->string('firstname');
            $table->string('lastname');
            $table->string('mobile');
            $table->string('email');
            $table->string('f_address');
            $table->string('city');
            $table->string('province');
            $table->string('zipcode');
            $table->enum('status', ['ordered', 'approved', 'pending', 'delivered', 'canceled'])->default('ordered');
            $table->timestamps();
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('orders');
    }
};
