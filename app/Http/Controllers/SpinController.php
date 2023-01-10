<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Repositories\AttendanceRepository as AttendanceRepo;
use App\Repositories\DepartmentRepository as DepartmentRepo;
use App\Repositories\InformationRepository as InformationRepo;
use App\Repositories\RewardRepository as RewardRepo;

class SpinController extends Controller
{
    protected $attendanceRepo;
    protected $departmentRepo;
    protected $informationRepo;
    protected $rewardRepo;
    public function __construct(RewardRepo $rewardRepo, AttendanceRepo $attendanceRepo, DepartmentRepo $departmentRepo, InformationRepo $informationRepo)
    {
        $this->rewardRepo = $rewardRepo;
        $this->attendanceRepo = $attendanceRepo;
        $this->departmentRepo = $departmentRepo;
        $this->informationRepo = $informationRepo;
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $about = $this->informationRepo->find(1);
        return view('spin', [
            'about' => $about
        ]);
    }

    public function banhXe()
    {
        $about = $this->informationRepo->find(1);
        return view('banh-xe', [
            'about' => $about
        ]);
    }
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $response = [
            'success' => 100,
            'data' => '',
            'message' => ''
        ];
        $code = $this->attendanceRepo->randomCode();
        $code['department'] = '';
        if($code && $code['department_id']){
           $department = $this->departmentRepo->find($code['department_id']);
           $code['phones'] = 'xxx xxx'.substr($code['phone'], -4);
           if($department){
               $code['department'] = $department->name;
           }
        }
        $code['phone'] = 'xxx xxx'.substr($code['phone'], -4);
        $response['data'] = $code;

        return $this->sendResponse($response, 'Success.');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }

    public function reward()
    {
        $about = $this->informationRepo->find(1);
        $rewards = $this->rewardRepo->getRewards();
        return view('reward', [
            'about' => $about,
            'rewards' => $rewards
        ]);
    }
    public function confirmResult(Request $request)
    {
        $response = [
            'success' => 100,
            'data' => true,
            'message' => ''
        ];
        $reward = $this->rewardRepo->find($request['id_reward']);
        $reward->attendance_id = $request['id_attendance'];
        $reward->save();
        return $this->sendResponse($response, 'Success.');
    }
}
