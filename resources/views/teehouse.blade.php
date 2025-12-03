@extends('layouts.app')

@section('title', 'Facilities - Teehouse')

@push('styles')
    <link href="{{ asset('css/teehouse.css') }}" rel="stylesheet">
    <link href="{{ asset('images/RivieraHeaderLogo3.png') }}" rel="icon">
@endpush

@section('content')
    <div class="container-fluid custom-bg d-flex align-items-center p-0">
        <h1 class="text-white custom-title m-0">FACILITIES</h1>
    </div>

    <div class="div1">
        <div class="container-fluid px-0">

            <div class="div1-header d-flex align-items-center justify-content-center mb-4">
                <div class="header-line"></div>
                <h2 class="mx-3">TEEHOUSE</h2>
                <div class="header-line"></div>
            </div>

            <div class="row gx-2">
                {{-- Langer Front 9 --}}
                <div class="col-12 col-sm-6">
                    <div class="row gx-0">
                        <div class="col-12">
                            <div class="box white" style="padding:20px;">
                                <h4 style="color: #107039; font-weight: bold;">LANGER FRONT 9</h4>
                                <hr class="dotted-line">
                                <span style="font-weight: 500;">LF9</span>
                            </div>
                        </div>
                        @foreach ($lf9 as $img)
                            <div class="col-12 col-sm-6">
                                <div class="box">
                                    <img src="{{ asset('storage/' . $img) }}" alt="LF9">
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>

                {{-- Halfway Langer --}}
                <div class="col-12 col-sm-6">
                    <div class="row gx-0">
                        <div class="col-12">
                            <div class="box white" style="padding:20px;">
                                <h4 style="color: #107039; font-weight: bold;">HALFWAY LANGER</h4>
                                <hr class="dotted-line">
                                <span style="font-weight: 500;">HWL</span>
                            </div>
                        </div>
                        @foreach ($hwl as $img)
                            <div class="col-12 col-sm-6">
                                <div class="box">
                                    <img src="{{ asset('storage/' . $img) }}" alt="HWL">
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>

            <br>

            <div class="row gx-2">
                {{-- Couples Front 9 --}}
                <div class="col-12 col-sm-6">
                    <div class="row gx-0">
                        <div class="col-12">
                            <div class="box white" style="padding:20px;">
                                <h4 style="color: #107039; font-weight: bold;">COUPLES FRONT 9</h4>
                                <hr class="dotted-line">
                                <span style="font-weight: 500;">CF9</span>
                            </div>
                        </div>
                        @foreach ($cf9 as $img)
                            <div class="col-12 col-sm-6">
                                <div class="box">
                                    <img src="{{ asset('storage/' . $img) }}" alt="CF9">
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>

                {{-- Halfway Couples --}}
                <div class="col-12 col-sm-6">
                    <div class="row gx-0">
                        <div class="col-12">
                            <div class="box white" style="padding:20px;">
                                <h4 style="color: #107039; font-weight: bold;">HALFWAY COUPLES</h4>
                                <hr class="dotted-line">
                                <span style="font-weight: 500;">HWC</span>
                            </div>
                        </div>
                        @foreach ($hwc as $img)
                            <div class="col-12 col-sm-6">
                                <div class="box">
                                    <img src="{{ asset('storage/' . $img) }}" alt="HWC">
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>

        </div>
    </div>
@endsection
