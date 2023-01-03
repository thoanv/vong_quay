@extends('layouts.app')
@section('title', 'Điểm danh')
@section('content')
    <main class="main-content mt-0 ps">
        <div class="page-header align-items-start min-vh-100">
            <span class="mask bg-gradient-dark opacity-6"></span>
            <div class="container my-auto">
                <div class="row">
                    <div class="col-lg-5 col-md-8 col-12 mx-auto">
                        <div class="card z-index-0 fadeIn3 fadeInBottom">
                            @include('components.header', ['title' => 'Vòng quay may mắn', 'about' => \App\Models\Information::find(1)])
                            <div class="pyro"><div class="before"></div><div class="after"></div></div>
                            <div class="card-body attendance" style="display: flex; align-items: center; justify-content: center; flex-direction: column">
                                <div class="main-wheel">
                                    <div class="icon-arrow">
                                        <img src="/assets/img/down.png" alt="down">
                                    </div>
                                    <ul class="wheel"></ul>
                                </div>
                                <div>
                                    <button class="btn-start">Quay thưởng</button>
                                </div>
                                <h1 class="msg"></h1>
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
        (() => {
            let timer = 7000;
            let isRotating = false;
            let currentRotate = 0;
            const  wheel = $('.wheel');
            const  btnStart = $('.btn-start');
            const  msg = $('.msg');
            // Chú ý: Tổng % các phần thưởng = 100/100
            const  listGift = [
                {
                    txtName: 'Iphone 1',
                    percent: 10/100
                },
                {
                    txtName: 'Iphone 2',
                    percent: 90/100
                },
                {
                    txtName: 'Iphone 3',
                    percent: 0/100
                },
                {
                    txtName: 'Iphone 4',
                    percent: 0/100
                },
                {
                    txtName: 'Iphone 5',
                    percent: 0/100
                },
                {
                    txtName: 'Iphone 6',
                    percent: 0/100
                },
                // {
                //     txtName: 'Iphone 7',
                //     percent: 10/100
                // },
                // {
                //     txtName: 'Iphone 8',
                //     percent: 10/100
                // },
                // {
                //     txtName: 'Iphone 9',
                //     percent: 10/100
                // },
                // {
                //     txtName: 'Iphone 10',
                //     percent: 10/100
                // },
            ];
            const  size = listGift.length;
            const  rotate = 360 / size; //Số góc 1 phần thưởng chiếm trong vòng tròn
            const  skewY = 90 - rotate; // Độ nghiêng của 1 item

            const renderItem = () => {
                listGift.map((item, index) =>  {
                    const itemGift = `<li style="transform: rotate(${rotate*index}deg) skewY(-${skewY}deg)">
                        <p class="text-item ${index%2==0&&'even'}" style="transform: skewY(${skewY}deg) rotate(${(rotate/2)}deg)">
                            <b>${item.txtName}</b>
                        </p>
                    </li>`;

                    wheel.append(itemGift);
                });
            };
            const roteteWheel = (currentRotate, index) => {
                wheel.css(
                    'transform' , `rotate(${ currentRotate - index * rotate - rotate/2 }deg)`
                )
            };
            const getGift = (randomNumber) => {
              let currentPercent = 0;
              let list = [];
              listGift.forEach((item, index) => {
                  currentPercent += item.percent;

                  randomNumber <= currentPercent && list.push({
                      ...item, index
                  });
              });
              return list[0];
            }
            const showTxtGift = (txt) => {
                setTimeout(() => {
                    isRotating = false;
                    msg.html(`Chúc mừng bạn đã trúng ${txt}`)
                    console.log(txt)
                }, timer);
            }
            const start = () => {
                isRotating = true;
                msg.html('');
                const random= Math.random();
                const gift = getGift(random);

                console.log(gift);
                currentRotate += 360 * 10;
                roteteWheel(currentRotate, gift.index)
                showTxtGift(gift.txtName)
            }
            btnStart.click(function() {
                !isRotating && start();
            });

            renderItem();
        })();
    </script>
@endpush
@push('style')
    <style>
        img{
            width: 100%;
            height: 100%;
            object-fit: cover;
        }
        .main-wheel{
            position: relative;
            width: calc(400px * 1.1);
            height: calc(400px * 1.1);
            border-radius: 50%;
            background-image: linear-gradient(
                233.36deg,
                #00435e 35.38%,
                #000604 94.78%
            );
            display: flex;
            justify-content: center;
            align-items: center;
        }
        .main-wheel:after{
            content: '';
            position: absolute;
            width: calc(400px * 1.05);
            height: calc(400px * 1.05);
            border-radius: 50%;
            background-image: linear-gradient(
                135deg,
                #fffb90 14.32%,
                #fbea78 25.04%,
                #f8dc65 32.44%,
                #e6c758 34.8%,
                #c5a041 39.83%,
                #ad8330 44.46%,
                #9e7226 48.48%,
                #996c22 51.45%,
                #9d7126 53.71%,
                #aa8131 56.55%,
                #be9b42 59.7%,
                #dabe5b 63.05%,
                #fbe878 66.32%,
                #ffffaa 72.82%,
                #fbe878 77.44%,
                #a4631b 90.06%
            );
        }
        .icon-arrow{
            position: absolute;
            width: 50px;
            top: -7px;
            z-index: 3;
            left: 50%;
            transform: translateX(-50%);
        }
        .wheel{
            overflow: hidden;
            position: relative;
            z-index: 1;
            width: 400px;
            height: 400px;
            border-radius: 50%;
            background-color: #FFF;
            margin-bottom: 0;
            list-style: none;
            transition: cubic-bezier(0.075, 0.82, 0.165, 1) 7s;
        }
        .btn-start{
            padding: 1rem 2rem;
            margin-top: 2rem;
            border: 2px solid #000;
            border-radius: 3rem;
            font-size: 1.3rem;
        }
        .btn-start:hover{
            cursor: pointer;
            opacity: .8;
        }
        .wheel li{
            overflow: hidden;
            position: absolute;
            top: 0;
            right: 0;
            width: 50%;
            height: 50%;
            transform-origin: 0% 100%;
        }
        .text-item{
            display: block;
            position: absolute;
            left: -100%;
            width: 200%;
            height: 200%;
            text-align: center;
            padding-top: 1.7rem;
            background-color: rgb(172, 172, 172);
            color: rgb(255, 255, 255);

        }
        .text-item.even{
            background-color: rgb(36, 36, 36);
        }
        .text-item > b{
            display: inline-block;
            word-break: break-word;
            max-width: 20%;
        }
    </style>
@endpush
