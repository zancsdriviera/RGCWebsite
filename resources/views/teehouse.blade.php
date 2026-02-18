@extends('layouts.app')

@section('title', 'Facilities - Teehouse')

@push('styles')
    <link href="{{ asset('css/Teehouse.css') }}" rel="stylesheet">
@endpush

@section('content')
    <div class="container-fluid custom-bg d-flex align-items-center p-0">
        <h1 class="text-white custom-title m-0">FACILITIES</h1>
    </div>

    <br>
    <div class="container-fluid my-0 hr_container">
        <div class="row justify-content-center text-center gx-2">
            <div class="col-12 col-md-6 col-lg-4 mb-4 d-flex">
                <div class="hr_column w-100">
                    <h2 class="bot-title"> TEEPAVILION </h2>
                </div>
            </div>
        </div>
    </div>

    <div class="div1">
        <div class="container-fluid px-0">
            {{-- TEEPAV Gallery --}}
            @if (count($teepav ?? []) > 0)
                <div class="wrapper">

                    <div class="wrapper_teepav">
                        <div class="gallery">
                            {{-- Big Image --}}
                            <div class="gallery-left big-image">
                                <div class="img-box" onclick="openTeehouseModal(0, 'teepav')">
                                    <img src="{{ asset('storage/' . $teepav[0]) }}" alt="TEEPAV">
                                </div>
                            </div>

                            {{-- Small images on right --}}
                            <div class="gallery-right">
                                @foreach ($teepav as $index => $img)
                                    @if ($index > 0)
                                        <div class="img-box" onclick="openTeehouseModal({{ $index }}, 'teepav')">
                                            <img src="{{ asset('storage/' . $img) }}" alt="TEEPAV">
                                        </div>
                                    @endif
                                @endforeach
                            </div>
                        </div>
                    </div>
                </div>
            @endif

            <div class="container-fluid my-0 hr_container">
                <div class="row justify-content-center text-center gx-2">
                    <div class="col-12 col-md-6 col-lg-4 mb-4 d-flex">
                        <div class="hr_column w-100">
                            <h2 class="bot-title"> TEEHOUSE </h2>
                        </div>
                    </div>
                </div>
            </div>
            <br>
            {{-- LF9 Gallery --}}
            @if (count($lf9) > 0)
                <div class="wrapper">
                    <div class="section-title section-title-left">
                        <h2>LANGER FRONT 9</h2>
                    </div>
                    <div class="wrapper_lf9">

                        <div class="gallery">
                            <div class="gallery-left big-image">
                                <div class="img-box" onclick="openTeehouseModal(0, 'lf9')">
                                    <img src="{{ asset('storage/' . $lf9[0]) }}" alt="LF9">
                                </div>
                            </div>
                            <div class="gallery-right">
                                @foreach ($lf9 as $index => $img)
                                    @if ($index > 0)
                                        <div class="img-box" onclick="openTeehouseModal({{ $index }}, 'lf9')">
                                            <img src="{{ asset('storage/' . $img) }}" alt="LF9">
                                        </div>
                                    @endif
                                @endforeach
                            </div>
                        </div>
                    </div>
                </div>
                <br>
            @endif

            {{-- HWL Gallery --}}
            @if (count($hwl) > 0)
                <div class="wrapper wrapper-green">
                    <div class="section-title section-title-right">
                        <h2>HALF WAY LANGER</h2>
                    </div>

                    <div class="wrapper_hwl">

                        <div class="gallery">

                            <div class="gallery-right">
                                @foreach ($hwl as $index => $img)
                                    @if ($index > 0)
                                        <div class="img-box" onclick="openTeehouseModal({{ $index }}, 'hwl')">
                                            <img src="{{ asset('storage/' . $img) }}" alt="HWL">
                                        </div>
                                    @endif
                                @endforeach
                            </div>

                            <div class="gallery-left big-image">
                                <div class="img-box" onclick="openTeehouseModal(0, 'hwl')">
                                    <img src="{{ asset('storage/' . $hwl[0]) }}" alt="HWL">
                                </div>
                            </div>

                        </div>
                    </div>
                </div>
                <br>
            @endif

            {{-- CF9 Gallery --}}
            @if (count($cf9) > 0)
                <div class="wrapper">
                    <div class="section-title section-title-left">
                        <h2>COUPLES FRONT 9</h2>
                    </div>
                    <div class="wrapper_cf9">
                        <div class="gallery">
                            <div class="gallery-left big-image">
                                <div class="img-box" onclick="openTeehouseModal(0, 'cf9')">
                                    <img src="{{ asset('storage/' . $cf9[0]) }}" alt="CF9">
                                </div>
                            </div>
                            <div class="gallery-right">
                                @foreach ($cf9 as $index => $img)
                                    @if ($index > 0)
                                        <div class="img-box" onclick="openTeehouseModal({{ $index }}, 'cf9')">
                                            <img src="{{ asset('storage/' . $img) }}" alt="CF9">
                                        </div>
                                    @endif
                                @endforeach
                            </div>
                        </div>
                    </div>
                </div>
                <br>
            @endif

            {{-- HWC Gallery --}}
            @if (count($hwc) > 0)
                <div class="wrapper wrapper-green">
                    <div class="section-title section-title-right">
                        <h2>HALF WAY COUPLES</h2>
                    </div>

                    <div class="wrapper_hwc">

                        <div class="gallery">

                            <div class="gallery-right">
                                @foreach ($hwc as $index => $img)
                                    @if ($index > 0)
                                        <div class="img-box" onclick="openTeehouseModal({{ $index }}, 'hwc')">
                                            <img src="{{ asset('storage/' . $img) }}" alt="HWC">
                                        </div>
                                    @endif
                                @endforeach
                            </div>

                            <div class="gallery-left big-image">
                                <div class="img-box" onclick="openTeehouseModal(0, 'hwc')">
                                    <img src="{{ asset('storage/' . $hwc[0]) }}" alt="HWC">
                                </div>
                            </div>

                        </div>
                    </div>
                </div>
                <br>
            @endif

        </div>
    </div>

    {{-- Modal --}}
    <div class="modal fade" id="teehouseModal" tabindex="-1">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content border-0 bg-transparent p-0">
                <div class="modal-body d-flex flex-column align-items-center p-0">
                    <div class="position-relative modal-img-wrapper">
                        <button type="button" class="modal-btn-close" data-bs-dismiss="modal">&times;</button>
                        <img id="teehouseModalImage" src="" alt="Teehouse" class="modal-img">
                        <button class="modal-btn modal-btn-prev" onclick="prevTeehouseImage()">&lt;</button>
                        <button class="modal-btn modal-btn-next" onclick="nextTeehouseImage()">&gt;</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('scripts')
    <script>
        let teehouseImages = {
            teepav: @json($teepav ?? []),
            lf9: @json($lf9 ?? []),
            hwl: @json($hwl ?? []),
            cf9: @json($cf9 ?? []),
            hwc: @json($hwc ?? [])
        };

        let currentGallery = '';
        let currentIndex = 0;

        function openTeehouseModal(index, galleryKey) {
            currentGallery = galleryKey;
            currentIndex = index;
            updateTeehouseImage();
            const modal = new bootstrap.Modal(document.getElementById('teehouseModal'));
            modal.show();
        }

        function updateTeehouseImage() {
            const images = teehouseImages[currentGallery];
            if (!images || images.length === 0) return;
            document.getElementById('teehouseModalImage').src =
                "{{ asset('storage') }}/" + images[currentIndex];
        }

        function prevTeehouseImage() {
            const images = teehouseImages[currentGallery];
            currentIndex = (currentIndex - 1 + images.length) % images.length;
            updateTeehouseImage();
        }

        function nextTeehouseImage() {
            const images = teehouseImages[currentGallery];
            currentIndex = (currentIndex + 1) % images.length;
            updateTeehouseImage();
        }
    </script>
@endpush
