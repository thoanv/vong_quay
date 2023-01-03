<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Reward;
use Illuminate\Http\Request;
use App\Repositories\RewardRepository as RewardRepo;
use Illuminate\Support\Facades\DB;

class RewardController extends Controller
{
    protected $view = 'admin.rewards';
    protected $route = 'rewards';
    protected $rewardRepo;
    public function __construct(RewardRepo $rewardRepo)
    {
        $this->rewardRepo = $rewardRepo;
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request, $type = 'list')
    {
        $rewards = $this->rewardRepo->getData($request);
        if($type == 'sort'){
            $rewards = $this->rewardRepo->getRewards(false);
        }
        return view($this->view.'.index', [
            'rewards' => $rewards,
            'request' => $request,
            'type'    => $type
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $reward = new Reward();
        return view($this->view.'.create', [
            'reward' => $reward,
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
        $data = $request->only('name', 'value', 'note');
        $data['status'] = isset($request['status']) ? 1 : 0;
        $this->rewardRepo->create($data);
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
    public function edit(Reward $reward)
    {
        if(!$reward) abort(404);
        return view($this->view.'.create', [
            'reward' => $reward,
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
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Reward $reward)
    {
        $reward->delete();
        return redirect()->back()->with('success','Xóa thành công');
    }

    public function deleteAll(Request $request)
    {
        DB::table('rewards')->delete();
        return redirect()->back()->with('success','Xóa thành công');
    }
    public function remove(Reward $reward)
    {
        if($reward['attendance_id']){
            $reward['attendance_id'] = 0;
            $reward->save();
        }
        return redirect()->back()->with('success','Gỡ thành công');
    }
}
