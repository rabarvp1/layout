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
        Schema::create('sell', function (Blueprint $table) {
            $table->id();
            $table->foreignId('product_id')->constrained('product');
            $table->decimal('quantity');
            $table->decimal('sell_price');
            $table->decimal('total');




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
