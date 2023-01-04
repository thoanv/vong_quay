<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Information extends Model
{
    use HasFactory;
    protected $fillable = [
        'logo',
        'favicon',
        'thumbnail',
        'company',
        'email',
        'address',
        'phone',
        'fax',
        'description',
        'code_color',
        'second',
        'audio'
    ];
}
