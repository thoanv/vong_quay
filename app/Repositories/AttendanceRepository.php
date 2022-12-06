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
        $query = $this->model->where('status', false)->pluck('code')->toArray();
        $rand_key = array_rand($query, 1);
        $attendance = $this->model->where('code', $query[$rand_key])->first();
        return $attendance;
    }
}
