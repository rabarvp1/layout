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
        });
        DB::table('name_of_roles')->insert([
            ['name' => 'All Roles Of Users'],
            ['name' => 'All Roles Of Selling'],
            ['name' => 'All Roles Of Purchasing'],
            ['name' => 'View Invoices'],
            ['name' => 'View Purchases'],
            ['name' => 'All Roles Of Storage'],
            ['name' => 'All Roles Of Supplier'],
            ['name' => 'All Roles Of Customer'],
            ['name' => 'All Roles Of Product'],
            ['name' => 'All Roles Of Category'],
            ['name' => 'Renewals During The Sale'],

        ]);
    }
};
