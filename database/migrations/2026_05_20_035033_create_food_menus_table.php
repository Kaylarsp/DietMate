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
        Schema::create('food_menus', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('category'); // sarapan, siang, malam
            $table->integer('calories');
            $table->integer('protein_g');
            $table->integer('carbs_g');
            $table->integer('fat_g');
            $table->text('description');
            $table->string('image_url');
            $table->boolean('is_active')->default(true);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('food_menus');
    }
};
