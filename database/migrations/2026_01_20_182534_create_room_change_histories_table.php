<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('room_change_histories', function (Blueprint $table) {
            $table->id();

            $table->foreignId('student_id')
                  ->constrained()
                  ->cascadeOnDelete();

            $table->foreignId('old_room_id')
                  ->nullable()
                  ->constrained('rooms')
                  ->nullOnDelete();

            $table->foreignId('new_room_id')
                  ->nullable()
                  ->constrained('rooms')
                  ->nullOnDelete();

            $table->timestamp('changed_at')->nullable();

            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('room_change_histories');
    }
};
