<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Department;
use Illuminate\Http\Request;
use App\Repositories\DepartmentRepository as DepartmentRepo;

class DepartmentController extends Controller
{
    protected $view = 'admin.departments';
    protected $route = 'departments';
    protected $departmentRepo;
    public function __construct(DepartmentRepo $departmentRepo)
    {
        $this->departmentRepo = $departmentRepo;
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $departments = $this->departmentRepo->getData($request);
        return view($this->view.'.index', [
           'departments' => $departments,
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
        $department = new Department();
        return view($this->view.'.create', [
            'department' => $department,
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
        ]);
        $data['name'] = $request['name'];
        $data['parent_id'] = 0;
        $data['status'] = isset($request['status']) ? 1 : 0;
        $this->departmentRepo->create($data);
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
    public function edit(Department $department)
    {
        return view($this->view.'.update', [
            'department' => $department,
            'view'  => $this->view
        ]);
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
        $request->validate([
            'name'  => 'required',
        ]);
        $data['name'] = $request['name'];
        $data['status'] = isset($request['status']) ? 1 : 0;
        $this->departmentRepo->update($data, $id);
        return redirect(route($this->route.'.index'))->with('success','Cập nhật thành công');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Department $department)
    {
        $department->delete();
        return redirect()->back()->with('success','Xóa thành công');
    }
}
