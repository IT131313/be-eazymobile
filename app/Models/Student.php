<?php

namespace App\Models;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Student extends Model
{
    use HasFactory;
    protected $table = 'hr.ms_student'; 
    protected $primaryKey = 'student_number';
    public $incrementing = false; 
    protected $keyType = 'string'; 

    protected $fillable = [
        'student_number',
        'student_id',
        'fullname',
        'studyprogram_id',
        'student_school_year',
        'student_type_id',
        'gender',
        'email',
        'phone_number',
    ];
}
