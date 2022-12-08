<?php
namespace App\Repositories;

use App\Models\Attendance;
use App\Models\User;
use App\Repositories\Support\AbstractRepository;
use Illuminate\Support\Facades\Auth;

class UserRepository extends AbstractRepository
{
    public function model(){
        return User::class;
    }
    public function getData($request)
    {
        $query = $this->model;
        if($request->name){
            $query = $query->where('name', 'like', '%' . $request->name . '%')
                ->orWhere('email', 'like', '%' . $request->name . '%');
        }

        if($request->status == 0 && $request->status !=''){
            $query = $query->where('status', false);
        }
        if($request->status == 1){
            $query = $query->where('status', true);
        }

        return $query->orderBy('id', 'DESC')->paginate(20);
    }
}
