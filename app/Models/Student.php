<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Student extends Model
{
    use HasFactory;

    protected $table = 'students';

    protected $fillable = [
        'roll_number',
        'first_name',
        'last_name',
        'date_of_birth',
        'admission_date',
        'structure_id',
    ];

    /**
     * The fee structure this student belongs to.
     */
    public function feeStructure()
    {
        return $this->belongsTo(FeeStructure::class, 'structure_id');
    }

    /**
     * The account associated with this student (one-to-one).
     */
    public function studentAccount()
    {
        return $this->hasOne(StudentAccount::class, 'student_id');
    }
}
