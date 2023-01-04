@extends('admin.layouts.app')
@section('title', 'Dashboard')
@section('content')
<main class="main-content position-relative max-height-vh-100 h-100 border-radius-lg ">
    <!-- Navbar -->
    <nav class="navbar navbar-main navbar-expand-lg px-0 mx-4 shadow-none border-radius-xl" id="navbarBlur" data-scroll="true">
        <div class="container-fluid py-1 px-3">
            <nav aria-label="breadcrumb">
                <h6 class="font-weight-bolder mb-0">Dashboard</h6>
            </nav>
        </div>
    </nav>
    <!-- End Navbar -->
    <div class="container-fluid py-4">
        <div class="row">
            <div class="col-xl-4 col-sm-6 mb-xl-0 mb-4">
                <div class="card">
                    <div class="card-header p-3 pt-2">
                        <div class="icon icon-lg icon-shape bg-gradient-dark shadow-dark text-center border-radius-xl mt-n4 position-absolute">
                            <i class="material-icons opacity-10">hotel_class</i>
                        </div>
                        <div class="text-end pt-1">
                            <p class="text-sm mb-0 text-capitalize">Giải thưởng</p>
                            <h4 class="mb-0">{{$rewards->total()}}</h4>
                        </div>
                    </div>
                    <hr class="dark horizontal my-0">
                    <div class="card-footer p-3">
                        <div class="table-responsive">
                            <table class="table align-items-center ">
                                <thead>
                                <tr>
                                    <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                        STT
                                    </th>
                                    <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                        Tên giải
                                    </th>
                                    <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 text-center">
                                        Giá trị
                                    </th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach($rewards as $reward)
                                <tr>
                                    <td class="text-center">{{$loop->iteration}}</td>
                                    <td class="w-30">
                                        {{$reward['name']}}
                                    </td>
                                    <td class="text-center">
                                        <div class="btn btn-rounded btn-outline-danger mb-0 me-2 btn-sm align-items-center justify-content-center">
                                            {{$reward['value']}}
                                        </div>
                                    </td>
                                </tr>
                                @endforeach
                                </tbody>
                            </table>
                        </div>
                        <hr class="dark horizontal my-0">
                        <div class="text-center pt-2">
                            <a style="font-size: 14px; font-weight: lighter;" href="{{route('rewards.type', 'list')}}">Xem thêm</a>
                        </div>

                    </div>
                </div>
            </div>
            <div class="col-xl-4 col-sm-6 mb-xl-0 mb-4">
                <div class="card">
                    <div class="card-header p-3 pt-2">
                        <div class="icon icon-lg icon-shape bg-gradient-primary shadow-primary text-center border-radius-xl mt-n4 position-absolute">
                            <i class="material-icons opacity-10">person</i>
                        </div>
                        <div class="text-end pt-1">
                            <p class="text-sm mb-0 text-capitalize">Check In</p>
                            <h4 class="mb-0">{{$attendances->total()}}</h4>
                        </div>
                    </div>
                    <hr class="dark horizontal my-0">
                    <div class="card-footer p-3">
                        <div class="table-responsive">
                            <table class="table align-items-center ">
                                <thead>
                                <tr>
                                    <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                        STT
                                    </th>
                                    <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                        Họ tên
                                    </th>
                                    <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 text-center">
                                        Số điện thoại
                                    </th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach($attendances as $attendance)
                                    <tr>
                                        <td class="text-center">{{$loop->iteration}}</td>
                                        <td class="w-30">
                                            {{$attendance['name']}}
                                        </td>
                                        <td class="text-center">
                                            {{$attendance['phone']}}
                                        </td>
                                    </tr>
                                @endforeach
                                </tbody>
                            </table>
                        </div>
                        <hr class="dark horizontal my-0">
                        <div class="text-center pt-2">
                            <a style="font-size: 14px; font-weight: lighter;" href="{{route('attendances.index')}}">Xem thêm</a>
                        </div>

                    </div>
                </div>
            </div>
            <div class="col-xl-4 col-sm-6 mb-xl-0 mb-4">
                <div class="card">
                    <div class="card-header p-3 pt-2">
                        <div class="icon icon-lg icon-shape bg-gradient-success shadow-success text-center border-radius-xl mt-n4 position-absolute">
                            <i class="material-icons opacity-10">apartment</i>
                        </div>
                        <div class="text-end pt-1">
                            <p class="text-sm mb-0 text-capitalize">Phòng ban</p>
                            <h4 class="mb-0">{{$departments->total()}}</h4>
                        </div>
                    </div>
                    <hr class="dark horizontal my-0">
                    <div class="card-footer p-3">
                        <div class="table-responsive">
                            <table class="table align-items-center ">
                                <thead>
                                <tr>
                                    <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                        STT
                                    </th>
                                    <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                        Tên phòng ban
                                    </th>
                                    <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                        Trạng thái
                                    </th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach($departments as $department)
                                    <tr>
                                        <td class="text-center">{{$loop->iteration}}</td>
                                        <td class="w-30">
                                            {{$department['name']}}
                                        </td>
                                        <td class="text-center">
                                            <div class="form-check form-switch" style="display: inline-block">
                                                <input class="form-check-input" name="my-checkbox" type="checkbox" data-id="{{$department['id']}}"
                                                       data-api="{{route('enable-column')}}" data-table="departments"
                                                       data-column="status"  {{ $department['status'] ? 'checked="checked"' : '' }}>
                                            </div>
                                        </td>
                                    </tr>
                                @endforeach
                                </tbody>
                            </table>
                        </div>
                        <hr class="dark horizontal my-0">
                        <div class="text-center pt-2">
                            <a style="font-size: 14px; font-weight: lighter;" href="{{route('departments.index')}}">Xem thêm</a>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>
</main>
@endsection
