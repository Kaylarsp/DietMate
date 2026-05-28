<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('food_preferences', function (Blueprint $table) {
            $table->id();

            $table->foreignId('user_profile_id')
                ->constrained()
                ->onDelete('cascade');

            $table->string('preference_name');

            $table->enum('type', [
                'preference',
                'allergy'
            ]);

            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('food_preferences');
    }
};
