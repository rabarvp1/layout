<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;


return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('purchase', function (Blueprint $table) {
            $table->id();
            $table->integer('order_number');
            $table->decimal('discount');
            $table->datetime('created_at');
            $table->text('note')->nullable();



        });
        Schema::create('purchase_product', function (Blueprint $table) {
            $table->foreignId('product_id')->constrained('product');
            $table->integer('quantity');
            $table->decimal('cost');
            $table->foreignId('purchase_id')->constrained('purchase')->cascadeOnDelete();




        });
        // DB::statement('ALTER TABLE pi ADD CONSTRAINT check_quantity_nonnegative CHECK (quantity >= 0)');

    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {

    }
};
