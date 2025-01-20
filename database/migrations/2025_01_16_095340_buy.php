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
        Schema::create('po', function (Blueprint $table) {
            $table->id();
            $table->integer('order_number');
            $table->decimal('discount');



        });
        Schema::create('pi', function (Blueprint $table) {
            $table->foreignId('product_id')->constrained('product');
            $table->integer('quantity');
            $table->decimal('cost');
            $table->foreignId('po_id')->constrained('po');




        });
        DB::statement('ALTER TABLE pi ADD CONSTRAINT check_quantity_nonnegative CHECK (quantity >= 0)');

    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        DB::statement('ALTER TABLE pizzas DROP CONSTRAINT check_quantity_nonnegative');

    }
};
