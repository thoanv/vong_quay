<aside class="sidenav navbar navbar-vertical navbar-expand-xs border-0 border-radius-xl my-3 fixed-start ms-3   bg-gradient-dark" id="sidenav-main">
    <div class="sidenav-header">
        <i class="fas fa-times p-3 cursor-pointer text-white opacity-5 position-absolute end-0 top-0 d-none d-xl-none" aria-hidden="true" id="iconSidenav"></i>
        <a class="navbar-brand m-0" href=" https://demos.creative-tim.com/material-dashboard/pages/dashboard " target="_blank">
            <img src="/assets/img/logo-ct.png" class="navbar-brand-img h-100" alt="main_logo">
            <span class="ms-1 font-weight-bold text-white tt text-uppercase">Quản trị viên</span>
        </a>
    </div>
    <hr class="horizontal light mt-0 mb-2">
    <div class="collapse navbar-collapse  w-auto " id="sidenav-collapse-main">
        <ul class="navbar-nav">
            <li class="nav-item">
                <a class="nav-link text-white {{ (request()->is('admin/dashboard')) ? 'active bg-gradient-primary' : '' }}" href="{{route('dashboard')}}">
                    <div class="text-white text-center me-2 d-flex align-items-center justify-content-center">
                        <i class="material-icons opacity-10">dashboard</i>
                    </div>
                    <span class="nav-link-text ms-1">Dashboard</span>
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link text-white " href="{{route('home')}}" target="_blank">
                    <div class="text-white text-center me-2 d-flex align-items-center justify-content-center">
                        <i class="material-icons opacity-10">qr_code_scanner</i>
                    </div>
                    <span class="nav-link-text ms-1">QR code</span>
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link text-white " href="{{route('spin')}}" target="_blank">
                    <div class="text-white text-center me-2 d-flex align-items-center justify-content-center">
                        <i class="material-icons opacity-10">autorenew</i>
                    </div>
                    <span class="nav-link-text ms-1">Vòng quay</span>
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link text-white {{(request()->is('admin/attendances')) ? 'active bg-gradient-primary' : '' }}" href="{{route('attendances.index')}}">
                    <div class="text-white text-center me-2 d-flex align-items-center justify-content-center">
                        <i class="material-icons opacity-10">group</i>
                    </div>
                    <span class="nav-link-text ms-1">Check In</span>
                </a>
            </li>


            <li class="nav-item mt-3">
                <h6 class="ps-4 ms-2 text-uppercase text-xs text-white font-weight-bolder opacity-8">Cơ cấu giải thưởng</h6>
            </li>
            <li class="nav-item">
                <a class="nav-link text-white {{(request()->is('admin/rewards/*')) ? 'active bg-gradient-primary' : '' }}" href="{{route('rewards.type', 'list')}}">
                    <div class="text-white text-center me-2 d-flex align-items-center justify-content-center">
                        <i class="material-icons opacity-10">hotel_class</i>
                    </div><span class="nav-link-text ms-1">Giải thưởng</span>
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link text-white" href="{{route('reward')}}" target="_blank">
                    <div class="text-white text-center me-2 d-flex align-items-center justify-content-center">
                        <i class="material-icons opacity-10">auto_mode</i>
                    </div><span class="nav-link-text ms-1">Thực hiện quay</span>
                </a>
            </li>
            @if(\Illuminate\Support\Facades\Auth::user()->is_admin)
            <li class="nav-item mt-3">
                <h6 class="ps-4 ms-2 text-uppercase text-xs text-white font-weight-bolder opacity-8">Quản trị</h6>
            </li>
            <li class="nav-item">
                <a class="nav-link text-white {{(request()->is('admin/users')) ? 'active bg-gradient-primary' : '' }}" href="{{route('users.index')}}">
                    <div class="text-white text-center me-2 d-flex align-items-center justify-content-center">
                        <i class="material-icons opacity-10">person</i>
                    </div>
                    <span class="nav-link-text ms-1">Quản trị viên</span>
                </a>
            </li>
            @endif
            <li class="nav-item mt-3">
                <h6 class="ps-4 ms-2 text-uppercase text-xs text-white font-weight-bolder opacity-8">Cài đặt</h6>
            </li>
            <li class="nav-item">
                <a class="nav-link text-white {{ (request()->is('admin/information')) ? 'active bg-gradient-primary' : '' }}" href="{{route('information.edit')}}">
                    <div class="text-white text-center me-2 d-flex align-items-center justify-content-center">
                        <i class="material-icons opacity-10">receipt_long</i>
                    </div>
                    <span class="nav-link-text ms-1">Thông tin hệ thống</span>
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link text-white {{ (request()->is('admin/departments')) ? 'active bg-gradient-primary' : '' }}" href="{{route('departments.index')}}">
                    <div class="text-white text-center me-2 d-flex align-items-center justify-content-center">
                        <i class="material-icons opacity-10">table_view</i>
                    </div>
                    <span class="nav-link-text ms-1">Phòng ban</span>
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link text-white {{ (request()->is('admin/thay-doi-mat-khau')) ? 'active bg-gradient-primary' : '' }}" href="{{route('changePasswordGet')}}">
                    <div class="text-white text-center me-2 d-flex align-items-center justify-content-center">
                        <i class="material-icons opacity-10">password</i>
                    </div>
                    <span class="nav-link-text ms-1">Đổi mật khẩu</span>
                </a>
            </li>
            <li class="nav-item">
                <form action="{{route('logout')}}" method="POST" >
                    @csrf
                    <button class="nav-link btn" type="submit" style="width: 88%;text-transform: capitalize;">
                        <div class="text-white text-center me-2 d-flex align-items-center justify-content-center">
                            <i class="material-icons opacity-10">login</i>
                        </div>
                        <span class="nav-link-text ms-1">Đăng xuất</span>
                    </button>
                    {{--                    <button type="submit" class="btn btn-primary btn-sm mb-0" onclick="return confirm('Bạn có muốn xóa không?')"> Xóa</button>--}}
                </form>
            </li>
        </ul>
    </div>
</aside>
