@extends('admin.layout')
@section('title', 'Teehouse Editor')

@section('content')
    <div class="container-fluid px-4 py-3">
        <h3 class="fw-bold mb-4">Teehouse</h3>

        @if (session('success'))
            <div class="alert alert-success">{{ session('success') }}</div>
        @endif
        @if (session('error'))
            <div class="alert alert-danger">{{ session('error') }}</div>
        @endif

        @php
            $content = $content ?? null;
            $lf9 = $content->lf9_images ?? [];
            $hwl = $content->hwl_images ?? [];
            $cf9 = $content->cf9_images ?? [];
            $hwc = $content->hwc_images ?? [];
        @endphp

        @php
            $groups = [
                'lf9' => ['label' => 'Langer Front 9', 'images' => $lf9],
                'hwl' => ['label' => 'Halfway Langer', 'images' => $hwl],
                'cf9' => ['label' => 'Couples Front 9', 'images' => $cf9],
                'hwc' => ['label' => 'Halfway Couples', 'images' => $hwc],
            ];
        @endphp

        <div class="row">
            @foreach ($groups as $key => $g)
                <div class="col-md-6 mb-4">
                    <div class="card h-100">
                        <div class="card-header" style="font-weight: bold; font-size:1.2em">{{ $g['label'] }}</div>
                        <div class="card-body">
                            {{-- Upload form --}}
                            <form action="{{ route('admin.teehouse.upload_images', $key) }}" method="POST"
                                enctype="multipart/form-data">
                                @csrf
                                <label>Upload images (multiple allowed)</label>
                                <input type="file" name="images[]" multiple class="form-control mb-2">
                                <button class="btn btn-primary btn-sm">Upload</button>
                            </form>

                            <hr>

                            {{-- Thumbnails --}}
                            <div class="d-flex flex-wrap gap-2">
                                @foreach ($g['images'] as $i => $img)
                                    <div style="width:140px; text-align:center;">
                                        {{-- Fixed image size --}}
                                        <div
                                            style="width:140px; height:140px; overflow:hidden; border-radius:6px; margin-bottom:6px;">
                                            <img src="{{ asset('storage/' . $img) }}" class="img-fluid"
                                                style="width:100%; height:100%; object-fit:cover;">
                                        </div>

                                        {{-- Buttons --}}
                                        <div class="d-flex flex-column gap-1">
                                            <button class="btn btn-warning btn-sm w-100 mt-2" data-bs-toggle="modal"
                                                data-bs-target="#updateModal{{ $key }}{{ $i }}"><i
                                                    class="bi bi-arrow-repeat"></i>
                                                Update
                                            </button>

                                            <form action="{{ route('admin.teehouse.remove_image', [$key, $i]) }}"
                                                method="POST" onsubmit="return confirm('Remove image?')">
                                                @csrf
                                                <button class="btn btn-danger btn-sm w-100 mt-1"><i
                                                        class="bi bi-trash me-1"></i>Delete</button>
                                            </form>
                                        </div>
                                    </div>

                                    {{-- Update Modal --}}
                                    <div class="modal fade" id="updateModal{{ $key }}{{ $i }}"
                                        tabindex="-1">
                                        <div class="modal-dialog modal-dialog-centered">
                                            <div class="modal-content">
                                                <form action="{{ route('admin.teehouse.replace_image', [$key, $i]) }}"
                                                    method="POST" enctype="multipart/form-data">
                                                    @csrf
                                                    <div class="modal-header">
                                                        <h5 class="modal-title">Update image</h5>
                                                        <button class="btn-close" data-bs-dismiss="modal"></button>
                                                    </div>
                                                    <div class="modal-body">
                                                        <img src="{{ asset('storage/' . $img) }}" class="img-fluid mb-2"
                                                            style="width:100%; object-fit:cover;">
                                                        <input type="file" name="image" required class="form-control">
                                                    </div>
                                                    <div class="modal-footer">
                                                        <button class="btn btn-success">Save</button>
                                                    </div>
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                @endforeach
                            </div>

                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
@endsection
