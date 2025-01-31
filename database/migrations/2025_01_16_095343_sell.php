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
        Schema::create('customer', function (Blueprint $table) {

            $table->id();

            $table->string('name')->unique();

            $table->string('address');

            $table->string('phone_number')->unique();

        });

        Schema::create('invoice', function (Blueprint $table) {
            $table->id();
            $table->foreignId('customer_id')->constrained('customer')->cascadeOnDelete();
            $table->integer('order_number');
            $table->datetime('created_at');
            $table->double('sum', 8, 2);
            $table->double('discount', 8, 2);
            $table->text('note')->nullable();
            $table->double('total', 8, 2);






        });
        Schema::create('sell_product', function (Blueprint $table) {

            $table->foreignId('product_id')->constrained('product')->cascadeOnDelete();
            $table->integer('quantity');
            $table->double('sell_price', 8, 2);
            $table->double('sum', 8, 2);
            $table->foreignId('invoice_id')->constrained('invoice')->cascadeOnDelete();




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
