<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Graduation extends Model
{
    use HasFactory;
    protected $fillable = [
        'body',
        'high_school_major',
        'university_major',
        'university_name',
    ];
}
