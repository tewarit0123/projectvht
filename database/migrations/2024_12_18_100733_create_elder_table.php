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
        Schema::create('elder', function (Blueprint $table) {
            $table->id();
            $table->string('titlename');  
            $table->string('fullname');   
            $table->string('phone');  
            $table->decimal('height', 5, 2);
            $table->decimal('weight', 5, 2); 
            $table->date('birth_date');  
            $table->string('id_card');  
            $table->string('address');  
            $table->string('village'); 
            $table->enum('gender', ['male', 'female']); 
            $table->string('volunteer'); 
            $table->string('doctor'); 
            $table->string('phonevolunteer'); 
            $table->string('phonedoctor'); 
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('elder');
    }
};
