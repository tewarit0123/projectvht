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
        Schema::create('chv', function (Blueprint $table) {
            $table->id();
            $table->string('titlename');
            $table->string('fullname');
            $table->date('birth_date');
            $table->string('phone');
            $table->string('id_card')->unique();
            $table->string('address');
            $table->string('village')->nullable();
            $table->string('username');
            $table->string('password');
            $table->enum('gender', ['male', 'female']);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('chv');
    }
};
