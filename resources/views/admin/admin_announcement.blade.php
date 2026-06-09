@extends('admin.layout')

@section('content')
    <div class="container-fluid px-4">
        <div class="d-flex justify-content-between align-items-center mb-4">
            <div>
                <h1 class="h3 mb-0">Announcement Manager</h1>
                <p class="text-muted mt-1">Create and manage temporary announcement pages</p>
            </div>
            <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#createModal">
                <i class="bi bi-plus-circle me-1"></i>New Announcement
            </button>
        </div>

        @if (session('success'))
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                <i class="bi bi-check-circle-fill me-2"></i>{{ session('success') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
            </div>
        @endif

        <div class="card mb-4">
            <div class="card-header bg-dark text-white">
                <h5>All Announcements</h5>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-hover">
                        <thead class="table-light">
                            <tr>
                                <th width="50">Order</th>
                                <th>Title</th>
                                <th>Slug</th>
                                <th>Status</th>
                                <th>Published Date</th>
                                <th>Created At</th>
                                <th width="120">Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($announcements as $announcement)
                                <tr>
                                    <td>
                                        <input type="number" class="form-control form-control-sm order-input"
                                            data-id="{{ $announcement->id }}" value="{{ $announcement->order }}"
                                            style="width: 70px;">
                                    </td>
                                    <td>{{ $announcement->title }}</td>
                                    <td><code>{{ $announcement->slug }}</code></td>
                                    <td>
                                        @if ($announcement->is_published)
                                            <span class="badge bg-success">Published</span>
                                        @else
                                            <span class="badge bg-secondary">Draft</span>
                                        @endif
                                    </td>
                                    <td>{{ $announcement->published_date ? $announcement->published_date->format('Y-m-d') : '-' }}
                                    </td>
                                    <td>{{ $announcement->created_at->format('Y-m-d') }}</td>
                                    <td>
                                        <button class="btn btn-sm btn-info edit-btn" data-id="{{ $announcement->id }}"
                                            data-title="{{ $announcement->title }}"
                                            data-content="{{ $announcement->content }}"
                                            data-is_published="{{ $announcement->is_published }}"
                                            data-published_date="{{ $announcement->published_date ? $announcement->published_date->format('Y-m-d') : '' }}"
                                            data-order="{{ $announcement->order }}">
                                            <i class="bi bi-pencil"></i>
                                        </button>
                                        <button class="btn btn-sm btn-danger delete-btn" data-id="{{ $announcement->id }}"
                                            data-title="{{ $announcement->title }}">
                                            <i class="bi bi-trash"></i>
                                        </button>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="7" class="text-center py-4">
                                        <p class="text-muted mb-0">No announcements yet. Click "New Announcement" to create
                                            one.</p>
                                    </td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

    <!-- Create Modal -->
    <div class="modal fade" id="createModal" tabindex="-1">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <form action="{{ route('admin.announcement.store') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="modal-header">
                        <h5 class="modal-title">Create New Announcement</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                    </div>
                    <div class="modal-body">
                        <div class="mb-3">
                            <label class="form-label">Title *</label>
                            <input type="text" name="title" class="form-control" required>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Content</label>
                            <textarea name="content" class="form-control" rows="5"></textarea>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Featured Image</label>
                            <input type="file" name="featured_image" class="form-control"
                                accept="image/jpeg,image/png,jpg">
                        </div>
                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <label class="form-label">Published Date</label>
                                <input type="date" name="published_date" class="form-control">
                            </div>
                            <div class="col-md-6 mb-3">
                                <label class="form-label">Order</label>
                                <input type="number" name="order" class="form-control" value="0">
                            </div>
                        </div>
                        <div class="mb-3">
                            <div class="form-check">
                                <input type="checkbox" name="is_published" class="form-check-input" value="1">
                                <label class="form-check-label">Publish immediately</label>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                        <button type="submit" class="btn btn-primary">Create</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <!-- Edit Modal -->
    <div class="modal fade" id="editModal" tabindex="-1">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <form id="editForm" method="POST" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')
                    <div class="modal-header">
                        <h5 class="modal-title">Edit Announcement</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                    </div>
                    <div class="modal-body">
                        <div class="mb-3">
                            <label class="form-label">Title *</label>
                            <input type="text" name="title" id="edit_title" class="form-control" required>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Content</label>
                            <textarea name="content" id="edit_content" class="form-control" rows="5"></textarea>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Featured Image</label>
                            <input type="file" name="featured_image" class="form-control"
                                accept="image/jpeg,image/png,jpg">
                            <small class="text-muted">Leave empty to keep current image</small>
                        </div>
                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <label class="form-label">Published Date</label>
                                <input type="date" name="published_date" id="edit_published_date"
                                    class="form-control">
                            </div>
                            <div class="col-md-6 mb-3">
                                <label class="form-label">Order</label>
                                <input type="number" name="order" id="edit_order" class="form-control"
                                    value="0">
                            </div>
                        </div>
                        <div class="mb-3">
                            <div class="form-check">
                                <input type="checkbox" name="is_published" id="edit_is_published"
                                    class="form-check-input" value="1">
                                <label class="form-check-label">Published</label>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                        <button type="submit" class="btn btn-primary">Update</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <!-- Delete Modal -->
    <div class="modal fade" id="deleteModal" tabindex="-1">
        <div class="modal-dialog">
            <div class="modal-content">
                <form id="deleteForm" method="POST">
                    @csrf
                    @method('DELETE')
                    <div class="modal-header">
                        <h5 class="modal-title">Delete Announcement</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                    </div>
                    <div class="modal-body">
                        <p>Are you sure you want to delete "<span id="delete_title"></span>"?</p>
                        <p class="text-danger mb-0">This action cannot be undone.</p>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                        <button type="submit" class="btn btn-danger">Delete</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <script>
        document.querySelectorAll('.edit-btn').forEach(btn => {
            btn.addEventListener('click', function() {
                const id = this.dataset.id;
                document.getElementById('edit_title').value = this.dataset.title;
                document.getElementById('edit_content').value = this.dataset.content || '';
                document.getElementById('edit_published_date').value = this.dataset.published_date || '';
                document.getElementById('edit_order').value = this.dataset.order || 0;
                document.getElementById('edit_is_published').checked = this.dataset.is_published === '1';
                document.getElementById('editForm').action = `/admin/announcement/${id}`;
                new bootstrap.Modal(document.getElementById('editModal')).show();
            });
        });

        document.querySelectorAll('.delete-btn').forEach(btn => {
            btn.addEventListener('click', function() {
                const id = this.dataset.id;
                const title = this.dataset.title;
                document.getElementById('delete_title').textContent = title;
                document.getElementById('deleteForm').action = `/admin/announcement/${id}`;
                new bootstrap.Modal(document.getElementById('deleteModal')).show();
            });
        });

        document.querySelectorAll('.order-input').forEach(input => {
            input.addEventListener('change', function() {
                const id = this.dataset.id;
                const order = this.value;
                fetch(`/admin/announcement/${id}/order`, {
                        method: 'PATCH',
                        headers: {
                            'Content-Type': 'application/json',
                            'X-CSRF-TOKEN': '{{ csrf_token() }}'
                        },
                        body: JSON.stringify({
                            order: order
                        })
                    }).then(response => response.json())
                    .then(data => {
                        if (data.success) {
                            location.reload();
                        }
                    });
            });
        });
    </script>
@endsection
