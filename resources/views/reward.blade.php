@extends('layouts.app')
@section('title', 'Điểm danh')
@section('content')
    <nav class="navbar navbar-expand-lg position-absolute top-0 z-index-3 w-100 shadow-none navbar-transparent">
        <div class="container">
            <a class="navbar-brand font-weight-bolder ms-lg-0 ms-3 text-white" href="">
                <img style="width: 120px;" class="logo" src="{{$about['logo'] ? $about['logo'] : '../assets/img/logo.png'}}" alt="logo">
            </a>
        </div>
    </nav>
    <main class="main-content mt-0 ps reward">
        <div class="page-header align-items-start min-vh-100">
            <span class="mask bg-gradient-dark opacity-6"></span>
            <div class="container-fluid my-auto">
                <div class="row">
                    <div class="col-lg-7 col-md-7 col-12 mx-auto">
                        <div class="card z-index-0 fadeIn3 fadeInBottom">
                            <div class="card-header p-0 position-relative mt-n5 mx-3 z-index-2">
                                <div class="bg-gradient-primary shadow-primary border-radius-lg py-3 pe-1 text-center">
                                    <h4 class="text-white font-weight-bolder text-center mt-2 mb-0">Vòng quay</h4>
                                </div>
                            </div>
                            <div class="pyro"><div class="before"></div><div class="after"></div></div>
                            <div class="card-body attendance">
                                <h1 class="name-reward-run text-center"></h1>
                                <div class="number-run mb-2">
                                    <span id="counter">0000</span>
                                </div>
                                <audio id="myAudio" preload loop>
                                    <source src="{{$about['audio'] ? $about['audio'] : '/assets/audio/music.mp3'}}" type="audio/mpeg">
                                </audio>
                                <div class="information text-center mt-4" style="display: none">
                                    <span>Chúc mừng</span>
                                    <h4 class="mb-0 name">Nguyễn Văn Thỏa</h4>
                                    <p class="phone mb-0">0356240993</p>
                                    <span class="department"></span>
                                    <div class="list-button">
                                        <button class="btn mb-0 btn-primary-css confirm">Xác nhận</button>
                                        <button class="btn mb-0 btn-primary-css come-back">Quay lại</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-3 col-md-3 col-12 mx-auto">
                        <div class="card z-index-0 fadeIn3 fadeInBottom">
                            <div class="card-header p-0 position-relative mt-n5 mx-3 z-index-2">
                                <div class="bg-gradient-primary shadow-primary border-radius-lg py-3 pe-1 text-center">
                                    <h4 class="text-white font-weight-bolder text-center mt-2 mb-0">Giải thưởng</h4>
                                </div>
                            </div>
                            <div class="pyro"><div class="before"></div><div class="after"></div></div>
                            <div class="card-body attendance">
                                @foreach($rewards as $key => $reward)
                                <div class="d-flex">
                                    <div class="my-auto ms-3">
                                        <div class="h-100">
                                            <h5 class="mb-0">
                                                {{$reward['name']}}
                                                @if($reward->attendance)
                                                    <span style="color: red; font-size: 18px">({{$reward->attendance->code}})</span>
                                                @endif
                                            </h5>
                                            <p class="mb-0 text-sm">{{$reward['value']}}</p>
                                        </div>
                                    </div>

                                    <div class="form-check form-switch my-auto ms-auto my-auto">
                                        @if($reward['attendance_id'] && $reward->attendance)
                                        <div class="text-center">
                                            <h6 class="mb-0" style="font-size: 14px">{{$reward->attendance->name}}</h6>
                                            <p class="mb-0" style="font-size: 13px">{{$reward->attendance->phone}}</p>
                                            @if(isset($reward->attendance->department) && $reward->attendance->department)
                                            <p class="mb-0" style="font-size: 13px">{{$item->attendance->department->name}}</p>
                                            @endif
                                        </div>
                                        @else
                                            <div class="spinner-border text-primarys spinner-reward-{{$reward['id']}}" role="status" style="display: none">
                                                <span class="sr-only">Loading...</span>
                                            </div>
                                            <button class="btn btn-primary-css btn-sm start-reward reward-{{$reward['id']}}" data-id="{{$reward['id']}}" data-name="{{$reward['name']}}">Quay</button>
                                        @endif
                                    </div>
                                </div>
                                @if((count($rewards)-1) > $key)
                                <hr class="dark horizontal">
                                    @endif
                                @endforeach
                            </div>
                        </div>
                    </div>

                </div>
            </div>
            @include('layouts.footer')
        </div>
    </main>
@endsection
@push('scripts')
    <script>
        var x = document.getElementById("myAudio");
        var timer = null,
            code = 0000,
            second = {{$about['second'] ? $about['second'] * 1000 : 5000}},
            interval = 100,
            a = 0,
            b = 3,
            c = 6,
            d = 8;
        $('.start-reward').click(function () {
            $('.information').hide();
            let id = $(this).data('id');
            let name = $(this).data('name');
            $('.start-reward').prop("disabled", true);
            spin(id, name);
        })
        $('.come-back').click(function () {
            $('.information').hide();
            let id = $(this).data('id');
            let name = $(this).data('name');
            spin(id, name);
        })
        $('.confirm').click(function () {
            let id_reward = $(this).data('id');
            let id_attendance = $(this).data('attendance');
            Swal.fire({
                title: 'Thông báo?',
                text: "Bạn có muốn thực hiện thao tác này",
                icon: 'success',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                cancelButtonText: 'Hủy',
                confirmButtonText: 'Đồng ý',

            }).then((result) => {
                if (result.isConfirmed) {
                    $.ajax({
                        url: '{{route('confirm-result')}}',
                        method: 'POST',
                        data: {
                            id_reward: id_reward,
                            id_attendance: id_attendance,
                            _token: $('meta[name="csrf-token"]').attr('content')
                        },
                        success: function (res) {
                            if(res.success){
                                window.location.reload();
                            }
                        }
                    });
                }
            })

        })
        function spin(id, name){
            x.play();
            $('.pyro').hide();
            $('.name-reward-run').html(name);
            $('.spinner-reward-'+id).show();
            $('.reward-'+id).hide();
            timer = setInterval(function () {
                a = a+1;
                if(a === 9){
                    a = 0;
                }
                b = b+1;
                if(b === 9){
                    b = 0;
                }
                c = c+1;
                if(c === 9){
                    c = 0;
                }
                d = d+1;
                if(d === 9){
                    d = 0;
                }
                let result = `${a}${b}${c}${d}`
                $("#counter").html(result);
            }, interval);
            $.ajax({
                url: '{{route('call-result')}}',
                data: {
                    _token: $('meta[name="csrf-token"]').attr('content')
                },
                success: function (res) {
                    if(res.success){
                        let data = res.data.data;
                        $('.come-back').attr('data-id', id);
                        $('.come-back').attr('data-name', name);
                        $('.confirm').attr('data-id', id);
                        $('.confirm').attr('data-attendance', data.id);
                        code = data.code;
                        $('.name').html(data.name)
                        $('.phone').html(data.phone)
                        if(data.department)
                            $('.department').html(data.department)
                    }
                }
            });
            setTimeout(function () {
                stop();
            }, second)
        }
        function stop(){
            x.pause();
            $('.pyro').show();
            $('.information').show();
            clearInterval(timer);
            timer = null;
            $("#counter").html(code);
        }
        </script>
@endpush
