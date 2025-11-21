@extends('admin.layout')
@section('title', 'Careers')

@section('content')
    <div class="container-fluid px-4 py-3">
        <h3 class="fw-bold mb-4">Careers</h3>

        @if (session('success'))
            <div class="alert alert-success">{{ session('success') }}</div>
        @endif

        <!-- Add Career Image -->
        <form action="{{ route('admin.careers.store') }}" method="POST" enctype="multipart/form-data" class="card p-4 mb-4">
            @csrf
            <h5>Add New Job Opening</h5>
            <div class="mb-3">
                <label class="form-label">Upload Image</label>
                <input type="file" name="career_image" class="form-control" accept="image/*" required>
            </div>
            <div class="text-end">
                <button type="submit" class="btn btn-primary mt-3"><i class="bi bi-bookmark-plus me-2"></i>Post Job
                    Opening</button>
            </div>

        </form>

        <!-- Display Uploaded Images -->
        <div class="row g-4">
            @forelse ($careers as $career)
                <div class="col-md-3">
                    <div class="card shadow-sm">
                        <img src="{{ asset('storage/' . $career->career_image) }}" class="card-img-top" alt="Career Image">
                        <div class="card-body text-center">
                            <!-- Edit Form -->
                            <form action="{{ route('admin.careers.update', $career->id) }}" method="POST"
                                enctype="multipart/form-data" class="mb-2">
                                @csrf
                                @method('PUT')
                                <input type="file" name="career_image" class="form-control mb-2" accept="image/*"
                                    required>
                                <button class="btn btn-warning w-100"><i class="bi bi-arrow-repeat"></i> Update</button>
                            </form>

                            <!-- Delete Form -->
                            <form action="{{ route('admin.careers.destroy', $career->id) }}" method="POST"
                                onsubmit="return confirm('Delete this job post?');">
                                @csrf
                                @method('DELETE')
                                <button class="btn btn-danger w-100"><i class="bi bi-trash"></i> Delete</button>
                            </form>
                        </div>
                    </div>
                </div>
            @empty
                <p class="text-muted">No career images uploaded yet.</p>
            @endforelse
        </div>
    </div>
@endsection
