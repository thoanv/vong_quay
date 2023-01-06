@extends('layouts.app')
@section('title', 'Hệ thống đăng nhập')
@section('content')

            <div class="container my-auto">
                <div class="row">
                    <div class="col-lg-4 col-md-8 col-12 mx-auto">
                        <div class="card z-index-0 fadeIn3 fadeInBottom">
                            @include('components.header', ['title' => 'Hệ thống đăng nhập', 'about' => \App\Models\Information::find(1)])
                            <div class="card-body">
                                <form method="POST" action="{{ route('login') }}">
                                    @csrf
                                    <div class="form-group">
                                        <label>Tên đăng nhập</label>
                                        <input type="email" name="email"  placeholder="Nhập tên địa chỉ email..." class="form-control" value="{{old('email')}}">
                                    </div>
                                    <div class="form-group">
                                        <label>Mật khẩu</label>
                                        <input type="password" name="password"  placeholder="Nhập tên mật khẩu..." class="form-control">
                                    </div>
                                    <div class="text-center">
                                        <button type="submit" class="btn bg-gradient-primary w-100 my-4 mb-2">Đăng nhập</button>
                                    </div>
                                    {{--                                    <p class="mt-4 text-sm text-center">--}}
                                    {{--                                        Nếu bạn chưa có tài khoản ?--}}
                                    {{--                                        <a href="{{route('register')}}" class="text-primary text-gradient font-weight-bold">Đăng ký</a>--}}
                                    {{--                                    </p>--}}
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

@endsection
