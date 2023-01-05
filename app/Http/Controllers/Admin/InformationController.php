<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Information;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use App\Repositories\InformationRepository as InformationRepo;

class InformationController extends Controller
{
    protected $informationRepo;
    public function __construct(InformationRepo $informationRepo)
    {
        $this->informationRepo = $informationRepo;
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
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
        //
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
     * @return \Illuminate\Http\Response
     */
    public function edit()
    {
        $infomation = Information::where('id', 1)->first();
        return view('admin.informations.update', ['infomation' => $infomation]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
        $data = $request->only('company', 'email', 'phone', 'address', 'code_color', 'second');
        $data['deadline'] = date('Y-m-d H:i:s', strtotime($request->deadline));
        if($request->hasFile('logo')){
            $img = Storage::disk('public')->put('images', $request->logo);
            $data['logo'] = '/storage/'.$img;
        }
        if($request->hasFile('favicon')){
            $img = Storage::disk('public')->put('images', $request->favicon);
            $data['favicon'] = '/storage/'.$img;
        }
        if($request->hasFile('thumbnail')){
            $img = Storage::disk('public')->put('images', $request->thumbnail);
            $data['thumbnail'] = '/storage/'.$img;
        }
        if($request->hasFile('background')){
            $img = Storage::disk('public')->put('images', $request->background);
            $data['background'] = '/storage/'.$img;
        }
        if($request->hasFile('audio')){
            $uniqueid=uniqid();
            $original_name=$request->file('audio')->getClientOriginalName();
            $size=$request->file('audio')->getSize();
            $extension=$request->file('audio')->getClientOriginalExtension();
            $filename='audio.'.$extension;
            $audiopath ='/storage/upload/files/audio/'.$filename;
            $path = $request->file('audio')->storeAs('public/upload/files/audio/',$filename);
            $data['audio'] = $audiopath;
        }
        $this->informationRepo->update($data, 1);
        return back()->with('success','Cập nhật thành công');;
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
