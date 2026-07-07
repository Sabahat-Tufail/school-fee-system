<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PaymentReceipt extends Model
{
    use HasFactory;

    protected $table = 'payment_receipts';

    protected $fillable = [
        'receipt_number',
        'payment_mode',
        'late_fine_levied',
        'transaction_id',
    ];

    /**
     * The transaction this receipt belongs to.
     */
    public function transaction()
    {
        return $this->belongsTo(Transaction::class, 'transaction_id');
    }

    /**
     * The cash payment details linked to this receipt (one-to-one).
     */
    public function cashPayment()
    {
        return $this->hasOne(CashPayment::class, 'receipt_id');
    }

    /**
     * The online payment details linked to this receipt (one-to-one).
     */
    public function onlinePayment()
    {
        return $this->hasOne(OnlinePayment::class, 'receipt_id');
    }

    /**
     * The credit card payment details linked to this receipt (one-to-one).
     */
    public function creditCardPayment()
    {
        return $this->hasOne(CreditCardPayment::class, 'receipt_id');
    }
}
