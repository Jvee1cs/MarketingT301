<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Student extends Model
{
    use HasFactory;

    protected $fillable = ['stud_first_name', 'stud_last_name', 'stud_middle_name', 'address', 'city', 'grade_level', 'strand', 'course', 'course', 'school_name', 'g_name', 'g_relationship', 'email_address', 'fbaccount', 'phone', 'g_phone'];

}
