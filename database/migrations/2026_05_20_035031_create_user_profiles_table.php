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
        Schema::create('user_profiles', function (Blueprint $table) {
            $table->id();
            // Relasi ke tabel users
            $table->foreignId('user_id')->constrained('users')->onDelete('cascade');
            $table->integer('age');
            $table->string('gender');
            $table->float('height_cm', 5, 1);
            $table->float('weight_kg', 5, 1);
            $table->string('activity_level');
            $table->float('bmi', 4, 2);
            $table->integer('daily_calorie_target');
            $table->string('diet_goal');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('user_profiles');
    }
};
