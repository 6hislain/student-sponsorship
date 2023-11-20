<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Child extends Model
{
    use HasFactory;

    protected $fillable = [
        'first_name',
        'last_name',
        'school',
        'address',
        'contact_person',
        'contact_details',
        'image',
        'description',
        'dob',
        'user_id'
    ];
}
