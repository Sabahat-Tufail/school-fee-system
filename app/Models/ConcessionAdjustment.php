<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ConcessionAdjustment extends Model
{
    use HasFactory;

    protected $table = 'concession_adjustments';

    protected $fillable = [
        'concession_type',
        'percentage',
        'authorization_ref',
        'transaction_id',
    ];

    /**
     * The transaction this concession adjustment belongs to.
     */
    public function transaction()
    {
        return $this->belongsTo(Transaction::class, 'transaction_id');
    }
}
