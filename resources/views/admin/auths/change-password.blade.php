@extends('admin.layouts.app')
@section('title', 'Thay đổi mật khẩu')
@section('content')
<main class="main-content position-relative max-height-vh-100 h-100 border-radius-lg ps ps--active-y">
    <nav class="navbar navbar-main navbar-expand-lg px-0 mx-4 shadow-none border-radius-xl" id="navbarBlur" data-scroll="true">
        <div class="container-fluid py-1 px-3">
            <nav aria-label="breadcrumb">
                <h6 class="font-weight-bolder mb-0">Thay đổi mật khẩu</h6>
            </nav>
        </div>
    </nav>
    <div class="container py-1">
        <div class="row mb-4">
            <div class="col-lg-12 col-md-12 mb-md-0 mb-4">
                <div class="card">
                    <div class="card-header p-3 pb-0">
                        <h6 class="mb-0">Thông tin</h6>
                    </div>
                    <hr class="dark horizontal my-0">
                    <div class="card-body p-3 pb-0 pt-1">
                        @if (session('success'))
                            <div class="col-lg-12">
                                <div class="alert alert-success  text-white " role="alert">
                                    <strong>Thao tác !</strong> {{ session('success') }}!
                                </div>
                            </div>
                        @endif
                        @if (session('error'))
                                <div class="col-lg-12">
                                    <div class="alert alert-danger  text-white " role="alert">
                                        <strong>Thao tác !</strong> {{ session('error') }}!
                                    </div>
                                </div>
                        @endif
                        <form method="POST" action="{{ route('changePasswordPost') }}">
                                @csrf
                                <div class="form-group mb-3">
                                    <label>Mật khẩu hiện tại</label>
                                    <input type="password" class="form-control p_input" name="current_password" value="{{old('current_password')}}">
                                    @if ($errors->has('current_password'))
                                        <div class="mt-1 notification-error">
                                            {{$errors->first('current_password')}}
                                        </div>
                                    @endif
                                </div>
                                <div class="form-group mb-3">
                                    <label>Mật khẩu mới</label>
                                    <input type="password" class="form-control p_input" name="password" value="{{old('password')}}">
                                    @if ($errors->has('password'))
                                        <div class="mt-1 notification-error">
                                            {{$errors->first('password')}}
                                        </div>
                                    @endif
                                    </div>
                                <div class="form-group mb-3">
                                    <label>Nhập lại mật khẩu</label>
                                    <input type="password" class="form-control p_input" name="confirm_password" value="{{old('confirm_password')}}">
                                    @if ($errors->has('confirm_password'))
                                        <div class="mt-1 notification-error">
                                            {{$errors->first('confirm_password')}}
                                        </div>
                                    @endif
                                </div>
                                <div class="form-group mb-3 d-flex align-items-center justify-content-between">
                                    <div class="form-check" style="padding-left: 0">
                                        <label class="form-check-label">
                                            <input type="checkbox" id="check" class="form-check-input"> Hiển thị mật khẩu <i class="input-helper"></i></label>
                                    </div>
                                </div>
                                <div class="text-center">
                                    <button type="submit" class="btn btn-primary btn-block enter-btn">Xác nhận</button>
                                </div>
                            </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</main>
@endsection
@push('scripts')
    <script type='text/javascript'>
        $(document).ready(function(){
            $('#check').click(function(){
                $(this).is(':checked') ? $('.p_input').attr('type', 'text') : $('.p_input').attr('type', 'password');
            });
        });
    </script>
@endpush
