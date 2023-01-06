@extends('layouts.app')
@section('title', 'Điểm danh')
@section('content')
    <div class="container my-auto">
        <div class="row">
            <div class="col-lg-4 col-md-8 col-12 mx-auto">
                <div class="card z-index-0 fadeIn3 fadeInBottom">
                    @include('components.header', ['title' => 'Check In', 'about' => \App\Models\Information::find(1)])
                    <div class="card-body attendance text-center">
                        <h5>Thời gian check In đã kết thúc</h5>
                        <p>Xin cảm ơn!</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
