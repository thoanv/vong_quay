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
    public function getData($request)
    {
        $query = $this->model;
        if($request->name){
            $query = $query->where('name', 'like', '%' . $request->name . '%')
                ->orWhere('phone', 'like', '%' . $request->name . '%')
                ->orWhere('code', $request->name);
        }

        if($request->status == 0 && $request->status !=''){
            $query = $query->where('status', false);
        }
        if($request->status == 1){
            $query = $query->where('status', true);
        }

        return $query->orderBy('id', 'DESC')->paginate(20);
    }
    public function randomCode()
    {
        $query = $this->model->where('status', true)->inRandomOrder()->first();
        $query['status'] = 0;
        $query->save();
        return $query;
    }
    public function getAttendanceByCode($code)
    {
        return $this->model->where('code', $code)->first();
    }
}
