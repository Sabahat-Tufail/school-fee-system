<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CashPayment extends Model
{
    use HasFactory;

    protected $table = 'cash_payments';

    protected $fillable = [
        'window_number',
        'book_reference',
        'cashier_name',
        'receipt_id',
    ];

    /**
     * The payment receipt this cash payment belongs to.
     */
    public function paymentReceipt()
    {
        return $this->belongsTo(PaymentReceipt::class, 'receipt_id');
    }
}
