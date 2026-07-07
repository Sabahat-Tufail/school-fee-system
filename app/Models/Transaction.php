<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Transaction extends Model
{
    use HasFactory;

    protected $table = 'transactions';

    protected $fillable = [
        'transaction_type',
        'transaction_date',
        'amount',
        'category',
        'account_id',
    ];

    /**
     * The student account this transaction belongs to.
     */
    public function studentAccount()
    {
        return $this->belongsTo(StudentAccount::class, 'account_id');
    }

    /**
     * The payment receipt linked to this transaction (one-to-one).
     */
    public function paymentReceipt()
    {
        return $this->hasOne(PaymentReceipt::class, 'transaction_id');
    }

    /**
     * The concession adjustment linked to this transaction (one-to-one).
     */
    public function concessionAdjustment()
    {
        return $this->hasOne(ConcessionAdjustment::class, 'transaction_id');
    }
}
