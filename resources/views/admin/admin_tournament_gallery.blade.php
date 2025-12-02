@extends('admin.layout')
@section('title', 'Tournament Gallery Editor')

@section('content')
    <div class="container-fluid px-4 py-3">
        <h3 class="fw-bold mb-4">Tournament Gallery</h3>

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

        {{-- Create new gallery --}}
        <div class="card mb-4 p-3">
            <h5>Create new gallery</h5>
            <form action="{{ route('admin.tournament_gallery.store') }}" method="POST" enctype="multipart/form-data"
                class="row g-3">
                @csrf
                <div class="col-md-6">
                    <label class="form-label">Title</label>
                    <input name="title" class="form-control" required value="{{ old('title') }}">
                </div>
                <div class="col-md-3">
                    <label class="form-label">Event date</label>
                    <input type="date" name="event_date" class="form-control" required value="{{ old('event_date') }}">
                </div>
                <div class="col-md-3">
                    <label class="form-label">Thumbnail</label>
                    <input type="file" name="thumbnail" class="form-control" required>
                </div>
                <div class="col-12">
                    <button type="submit" class="btn btn-primary"><i class="bi bi-images me-2"></i>Create
                        Gallery</button>
                </div>
            </form>
        </div>

        {{-- Existing galleries --}}
        <div class="row g-3">
            @foreach ($galleries as $g)
                <div class="col-md-6">
                    <div class="card p-3">
                        <div class="d-flex justify-content-between align-items-start">
                            <div>
                                <h5>{{ $g->title }}</h5>
                                <small class="text-muted">{{ $g->event_date }}</small>
                            </div>
                            <button type="button" class="btn btn-sm btn-danger delete-gallery-btn"
                                data-url="{{ route('admin.tournament_gallery.destroy', $g->id) }}" data-bs-toggle="modal"
                                data-bs-target="#deleteImageModal">
                                <i class="bi bi-trash"></i> Delete
                            </button>

                        </div>

                        <hr>

                        {{-- Upload images --}}
                        <form action="{{ route('admin.tournament_gallery.images.store', $g->id) }}" method="POST"
                            enctype="multipart/form-data" class="mb-3">
                            @csrf
                            <label class="form-label">Upload images</label>
                            <input type="file" name="images[]" multiple class="form-control mb-2" required>
                            <div class="d-flex gap-2">
                                <button type="submit" class="btn btn-success btn-sm"><i
                                        class="bi bi-file-earmark-arrow-up me-2"></i>Upload</button>
                                {{-- <a class="btn btn-secondary btn-sm" href="{{ url('event/gallery?gallery=' . $g->slug) }}"
                                    target="_blank">Open Gallery</a> --}}
                            </div>
                        </form>
                        <hr>

                        {{-- Display thumbnails --}}
                        <div class="d-flex flex-wrap gap-2">
                            @foreach ($g->images()->limit(6)->get() as $img)
                                <div class="text-center border rounded p-1" style="width:140px;">
                                    <img src="{{ $img->path }}" style="width:100%;height:100px;object-fit:cover"
                                        alt="">

                                    {{-- Delete button --}}
                                    <button type="button" class="btn btn-danger btn-sm w-100 delete-image-btn"
                                        data-url="{{ route('admin.tournament_gallery.images.destroy', $img->id) }}"
                                        data-bs-toggle="modal" data-bs-target="#deleteImageModal">
                                        <i class="bi bi-trash"></i> Delete
                                    </button>

                                    {{-- Edit button (modal trigger) --}}
                                    <button type="button" class="btn btn-warning btn-sm w-100 mt-1" data-bs-toggle="modal"
                                        data-bs-target="#editImageModal{{ $img->id }}">
                                        <i class="bi bi-arrow-repeat"></i> Update
                                    </button>
                                </div>

                                {{-- Edit Modal --}}
                                <div class="modal fade" id="editImageModal{{ $img->id }}" tabindex="-1"
                                    aria-hidden="true">
                                    <div class="modal-dialog modal-dialog-centered">
                                        <div class="modal-content">
                                            <form action="{{ route('admin.tournament_gallery.images.update', $img->id) }}"
                                                method="POST" enctype="multipart/form-data">
                                                @csrf
                                                @method('PUT')
                                                <div class="modal-header bg-primary text-white">
                                                    <h5 class="modal-title">Update Image</h5>
                                                    <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                        aria-label="Close"></button>
                                                </div>
                                                <div class="modal-body">
                                                    <img src="{{ $img->path }}" class="img-fluid mb-3 rounded"
                                                        alt="">
                                                    <div class="mb-3">
                                                        <label class="form-label">Change Image</label>
                                                        <input type="file" name="image" class="form-control"
                                                            accept="image/*">
                                                    </div>
                                                </div>
                                                <div class="modal-footer">
                                                    <button type="submit" class="btn btn-success">Save Changes</button>
                                                </div>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                                {{-- Delete Image Modal --}}
                                <div class="modal fade" id="deleteImageModal" tabindex="-1" aria-hidden="true">
                                    <div class="modal-dialog modal-md">
                                        <div class="modal-content">
                                            <form id="deleteImageForm" method="POST">
                                                @csrf
                                                @method('DELETE')
                                                <div class="modal-header bg-danger text-white">
                                                    <h5 class="modal-title">Confirm Delete</h5>
                                                    <button type="button" class="btn-close btn-close-white"
                                                        data-bs-dismiss="modal"></button>
                                                </div>
                                                <div class="modal-body">
                                                    Are you sure you want to delete this image?
                                                </div>
                                                <div class="modal-footer">

                                                    <button type="submit" class="btn btn-danger">Delete</button>
                                                </div>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    </div>
                </div>
                <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
            @endforeach
        </div>
    </div>
    <!-- Success Modal -->
    <div class="modal fade" id="successModal" tabindex="-1">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header btn-success text-white">
                    <h5 class="modal-title">Success</h5>
                </div>
                <div class="modal-body text-black">
                    {{ session('modal_message') }}
                </div>
                <div class="modal-footer">
                    <button class="btn btn-primary" data-bs-dismiss="modal">OK</button>
                </div>
            </div>
        </div>
    </div>

    <script>
        // Delete Image Modal Script
        document.addEventListener('DOMContentLoaded', () => {
            const deleteForm = document.getElementById('deleteImageForm');

            // Handle all delete buttons (images or galleries)
            document.querySelectorAll('.delete-image-btn, .delete-gallery-btn').forEach(btn => {
                btn.addEventListener('click', () => {
                    const url = btn.getAttribute('data-url');
                    deleteForm.setAttribute('action', url);

                    // Optional: Update modal text dynamically
                    const modalBody = deleteForm.querySelector('.modal-body');
                    if (btn.classList.contains('delete-gallery-btn')) {
                        modalBody.textContent =
                            'Are you sure you want to delete this entire gallery?';
                    } else {
                        modalBody.textContent = 'Are you sure you want to delete this image?';
                    }
                });
            });
        });

        document.addEventListener('DOMContentLoaded', () => {
            @if (session('success'))
                const modalEl = document.getElementById('successModal');
                const modalBody = modalEl.querySelector('.modal-body');
                modalBody.textContent = "{{ session('success') }}";
                modalBody.style.color = 'green'; // optional: color

                const modal = new bootstrap.Modal(modalEl);
                modal.show();

                // Auto-close after 1.5s
                setTimeout(() => modal.hide(), 3000);
            @endif
        });
    </script>
@endsection
