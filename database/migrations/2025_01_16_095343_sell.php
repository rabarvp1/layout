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
            $table->string('customer');
            $table->integer('order_number');
            $table->datetime('created_at');
            $table->integer('sum');
            $table->decimal('discount');
            $table->text('note')->nullable();
            $table->integer('total');






        });
        Schema::create('sell_product', function (Blueprint $table) {

            $table->foreignId('product_id')->constrained('product')->cascadeOnDelete();
            $table->integer('quantity');
            $table->decimal('sell_price');
            $table->decimal('sum');
            $table->foreignId('invoice_id')->constrained('invoice')->cascadeOnDelete();




        });


        Schema::create('customer', function (Blueprint $table) {

            $table->id();

            $table->string('name')->unique();

            $table->string('address');

            $table->string('phone_number')->unique();

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
