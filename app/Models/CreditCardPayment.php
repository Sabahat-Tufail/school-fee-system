<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CreditCardPayment extends Model
{
    use HasFactory;

    protected $table = 'credit_card_payments';

    protected $fillable = [
        'authorization_code',
        'card_brand',
        'card_last_four',
        'receipt_id',
    ];

    /**
     * The payment receipt this credit card payment belongs to.
     */
    public function paymentReceipt()
    {
        return $this->belongsTo(PaymentReceipt::class, 'receipt_id');
    }
}
