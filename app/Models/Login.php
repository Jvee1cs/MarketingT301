<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Login extends Model
{
    use HasFactory;
    protected $fillable = [
    'id',
    'name',
    'user_login',
    'username',
    'password',
    'confirm_pass',
    'user_lastname',
    'user_firstname',
    'user_middlename',
    'email_address',
    'user_type',
    'timestamps'

    ];
}
