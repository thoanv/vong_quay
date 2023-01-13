<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use App\Repositories\UserRepository as UserRepo;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    protected $view = 'admin.users';
    protected $route = 'users';
    protected $userRepo;
    public function __construct(UserRepo $userRepo)
    {
        $this->userRepo = $userRepo;
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $users = $this->userRepo->getData($request);
        return view($this->view.'.index', [
            'users' => $users,
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
    public function resetPassword(User $user)
    {
        $pass = $this->generateRandomString(10);
        if($pass){
            $data['password'] = Hash::make($pass);
            $data['password_reset'] = $pass;
            $this->userRepo->update($data, $user['id']);
        }
        return redirect()->route($this->route.'.index')->with('success','Reset mật khẩu thành công');
    }
    private function generateRandomString($length = 8) {
        $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
        $charactersLength = strlen($characters);
        $randomString = '';
        for ($i = 0; $i < $length; $i++) {
            $randomString .= $characters[rand(0, $charactersLength - 1)];
        }
        return $randomString;
    }
    public function showChangePasswordGet() {
        return view('admin.auths.change-password');
    }

    public function changePasswordPost(Request $request)
    {
        $user = Auth::user();

        $userPassword = $user->password;
        $request->validate([
            'current_password' => 'required',
            'password' => 'required|same:confirm_password',
            'confirm_password' => 'required',
        ]);
        if (!Hash::check($request->current_password, $userPassword)) {
            return back()->with('error','Mật khẩu hiện tại không đúng');
        }

        $user->password = Hash::make($request->password);

        if($user->password_reset){
            $user->password_reset = NULL;
        }
        $user->save();

        return redirect()->back()->with('success','Đổi mật khẩu thánh công');
    }
}
