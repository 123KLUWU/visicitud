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
        // Migration priorities
        Schema::create('priorities', function (Blueprint $table) {
            $table->id();
            $table->string('name');
        });

        // Migration frequencies
        Schema::create('frequencies', function (Blueprint $table) {
            $table->id();
            $table->string('name');
        });

        // Migration statuses
        Schema::create('statuses', function (Blueprint $table) {
            $table->id();
            $table->string('name');
        });

        Schema::create('tasks', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->onDelete('cascade');
            $table->string('title');
            $table->text('description')->nullable();
            $table->datetime('due_date')->nullable();
            $table->foreignId('priority_id')->constrained()->nullOnDelete()->nullable();
            $table->foreignId('status_id')->constrained()->nullOnDelete()->nullable();
            $table->boolean('recurrent')->default(false);
            $table->foreignId('frequency_id')->constrained()->nullOnDelete()->nullable();
            $table->date('start_date')->nullable();
            $table->date('end_date')->nullable();
            $table->integer('repetitions')->nullable();
            $table->timestamps();
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
