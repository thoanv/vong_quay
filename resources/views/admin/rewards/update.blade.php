@extends('admin.layouts.app')
@section('title', 'Cập nhật thông tin phòng ban')
@section('content')
    <main class="main-content position-relative max-height-vh-100 h-100 border-radius-lg ps ps--active-y">
        <nav class="navbar navbar-main navbar-expand-lg px-0 mx-4 shadow-none border-radius-xl" id="navbarBlur" data-scroll="true">
            <div class="container-fluid py-1 px-3">
                <nav aria-label="breadcrumb">
                    <h6 class="font-weight-bolder mb-0">Cập nhật thông tin phòng ban</h6>
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
                        <div class="card-body p-1 pb-2">
                            <form class="theme-form" method="POST" action="{{route('rewards.update', $reward['id'])}}">
                                @csrf
                                @method('PATCH')
                                @include($view.'._form',['reward'=> $reward])
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </main>
@endsection
