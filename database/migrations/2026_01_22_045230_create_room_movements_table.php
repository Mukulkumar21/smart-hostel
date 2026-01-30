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
        Schema::create('room_movements', function (Blueprint $table) {
            $table->id();

            // Student relation
            $table->foreignId('student_id')
                  ->constrained()
                  ->cascadeOnDelete();

            // Room relation (nullable because student can go OUT without room change)
            $table->foreignId('room_id')
                  ->nullable()
                  ->constrained()
                  ->nullOnDelete();

            // IN / OUT
            $table->enum('type', ['IN', 'OUT']);

            // Reason (optional)
            $table->string('reason')->nullable();

            // Date & Time
            $table->timestamp('moved_at');

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('room_movements');
    }
};