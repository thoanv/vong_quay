@extends('layouts.app')
@section('title', 'Điểm danh')
@section('content')
    <div class="container my-auto">
        <div class="row">
            <div class="col-lg-4 col-md-8 col-12 mx-auto mt-mobile">
                <div class="card z-index-0 fadeIn3 fadeInBottom">
                    <div class="card-header p-0 position-relative mt-n5 mx-3 z-index-2">
                        <div class="bg-gradient-primary shadow-primary border-radius-lg py-3 pe-1 text-center">
                            <h4 class="text-white font-weight-bolder text-center mt-2 mb-0 text-uppercase">Đăng ký thành
                                công</h4>
                        </div>
                    </div>
                    <div class="pyro">
                        <div class="before"></div>
                        <div class="after"></div>
                    </div>
                    <div class="card-body attendance">
                        <div class="box-result">
                            <span class="number-code">{{$attendance['code']}}</span>

                        </div>
                        <div class="text-center mt-2">
                            <h6>Đây là mã số quay trúng thưởng của bạn.</h6>
                            <p>Vui lòng <strong>chụp ảnh màn hình điện thoại</strong> giữ lại để so sánh với kết quả quay thưởng.</p>
                            <h5>Xin trân thành cảm ơn!</h5>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
