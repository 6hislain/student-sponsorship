<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Sponsor extends Model
{
    use HasFactory;
    
    protected $fillable = [
        'first_name',
        'last_name',
        'address',
        'contact',
        'image',
        'description',
        'dob',
        'identification',
        'user_id'
    ];
}
