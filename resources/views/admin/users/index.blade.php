@extends('admin.layouts.app')
@section('title', 'Danh sách phòng ban')
@section('content')
    <main class="main-content position-relative max-height-vh-100 h-100 border-radius-lg ps ps--active-y">
        <nav class="navbar navbar-main navbar-expand-lg px-0 mx-4 shadow-none border-radius-xl" id="navbarBlur" data-scroll="true">
            <div class="container-fluid py-1 px-3">
                <nav aria-label="breadcrumb">
                    <h6 class="font-weight-bolder mb-0">Danh sách người dùng</h6>
                </nav>
            </div>
        </nav>
        <div class="container py-1">
            <div class="row mb-4">
                <div class="col-lg-12 col-md-12 mb-md-0 mb-4">
                    <div class="card">
                        <div class="card-header p-3 pb-0">
                            <h6 class="mb-0">Tìm kiếm</h6>
                        </div>
                        <hr class="dark horizontal my-0">
                        <div class="card-body p-3 pb-0 pt-1">
                            <form action="{{route('users.index')}}">
                                <div class="form-group row mb-4">
                                    <div class="col-lg-3">
                                        <div class="form-group mb-3">
                                            <label>Từ khóa</label>
                                            <input type="text" class="form-control" name="name" value="{{Request::get('name')}}" placeholder="Nhập tên, số điện thoại, mã dự thưởng,...">
                                        </div>
                                    </div>
                                    <div class="col-lg-3">
                                        <div class="form-group mb-3">
                                            <label>Ẩn/Hiển thị</label>
                                            <select name="status" id="" class="form-control">
                                                <option value="">Tất cả</option>
                                                <option
                                                    {{(isset($request->status) && $request->status == 1)  ? 'selected' : ''}} value="1">
                                                    Hiển thị
                                                </option>
                                                <option
                                                    {{(isset($request->status) && $request->status == 0)  ? 'selected' : ''}}  value="0">
                                                    Ẩn
                                                </option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-lg-3" style="display: flex; align-items: end">
                                        <div class="form-group">
                                            <button type="submit" class="btn btn-primary btn-sm">Tìm kiếm</button>
                                            <a href="{{route('users.index')}}" class="btn btn-danger btn-sm">Làm mới</a>
                                        </div>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
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
                            <h6 class="mb-0">Danh sách
                            </h6>
                        </div>
                        <hr class="dark horizontal my-0">
                        <div class="card-body p-1 pb-2">
                            <div class="table-responsive">
                                <table class="table align-items-center mb-0">
                                    <thead>
                                    <tr>
                                        <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">STT</th>
                                        <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Họ và tên</th>
                                        <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 text-center">Địa chỉ Email</th>
                                        <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 text-center">Thời gian sử dụng</th>
                                        <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 text-center">Thời gian đăng ký</th>
                                        <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2 text-center">Trạng thái</th>
                                        <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2 text-center">Admin</th>
                                        <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2 text-center">Mật khẩu mới</th>
                                        <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Hành động</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    @foreach($users  as $item)
                                    <tr>
                                        <td  class="align-middle text-center text-sm">{{$loop->iteration}}</td>
                                        <td>
                                            <div class="d-flex px-2 py-1">
                                                <div class="d-flex flex-column justify-content-center">
                                                    <h6 class="mb-0 text-sm">{{$item['name']}}</h6>
                                                </div>
                                            </div>
                                        </td>
                                        <td class="align-middle text-center text-sm">
                                            <div class="text-center">
                                            {{$item->email}}
                                        </div>
                                        </td>
                                        <td class="align-middle text-center text-sm">
                                            @if($item->time_use))
                                            <div class="text-center">
                                                {{date('H:i d-m-Y', strtotime($item->time_use))}}
                                            </div>
                                            @endif
                                        </td>

                                        <td class="align-middle text-center text-sm">
                                            <div class="text-center">
                                                {{date('H:i d-m-Y', strtotime($item->created_at))}}
                                            </div>
                                        </td>
                                        <td class="align-middle text-center text-sm">
                                            <div class="form-check form-switch" style="display: inline-block">
                                                <input class="form-check-input" name="my-checkbox" type="checkbox" data-id="{{$item['id']}}"
                                                       data-api="{{route('enable-column')}}" data-table="users"
                                                       data-column="status"  {{ $item['status'] ? 'checked="checked"' : '' }}>
                                            </div>
                                        </td>
                                        <td class="align-middle text-center text-sm">
                                            <div class="form-check form-switch" style="display: inline-block">
                                                <input class="form-check-input" name="my-checkbox" type="checkbox" data-id="{{$item['id']}}"
                                                       data-api="{{route('enable-column')}}" data-table="users"
                                                       data-column="is_admin"  {{ $item['is_admin'] ? 'checked="checked"' : '' }}>
                                            </div>
                                        </td>
                                        <td class="align-middle text-center text-sm">
                                           {{$item['password_reset']}}
                                        </td>
                                        <td class="align-middle text-center text-sm">
                                            <form class="d-inline-block" action="{{ route('attendances.destroy', $item) }}" method="POST" >
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn btn-primary btn-sm mb-0" onclick="return confirm('Bạn có muốn xóa không?')"> Xóa</button>
                                            </form>
                                            <form class="d-inline-block" action="{{route('user.reset-pass', $item)}}" method="POST" >
                                                @csrf
                                                <button type="submit" class="btn btn-primary btn-sm mb-0" onclick="return confirm('Bạn có muốn reset lại mật khẩu không?')">
                                                    Reset MK</button>
                                            </form>
                                        </td>
                                    </tr>
                                    @endforeach
                                    </tbody>
                                </table>
                            </div>
                            <hr class="dark horizontal my-0">
                            @if(!count($users))
                                @include('admin.components.data-empty')
                            @endif
                            <div class="text-center m-3 d-flex">
                                <div style="font-size: 12px">
                                    Tổng: {{ $users->total() }} bản ghi
                                </div>
                                <div class="float-end" style="margin-left: auto">
                                    {{ $users    ->links() }}
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </main>
@endsection
