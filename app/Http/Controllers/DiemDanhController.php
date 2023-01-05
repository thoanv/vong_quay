<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreAttendanceRequest;
use App\Models\Attendance;
use App\Models\Information;
use Illuminate\Http\Request;
use App\Repositories\DepartmentRepository as DepartmentRepo;
use App\Repositories\AttendanceRepository as AttendanceRepo;
use App\Repositories\InformationRepository as InformationRepo;
use Illuminate\Support\Facades\Validator;

class DiemDanhController extends Controller
{
    protected $departmentRepo;
    protected $attendanceRepo;
    protected $informationRepo;
    public function __construct(DepartmentRepo $departmentRepo, AttendanceRepo $attendanceRepo, InformationRepo $informationRepo)
    {
        $this->departmentRepo = $departmentRepo;
        $this->attendanceRepo = $attendanceRepo;
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
        if(isset($_COOKIE['code']) && $_COOKIE['code']){
            $cookie = (int)$_COOKIE['code'];
            $attendance = $this->attendanceRepo->getAttendanceByCode($cookie);
            return redirect(route('success.attendance', $attendance));
        }
        $information = Information::find(1);
        if($information['deadline'] && ($information['deadline'] < date('Y-m-d H:i:s'))){
            return view('deadline');
        }
        $departments = $this->departmentRepo->getDepartments();
        return view('attendance', [
            'departments' => $departments,
            'about' => $about
        ]);
    }
    public static function generateOrderNumber($length = 4)
    {
        $numberID = null;
        while (!$numberID) {
            $randomString = null;
            $characters = '0123456789';
            $charactersLength = strlen($characters);
            $randomString = '';
            for ($i = 0; $i < $length; $i++) {
                $randomString .= $characters[rand(0, $charactersLength - 1)];
            }
            $exist = Attendance::where('code', $randomString)->exists();
            if (!$exist) {
                $numberID = $randomString;
            }
        }
        return $numberID;
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
        $validated = $request->validate([
            'phone' => 'required|unique:attendances',
            'full_name' => 'required',
//            'captcha'  => 'required|captcha'
        ]);
        $data['name'] = $request->full_name;
        if($request['department_id'])
            $data['department_id'] = $request['department_id'];
        $data['phone'] = $request['phone'];
        $data['code'] = $this->generateOrderNumber();
        $result = $this->attendanceRepo->create($data);
        setcookie('code', $data['code'], time() + (30*24*60*60), "/");
        return redirect(route('success.attendance', $result));
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Attendance $attendance)
    {
        return view('success_attendance', [
            'attendance' => $attendance
        ]);
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
}
