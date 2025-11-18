@extends('admin.layout')
@section('title', 'Locker Room')

@section('content')
    <div class="container-fluid px-4 py-3">
        <h3 class="fw-bold mb-4">Locker Room</h3>

        {{-- Alerts --}}
        @if (session('success'))
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                {{ session('success') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        @endif

        @if ($errors->any())
            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                <ul class="mb-0">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        @endif

        {{-- Description Card --}}
        <div class="card mb-4 p-3">
            <h5>🏠 Description</h5>
            <form action="{{ route('admin.locker.updateDescription') }}" method="POST">
                @csrf
                <textarea name="description" class="form-control" rows="5" required>{{ $description->description ?? '' }}</textarea>
                <div class="mt-2">
                    <button class="btn btn-primary">Save Description</button>
                </div>
            </form>
        </div>

        {{-- Upload Images Card --}}
        <div class="card mb-4 p-3">
            <h5>🖼 Upload Images</h5>
            <form action="{{ route('admin.locker.uploadImages') }}" method="POST" enctype="multipart/form-data">
                @csrf
                <input type="file" name="images[]" multiple class="form-control mb-2" required>
                <button class="btn btn-success">Upload</button>
            </form>
        </div>

        {{-- Display Images --}}
        <div class="row g-3">
            @foreach ($images as $img)
                <div class="col-md-3">
                    <div class="card p-3">
                        {{-- Thumbnail --}}
                        <div style="width:100%;height:180px;overflow:hidden;">
                            <img src="{{ $img->image_path }}" style="width:100%;height:100%;object-fit:cover;"
                                alt="Locker Room Image">
                        </div>

                        {{-- Edit image --}}
                        <form action="{{ route('admin.locker.updateImage', $img->id) }}" method="POST"
                            enctype="multipart/form-data" class="mt-2">
                            @csrf
                            @method('PUT')
                            <input type="file" name="image" class="form-control form-control-sm mb-1" required>
                            <button class="btn btn-warning btn-sm w-100">Update</button>
                        </form>

                        {{-- Delete image --}}
                        <form action="{{ route('admin.locker.deleteImage', $img->id) }}" method="POST" class="mt-1"
                            onsubmit="return confirm('Are you sure you want to delete this image? This action cannot be undone.');">
                            @csrf
                            @method('DELETE')
                            <button class="btn btn-danger btn-sm w-100">Delete</button>
                        </form>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
@endsection
