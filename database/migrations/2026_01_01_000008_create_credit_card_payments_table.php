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
        Schema::create('credit_card_payments', function (Blueprint $table) {
            $table->id();
            $table->string('authorization_code');
            $table->enum('card_brand', ['Visa', 'Mastercard', 'Amex']);
            $table->string('card_last_four', 4);
            $table->foreignId('receipt_id')
                  ->unique()
                  ->constrained('payment_receipts')
                  ->onDelete('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('credit_card_payments');
    }
};
