<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;


class Link extends Model
{
    use HasFactory;

    protected $fillable = ['unique_identifier', 'expires_at', 'is_active'];
}
