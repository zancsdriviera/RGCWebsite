@extends('admin.layout')
@section('title', 'Clubhouse')

@section('content')
    <div class="container-fluid px-4 py-3">
        <h3 class="fw-bold mb-4">Golf Clubhouse</h3>

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
        <div class="card mb-4 p-3 dark-bg">
            <h5>🏠 Description</h5>
            <form action="{{ route('admin.clubhouse.updateDescription') }}" method="POST">
                @csrf
                <textarea name="description" class="form-control" rows="5" required>{{ $description->description ?? '' }}</textarea>
                <div class="mt-2">
                    <button class="btn btn-primary"><i class="bi bi-check-square me-2"></i>Save Description</button>
                </div>
            </form>
        </div>

        {{-- Upload Images Card --}}
        <div class="card mb-4 p-3">
            <h5>🖼 Upload Images</h5>
            <form action="{{ route('admin.clubhouse.uploadImages') }}" method="POST" enctype="multipart/form-data">
                @csrf
                <input type="file" name="images[]" multiple class="form-control mb-2" required>
                <button class="btn btn-success"><i class="bi bi-file-earmark-arrow-up me-2"></i>Upload</button>
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
                                alt="Clubhouse Image">
                        </div>

                        {{-- Edit Button (opens modal) --}}
                        <button class="btn btn-warning btn-sm w-100 mt-2" data-bs-toggle="modal"
                            data-bs-target="#editModal{{ $img->id }}">
                            <i class="bi bi-arrow-repeat"></i> Update
                        </button>

                        {{-- Delete Button (opens modal) --}}
                        <button class="btn btn-danger btn-sm w-100 mt-1" data-bs-toggle="modal"
                            data-bs-target="#deleteModal{{ $img->id }}">
                            <i class="bi bi-trash"></i> Delete
                        </button>
                    </div>
                </div>

                {{-- Edit Modal --}}
                <div class="modal fade" id="editModal{{ $img->id }}" tabindex="-1"
                    aria-labelledby="editModalLabel{{ $img->id }}" aria-hidden="true">
                    <div class="modal-dialog">
                        <form action="{{ route('admin.clubhouse.updateImage', $img->id) }}" method="POST"
                            enctype="multipart/form-data" class="modal-content">
                            @csrf
                            @method('PUT')
                            <div class="modal-header bg-primary text-white">
                                <h5 class="modal-title" id="editModalLabel{{ $img->id }}">Update Image</h5>
                            </div>
                            <div class="modal-body">
                                <input type="file" name="image" class="form-control" required>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                                <button type="submit" class="btn btn-warning">Update</button>
                            </div>
                        </form>
                    </div>
                </div>

                {{-- Delete Modal --}}
                <div class="modal fade" id="deleteModal{{ $img->id }}" tabindex="-1"
                    aria-labelledby="deleteModalLabel{{ $img->id }}" aria-hidden="true">
                    <div class="modal-dialog">
                        <form action="{{ route('admin.clubhouse.deleteImage', $img->id) }}" method="POST"
                            class="modal-content">
                            @csrf
                            @method('DELETE')
                            <div class="modal-header bg-danger text-white">
                                <h5 class="modal-title" id="deleteModalLabel{{ $img->id }}">Delete Image
                                </h5>
                            </div>
                            <div class="modal-body">
                                Are you sure you want to delete this image? This action cannot be undone.
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                                <button type="submit" class="btn btn-danger">Delete</button>
                            </div>
                        </form>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
@endsection
