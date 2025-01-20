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
        Schema::create('invoice', function (Blueprint $table) {
            $table->id();
            $table->integer('order_number');
            $table->decimal('discount');




        });
        Schema::create('invoice_id', function (Blueprint $table) {

            $table->foreignId('product_id')->constrained('product');
            $table->integer('quantity');
            $table->decimal('price');
            $table->foreignId('invoice_id')->constrained('invoice');




        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        //
    }
};
