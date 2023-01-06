@extends('layouts.app')
@section('title', 'QR Code')
@section('content')
    <style>
        .border-qr svg {
            width: 100% !important;
            height: auto !important;
        }
    </style>

    <div class="container my-auto">
        <div class="row">
            <div class="col-lg-4 col-md-8 col-12 mx-auto">
                <div class="card z-index-0 fadeIn3 fadeInBottom">
                    @include('components.header', ['title' => 'QR Code', 'about' => \App\Models\Information::find(1)])
                    <div class="card-body">
                        <div class="border-qr">
                            @php
                                echo QrCode::size(500)->format('svg')->color(0,0,0)->generate(route('attendance'));
                            @endphp
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection
