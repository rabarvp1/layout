<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('roles', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->foreignId('user_id')->constrained('users')->cascadeOnDelete();
        });

        Schema::create('name_of_roles', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('prefix');
        });
        DB::table('name_of_roles')->insert([
            ['name' => 'All Roles Of Users', 'prefix' => 'user'],
            ['name' => 'All Roles Of Selling', 'prefix' => 'sell'],
            ['name' => 'All Roles Of Purchasing', 'prefix' => 'purchase'],
            ['name' => 'View Invoices', 'prefix' => 'view_invoice'],
            ['name' => 'View Purchases', 'prefix' => 'view_purchase'],
            ['name' => 'All Roles Of Storage', 'prefix' => 'storage'],
            ['name' => 'All Roles Of Supplier', 'prefix' => 'supplier'],
            ['name' => 'All Roles Of Customer', 'prefix' => 'customer'],
            ['name' => 'All Roles Of Product', 'prefix' => 'product'],
            ['name' => 'All Roles Of Category', 'prefix' => 'cat'],
            ['name' => 'Renewals During The Sale', 'prefix' => 'edit_sell'],
        ]);
        DB::table('roles')->insert([
            ['name' => 'user'],
            ['name' => 'sell'],
            ['name' => 'purchase'],
            ['name' => 'view_invoice'],
            ['name' => 'view_purchase'],
            ['name' => 'storage'],
            ['name' => 'supplier'],
            ['name' => 'customer'],
            ['name' => 'product'],
            ['name' => 'cat'],
            ['name' => 'edit_sell'],
        ]);

    }
};
