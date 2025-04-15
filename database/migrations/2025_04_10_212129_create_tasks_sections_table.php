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
        Schema::create('tasks_sections', function (Blueprint $table) {
            $table->id();
            $table->foreignId('project_id')->default(0);
            $table->string('title');
            $table->json('properties')->nullable();
            $table->unsignedTinyInteger('sort')->nullable();
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tasks_sections');
    }
};
