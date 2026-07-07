<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class FeeStructure extends Model
{
    use HasFactory;

    protected $table = 'fee_structures';

    protected $fillable = [
        'class_name',
        'section',
        'term',
        'tution_fee',
        'exam_fee',
        'misc_fee',
    ];

    /**
     * A fee structure can be assigned to many students.
     */
    public function students()
    {
        return $this->hasMany(Student::class, 'structure_id');
    }
}
