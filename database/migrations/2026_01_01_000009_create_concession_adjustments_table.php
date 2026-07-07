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
        Schema::create('concession_adjustments', function (Blueprint $table) {
            $table->id();
            $table->string('concession_type');
            $table->decimal('percentage', 5, 2);
            $table->string('authorization_ref');
            $table->foreignId('transaction_id')
                  ->unique()
                  ->constrained('transactions')
                  ->onDelete('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('concession_adjustments');
    }
};
