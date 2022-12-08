@php
    $about = \App\Models\Information::find(1);
@endphp
<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>@yield('title')</title>
    <link rel="shortcut icon" href="{{$about['favicon'] ? $about['favicon'] : '/assets/img/wait.png'}}" />
    <!-- Fonts -->
    <link rel="stylesheet" type="text/css" href="https://fonts.googleapis.com/css?family=Roboto:300,400,500,700,900|Roboto+Slab:400,700" />
    <!-- Nucleo Icons -->
    <link href="{{asset('assets/css/nucleo-icons.css')}}" rel="stylesheet" />
    <link href="{{asset('assets/css/nucleo-svg.css')}}" rel="stylesheet" />
    <!-- Font Awesome Icons -->
    <script src="https://kit.fontawesome.com/42d5adcbca.js" crossorigin="anonymous"></script>
    <!-- Material Icons -->
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons+Round" rel="stylesheet">
    <!-- CSS Files -->
    <link id="pagestyle" href="{{asset('assets/css/material-dashboard.css')}}" rel="stylesheet" />
    <link href="{{asset('assets/lib/select2/css/select2.min.css')}}" rel="stylesheet" />
    <link href="{{asset('assets/css/style.css')}}" rel="stylesheet" />
    <style>
        .bg-gradient-primary{
            background-image: linear-gradient(356deg, {{$about['code_color'] ? $about['code_color'] : '#026938'}} 0%, {{$about['code_color'] ? $about['code_color'] : '#0269389e'}} 100%)!important;
        }
        .btn-primary-css{
            background-color: {{$about['code_color'] ? $about['code_color'] : '#026938'}};
            color: #FFF;
        }
        .btn-primary-css:disabled{
            background-color: #FFF;
            color: {{$about['code_color'] ? $about['code_color'] : '#026938'}};
            border: 1px solid {{$about['code_color'] ? $about['code_color'] : '#026938'}};
        }
        .btn-primary-css:hover{
            background-color: #FFF;
            color: {{$about['code_color'] ? $about['code_color'] : '#026938'}};
            border: 1px solid {{$about['code_color'] ? $about['code_color'] : '#026938'}};
        }
    </style>
</head>
<body style="background-image: url('{{$about['background'] ? $about['background'] : '../assets/img/bg.jpg'}}');" class="attendance">
<div class="container top-0">
    <div class="row">
        <div class="col-lg-12 text-center col-box-logo">
            <div class="box-logo bg-gradient-primary box-shadow">
                <a  href="{{route('spin')}}">
                    <img src="{{$about['logo'] ? $about['logo'] : '../assets/img/logo.png'}}" alt="logo" style="width: 150px;">
                </a>
            </div>
        </div>
    </div>
</div>
@yield('content')
<!--   Core JS Files   -->
<script src="{{asset('assets/js/jquery-3.6.1.min.js')}}"></script>
<script src="{{asset('assets/js/core/popper.min.js')}}"></script>
<script src="{{asset('assets/js/core/bootstrap.min.js')}}"></script>
<script src="{{asset('assets/lib/select2/js/select2.min.js')}}"></script>
<script src="{{asset('assets/js/plugins/perfect-scrollbar.min.js')}}"></script>
<script src="{{asset('assets/js/plugins/smooth-scrollbar.min.js')}}"></script>
<script>
    var win = navigator.platform.indexOf('Win') > -1;
    if (win && document.querySelector('#sidenav-scrollbar')) {
        var options = {
            damping: '0.5'
        }
        Scrollbar.init(document.querySelector('#sidenav-scrollbar'), options);
    }
</script>
<!-- Github buttons -->
<script async defer src="https://buttons.github.io/buttons.js"></script>
<!-- Control Center for Material Dashboard: parallax effects, scripts for the example pages etc -->
<script src="{{asset('assets/js/material-dashboard.min.js')}}"></script>
<script>
    $(document).ready(function() {
        $('.js-example-basic-single').select2();
    });
</script>
<script type="text/javascript">
    $(document).ready(function () {
        const isNumericInput = (event) => {
            const key = event.keyCode;
            return ((key >= 48 && key <= 57) || // Allow number line
                (key >= 96 && key <= 105) // Allow number pad
            );
        };

        const isModifierKey = (event) => {
            const key = event.keyCode;
            return (event.shiftKey === true || key === 35 || key === 36) || // Allow Shift, Home, End
                (key === 8 || key === 9 || key === 13 || key === 46) || // Allow Backspace, Tab, Enter, Delete
                (key > 36 && key < 41) || // Allow left, up, right, down
                (
                    // Allow Ctrl/Command + A,C,V,X,Z
                    (event.ctrlKey === true || event.metaKey === true) &&
                    (key === 65 || key === 67 || key === 86 || key === 88 || key === 90)
                )
        };

        const enforceFormat = (event) => {
            // Input must be of a valid number format or a modifier key, and not longer than ten digits
            if (!isNumericInput(event) && !isModifierKey(event)) {
                event.preventDefault();
            }
        };

        const formatToPhone = (event) => {
            if (isModifierKey(event)) {
                return;
            }

            // I am lazy and don't like to type things more than once
            const target = event.target;
            const input = event.target.value.replace(/\D/g, '').substring(0, 10); // First ten digits of input only
            const zip = input.substring(0, 3);
            const middle = input.substring(3, 6);
            const last = input.substring(6, 10);

            if (input.length > 6) {
                target.value = `${zip} ${middle} ${last}`;
            } else if (input.length > 3) {
                target.value = `${zip} ${middle}`;
            } else if (input.length > 0) {
                target.value = `${zip}`;
            }
        };

        const inputElement_ = document.getElementById('phoneNumber');
        inputElement_.addEventListener('keydown', enforceFormat);
        inputElement_.addEventListener('keyup', formatToPhone);
    })

</script>
@stack('scripts')
</body>
</html>
