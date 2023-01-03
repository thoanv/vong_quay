@extends('admin.layouts.app')
@section('title', 'Danh sách phòng ban')
@push('link_style')

@endpush
@section('content')
    <main class="main-content position-relative max-height-vh-100 h-100 border-radius-lg ps ps--active-y">
        <nav class="navbar navbar-main navbar-expand-lg px-0 mx-4 shadow-none border-radius-xl" id="navbarBlur"
             data-scroll="true">
            <div class="container-fluid py-1 px-3">
                <nav aria-label="breadcrumb">
                    <h6 class="font-weight-bolder mb-0">Cơ cấu giải thưởng</h6>
                </nav>
            </div>
        </nav>
        <div class="container py-1">
            @if($type == 'list')
                <div class="row mb-4">
                    <div class="col-lg-12 col-md-12 mb-md-0 mb-4">
                        <div class="card">
                            <div class="card-header p-3 pb-0">
                                <h6 class="mb-0">Tìm kiếm</h6>
                            </div>
                            <hr class="dark horizontal my-0">
                            <div class="card-body p-3 pb-0 pt-1">
                                <form action="{{route('rewards.index')}}">
                                    <div class="form-group row mb-4">
                                        <div class="col-lg-3">
                                            <div class="form-group mb-3">
                                                <label>Từ khóa</label>
                                                <input type="text" class="form-control" name="name"
                                                       value="{{Request::get('name')}}"
                                                       placeholder="Nhập tên, số điện thoại, mã dự thưởng,...">
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
                                                <a href="{{route('rewards.index')}}" class="btn btn-danger btn-sm">Làm
                                                    mới</a>
                                            </div>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            @endif
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
                    <div class="card p-2">
                        <ul class="nav nav-tabs" id="myTab" role="tablist">
                            <li class="nav-item" role="presentation">
                                <a href="{{route('rewards.type', 'list')}}"
                                   class="nav-link {{$type == 'list' ? 'active' : ''}}" id="home-tab"
                                   aria-selected="true">Danh sách</a>
                            </li>
                            <li class="nav-item" role="presentation">
                                <a href="{{route('rewards.type', 'sort')}}"
                                   class="nav-link {{$type == 'sort' ? 'active' : ''}}" id="profile-tab"
                                   aria-selected="false">Thứ tự</a>
                            </li>

                        </ul>
                        <div class="tab-content" id="myTabContent">
                            <div class="tab-pane fade {{$type == 'list' ? 'show active' : ''}}" id="home"
                                 role="tabpanel" aria-labelledby="home-tab">
                                <div class="card">
                                    <div class="card-header pb-0 pt-2">
                                        <div style="display: flex; justify-content: start; align-items: center;">
                                            <a href="{{route('rewards.list.create')}}" class="btn btn-primary btn-sm me-1">Thêm
                                                mới</a>
                                            <form class="d-inline-block" action="{{route('delete-all-rewards')}}"
                                                  method="POST">
                                                @csrf
                                                <button type="submit" class="btn btn-primary btn-sm"
                                                        onclick="return confirm('Bạn có muốn xóa tất cả không?')"> Xóa
                                                    tất cả
                                                </button>
                                            </form>
                                        </div>
                                    </div>
                                    <hr class="dark horizontal my-0">

                                    <div class="card-body p-1 pb-2">
                                        <div class="table-responsive">
                                            <table class="table align-items-center mb-0">
                                                <thead>
                                                <tr>
                                                    <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                                        STT
                                                    </th>
                                                    <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                                        Tên giải
                                                    </th>
                                                    <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 text-center">
                                                        Giá trị
                                                    </th>
                                                    <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 text-center">
                                                        Người nhận giải
                                                    </th>
                                                    <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 text-center">
                                                        Số điện thoại
                                                    </th>
                                                    <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 text-center">
                                                        Phòng ban làm việc
                                                    </th>
                                                    <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 text-center">
                                                        Thời gian
                                                    </th>
                                                    <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2 text-center">
                                                        Trạng thái
                                                    </th>
                                                    <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                                        Hành động
                                                    </th>
                                                </tr>
                                                </thead>
                                                <tbody>
                                                @foreach($rewards  as $item)
                                                    <tr>
                                                        <td class="align-middle text-center text-sm">{{$loop->iteration}}</td>
                                                        <td>
                                                            <div class="d-flex px-2 py-1">
                                                                <div class="d-flex flex-column justify-content-center">
                                                                    <h6 class="mb-0 text-sm">{{$item['name']}}</h6>
                                                                </div>
                                                            </div>
                                                        </td>
                                                        <td class="align-middle text-center text-sm">
                                                            <div
                                                                class="btn btn-rounded btn-outline-danger mb-0 me-2 btn-sm align-items-center justify-content-center">
                                                                {{$item->value}}
                                                            </div>
                                                        </td>
                                                        @if($item['attendance_id'])
                                                        <td class="align-middle text-center text-sm">
                                                            <div
                                                                class="btn mb-0 me-2 btn-sm align-items-center justify-content-center">
                                                                <h6 class="mb-0" style="font-size: 14px">{{($item->attendance && isset($item->attendance->name)) ? $item->attendance->name : '...'}}</h6>
                                                            </div>
                                                        </td>
                                                        <td class="align-middle text-center text-sm">
                                                            <div class="btn mb-0 me-2 btn-sm align-items-center justify-content-center">
                                                                <p class="mb-0" style="font-size: 14px">{{($item->attendance && isset($item->attendance->phone)) ? $item->attendance->phone : '...'}}</p>
                                                            </div>
                                                        </td>
                                                        <td class="align-middle text-center text-sm">
                                                            <div class="btn mb-0 me-2 btn-sm align-items-center justify-content-center">
                                                                @if(isset($item->attendance->department) && $item->attendance->department)
                                                                    <p class="mb-0" style="font-size: 14px">{{($item->attendance && isset($item->attendance->department)) ? $item->attendance->department->name : '...'}}</p>
                                                                @endif
                                                            </div>
                                                        </td>
                                                        @else
                                                            <td class="align-middle text-center text-sm">...</td>
                                                            <td class="align-middle text-center text-sm">...</td>
                                                            <td class="align-middle text-center text-sm">...</td>
                                                        @endif
                                                        <td class="align-middle text-center text-sm">
                                                            <div class="text-center">
                                                                {{date('H:i d-m-Y', strtotime($item->created_at))}}
                                                            </div>
                                                        </td>
                                                        <td class="align-middle text-center text-sm">
                                                            <div class="form-check form-switch"
                                                                 style="display: inline-block">
                                                                <input class="form-check-input" name="my-checkbox"
                                                                       type="checkbox"
                                                                       data-id="{{$item['id']}}"
                                                                       data-api="{{route('enable-column')}}"
                                                                       data-table="rewards"
                                                                       data-column="status" {{ $item['status'] ? 'checked="checked"' : '' }}>
                                                            </div>
                                                        </td>

                                                        <td class="align-middle text-center text-sm action-css">
                                                            <a class="btn btn-primary btn-sm mb-0" data-bs-toggle="tooltip" data-bs-placement="top" title="Sửa" data-container="body" data-animation="true"
                                                               href="{{ route('rewards.edit', $item) }}">Sửa</a>
                                                            <form class="d-inline-block"
                                                                  action="{{ route('rewards.destroy', $item) }}"
                                                                  method="POST">
                                                                @csrf
                                                                @method('DELETE')
                                                                <button type="submit" data-bs-toggle="tooltip" data-bs-placement="top" title="Xóa" data-container="body" data-animation="true"
                                                                        class="btn btn-primary btn-sm mb-0"
                                                                        onclick="return confirm('Bạn có muốn xóa không?')">
                                                                    Xóa
                                                                </button>
                                                            </form>
                                                            @if($item['attendance_id'])
                                                            <form class="d-inline-block"
                                                                  action="{{ route('rewards.remove', $item) }}"
                                                                  method="POST">
                                                                @csrf
                                                                <button type="submit" data-bs-toggle="tooltip" data-bs-placement="top" title="Gỡ người trúng thưởng" data-container="body" data-animation="true"
                                                                        class="btn btn-primary btn-sm mb-0"
                                                                        onclick="return confirm('Bạn có gỡ người trúng thưởng không?')">
                                                                    Gỡ
                                                                </button>
                                                            </form>
                                                            @endif
                                                        </td>
                                                    </tr>
                                                @endforeach
                                                </tbody>
                                            </table>
                                        </div>
                                        <hr class="dark horizontal my-0">
                                        @if(!count($rewards))
                                            @include('admin.components.data-empty')
                                        @endif
{{--                                        <div class="text-center m-3 d-flex">--}}
{{--                                            <div style="font-size: 12px">--}}
{{--                                                Tổng: {{ $rewards->total() }} bản ghi--}}
{{--                                            </div>--}}
{{--                                            <div class="float-end" style="margin-left: auto">--}}
{{--                                                {{ $rewards->links() }}--}}
{{--                                            </div>--}}
{{--                                        </div>--}}
                                    </div>
                                </div>
                            </div>
                            <div class="tab-pane fade {{$type == 'sort' ? 'show active' : ''}}" id="profile"
                                 role="tabpanel" aria-labelledby="profile-tab">
                                <div class="card">
                                    <div class="card-header pb-0 pt-2">
                                        <div style="display: flex; justify-content: start; align-items: center;">
                                            <button class="btn btn-primary btn-sm me-1 mb-0 save-nestable">Lưu</button>
                                            <a class="btn btn-primary btn-sm mb-0"
                                               href="{{route('rewards.type', 'sort')}}">Tải lại</a>
                                        </div>
                                    </div>
                                    <hr class="dark horizontal my-0">

                                    <div class="card-body p-1 pb-2">
                                        <div class="cf nestable-lists">

                                            <div class="dd" id="nestable" style="max-width: unset">
                                                <ol class="dd-list">
                                                    @foreach($rewards as $reward)
                                                        <li class="dd-item" data-id="{{$reward['id']}}">
                                                            <div class="dd-handle">{{$reward['name']}}</div>
                                                        </li>
                                                    @endforeach
                                                </ol>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </main>
@endsection
@push('scripts')
    <script>
        $(document).ready(function () {

            var updateOutput = function (e) {
                var list = e.length ? e : $(e.target),
                    output = list.data('output');
                if (window.JSON) {
                    output.val(window.JSON.stringify(list.nestable('serialize')));//, null, 2));
                } else {
                    output.val('JSON browser support required for this demo.');
                }
            };

            // activate Nestable for list 1
            $('#nestable').nestable({
                group: 1
            })
                .on('change', updateOutput);
            // output initial serialised data
            updateOutput($('#nestable').data('output', $('#nestable-output')));

            $('.save-nestable').click(function () {
                console.log(123);
                let serialize = $('#nestable').nestable('serialize');
                console.log(serialize)
                $.ajax({
                    url: '{{route('sort-reward')}}',
                    type: 'post',
                    data: {
                        serialize: JSON.stringify(serialize),
                        _token: $('meta[name="csrf-token"]').attr('content')
                    },
                    success: function (res) {
                        if (res.success) {
                            Swal.fire('Cập nhật thành công')
                        }
                    }
                });
            });
        });
    </script>

@endpush
