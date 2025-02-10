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
            ['name' => 'admin'],
            ['name' => 'selling'],
            ['name' => 'buy'],
            ['name' => 'invoice'],
            ['name' => 'purchase'],

        ]);
    }
};
