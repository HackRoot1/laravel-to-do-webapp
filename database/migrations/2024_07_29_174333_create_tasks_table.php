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
        Schema::create('tasks', function (Blueprint $table) {
            $table->id(); // Auto-incrementing ID
            $table->foreignId('user_id')->constrained()->onDelete('cascade'); // Foreign key to users table
            $table->string('task_title', 255); // Task title with a maximum length of 255 characters
            $table->text('task_description'); // Use text instead of string for potentially long descriptions
            $table->integer('task_status')->default(0); // Status with default value 0
            $table->date('task_due_date')->nullable(); // Due date, nullable
            $table->string('task_category', 100)->nullable(); // Task category with a maximum length of 100 characters, nullable
            $table->timestamps(); // Created at and updated at timestamps
        });
        
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tasks');
    }
};
