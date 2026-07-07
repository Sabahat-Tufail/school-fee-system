<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class StudentAccount extends Model
{
    use HasFactory;

    protected $table = 'student_accounts';

    protected $fillable = [
        'total_fee_due',
        'total_concession_applied',
        'levied_fines',
        'total_payment_collected',
        'student_id',
    ];

    /**
     * The student this account belongs to.
     */
    public function student()
    {
        return $this->belongsTo(Student::class, 'student_id');
    }

    /**
     * All transactions under this account.
     */
    public function transactions()
    {
        return $this->hasMany(Transaction::class, 'account_id');
    }
}
