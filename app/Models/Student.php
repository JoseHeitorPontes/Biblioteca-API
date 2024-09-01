<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Student extends Model
{
    use HasFactory;

    protected $fillable = [
        'id',
        'name',
        'gender',
        'birthdate',
        'city',
        'neighborhood',
        'street',
        'number',
        'email',
        'phone',
        'classroom',
    ];

    protected $casts = [
        'birthdate' => 'date'
    ];
}
