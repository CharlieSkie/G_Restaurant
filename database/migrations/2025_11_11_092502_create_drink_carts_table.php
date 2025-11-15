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
        Schema::create('drink_carts', function (Blueprint $table) {
            $table->id();
            $table->integer('userID');
            $table->integer('drink_id');
            $table->string('drink_name')->nullable();
            $table->string('drink_details')->nullable();
            $table->string('drink_image')->nullable();
            $table->integer('drink_quantity')->nullable();
            $table->integer('drink_price')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('drink_carts');
    }
};
