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
        Schema::create('volunteers', function (Blueprint $table) {
            $table->id();
            $table->string('national_id')->unique();
            $table->string('titlename');
            $table->string('fullname');
            $table->string('address');
            $table->string('phone');
            $table->date('birth_date');
            $table->decimal('height', 5, 2);
            $table->decimal('weight', 5, 2);
            $table->enum('gender', ['male', 'female']);
            $table->enum('status', ['0', '1']);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('volunteers');
    }
};
