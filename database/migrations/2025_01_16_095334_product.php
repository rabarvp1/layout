<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('cat', function (Blueprint $table) {
            $table->id();
            $table->string('name');

        });
        Schema::create('product', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->decimal('price',11,2);
            $table->decimal('stock')->default(0);
            $table->foreignId('cat_id')->references('id')->on('cat');
        });

    }

};
