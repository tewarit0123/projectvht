<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMonthlySurveysTable extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('monthly_surveys', function (Blueprint $table) {
            $table->id();
            $table->foreignId('e_id')->constrained()->onDelete('cascade'); // เชื่อมกับตาราง elderly
            $table->date('survey_date'); // วันที่ทำแบบประเมิน

            // Movement
            $table->tinyInteger('walk_6m')->nullable();
            $table->tinyInteger('fall_6mo')->nullable();

            // Nutrition
            $table->tinyInteger('weight_loss')->nullable();
            $table->tinyInteger('appetite_loss')->nullable();

            // Vision
            $table->tinyInteger('vision_problem')->nullable();

            // Hearing
            $table->tinyInteger('hearing_status')->nullable();

            // Depression
            $table->tinyInteger('sadness')->nullable();
            $table->tinyInteger('no_pleasure')->nullable();

            // Daily Living
            $table->tinyInteger('daily_living')->nullable();

            // Oral
            $table->tinyInteger('chewing_problem')->nullable();
            $table->tinyInteger('oral_pain')->nullable();

            $table->text('details')->nullable(); // รายละเอียดเพิ่มเติม

            $table->timestamps(); // created_at และ updated_at
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('monthly_surveys');
    }
}

