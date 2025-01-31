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
            $table->foreignId('suplier_id')->constrained('suplier')->cascadeOnDelete();
            $table->integer('order_number');
            $table->datetime('created_at');
            $table->double('sum', 8, 2);
            $table->double('discount');
            $table->text('note')->nullable();
            $table->double('total', 8, 2);

        });
        Schema::create('purchase_product', function (Blueprint $table) {
            $table->foreignId('product_id')->constrained('product')->cascadeOnDelete();
            $table->integer('quantity');
            $table->double('cost', 8, 2);
            $table->double('sum', 8, 2);
            $table->foreignId('purchase_id')->constrained('purchase')->cascadeOnDelete();

        });

        Schema::create('storage', function (Blueprint $table) {
            $table->foreignId('product_id')->constrained('product')->cascadeOnDelete();
            $table->integer('quantity');
            $table->double('avg_cost', 8, 2);
            $table->string('cat');

        });

    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {

    }
};
