@extends('layouts.app')
@section('title', 'Điểm danh')
@section('content')
    <div class="container my-auto ">
        <div class="row">
            <div class="col-lg-4 col-md-8 col-12 mx-auto mt-mobile">
                <div class="card z-index-0 fadeIn3 fadeInBottom">
                    <div class="card-header p-0 position-relative mt-n5 mx-3 z-index-2">
                        <div class="bg-gradient-primary shadow-primary border-radius-lg py-3 pe-1 text-center">
                            <h4 class="text-white font-weight-bolder text-center mb-0">CHECK IN</h4>
                        </div>
                    </div>
                    <div class="card-body attendance">
                        <form method="POST" action="{{ route('post.attendance') }}">
                            @csrf
                            <div class="form-group">
                                <label>Họ và tên <span class="text-danger">*</span></label>
                                <input type="text" name="full_name"  placeholder="Nhập họ và tên ..." class="form-control" value="{{old('full_name')}}">
                                @if ($errors->has('full_name'))
                                    <div class="mt-1 notification-error">
                                        {{$errors->first('full_name')}}
                                    </div>
                                @endif
                            </div>
                            <div class="form-group">
                                <label>Số điện thoại <span class="text-danger">*</span></label>
                                <input type="text" name="phone" id="phoneNumber" placeholder="Nhập số điện thoại ..." class="form-control" value="{{old('phone')}}">
                                @if ($errors->has('phone'))
                                    <div class="mt-1 notification-error">
                                        {{$errors->first('phone')}}
                                    </div>
                                @endif
                            </div>
                            @if(count($departments) > 0)
                                <div class="form-group">
                                    <label>Phòng ban</label>
                                    <select class="form-control js-example-basic-single" name="department_id">
                                        <option value="" style="color: #d2d6da">Chọn</option>
                                        @foreach($departments as $item)
                                            <option  {{ old('department_id') == $item['id'] ? 'selected' : '' }} value="{{$item['id']}}">{{$item['name']}}</option>
                                        @endforeach
                                    </select>
                                </div>
                            @endif
{{--                                    <div class="form-group">--}}
{{--                                        <div class="row">--}}
{{--                                            <div class="col-lg-6">--}}
{{--                                                <label for="captcha" class="form-label">Mã captcha</label>--}}
{{--                                                <div class="captcha">--}}
{{--                                                    <span>{!! Captcha::img('flat') !!}</span>--}}
{{--                                                    <a href="javascript:void(0)" class="btn-reload" id="refresh"><i class="fa fa-refresh" ></i></a>--}}
{{--                                                </div>--}}
{{--                                            </div>--}}
{{--                                            <div class="col-lg-6">--}}
{{--                                                <label for="captcha" class="form-label">Nhập kết quả *</label>--}}
{{--                                                <input type="text" class="form-control apply-captcha" id="captcha" name="captcha" placeholder="Nhập kết quả...">--}}
{{--                                                @if ($errors->has('captcha'))--}}
{{--                                                    <div class="mt-1 notification-error">--}}
{{--                                                        {{$errors->first('captcha')}}--}}
{{--                                                    </div>--}}
{{--                                                @endif--}}
{{--                                            </div>--}}

{{--                                        </div>--}}
{{--                                    </div>--}}

                            <div class="text-center">
                                <button type="submit" class="btn bg-gradient-primary w-100 my-4 mb-2">Check In</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
