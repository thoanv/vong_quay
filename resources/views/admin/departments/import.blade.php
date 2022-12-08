@extends('admin.layouts.app')
@section('title', 'Import Excel dữ liệu phòng ban')
@section('content')
    <main class="main-content position-relative max-height-vh-100 h-100 border-radius-lg ps ps--active-y">
        <nav class="navbar navbar-main navbar-expand-lg px-0 mx-4 shadow-none border-radius-xl" id="navbarBlur" data-scroll="true">
            <div class="container-fluid py-1 px-3">
                <nav aria-label="breadcrumb">
                    <h6 class="font-weight-bolder mb-0">Import Excel dữ liệu phòng ban</h6>
                </nav>
            </div>
        </nav>
        <div class="container py-1">
            @if (session('success'))
                <div class="row notification-submit">
                    <div class="col-lg-12">
                        <div class="alert alert-success  text-white " role="alert">
                            <strong>Thao tác !</strong> {{ session('success') }}!
                        </div>
                    </div>
                </div>
            @endif
            <div class="row mb-4">
                <div class="col-lg-12 col-md-12 mb-md-0 mb-4">
                    <div class="card">
                        <div class="card-header p-3 pb-0">
                            <h6 class="mb-0">Thông tin</h6>
                        </div>
                        <hr class="dark horizontal my-0">
                        <div class="card-body p-1 pb-2">
                            <form class="theme-form" method="POST" action="{{route('import-departments')}}" enctype="multipart/form-data">
                                @csrf
                                <div class="px-3 py-2">
                                    <div class="form-group row">
                                        <div class="col-lg-12 mb-1">
                                            <div class="form-group mb-3">
                                                <label>File excel</label>
                                                <input type="file" class="form-control form-control-lg" name="file" placeholder="Vui lòng chọn file cần Import..." value="">
                                                @if ($errors->has('file'))
                                                    <div class="mt-1 notification-error">
                                                        {{$errors->first('file')}}
                                                    </div>
                                                @endif
                                            </div>
                                            <a class="d-flex" href="/assets/excel/file mẫu import dữ liệu phòng ban.xlsx" style="font-size: 14px">
                                                <div class="text-center d-flex align-items-center justify-content-center">
                                                    <i class="material-icons">download</i>
                                                </div>
                                                <span class="nav-link-text">Tải File mẫu</span>
                                            </a>
                                        </div>

                                        <hr class="dark horizontal">
                                        <div class="col-lg-12 text-center">
                                            <button type="submit" class="btn btn-primary btn-sm">Lưu</button>
                                            <a href="{{route('departments.index')}}" class="btn btn-danger btn-sm">Trở lại</a>
                                        </div>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </main>
@endsection
