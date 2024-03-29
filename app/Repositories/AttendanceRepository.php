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
        if(isset($request->action) && $request->action === 'export'){
            return $query->orderBy('id', 'DESC')->get();
        }
        return $query->orderBy('id', 'DESC')->paginate(20);
    }
    public function randomCode()
    {
        $query = $this->model->where([['status', true], ['is_otp', 'YES']])->inRandomOrder()->first();
        if(!$query){
            $query = $this->model->where('status', true)->inRandomOrder()->first();
        }
        if(isset($query['is_otp']))
            $query['is_otp'] = 'NO';
        $query['status'] = 0;
        $query->save();
        return $query;
    }
    public function getAttendanceByCode($code)
    {
        return $this->model->where('code', $code)->first();
    }
}
