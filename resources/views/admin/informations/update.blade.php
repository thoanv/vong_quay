@extends('admin.layouts.app')
@section('title', 'QR Code')
@section('content')
    <main class="main-content position-relative max-height-vh-100 h-100 border-radius-lg ps ps--active-y">
        <nav class="navbar navbar-main navbar-expand-lg px-0 mx-4 shadow-none border-radius-xl" id="navbarBlur" data-scroll="true">
            <div class="container-fluid py-1 px-3">
                <nav aria-label="breadcrumb">
                    <h6 class="font-weight-bolder mb-0">Thông tin chung</h6>
                </nav>
            </div>
        </nav>

        <div class="container py-4">
            @if (session('success'))
                <div class="row notification-submit">
                    <div class="col-lg-12">
                        <div class="alert alert-success  text-white " role="alert">
                            <strong>Thao tác !</strong> {{ session('success') }}!
                        </div>
                    </div>
                </div>
            @endif
            <form method="POST" action="{{route('information.update')}}" enctype="multipart/form-data">
                @csrf
                <input type="hidden" name="id" value="{{$infomation['id']}}">
            <div class="row mb-4">
                <div class="col-xl-3 col-sm-6 mb-xl-0 mb-4">
                    <div class="card">
                        <div class="card-header p-3 pt-2">
                            <div class="box-images">
                                <div class="file-upload text-center">
                                    <input type="file" class="upload_image_general" data-id="100" accept="image/x-png,image/jpeg"
                                           data-bs-original-title="" title="" style="left: 30%" name="logo">
                                    <img src="{{$infomation['logo'] ? $infomation['logo'] : '/assets/img/department.jpg'}}" width="180px" alt="" class="imge image-100">
                                </div>
                            </div>
                        </div>
                        <hr class="dark horizontal my-0">
                        <div class="card-footer p-3">
                            <p class="mb-0">Logo</p>
                        </div>
                    </div>
                </div>
                <div class="col-xl-3 col-sm-6 mb-xl-0 mb-4">
                    <div class="card">
                        <div class="card-header p-3 pt-2">
                            <div class="box-images">
                                <div class="file-upload text-center">
                                    <input type="file" class="upload_image_general" data-id="200" accept="image/x-png,image/jpeg"
                                           data-bs-original-title="" title="" style="left: 30%" name="favicon">
                                    <img src="{{$infomation['favicon'] ? $infomation['favicon'] : '/assets/img/department.jpg'}}" width="180px" alt="" class="imge image-200">
                                </div>
                            </div>
                        </div>
                        <hr class="dark horizontal my-0">
                        <div class="card-footer p-3">
                            <p class="mb-0">Favicon</p>
                        </div>
                    </div>
                </div>
                <div class="col-xl-3 col-sm-6 mb-xl-0 mb-4">
                    <div class="card">
                        <div class="card-header p-3 pt-2">
                           <div class="box-images">
                               <div class="file-upload text-center">
                                   <input type="file" class="upload_image_general" data-id="300" accept="image/x-png,image/jpeg"
                                          data-bs-original-title="" title="" style="left: 30%" name="thumbnail">
                                   <img src="{{$infomation['thumbnail'] ? $infomation['thumbnail'] : '/assets/img/department.jpg'}}" width="180px" alt="" class="imge image-300">
                               </div>
                           </div>
                        </div>
                        <hr class="dark horizontal my-0">
                        <div class="card-footer p-3">
                            <p class="mb-0">Thumbail</p>
                        </div>
                    </div>
                </div>
                <div class="col-xl-3 col-sm-6 mb-xl-0 mb-4">
                    <div class="card">
                        <div class="card-header p-3 pt-2">
                            <div class="box-images">
                                <div class="file-upload text-center">
                                    <input type="file" class="upload_image_general" data-id="400" accept="image/x-png,image/jpeg"
                                           data-bs-original-title="" title="" style="left: 30%" name="background">
                                    <img src="{{$infomation['background'] ? $infomation['background'] : '/assets/img/department.jpg'}}" width="180px" alt="" class="imge image-400">
                                </div>
                            </div>
                        </div>
                        <hr class="dark horizontal my-0">
                        <div class="card-footer p-3">
                            <p class="mb-0">Background (1920x1080)</p>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row mb-4">
                <div class="col-xl-12 col-sm-6 mb-xl-0 mb-4">
                    <div class="card">
                        <div class="card-body p-3 pt-2">
                            <h4 class="font-weight-normal mt-1">Thông tin chung</h4>
                            <hr class="dark horizontal my-0">
                            <div class="pt-2">
                                <div class="form-group row mb-4">
                                    <div class="col-lg-6">
                                        <div class="form-group mb-3">
                                            <label>Tên công ty</label>
                                            <input type="text" class="form-control form-control-lg" name="company" value="{{$infomation['company']}}">
                                        </div>
                                    </div>
                                    <div class="col-lg-6">
                                        <div class="form-group mb-3">
                                            <label>Tên sự kiện</label>
                                            <input type="text" class="form-control form-control-lg" name="name_event" value="{{$infomation['name_event']}}">
                                        </div>
                                    </div>
                                    <div class="col-lg-6">
                                        <div class="form-group mb-3">
                                            <label>Địa chỉ Email</label>
                                            <input type="email" class="form-control form-control-lg" name="email" value="{{$infomation['email']}}">
                                        </div>
                                    </div>
                                    <div class="col-lg-6">
                                        <div class="form-group mb-3">
                                            <label>Số điện thoại</label>
                                            <input type="text" class="form-control form-control-lg" name="phone" value="{{$infomation['phone']}}">
                                        </div>
                                    </div>
                                    <div class="col-lg-6">
                                        <div class="form-group mb-3">
                                            <label>Địa chỉ</label>
                                            <input type="text" class="form-control form-control-lg" name="address" value="{{$infomation['address']}}">
                                        </div>
                                    </div>
                                    <div class="col-lg-6">
                                        <div class="form-group mb-3">
                                            <label>Mã màu (#000)</label>
                                            <input type="text" class="form-control form-control-lg" name="code_color" value="{{$infomation['code_color']}}">
                                        </div>
                                    </div>
                                    <div class="col-lg-6">
                                        <div class="form-group mb-3">
                                            <label>Số giây dừng lại (đơn vị: giây)</label>
                                            <input type="number" class="form-control form-control-lg" name="second" value="{{$infomation['second']}}" placeholder="10">
                                        </div>
                                    </div>
                                    <div class="col-lg-6">
                                        <div class="form-group">
                                            <label>Audio</label>
                                            <div class="d-flex">
                                                <input type="file" class="form-control form-control-lg" name="audio" value="" accept=".mp3,audio/*">
                                                @if($infomation['audio'])
                                                    <a data-bs-toggle="tooltip" data-bs-placement="top" data-container="body" data-animation="true" data-bs-original-title="Nghe thử" style="color: red; font-size: 13px; font-style: italic; display: flex; justify-content: center; align-items: center; margin-left: 20px;" href="{{$infomation['audio']}}" target="_blank"><i class="material-icons opacity-10">play_circle</i></a>
                                                @else
                                                    <a data-bs-toggle="tooltip" data-bs-placement="top" data-container="body" data-animation="true" data-bs-original-title="Nghe thử" style="color: red; font-size: 13px; font-style: italic; display: flex; justify-content: center; align-items: center; margin-left: 20px;" href="/assets/audio/music.mp3" target="_blank"><i class="material-icons opacity-10">play_circle</i></a>
                                                @endif
                                            </div>

                                        </div>

                                    </div>
                                    <div class="col-lg-6">
                                        <div class="form-group mb-3">
                                            <label>Kết thúc check In</label>
                                            <input type="datetime-local" class="form-control form-control-lg" name="deadline" value="{{$infomation['deadline']}}">
                                        </div>
                                    </div>
                                </div>
                            </div>

                        </div>
                    </div>
                </div>

            </div>

            <div class="row">
                <div class="col-xl-12 col-sm-6 mb-xl-0 mb-4">
                    <div class="card">
                        <div class="card-body p-2 text-center">
                            <button type="submit" class="btn btn-primary mb-0">Cập nhật</button>
                        </div>
                    </div>
                </div>
            </div>
            </form>
            <footer class="footer py-4  ">
                <div class="container-fluid">
                    <div class="row align-items-center justify-content-lg-between">
                        <div class="col-lg-6 mb-lg-0 mb-4">
                            <div class="copyright text-center text-sm text-muted text-lg-start">
                                © <script>
                                    document.write(new Date().getFullYear())
                                </script>2022,
                                made with <i class="fa fa-heart" aria-hidden="true"></i> by
                                <a href="https://www.creative-tim.com" class="font-weight-bold" target="_blank">Creative Tim</a>
                                for a better web.
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <ul class="nav nav-footer justify-content-center justify-content-lg-end">
                                <li class="nav-item">
                                    <a href="https://www.creative-tim.com" class="nav-link text-muted" target="_blank">Creative Tim</a>
                                </li>
                                <li class="nav-item">
                                    <a href="https://www.creative-tim.com/presentation" class="nav-link text-muted" target="_blank">About Us</a>
                                </li>
                                <li class="nav-item">
                                    <a href="https://www.creative-tim.com/blog" class="nav-link text-muted" target="_blank">Blog</a>
                                </li>
                                <li class="nav-item">
                                    <a href="https://www.creative-tim.com/license" class="nav-link pe-0 text-muted" target="_blank">License</a>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
            </footer>
        </div>
        <div class="ps__rail-x" style="left: 0px; bottom: 0px;"><div class="ps__thumb-x" tabindex="0" style="left: 0px; width: 0px;"></div></div><div class="ps__rail-y" style="top: 0px; height: 969px; right: 0px;"><div class="ps__thumb-y" tabindex="0" style="top: 0px; height: 734px;"></div></div></main>
@endsection
