<?php
namespace App\Repositories;

use App\Models\Attendance;
use App\Models\Information;
use App\Repositories\Support\AbstractRepository;
use Illuminate\Support\Facades\Auth;

class InformationRepository extends AbstractRepository
{
    public function model(){
        return Information::class;
    }
}
