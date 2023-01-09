@extends('layouts.app')
@section('title', 'Điểm danh')
@section('content')
    <div class="container-fluid my-auto reward">
        <div class="row">
            <div class="col-lg-5 col-md-5 col-12 mx-auto">
                <div class="card z-index-0 fadeIn3 fadeInBottom">
                    <div class="card-header p-0 position-relative mt-n5 mx-3 z-index-2">
                        <div class="bg-gradient-primary shadow-primary border-radius-lg py-3 pe-1 text-center">
                            <h4 class="text-white font-weight-bolder text-center mt-2 mb-0 text-uppercase">Vòng quay</h4>
                        </div>
                    </div>
                    <div class="pyro">
                        <div class="before"></div>
                        <div class="after"></div>
                    </div>
                    <div class="card-body attendance">
                        <h3 class="name-reward-run text-center text-uppercase" ></h3>
                        <div class="number-run mb-2">
                            <span id="counter">0000</span>
                        </div>
                        <audio id="myAudio" preload>
                            <source src="{{$about['audio'] ? $about['audio'] : '/assets/audio/music.mp3'}}"
                                    type="audio/mpeg">
                        </audio>
                        <div class="information text-center mt-2" style="display: none">
                            <h5 class="mb-0 text-uppercase text-black">Chúc mừng</h5>
                            <h2 class="mb-0 name font-weight-bold"></h2>
                            <h5 class="phone mb-0 text-black"></h5>
{{--                            <span class="department color-setup">Ban Công nghệ</span>--}}
                            <div class="list-button mt-3">
                                <button class="btn mb-0 btn-primary-css confirm btn-sm">Xác nhận</button>
                                <button class="btn mb-0 btn-primary-css come-back btn-sm">Quay lại</button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-5 col-md-5 col-12 mx-auto">
                <div class="card z-index-0 fadeIn3 fadeInBottom">
                    <div class="card-header p-0 position-relative mt-n5 mx-3 z-index-2">
                        <div class="bg-gradient-primary shadow-primary border-radius-lg py-3 pe-1 text-center">
                            <h4 class="text-white font-weight-bolder text-center mt-2 mb-0 text-uppercase">Giải thưởng</h4>
                        </div>
                    </div>
                    <div class="pyro">
                        <div class="before"></div>
                        <div class="after"></div>
                    </div>
                    <div class="card-body attendance">
                        @foreach($rewards as $key => $reward)
                            <div class="d-flex">
                                <div class="my-auto ms-3">
                                    <div class="h-100">
                                        <h5 class="mb-0 font-size-16">
                                            {{$reward['name']}}
                                        </h5>
                                        <p class="mb-0 tex-css-text-second">{{$reward['value']}}</p>
                                    </div>
                                </div>

                                <div class="form-check form-switch my-auto ms-auto my-auto">
                                    @if($reward['attendance_id'] && $reward->attendance)
                                        <div class="text-right">
                                            <h5 class="mb-0 color-setup font-size-16">{{$reward->attendance->name}} @if($reward->attendance)
                                                    <span>- {{$reward->attendance->code}}</span>
                                                @endif</h5>

                                            @if(isset($reward->attendance->department) && $reward->attendance->department)
                                                <p class="mb-0 tex-css-text-second">({{$reward->attendance->department->name}} - {{$reward->attendance->phone}})</p>
                                            @else
                                                <p class="mb-0 tex-css-text-second">{{$reward->attendance->phone}}</p>
                                            @endif
                                        </div>
                                    @else
                                        <div class="spinner-border text-primarys spinner-reward-{{$reward['id']}}"
                                             role="status" style="display: none">
                                            <span class="sr-only">Loading...</span>
                                        </div>
                                        <button class="btn btn-primary-css btn-sm start-reward reward-{{$reward['id']}}"
                                                data-id="{{$reward['id']}}" data-name="{{$reward['name']}}">Quay
                                        </button>
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
                            if (res.success) {
                                window.location.reload();
                            }
                        }
                    });
                }
            })

        })

        function spin(id, name) {
            x.play();
            $('.pyro').hide();
            $('.name-reward-run').html(name);
            $('.spinner-reward-' + id).show();
            $('.reward-' + id).hide();
            timer = setInterval(function () {
                a = a + 1;
                if (a === 9) {
                    a = 0;
                }
                b = b + 1;
                if (b === 9) {
                    b = 0;
                }
                c = c + 1;
                if (c === 9) {
                    c = 0;
                }
                d = d + 1;
                if (d === 9) {
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
                    if (res.success) {
                        let data = res.data.data;
                        $('.come-back').attr('data-id', id);
                        $('.come-back').attr('data-name', name);
                        $('.confirm').attr('data-id', id);
                        $('.confirm').attr('data-attendance', data.id);
                        code = data.code;
                        let txt = '';
                        if (data.department)
                            txt_ = `(${data.department} - ${data.phone})`
                        else
                            txt_ = `(${data.phone})`
                        $('.name').html(data.name)
                        $('.phone').html(txt)
                    }
                }
            });
            setTimeout(function () {
                stop();
            }, second)
        }

        function stop() {
            // x.pause();
            $('.pyro').show();
            $('.information').show();
            clearInterval(timer);
            timer = null;
            $("#counter").html(code);
        }
    </script>
@endpush
