<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
  public function up()
{
    Schema::create('fees', function (Blueprint $table) {
        $table->id();
        $table->foreignId('student_id')->constrained()->cascadeOnDelete();
        $table->decimal('total_fees', 10, 2);
        $table->decimal('paid_fees', 10, 2)->default(0);
        $table->decimal('pending_fees', 10, 2);
        $table->date('payment_date')->nullable();
        $table->string('status')->default('PENDING'); // PAID / PARTIAL / PENDING
        $table->timestamps();
    });
}


    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('fees');
    }
};
