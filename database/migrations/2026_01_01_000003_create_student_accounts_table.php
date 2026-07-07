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
        Schema::create('student_accounts', function (Blueprint $table) {
            $table->id();
            $table->decimal('total_fee_due', 10, 2)->default(0);
            $table->decimal('total_concession_applied', 10, 2)->default(0);
            $table->decimal('levied_fines', 10, 2)->default(0);
            $table->decimal('total_payment_collected', 10, 2)->default(0);
            $table->foreignId('student_id')
                  ->unique()
                  ->constrained('students')
                  ->onDelete('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('student_accounts');
    }
};
