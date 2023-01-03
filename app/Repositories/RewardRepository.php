<?php
namespace App\Repositories;

use App\Models\Attendance;
use App\Models\Reward;
use App\Repositories\Support\AbstractRepository;
use Illuminate\Support\Facades\Auth;

class RewardRepository extends AbstractRepository
{
    public function model(){
        return Reward::class;
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

        return $query->orderBy('serial', 'ASC')->paginate(20);
    }

    public function getRewards($status = true)
    {
        $query = $this->model;
        if($status){
            $query = $query->where('status', $status);
        }
        return $query->orderBy('serial', 'ASC')->get();
    }

}
