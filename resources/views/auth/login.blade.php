@extends('layouts.app')
@section('title', 'Hệ thống đăng nhập')
@section('content')
    <main class="main-content mt-0">
        <div class="page-header align-items-start min-vh-50" >
            <div class="container my-auto" style="margin-top: 0!important; padding-top: 70px">
                <div class="row">
                    <div class="col-lg-4 col-md-8 col-12 mx-auto">
                        <div class="card z-index-0 fadeIn3 fadeInBottom">
                            <div class="card-header p-0 position-relative mt-n5 mx-3 z-index-2">
                                <div class="bg-gradient-primary shadow-primary border-radius-lg py-3 pe-1">
                                    <h4 class="text-white font-weight-bolder text-center mt-2">Hệ thống đăng nhập</h4>
                                </div>
                            </div>
                            <div class="card-body attendance">
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
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            @include('layouts.footer')
        </div>
    </main>
@endsection
