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
        Schema::create('catalogs', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('slug')->unique();
            $table->string('origin')->nullable();
            $table->text('description')->nullable();
            $table->string('image')->nullable();
            $table->string('type')->nullable(); // e.g., "Marble", "Quartzite"
            $table->string('application')->nullable(); // e.g., "Statement Walls", "Flooring"
            $table->boolean('is_featured')->default(false);
            $table->integer('sort_order')->default(0);
            $table->boolean('status')->default(true); // active/inactive
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('catalogs');
    }
};
