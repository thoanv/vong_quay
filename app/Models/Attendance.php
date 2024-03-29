<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Attendance extends Model
{
    use HasFactory;
    protected $fillable = [
        'name',
        'phone',
        'code',
        'department_id',
        'status',
        'is_otp'
    ];

    public function department()
    {
        return $this->belongsTo(Department::class, 'department_id');
    }
}
