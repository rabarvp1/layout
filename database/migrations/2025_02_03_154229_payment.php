<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('suplier_payment', function (Blueprint $table) {
            $table->id();
            $table->string('type');
            $table->foreignId('suplier_id')->constrained('suplier')->cascadeOnDelete();
            $table->datetime('created_at');
            $table->text('note')->nullable();
            $table->double('amount', 8, 2);
            $table->double('balance', 8, 2);

        });
        Schema::create('customer_payment', function (Blueprint $table) {
            $table->id();
            $table->string('type');
            $table->foreignId('customer_id')->constrained('customer')->cascadeOnDelete();
            $table->datetime('created_at');
            $table->text('note')->nullable();
            $table->double('amount', 8, 2);
            $table->double('balance', 8, 2);

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
