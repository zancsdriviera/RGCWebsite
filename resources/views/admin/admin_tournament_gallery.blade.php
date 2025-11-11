@extends('admin.layout')
@section('title', 'Tournament Gallery Editor')

@section('content')
    <div class="container-fluid">
        <h2 class="mb-4">Tournament Galleries</h2>

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
                    <button type="submit" class="btn btn-primary">Create Gallery</button>
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
                            <form method="POST" action="{{ route('admin.tournament_gallery.destroy', $g->id) }}"
                                onsubmit="return confirm('Delete this entire gallery?')">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-sm btn-danger">Delete</button>
                            </form>
                        </div>

                        <hr>

                        {{-- Upload images --}}
                        <form action="{{ route('admin.tournament_gallery.images.store', $g->id) }}" method="POST"
                            enctype="multipart/form-data" class="mb-3">
                            @csrf
                            <label class="form-label">Upload images</label>
                            <input type="file" name="images[]" multiple class="form-control mb-2" required>
                            <div class="d-flex gap-2">
                                <button type="submit" class="btn btn-success btn-sm">Upload</button>
                                {{-- <a class="btn btn-secondary btn-sm" href="{{ url('event/gallery?gallery=' . $g->slug) }}"
                                    target="_blank">Open Gallery</a> --}}
                            </div>
                        </form>
                        <hr>

                        {{-- Display thumbnails --}}
                        <div class="d-flex flex-wrap gap-2">
                            @foreach ($g->images()->limit(6)->get() as $img)
                                <div class="text-center border rounded p-1" style="width:100px;">
                                    <img src="{{ $img->path }}" style="width:100%;height:80px;object-fit:cover"
                                        alt="">

                                    {{-- Delete button --}}
                                    <form action="{{ route('admin.tournament_gallery.images.destroy', $img->id) }}"
                                        method="POST" class="mt-1"
                                        onsubmit="return confirm('Are you sure you want to delete this image?');">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-danger btn-sm w-100">Delete</button>
                                    </form>


                                    {{-- Edit button (modal trigger) --}}
                                    <button type="button" class="btn btn-warning btn-sm w-100 mt-1" data-bs-toggle="modal"
                                        data-bs-target="#editImageModal{{ $img->id }}">
                                        Edit
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
                                                <div class="modal-header">
                                                    <h5 class="modal-title">Edit Image</h5>
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
                                                    <button type="button" class="btn btn-secondary"
                                                        data-bs-dismiss="modal">Cancel</button>
                                                    <button type="submit" class="btn btn-success">Save Changes</button>
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
@endsection
