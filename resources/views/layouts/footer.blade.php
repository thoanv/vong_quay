<footer class="footer position-absolute bottom-2 py-2 w-100">
    <div class="container">
        <div class="row align-items-center justify-content-lg-between">

            <div class="col-12 col-md-6">
                <ul class="nav nav-footer justify-content-center justify-content-lg-start">
                    <li class="nav-item">
                        <a href="{{route('home')}}" class="nav-link text-white">QR code</a>
                    </li>
                    <li class="nav-item">
                        <a href="{{route('attendance')}}" class="nav-link text-white">Điểm danh</a>
                    </li>
                    @if(\Illuminate\Support\Facades\Auth::check())
                    <li class="nav-item">
                        <a href="{{route('dashboard')}}" class="nav-link text-white">Quản trị</a>
                    </li>
                    @else
                    <li class="nav-item">
                        <a href="{{route('login')}}" class="nav-link text-white">Đăng nhập</a>
                    </li>
                    @endif
{{--                    <li class="nav-item">--}}
{{--                        <a href="{{route('spin')}}" class="nav-link text-white">Vòng quay</a>--}}
{{--                    </li>--}}
                </ul>
            </div>
            <div class="col-12 col-md-6 my-auto">
                <div class="copyright text-center text-sm text-white text-lg-end">
                    © <script>
                        document.write(new Date().getFullYear())
                    </script>,
                    <i class="fa fa-heart" style="margin: 0 15px" aria-hidden="true"></i>
                    Phát triển bởi Ban Công Nghệ
                </div>
            </div>
        </div>
    </div>
</footer>
