<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Reward extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'value',
        'status',
        'serial',
        'attendance_id',
        'note',
    ];

    public function attendance()
    {
        return $this->belongsTo(Attendance::class);
    }
}
