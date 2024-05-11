<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Personal extends Model
{
    use HasFactory;
    protected $fillable = [
        'name',
        'familyName',
        'age',
        'gender',
        'military',
        'user_id'
    ];
    public function user(){
        return $this->belongsTo(User::class);
    }


    
}
