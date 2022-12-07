<?php
namespace App\Repositories;

use App\Models\Attendance;
use App\Repositories\Support\AbstractRepository;
use Illuminate\Support\Facades\Auth;

class AttendanceRepository extends AbstractRepository
{
    public function model(){
        return Attendance::class;
    }

    public function randomCode()
    {
        $query = $this->model->where('status', true)->inRandomOrder()->first();
        $query['status'] = 0;
        $query->save();
        return $query;
    }
}
