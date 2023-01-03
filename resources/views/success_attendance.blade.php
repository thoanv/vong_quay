@extends('layouts.app')
@section('title', 'Điểm danh')
@section('content')
    <main class="main-content mt-0 ps">
        <div class="page-header align-items-start min-vh-100">
            <span class="mask bg-gradient-dark opacity-6"></span>
            <div class="container my-auto">
                <div class="row">
                    <div class="col-lg-4 col-md-8 col-12 mx-auto">
                        <div class="card z-index-0 fadeIn3 fadeInBottom">
                            @include('components.header', ['title' => 'Đăng ký thành công', 'about' => \App\Models\Information::find(1)])
                            <div class="pyro"><div class="before"></div><div class="after"></div></div>
                            <div class="card-body attendance">
                                <div class="box-result">
                                    <span class="number-code">{{$attendance['code']}}</span>

                                </div>
                                <div class="text-center mt-2">
                                    <span>Đây là mã số quay trúng thưởng của bạn.</span>
                                    <p>Vui lòng lưu lại để so sánh với kết quả</p>
                                    <h5>Xin cảm ơn!</h5>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            @include('layouts.footer')
        </div>
        <div class="ps__rail-x" style="left: 0px; bottom: 0px;">
            <div class="ps__thumb-x" tabindex="0" style="left: 0px; width: 0px;"></div>
        </div>
        <div class="ps__rail-y" style="top: 0px; right: 0px;">
            <div class="ps__thumb-y" tabindex="0" style="top: 0px; height: 0px;"></div>
        </div>
    </main>
@endsection
