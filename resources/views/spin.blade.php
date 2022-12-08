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
                            <div class="card-header p-0 position-relative mt-n5 mx-3 z-index-2">
                                <div class="bg-gradient-primary shadow-primary border-radius-lg py-3 pe-1">
                                    <h4 class="text-white font-weight-bolder text-center mt-2 mb-0">Vòng quay may mắn</h4>

                                </div>
                            </div>
                            <div class="pyro"><div class="before"></div><div class="after"></div></div>
                            <div class="card-body attendance">
                                <div class="number-run mb-2">
                                    <span id="counter">0000</span>
                                </div>
                                <audio id="myAudio">
                                    <source src="/assets/audio/music.mp3" type="audio/mpeg">
                                </audio>
                                <div class="information text-center mt-4" style="display: none">
                                    <h4 class="mb-0 name">Nguyễn Văn Thỏa</h4>
                                    <p class="phone mb-0">0356240993</p>
                                    <span class="department"></span>
                                </div>
                                <div class="action-spin">
                                    <button class="btn btn-primary-css btn-lg btn-start" id="start">Start</button></p>
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

        $("#start").click(function() {
            $('.department').html();
            $('.pyro').hide();
            $('.information').hide();
            x.play();
            if (timer !== null) return;
            $('#start').prop("disabled", true);
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
                        console.log(data)
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
        });
        function stop(){
            x.pause();
            $('.pyro').show();
            $('.information').show();
            clearInterval(timer);
            timer = null;
            $('#start').prop("disabled", false);
            $("#counter").html(code);
        }

    </script>
@endpush
