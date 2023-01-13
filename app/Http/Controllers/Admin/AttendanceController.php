<?php

namespace App\Http\Controllers\Admin;

use App\Exports\ListCheckInExport;
use App\Http\Controllers\Controller;
use App\Models\Attendance;
use App\Models\Reward;
use Illuminate\Http\Request;
use App\Repositories\AttendanceRepository as AttendanceRepo;
use App\Repositories\DepartmentRepository as DepartmentRepo;
use Illuminate\Support\Facades\DB;
use Maatwebsite\Excel\Facades\Excel;

class AttendanceController extends Controller
{
    protected $view = 'admin.attendances';
    protected $route = 'attendances';
    protected $attendanceRepo;
    protected $departmentRepo;
    public function __construct(AttendanceRepo $attendanceRepo, DepartmentRepo $departmentRepo)
    {
        $this->attendanceRepo = $attendanceRepo;
        $this->departmentRepo = $departmentRepo;
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $attendances = $this->attendanceRepo->getData($request);
        if(isset($request->action) && $request->action === 'export'){
            $dataArray =new \stdClass();
            $dataArray->attendances = $attendances;
            return Excel::download(new ListCheckInExport($dataArray), 'Danh sách check in.xlsx');
        }
        return view($this->view.'.index', [
            'attendances' => $attendances,
            'request'  => $request
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $attendance = new Attendance();
        $departments = $this->departmentRepo->getDepartments();
        return view($this->view.'.create', [
            'attendance' => $attendance,
            'departments' => $departments,
            'view'  => $this->view
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'name'  => 'required',
            'phone' => 'required|unique:attendances',
            'department_id'  => 'required',
        ]);
        $data = $request->only('name', 'phone', 'department_id');
        $data['status'] = isset($request['status']) ? 1 : 0;
        $data['code'] = $this->generateOrderNumber();
        $this->attendanceRepo->create($data);
        return redirect(route($this->route.'.index'))->with('success','Thêm mới thành công');
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
    public function edit(Attendance $attendance)
    {

    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Attendance $attendance)
    {

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Attendance $attendance)
    {
        $attendance->delete();
        return redirect()->back()->with('success','Xóa thành công');
    }

    public function deleteAll(Request $request)
    {
        DB::table('attendances')->delete();
        return redirect()->back()->with('success','Xóa thành công');
    }

    public function removeWinners()
    {
        $rewards = Reward::get();
        foreach ($rewards as $reward){
            $reward['attendance_id'] = 0;
            $reward->save();
        }
        return redirect()->back()->with('success','Gỡ tất cả người trúng thưởng thành công');
    }
    private function generateOrderNumber($length = 4)
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
}
