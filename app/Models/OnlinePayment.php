<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OnlinePayment extends Model
{
    use HasFactory;

    protected $table = 'online_payments';

    protected $fillable = [
        'bank_name',
        'iban',
        'bank_reference_number',
        'receipt_id',
    ];

    /**
     * The payment receipt this online payment belongs to.
     */
    public function paymentReceipt()
    {
        return $this->belongsTo(PaymentReceipt::class, 'receipt_id');
    }
}
