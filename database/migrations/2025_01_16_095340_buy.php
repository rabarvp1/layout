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
        Schema::create('purchase', function (Blueprint $table) {
            $table->id();
            $table->string('suplier');
            $table->integer('order_number');
            $table->datetime('created_at');
            $table->integer('sum');
            $table->decimal('discount');
            $table->text('note')->nullable();
            $table->integer('total');

        });
        Schema::create('purchase_product', function (Blueprint $table) {
            $table->foreignId('product_id')->constrained('product')->cascadeOnDelete();
            $table->integer('quantity');
            $table->decimal('cost');
            $table->decimal('sum');
            $table->foreignId('purchase_id')->constrained('purchase')->cascadeOnDelete();

        });

    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {

    }
};
