@extends('layouts.app')
@section('title', 'Điểm danh')
@section('content')
    <div class="container my-auto ">
        <div class="row">
            <div class="col-lg-5 col-md-8 col-12 mx-auto">
                <div class="card z-index-0 fadeIn3 fadeInBottom" >
                    @include('components.header', ['title' => 'Thời gian còn lại', 'about' => \App\Models\Information::find(1)])
                    <div class="card-body attendance text-center" style="padding: 2rem 1.5rem 3rem">
                        <div class="countdown">
                            <div>
                                <span class="number days"></span>
                                <span>Ngày</span>
                            </div>
                            <div>
                                <span class="number hours"></span>
                                <span>Giờ</span>
                            </div>
                            <div>
                                <span class="number minutes"></span>
                                <span>Phút</span>
                            </div>
                            <div>
                                <span class="number seconds"></span>
                                <span>Giây</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <style>
        .countdown{
            display: flex;
            justify-content: center;
            gap: 20px;
        }
        .countdown > div{
            display: flex;
            flex-wrap: nowrap;
            flex-direction: column;
            justify-content: center;
            align-items: center;
            margin-top: 10px;
            box-shadow: 1px 1px 15px rgba(0,0,0,0.25);
            width: 110px;
            height: 150px;
            border-radius: 5px;
        }
        .number {
            font-weight: 500;
            font-size: 80px;
            height: 110px;
        }

        div span:last-of-type{
            font-size: 20px;
            padding-bottom: 15px;
        }
        @media screen and (max-width:600px){
            h1{
                font-size: 40px;
            }

            .countdown {
                flex-direction: row;
                align-items: center;
                gap: 10px;
                margin-top: 0px;
            }
            .countdown > div {
                background-color: #fff;
                width: 80px;
                height: 120px;
                margin: 0;
                flex-direction: column;
                justify-content: space-between;
                padding: 10px;
            }
            div span:last-of-type{
                font-size: 18px;
            }
            .number {
                font-size: 44px;
            }
        }
    </style>
@endsection
@push('scripts')
    <script>
        const newDate = new Date('{{$about['start_date']}}').getTime()
        const countdown = setInterval(() =>{

            const date = new Date().getTime()
            const diff = newDate - date
            if(diff > 1){
                const days = Math.floor(diff % (1000 * 60 * 60 * 24 * (365.25 / 12)) / (1000 * 60 * 60 * 24))
                const hours =  Math.floor(diff % (1000 * 60 * 60 * 24) / (1000 * 60 * 60))
                const minutes = Math.floor((diff % (1000 * 60 * 60)) / (1000 * 60))
                const seconds = Math.floor((diff % (1000 * 60)) / 1000)

                document.querySelector(".seconds").innerHTML = seconds < 10 ? '0' + seconds : seconds
                document.querySelector(".minutes").innerHTML = minutes < 10 ? '0' + minutes :minutes
                document.querySelector(".hours").innerHTML = hours < 10 ? '0' + hours : hours
                document.querySelector(".days").innerHTML = days < 10 ? '0' + days : days
            }else{
                clearInterval(countdown)
                document.querySelector(".countdown").innerHTML = 'Happy Birthday Ahmed'
            }
        }, 1000)

    </script>
@endpush
