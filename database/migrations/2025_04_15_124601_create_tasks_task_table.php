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
        Schema::create('tasks_task', function (Blueprint $table) {
            $table->id();
            $table->foreignId('project_id')->references('id')->on('tasks_projects')->onDelete('CASCADE');
            $table->foreignId('section_id')->references('id')->on('tasks_sections')->onDelete('CASCADE');
            $table->string('title');
            $table->text('descriptions')->fulltext()->nullable();
            $table->timestamp('date_start')->nullable();
            $table->timestamp('date_end')->nullable();
            $table->boolean('in_work')->default('true');
            $table->enum('type', ['task', 'subtask', 'separator']);
            $table->text('comments')->fulltext()->nullable();
            $table->timestamp('hide_until')->nullable();
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
        Schema::dropIfExists('tasks_task');
    }
};
