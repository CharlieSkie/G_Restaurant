<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('ordersses', function (Blueprint $table) {
            $table->id()->autoIncrement();
            $table->string('customer_name');
            $table->string('customer_email');
            $table->string('customer_Address');
            $table->string('customer_phone');
            $table->string('drink_name');
            $table->string('drink_image');   
            $table->integer('drink_quantity');
            $table->integer('drink_price');
            $table->string('order_status')->default('in progress');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('ordersses');
    }
};
