@extends('admin.layout')
@section('title', 'About Us')

@section('content')
    <style>
        .file-size-info {
            font-size: 12px;
            color: #6c757d;
            margin-top: 4px;
        }

        body.dark-mode .modal-body {
            color: #212529 !important;
            background-color: #ffffff;
        }

        body.dark-mode .modal-footer {
            background-color: #ffffff;
        }

        body.dark-mode .modal-content .bg-danger.text-white {
            color: #ffffff !important;
        }

        body.dark-mode .modal-content .btn-secondary {
            background-color: #6c757d;
            color: #ffffff;
        }
    </style>

    <div class="container-fluid px-4 py-3">
        <h3 class="fw-bold mb-4">About Us</h3>

        @if (session('success'))
            <div class="alert alert-success">{{ session('success') }}</div>
        @endif

        <div class="row g-3 mb-4">

            <!-- ================= MISSION ================= -->
            <div class="col-md-6">
                <form action="{{ route('admin.about_us.update', 'mission') }}" method="POST" enctype="multipart/form-data"
                    class="ajax-about-us-form">
                    @csrf
                    <div class="card h-100">
                        <div class="card-header bg-dark text-white" style="font-weight: bold; font-size:1.2em">
                            Mission Section
                        </div>
                        <div class="card-body">
                            <div class="mb-2">
                                <label>Title</label>
                                <input type="text" name="mission_title" class="form-control"
                                    value="{{ old('mission_title', $aboutUsContent->mission_title ?? '') }}" required>
                            </div>

                            <div class="mb-2">
                                <label>Text</label>
                                <textarea name="mission_text" class="form-control" rows="5" required>{{ old('mission_text', $aboutUsContent->mission_text ?? '') }}</textarea>
                            </div>

                            <div class="mb-2">
                                <label>Image</label>
                                <input type="file" name="mission_image" class="form-control" data-max-size="10240"
                                    accept="image/*">
                                <div class="file-size-info">Maximum file size: 10MB</div>

                                @if (!empty($aboutUsContent->mission_image))
                                    <img src="{{ \Illuminate\Support\Str::startsWith($aboutUsContent->mission_image, ['http://', 'https://']) ? $aboutUsContent->mission_image : asset('storage/' . $aboutUsContent->mission_image) }}"
                                        class="img-fluid mt-2" style="max-height:150px;">
                                @endif
                            </div>

                            <button type="submit" class="btn btn-success w-100">
                                <i class="bi bi-check2-square me-2"></i>Save
                            </button>
                        </div>
                    </div>
                </form>
            </div>

            <!-- ================= VISION ================= -->
            <div class="col-md-6">
                <form action="{{ route('admin.about_us.update', 'vision') }}" method="POST" enctype="multipart/form-data"
                    class="ajax-about-us-form">
                    @csrf
                    <div class="card h-100">
                        <div class="card-header bg-dark text-white" style="font-weight: bold; font-size:1.2em">
                            Vision Section
                        </div>
                        <div class="card-body">
                            <div class="mb-2">
                                <label>Title</label>
                                <input type="text" name="vision_title" class="form-control"
                                    value="{{ old('vision_title', $aboutUsContent->vision_title ?? '') }}" required>
                            </div>

                            <div class="mb-2">
                                <label>Text</label>
                                <textarea name="vision_text" class="form-control" rows="5" required>{{ old('vision_text', $aboutUsContent->vision_text ?? '') }}</textarea>
                            </div>

                            <div class="mb-2">
                                <label>Image</label>
                                <input type="file" name="vision_image" class="form-control" data-max-size="10240"
                                    accept="image/*">
                                <div class="file-size-info">Maximum file size: 10MB</div>

                                @if (!empty($aboutUsContent->vision_image))
                                    <img src="{{ \Illuminate\Support\Str::startsWith($aboutUsContent->vision_image, ['http://', 'https://']) ? $aboutUsContent->vision_image : asset('storage/' . $aboutUsContent->vision_image) }}"
                                        class="img-fluid mt-2" style="max-height:150px;">
                                @endif
                            </div>

                            <button type="submit" class="btn btn-success w-100">
                                <i class="bi bi-check2-square me-2"></i>Save
                            </button>
                        </div>
                    </div>
                </form>
            </div>
        </div>

        <!-- ================= BOARD OF DIRECTORS ================= -->
        <div class="card mb-4">
            <div class="card-header bg-dark text-white" style="font-weight: bold; font-size:1.2em">
                Board of Directors
            </div>

            <div class="card-body">
                <form action="{{ route('admin.about_us.update', 'boards') }}" method="POST" class="mb-3">
                    @csrf
                    <div class="mb-2">
                        <label>Year</label>
                        <input type="text" name="board_year" class="form-control form-control-sm"
                            value="{{ old('board_year', $aboutUsContent->board_year ?? '') }}" required>
                    </div>
                    <button type="submit" class="btn btn-success btn-sm">
                        <i class="bi bi-check2-square me-2"></i>Save
                    </button>
                </form>

                @php $boards = $aboutUsContent->boards ?? []; @endphp

                <div class="row g-2" id="boardsContainer">
                    @foreach ($boards as $i => $board)
                        <div class="col-6 col-sm-4 col-md-3 board-card">
                            <div class="border p-2 h-100">
                                <form action="{{ route('admin.about_us.update_board', $i) }}" method="POST"
                                    enctype="multipart/form-data">
                                    @csrf

                                    <div class="mb-1">
                                        <input type="text" name="name" class="form-control form-control-sm"
                                            placeholder="Name" value="{{ $board['name'] ?? '' }}" required>
                                    </div>

                                    <div class="mb-1">
                                        <input type="text" name="position" class="form-control form-control-sm"
                                            placeholder="Position" value="{{ $board['position'] ?? '' }}" required>
                                    </div>

                                    <div class="mb-1">
                                        <input type="file" name="image" class="form-control form-control-sm"
                                            data-max-size="10240" accept="image/*"
                                            {{ empty($board['image']) ? 'required' : '' }}>
                                        <div class="file-size-info">Max: 10MB</div>

                                        @if (!empty($board['image']))
                                            <img src="{{ \Illuminate\Support\Str::startsWith($board['image'], ['http://', 'https://']) ? $board['image'] : Storage::url($board['image']) }}"
                                                class="img-fluid mt-1" style="max-height:100px;">
                                        @endif
                                    </div>

                                    <button type="submit" class="btn btn-primary btn-sm w-100">Save</button>
                                </form>

                                <form action="{{ route('admin.about_us.remove_board', $i) }}" method="POST"
                                    class="mt-1">
                                    @csrf
                                    <button type="submit" class="btn btn-danger btn-sm w-100">Remove</button>
                                </form>
                            </div>
                        </div>
                    @endforeach
                </div>

                <button type="button" id="addBoardBtn" class="btn btn-primary mt-2">
                    <i class="bi bi-plus-circle me-2"></i>Add Board Member
                </button>
            </div>
        </div>

        <!-- ================= OFFICERS ================= -->
        <div class="card mb-4">
            <div class="card-header bg-dark text-white" style="font-weight: bold; font-size:1.2em">
                Officers
            </div>

            <div class="card-body">
                @php $officers = $aboutUsContent->officers ?? []; @endphp

                <div class="row g-2" id="officersContainer">
                    @foreach ($officers as $i => $officer)
                        <div class="col-6 col-sm-4 col-md-3 officer-card">
                            <div class="border p-2 h-100">
                                <form action="{{ route('admin.about_us.update_officer', $i) }}" method="POST"
                                    enctype="multipart/form-data">
                                    @csrf

                                    <div class="mb-1">
                                        <input type="text" name="name" class="form-control form-control-sm"
                                            placeholder="Name" value="{{ $officer['name'] ?? '' }}" required>
                                    </div>

                                    <div class="mb-1">
                                        <input type="text" name="position" class="form-control form-control-sm"
                                            placeholder="Position" value="{{ $officer['position'] ?? '' }}" required>
                                    </div>

                                    <div class="mb-1">
                                        <input type="file" name="image" class="form-control form-control-sm"
                                            data-max-size="10240" accept="image/*"
                                            {{ empty($officer['image']) ? 'required' : '' }}>
                                        <div class="file-size-info">Max: 10MB</div>

                                        @if (!empty($officer['image']))
                                            <img src="{{ \Illuminate\Support\Str::startsWith($officer['image'], ['http://', 'https://']) ? $officer['image'] : Storage::url($officer['image']) }}"
                                                class="img-fluid mt-1" style="max-height:100px;">
                                        @endif
                                    </div>

                                    <button type="submit" class="btn btn-primary btn-sm w-100">Save</button>
                                </form>

                                <form action="{{ route('admin.about_us.remove_officer', $i) }}" method="POST"
                                    class="mt-1">
                                    @csrf
                                    <button type="submit" class="btn btn-danger btn-sm w-100">Remove</button>
                                </form>
                            </div>
                        </div>
                    @endforeach
                </div>

                <button type="button" id="addOfficerBtn" class="btn btn-primary mt-2">
                    <i class="bi bi-plus-circle me-2"></i>Add Officer
                </button>
            </div>
        </div>

        <!-- ================= FACILITIES ================= -->
        <div class="card mb-4">
            <div class="card-header bg-dark text-white" style="font-weight: bold; font-size:1.2em">
                Facilities
            </div>

            <div class="card-body">
                @php $bullets = $aboutUsContent->facilities_bullets ?? []; @endphp

                <div class="row">
                    <div class="col-md-6">
                        <form action="{{ route('admin.about_us.update', 'facilities') }}" method="POST"
                            enctype="multipart/form-data" class="mb-3 ajax-about-us-form">
                            @csrf

                            <div class="mb-3">
                                <label>Caption</label>
                                <textarea name="facilities_caption" class="form-control" rows="5" required>{{ old('facilities_caption', $aboutUsContent->facilities_caption ?? '') }}</textarea>
                            </div>

                            <div class="mb-3">
                                <label>Image</label>
                                <input type="file" name="facilities_image" class="form-control" data-max-size="10240"
                                    accept="image/*">
                                <div class="file-size-info">Maximum file size: 10MB</div>

                                @if (!empty($aboutUsContent->facilities_image))
                                    <img src="{{ \Illuminate\Support\Str::startsWith($aboutUsContent->facilities_image, ['http://', 'https://']) ? $aboutUsContent->facilities_image : asset('storage/' . $aboutUsContent->facilities_image) }}"
                                        class="img-fluid mt-2" style="max-height:150px;">
                                @endif
                            </div>

                            <button type="submit" class="btn btn-success">
                                <i class="bi bi-check2-square me-2"></i>Save
                            </button>
                        </form>
                    </div>

                    <div class="col-md-6">
                        <div id="bulletsList">
                            @foreach ($bullets as $i => $bullet)
                                <div class="d-flex mb-2 align-items-center server-bullet"
                                    data-index="{{ $i }}">
                                    <input type="text" class="form-control me-2 server-bullet-input"
                                        value="{{ $bullet }}">
                                    <button type="button" class="btn btn-danger btn-sm server-remove-btn">
                                        <i class="bi bi-trash"></i> Remove
                                    </button>
                                </div>
                            @endforeach
                        </div>

                        <div class="mt-2">
                            <button type="button" id="addBulletBtn" class="btn btn-primary">
                                <i class="bi bi-plus-circle me-2"></i>Add Bullet
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- ================= VALUES / CORE PRINCIPLES ================= -->
        <div class="card mb-4">
            <div class="card-header bg-dark text-white" style="font-weight: bold; font-size:1.2em">
                Values / Core Principles
            </div>

            <div class="card-body">
                @php $values = $aboutUsContent->values ?? []; @endphp

                <div class="row g-3" id="valuesContainer">
                    @foreach ($values as $i => $value)
                        <div class="col-12 col-sm-6 col-md-3 value-card" data-index="{{ $i }}">
                            <form action="{{ route('admin.about_us.update_value', ['index' => $i]) }}" method="POST"
                                enctype="multipart/form-data">
                                @csrf

                                <div>
                                    <div class="mb-2">
                                        <label style="font-weight: bold">Title</label>
                                        <input type="text" name="title" class="form-control"
                                            value="{{ $value['title'] ?? '' }}" required>
                                    </div>

                                    <div class="mb-2">
                                        <label>Description</label>
                                        <textarea name="description" class="form-control" rows="2" required>{{ $value['description'] ?? '' }}</textarea>
                                    </div>

                                    <div class="mb-2">
                                        <label>Icon</label>
                                        <input type="file" name="icon" class="form-control" data-max-size="10240"
                                            accept="image/*" @if (empty($value['icon'])) required @endif>
                                        <div class="file-size-info">Max: 10MB</div>

                                        @if (!empty($value['icon']))
                                            <img src="{{ \Illuminate\Support\Str::startsWith($value['icon'], ['http://', 'https://']) ? $value['icon'] : Storage::url($value['icon']) }}"
                                                class="img-fluid mt-1" style="max-height:50px;">
                                        @endif
                                    </div>
                                </div>

                                <div class="mt-2 d-flex gap-2">
                                    <button type="submit" name="action" value="save"
                                        class="btn btn-primary w-50">Save</button>
                                    <button type="button" class="btn btn-danger w-50 removeValueBtn">
                                        <i class="bi bi-trash"></i> Remove
                                    </button>
                                </div>
                            </form>
                        </div>
                    @endforeach
                </div>

                <button type="button" id="addValueBtn" class="btn btn-primary mt-3">
                    <i class="bi bi-plus-circle me-2"></i>Add Value
                </button>
            </div>
        </div>
    </div>

    <!-- ================= CONFIRMATION MODAL ================= -->
    <div class="modal fade" id="confirmModal" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <form id="confirmForm" class="modal-content">
                <div class="modal-header bg-danger text-white">
                    <h5 class="modal-title" id="confirmModalTitle">Confirm</h5>
                </div>
                <div class="modal-body" id="confirmModalBody">Are you sure?</div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                    <button type="button" class="btn btn-danger" id="confirmModalOkBtn">
                        <i class="bi bi-trash"></i> Remove
                    </button>
                </div>
            </form>
        </div>
    </div>

    <!-- ================= SUCCESS MODAL ================= -->
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

    <!-- ================= ERROR MODAL ================= -->
    <div class="modal fade" id="errorModal" tabindex="-1">
        <div class="modal-dialog modal-dialog-centered modal-sm">
            <div class="modal-content">
                <div class="modal-header bg-danger text-white">
                    <h5 class="modal-title">Error</h5>
                    <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"></button>
                </div>
                <div class="modal-body text-black" id="errorModalBody"></div>
                <div class="modal-footer">
                    <button class="btn btn-primary" data-bs-dismiss="modal">OK</button>
                </div>
            </div>
        </div>
    </div>

    <!-- ================= FILE SIZE ERROR MODAL ================= -->
    <div class="modal fade" id="fileSizeErrorModal" tabindex="-1">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header bg-warning text-dark">
                    <h5 class="modal-title">
                        <i class="bi bi-exclamation-triangle-fill me-2"></i>File Too Large
                    </h5>
                </div>
                <div class="modal-body text-black" id="fileSizeErrorBody"></div>
                <div class="modal-footer">
                    <button class="btn btn-primary" data-bs-dismiss="modal">OK</button>
                </div>
            </div>
        </div>
    </div>

    @if (session('show_modal'))
        <script>
            document.addEventListener('DOMContentLoaded', function() {
                const modalEl = document.getElementById('successModal');
                const modal = new bootstrap.Modal(modalEl);
                modal.show();
            });
        </script>
    @endif

    <script>
        /*
         * IMAGE URL HANDLING
         *
         * Supports both:
         * 1. Local storage paths: about_us/example.jpg
         * 2. ImageKit URLs: https://ik.imagekit.io/...
         */

        const storageBase = @json(asset('storage'));

        function getImageUrl(imagePath) {
            if (!imagePath) return '';

            const path = String(imagePath).trim();

            if (/^https?:\/\//i.test(path) || path.startsWith('data:') || path.startsWith('blob:')) {
                return path;
            }

            return storageBase.replace(/\/$/, '') + '/' + path.replace(/^\/+/, '');
        }

        function getImagePathFromSrc(src) {
            if (!src) return '';

            // Preserve absolute ImageKit URLs.
            if (/^https?:\/\//i.test(src)) {
                return src;
            }

            // Convert a local /storage/... URL back to its relative storage path.
            const marker = '/storage/';
            const markerIndex = src.indexOf(marker);

            if (markerIndex !== -1) {
                return src.substring(markerIndex + marker.length);
            }

            return src;
        }

        function validateFileSize(fileInput) {
            if (!fileInput.files || fileInput.files.length === 0) return true;

            const maxSizeKB = parseInt(fileInput.getAttribute('data-max-size')) || 10240;
            const file = fileInput.files[0];
            const fileSizeKB = file.size / 1024;

            if (fileSizeKB > maxSizeKB) {
                const fileSizeMB = (fileSizeKB / 1024).toFixed(2);
                const maxSizeMB = (maxSizeKB / 1024).toFixed(1);
                const errorMessage =
                    `File "${file.name}" is ${fileSizeMB}MB. Maximum allowed size is ${maxSizeMB}MB.`;

                document.getElementById('fileSizeErrorBody').textContent = errorMessage;

                const errorModal = new bootstrap.Modal(document.getElementById('fileSizeErrorModal'));
                errorModal.show();

                fileInput.value = '';
                return false;
            }

            return true;
        }

        document.addEventListener('DOMContentLoaded', function() {
            document.querySelectorAll('input[type="file"][data-max-size]').forEach(input => {
                input.addEventListener('change', function() {
                    validateFileSize(this);
                });
            });

            document.querySelectorAll('form').forEach(form => {
                form.addEventListener('submit', function(e) {
                    const fileInputs = this.querySelectorAll('input[type="file"][data-max-size]');
                    let hasError = false;

                    fileInputs.forEach(input => {
                        if (!validateFileSize(input)) {
                            hasError = true;
                        }
                    });

                    if (hasError) e.preventDefault();
                });
            });
        });

        const showConfirmModal = (title, message) => {
            // ================= MISSION / VISION / FACILITIES AJAX =================
            document.addEventListener('DOMContentLoaded', function() {
                document.querySelectorAll('.ajax-about-us-form').forEach(form => {
                    form.addEventListener('submit', async function(e) {
                        e.preventDefault();

                        const fileInput = form.querySelector('input[type="file"]');

                        if (fileInput && !validateFileSize(fileInput)) {
                            return;
                        }

                        const submitButton = form.querySelector('button[type="submit"]');
                        const originalButtonHTML = submitButton ? submitButton.innerHTML :
                            '';

                        if (submitButton) {
                            submitButton.disabled = true;
                            submitButton.innerHTML = 'Saving...';
                        }

                        try {
                            const response = await fetch(form.action, {
                                method: 'POST',
                                headers: {
                                    'X-CSRF-TOKEN': document.querySelector(
                                        'meta[name="csrf-token"]').getAttribute(
                                        'content'),
                                    'Accept': 'application/json',
                                    'X-Requested-With': 'XMLHttpRequest'
                                },
                                body: new FormData(form)
                            });

                            const contentType = response.headers.get('content-type') || '';

                            if (!contentType.includes('application/json')) {
                                throw new Error(
                                    'Unexpected server response. Please try again.');
                            }

                            const json = await response.json();

                            if (!response.ok || !json.success) {
                                let message = json.message || 'Unable to save the content.';

                                if (json.errors) {
                                    message = Object.values(json.errors).flat().join('\n');
                                }

                                throw new Error(message);
                            }

                            // Update the image preview when a new image was uploaded.
                            if (json.image) {
                                const imageInput = form.querySelector('input[type="file"]');
                                const imageContainer = imageInput.closest('.mb-2, .mb-3');

                                if (imageContainer) {
                                    let preview = imageContainer.querySelector('img');

                                    if (!preview) {
                                        preview = document.createElement('img');
                                        preview.className = 'img-fluid mt-2';
                                        preview.style.maxHeight = '150px';

                                        const sizeInfo = imageContainer.querySelector(
                                            '.file-size-info');

                                        if (sizeInfo) {
                                            sizeInfo.after(preview);
                                        } else {
                                            imageContainer.appendChild(preview);
                                        }
                                    }

                                    preview.src = json.image;
                                }

                                fileInput.value = '';
                            }

                            showSuccessModal(json.message ||
                                'Content updated successfully!');

                        } catch (error) {
                            console.error('About Us AJAX error:', error);
                            showErrorModal(error.message ||
                                'An error occurred while saving.');
                        } finally {
                            if (submitButton) {
                                submitButton.disabled = false;
                                submitButton.innerHTML = originalButtonHTML;
                            }
                        }
                    });
                });
            });
            return new Promise((resolve) => {
                const modalEl = document.getElementById('confirmModal');
                const modal = new bootstrap.Modal(modalEl);

                document.getElementById('confirmModalTitle').textContent = title;
                document.getElementById('confirmModalBody').textContent = message;

                const okBtn = document.getElementById('confirmModalOkBtn');

                const cleanup = () => {
                    okBtn.removeEventListener('click', onOk);
                    modal.hide();
                };

                const onOk = () => {
                    cleanup();
                    resolve(true);
                };

                okBtn.addEventListener('click', onOk);
                modal.show();
            });
        };

        function showSuccessModal(message, isError = false) {
            const modalEl = document.getElementById('successModal');
            const modalBody = modalEl.querySelector('.modal-body');

            modalBody.textContent = message;
            modalBody.style.color = isError ? 'red' : 'green';

            const modal = new bootstrap.Modal(modalEl);
            modal.show();

            setTimeout(() => modal.hide(), 2000);
        }

        function showErrorModal(message) {
            const modalEl = document.getElementById('errorModal');
            const modalBody = document.getElementById('errorModalBody');

            modalBody.textContent = message || 'An error occurred';

            const modal = new bootstrap.Modal(modalEl);
            modal.show();
        }

        function escapeHtml(str) {
            if (!str) return '';

            return String(str)
                .replace(/&/g, '&amp;')
                .replace(/"/g, '&quot;')
                .replace(/'/g, '&#039;')
                .replace(/</g, '&lt;')
                .replace(/>/g, '&gt;');
        }

        // ================= BOARD OF DIRECTORS =================
        document.addEventListener('DOMContentLoaded', function() {
            const addBtn = document.getElementById('addBoardBtn');
            const boardsContainer = document.getElementById('boardsContainer');
            const csrfToken = document.querySelector('meta[name="csrf-token"]').getAttribute('content');

            const addUrl = "{{ route('admin.about_us.add_board') }}";
            const updateUrlTemplate = "{{ route('admin.about_us.update_board', ['index' => '__IDX__']) }}";
            const removeUrlTemplate = "{{ route('admin.about_us.remove_board', ['index' => '__IDX__']) }}";

            function buildServerCard(index, board) {
                const col = document.createElement('div');
                col.className = 'col-6 col-sm-4 col-md-3 board-card';

                const imageHtml = board.image ?
                    `<img src="${escapeHtml(getImageUrl(board.image))}" class="img-fluid mt-1" style="max-height:100px;">` :
                    '';

                const updateAction = updateUrlTemplate.replace('__IDX__', index);
                const removeAction = removeUrlTemplate.replace('__IDX__', index);

                col.innerHTML = `
                    <div class="border p-2 h-100">
                        <form action="${updateAction}" method="POST" enctype="multipart/form-data" class="server-update-form">
                            <input type="hidden" name="_token" value="${csrfToken}">
                            <div class="mb-1">
                                <input type="text" name="name" class="form-control form-control-sm"
                                    placeholder="Name" value="${escapeHtml(board.name || '')}" required>
                            </div>
                            <div class="mb-1">
                                <input type="text" name="position" class="form-control form-control-sm"
                                    placeholder="Position" value="${escapeHtml(board.position || '')}" required>
                            </div>
                            <div class="mb-1">
                                <input type="file" name="image" class="form-control form-control-sm"
                                    data-max-size="10240" accept="image/*">
                                <div class="file-size-info">Max: 10MB</div>
                                <div class="preview-wrap">${imageHtml}</div>
                            </div>
                            <button type="submit" class="btn btn-primary btn-sm w-100">Save</button>
                        </form>
                        <button type="button" class="btn btn-danger btn-sm w-100 mt-1 server-remove-btn">Remove</button>
                    </div>
                `;

                const fileInput = col.querySelector('input[type="file"]');

                fileInput.addEventListener('change', function() {
                    validateFileSize(this);
                });

                const updateForm = col.querySelector('.server-update-form');

                updateForm.addEventListener('submit', async function(ev) {
                    ev.preventDefault();

                    if (!validateFileSize(fileInput)) return;

                    const formData = new FormData(this);

                    try {
                        const resp = await fetch(this.action, {
                            method: 'POST',
                            headers: {
                                'X-CSRF-TOKEN': csrfToken,
                                'Accept': 'application/json'
                            },
                            body: formData
                        });

                        const json = await resp.json();

                        if (json.success) {
                            if (json.board && json.board.image) {
                                updateForm.querySelector('.preview-wrap').innerHTML =
                                    `<img src="${escapeHtml(getImageUrl(json.board.image))}" class="img-fluid mt-1" style="max-height:100px;">`;
                            }

                            showSuccessModal('Board member saved successfully!');
                        } else {
                            showErrorModal(json.message || 'Save failed');
                        }
                    } catch (err) {
                        console.error(err);
                        showErrorModal('Save error');
                    }
                });

                col.querySelector('.server-remove-btn').addEventListener('click', async () => {
                    const confirmed = await showConfirmModal(
                        'Remove Board Member?',
                        'Are you sure you want to remove this board member?'
                    );

                    if (!confirmed) return;

                    try {
                        const resp = await fetch(removeAction, {
                            method: 'POST',
                            headers: {
                                'X-CSRF-TOKEN': csrfToken,
                                'Accept': 'application/json'
                            }
                        });

                        const json = await resp.json();

                        if (json.success) {
                            col.remove();
                        } else {
                            alert(json.message || 'Remove failed');
                        }
                    } catch (err) {
                        console.error(err);
                        alert('Remove error');
                    }
                });

                return col;
            }

            function buildLocalCard() {
                const col = document.createElement('div');
                col.className = 'col-6 col-sm-4 col-md-3 board-card';

                col.innerHTML = `
                    <div class="border p-2 h-100">
                        <div class="mb-1">
                            <input type="text" class="form-control form-control-sm local-name" placeholder="Name">
                        </div>
                        <div class="mb-1">
                            <input type="text" class="form-control form-control-sm local-position" placeholder="Position">
                        </div>
                        <div class="mb-1">
                            <input type="file" class="form-control form-control-sm local-image"
                                data-max-size="10240" accept="image/*">
                            <div class="file-size-info">Max: 10MB</div>
                            <div class="preview-wrap"></div>
                        </div>
                        <div class="d-grid gap-1">
                            <button type="button" class="btn btn-success btn-sm local-save-btn">Save</button>
                            <button type="button" class="btn btn-secondary btn-sm local-cancel-btn">Cancel</button>
                        </div>
                    </div>
                `;

                const fileInput = col.querySelector('.local-image');

                fileInput.addEventListener('change', function() {
                    validateFileSize(this);
                });

                col.querySelector('.local-cancel-btn').addEventListener('click', () => col.remove());

                col.querySelector('.local-save-btn').addEventListener('click', async function() {
                    const name = col.querySelector('.local-name').value.trim();
                    const position = col.querySelector('.local-position').value.trim();

                    if (fileInput.files.length > 0 && !validateFileSize(fileInput)) return;

                    if (!name || !position || fileInput.files.length === 0) {
                        await showConfirmModal(
                            'Missing Data',
                            'Please provide the name, position, and image before saving.'
                        );
                        return;
                    }

                    try {
                        const addResp = await fetch(addUrl, {
                            method: 'POST',
                            headers: {
                                'X-CSRF-TOKEN': csrfToken,
                                'Accept': 'application/json'
                            }
                        });

                        const addJson = await addResp.json();

                        if (!addJson.success || typeof addJson.index === 'undefined') {
                            alert('Server failed to create new board entry.');
                            return;
                        }

                        const newIndex = addJson.index;
                        const updateUrl = updateUrlTemplate.replace('__IDX__', newIndex);

                        const fd = new FormData();
                        fd.append('name', name);
                        fd.append('position', position);
                        fd.append('image', fileInput.files[0]);

                        const updResp = await fetch(updateUrl, {
                            method: 'POST',
                            headers: {
                                'X-CSRF-TOKEN': csrfToken,
                                'Accept': 'application/json'
                            },
                            body: fd
                        });

                        const updJson = await updResp.json();

                        if (!updJson.success) {
                            alert(updJson.message || 'Failed to save board member.');
                            return;
                        }

                        const serverCard = buildServerCard(newIndex, updJson.board || {
                            name,
                            position,
                            image: ''
                        });

                        col.replaceWith(serverCard);
                        serverCard.scrollIntoView({
                            behavior: 'smooth',
                            block: 'center'
                        });
                    } catch (err) {
                        console.error(err);
                        alert('Network error while saving board member.');
                    }
                });

                return col;
            }

            (function initServerCards() {
                const serverCols = Array.from(boardsContainer.querySelectorAll('.board-card'));

                serverCols.forEach((col, idx) => {
                    const nameInput = col.querySelector('input[name="name"]');
                    const posInput = col.querySelector('input[name="position"]');
                    const previewImg = col.querySelector('img');

                    const name = nameInput ? nameInput.value : '';
                    const position = posInput ? posInput.value : '';
                    const image = previewImg ? getImagePathFromSrc(previewImg.getAttribute('src')) : '';

                    col.replaceWith(buildServerCard(idx, {
                        name,
                        position,
                        image
                    }));
                });
            })();

            addBtn.addEventListener('click', function(e) {
                e.preventDefault();

                const local = buildLocalCard();
                boardsContainer.appendChild(local);

                local.scrollIntoView({
                    behavior: 'smooth',
                    block: 'center'
                });
            });
        });

        // ================= FACILITIES BULLETS =================
        document.addEventListener('DOMContentLoaded', function() {
            const bulletsList = document.getElementById('bulletsList');
            const addBtn = document.getElementById('addBulletBtn');

            const csrfToken = document.querySelector('meta[name="csrf-token"]')?.getAttribute('content') ||
                '{{ csrf_token() }}';

            const addUrl = "{{ route('admin.about_us.add_bullet') }}";
            const updateUrlTemplate = "{{ route('admin.about_us.update_bullet', ['index' => '__IDX__']) }}";
            const removeUrlTemplate = "{{ route('admin.about_us.remove_bullet', ['index' => '__IDX__']) }}";

            function createLocalRow() {
                const container = document.createElement('div');
                container.className = 'd-flex mb-2 align-items-center local-bullet';

                container.innerHTML = `
                    <input type="text" class="form-control me-2 local-bullet-input" placeholder="Bullet text">
                    <button type="button" class="btn btn-success btn-sm me-1 local-save-btn">Save</button>
                    <button type="button" class="btn btn-secondary btn-sm local-cancel-btn">Cancel</button>
                `;

                container.querySelector('.local-cancel-btn').addEventListener('click', () => container.remove());

                container.querySelector('.local-save-btn').addEventListener('click', async () => {
                    const input = container.querySelector('.local-bullet-input');
                    const text = input.value.trim();

                    if (!text) {
                        await showConfirmModal('Missing Data', 'Bullet cannot be empty!');
                        return;
                    }

                    try {
                        const addResp = await fetch(addUrl, {
                            method: 'POST',
                            headers: {
                                'X-CSRF-TOKEN': csrfToken,
                                'Accept': 'application/json'
                            }
                        });

                        const addJson = await addResp.json();

                        if (!addJson.success) throw new Error('Failed to create bullet on server');

                        const newIndex = addJson.index;
                        const updateUrl = updateUrlTemplate.replace('__IDX__', newIndex);

                        const formData = new FormData();
                        formData.append('bullet', text);
                        formData.append('action', 'save');

                        const updResp = await fetch(updateUrl, {
                            method: 'POST',
                            headers: {
                                'X-CSRF-TOKEN': csrfToken,
                                'Accept': 'application/json'
                            },
                            body: formData
                        });

                        const updJson = await updResp.json();

                        if (!updJson.success) throw new Error('Failed to save bullet text');

                        const serverRow = document.createElement('div');
                        serverRow.className = 'd-flex mb-2 align-items-center server-bullet';
                        serverRow.setAttribute('data-index', newIndex);

                        serverRow.innerHTML = `
                            <input type="text" class="form-control me-2 server-bullet-input" value="${escapeHtml(text)}">
                            <button type="button" class="btn btn-danger btn-sm server-remove-btn">Remove</button>
                        `;

                        container.replaceWith(serverRow);
                        attachServerRowHandlers(serverRow);
                    } catch (err) {
                        console.error(err);
                        alert('Could not save bullet. See console for details.');
                    }
                });

                bulletsList.appendChild(container);
                container.querySelector('.local-bullet-input').focus();
            }

            function attachServerRowHandlers(row) {
                const removeBtn = row.querySelector('.server-remove-btn');
                const input = row.querySelector('.server-bullet-input');

                removeBtn.addEventListener('click', async () => {
                    const confirmed = await showConfirmModal(
                        'Remove Bullet?',
                        'Are you sure you want to remove this facility bullet?'
                    );

                    if (!confirmed) return;

                    const idx = row.getAttribute('data-index');
                    const url = removeUrlTemplate.replace('__IDX__', idx);

                    try {
                        const resp = await fetch(url, {
                            method: 'POST',
                            headers: {
                                'X-CSRF-TOKEN': csrfToken,
                                'Accept': 'application/json'
                            }
                        });

                        const json = await resp.json();

                        if (json.success) {
                            row.remove();
                        } else {
                            alert(json.message || 'Failed to remove bullet');
                        }
                    } catch (err) {
                        console.error(err);
                        alert('Remove failed');
                    }
                });

                input.addEventListener('blur', async () => {
                    const newText = input.value.trim();
                    const idx = row.getAttribute('data-index');

                    if (newText === '') {
                        alert('Bullet cannot be empty');
                        return;
                    }

                    const url = updateUrlTemplate.replace('__IDX__', idx);
                    const formData = new FormData();

                    formData.append('bullet', newText);
                    formData.append('action', 'save');

                    try {
                        const resp = await fetch(url, {
                            method: 'POST',
                            headers: {
                                'X-CSRF-TOKEN': csrfToken,
                                'Accept': 'application/json'
                            },
                            body: formData
                        });

                        const json = await resp.json();

                        if (!json.success) {
                            alert(json.message || 'Save failed');
                        }
                    } catch (err) {
                        console.error(err);
                        alert('Save failed');
                    }
                });
            }

            document.querySelectorAll('#bulletsList .server-bullet').forEach(row => {
                attachServerRowHandlers(row);
            });

            addBtn.addEventListener('click', createLocalRow);
        });

        // ================= VALUES / CORE PRINCIPLES =================
        document.addEventListener('DOMContentLoaded', function() {
            const addBtn = document.getElementById('addValueBtn');
            const valuesContainer = document.getElementById('valuesContainer');

            const csrfToken = document.querySelector('meta[name="csrf-token"]').getAttribute('content');

            const addUrl = "{{ route('admin.about_us.add_value') }}";
            const updateUrlTemplate = "{{ route('admin.about_us.update_value', ['index' => '__IDX__']) }}";
            const removeUrlTemplate = "{{ route('admin.about_us.remove_value', ['index' => '__IDX__']) }}";

            function buildServerCard(index, value) {
                const col = document.createElement('div');
                col.className = 'col-12 col-sm-6 col-md-3 value-card';

                const imgHtml = value.icon ?
                    `<img src="${escapeHtml(getImageUrl(value.icon))}" class="img-fluid mt-1" style="max-height:50px;">` :
                    '';

                const updateAction = updateUrlTemplate.replace('__IDX__', index);
                const removeAction = removeUrlTemplate.replace('__IDX__', index);

                col.innerHTML = `
                    <div class="border p-2 h-100">
                        <form action="${updateAction}" method="POST" enctype="multipart/form-data" class="server-update-form">
                            <input type="hidden" name="_token" value="${csrfToken}">
                            <div class="mb-2">
                                <label style="font-weight:bold">Title</label>
                                <input type="text" name="title" class="form-control"
                                    placeholder="Title" value="${escapeHtml(value.title || '')}" required>
                            </div>
                            <div class="mb-2">
                                <label>Description</label>
                                <textarea name="description" class="form-control" rows="2"
                                    placeholder="Description" required>${escapeHtml(value.description || '')}</textarea>
                            </div>
                            <div class="mb-2">
                                <label>Icon</label>
                                <input type="file" name="icon" class="form-control"
                                    data-max-size="10240" accept="image/*">
                                <div class="file-size-info">Max: 10MB</div>
                                <div class="preview-wrap">${imgHtml}</div>
                            </div>
                            <button type="submit" class="btn btn-primary w-100">Save</button>
                        </form>
                        <button type="button" class="btn btn-danger w-100 mt-1 server-remove-btn">Remove</button>
                    </div>
                `;

                const iconInput = col.querySelector('input[type="file"]');

                iconInput.addEventListener('change', function() {
                    validateFileSize(this);
                });

                col.querySelector('.server-update-form').addEventListener('submit', async function(e) {
                    e.preventDefault();

                    if (!validateFileSize(iconInput)) return;

                    const fd = new FormData(this);

                    try {
                        const resp = await fetch(this.action, {
                            method: 'POST',
                            headers: {
                                'X-CSRF-TOKEN': csrfToken,
                                'Accept': 'application/json'
                            },
                            body: fd
                        });

                        const ct = resp.headers.get('content-type') || '';

                        if (!resp.ok) {
                            let msg = 'Save failed (server error)';

                            if (ct.includes('application/json')) {
                                try {
                                    const errJson = await resp.json();
                                    msg = errJson.message || msg;
                                } catch {}
                            }

                            showErrorModal(msg);
                            return;
                        }

                        if (!ct.includes('application/json')) {
                            showErrorModal('Unexpected server response');
                            return;
                        }

                        const json = await resp.json();

                        if (json.success) {
                            if (json.value && json.value.icon) {
                                const previewWrap = this.querySelector('.preview-wrap');

                                if (previewWrap) {
                                    previewWrap.innerHTML =
                                        `<img src="${escapeHtml(getImageUrl(json.value.icon))}" class="img-fluid mt-1" style="max-height:50px;">`;
                                }
                            }

                            showSuccessModal('Principles saved successfully!');
                        } else {
                            showErrorModal(json.message || 'Save failed');
                        }
                    } catch (err) {
                        console.error(err);
                        showErrorModal('Network error while saving');
                    }
                });

                col.querySelector('.server-remove-btn').addEventListener('click', async function() {
                    const confirmed = await showConfirmModal(
                        'Remove Value / Core Principle?',
                        'Are you sure you want to remove this entry?'
                    );

                    if (!confirmed) return;

                    try {
                        const resp = await fetch(removeAction, {
                            method: 'POST',
                            headers: {
                                'X-CSRF-TOKEN': csrfToken,
                                'Accept': 'application/json'
                            }
                        });

                        const json = await resp.json();

                        if (json.success) {
                            col.remove();
                        } else {
                            alert(json.message || 'Remove failed');
                        }
                    } catch (err) {
                        console.error(err);
                        alert('Remove failed');
                    }
                });

                return col;
            }

            function buildLocalCard() {
                const col = document.createElement('div');
                col.className = 'col-12 col-sm-6 col-md-3 value-card';

                col.innerHTML = `
                    <div class="border p-2 h-100">
                        <div class="mb-2">
                            <input type="text" class="form-control local-title" placeholder="Title">
                        </div>
                        <div class="mb-2">
                            <textarea class="form-control local-desc" rows="2" placeholder="Description"></textarea>
                        </div>
                        <div class="mb-2">
                            <input type="file" class="form-control local-icon"
                                data-max-size="10240" accept="image/*">
                            <div class="file-size-info">Max: 10MB</div>
                            <div class="preview-wrap"></div>
                        </div>
                        <div class="d-grid gap-1">
                            <button type="button" class="btn btn-success btn-sm local-save-btn">Save</button>
                            <button type="button" class="btn btn-secondary btn-sm local-cancel-btn">Cancel</button>
                        </div>
                    </div>
                `;

                const iconInput = col.querySelector('.local-icon');

                iconInput.addEventListener('change', function() {
                    validateFileSize(this);

                    const file = this.files[0];

                    if (file) {
                        const preview = col.querySelector('.preview-wrap');
                        preview.innerHTML =
                            `<img src="${URL.createObjectURL(file)}" class="img-fluid mt-1" style="max-height:50px;">`;
                    }
                });

                col.querySelector('.local-cancel-btn').addEventListener('click', () => col.remove());

                col.querySelector('.local-save-btn').addEventListener('click', async function() {
                    const title = col.querySelector('.local-title').value.trim();
                    const desc = col.querySelector('.local-desc').value.trim();

                    if (iconInput.files.length > 0 && !validateFileSize(iconInput)) return;

                    if (!title || !desc || iconInput.files.length === 0) {
                        await showConfirmModal('Missing Data',
                            'Provide the title, description, and icon before saving!');
                        return;
                    }

                    try {
                        const addResp = await fetch(addUrl, {
                            method: 'POST',
                            headers: {
                                'X-CSRF-TOKEN': csrfToken,
                                'Accept': 'application/json'
                            }
                        });

                        const addJson = await addResp.json();

                        if (!addJson.success || typeof addJson.index === 'undefined') {
                            alert('Server failed to create value entry.');
                            return;
                        }

                        const newIndex = addJson.index;
                        const updateUrl = updateUrlTemplate.replace('__IDX__', newIndex);

                        const fd = new FormData();
                        fd.append('title', title);
                        fd.append('description', desc);
                        fd.append('icon', iconInput.files[0]);

                        const updResp = await fetch(updateUrl, {
                            method: 'POST',
                            headers: {
                                'X-CSRF-TOKEN': csrfToken,
                                'Accept': 'application/json'
                            },
                            body: fd
                        });

                        const updJson = await updResp.json();

                        if (!updJson.success) {
                            alert(updJson.message || 'Save failed');
                            return;
                        }

                        const serverCard = buildServerCard(newIndex, updJson.value || {
                            title,
                            description: desc,
                            icon: ''
                        });

                        col.replaceWith(serverCard);

                        serverCard.scrollIntoView({
                            behavior: 'smooth',
                            block: 'center'
                        });
                    } catch (err) {
                        console.error(err);
                        alert('Network error');
                    }
                });

                return col;
            }

            (function initServerCards() {
                const serverCols = Array.from(valuesContainer.querySelectorAll('.value-card'));

                serverCols.forEach((col, idx) => {
                    const titleInput = col.querySelector('input[name="title"]');
                    const descInput = col.querySelector('textarea[name="description"]');
                    const imgEl = col.querySelector('img');

                    const title = titleInput ? titleInput.value : '';
                    const desc = descInput ? descInput.value : '';
                    const icon = imgEl ? getImagePathFromSrc(imgEl.getAttribute('src')) : '';

                    col.replaceWith(buildServerCard(idx, {
                        title,
                        description: desc,
                        icon
                    }));
                });
            })();

            addBtn.addEventListener('click', () => {
                const local = buildLocalCard();
                valuesContainer.appendChild(local);

                local.scrollIntoView({
                    behavior: 'smooth',
                    block: 'center'
                });
            });
        });

        // ================= OFFICERS =================
        document.addEventListener('DOMContentLoaded', function() {
            const addBtn = document.getElementById('addOfficerBtn');
            const officersContainer = document.getElementById('officersContainer');

            const csrfToken = document.querySelector('meta[name="csrf-token"]').getAttribute('content');

            const addUrl = "{{ route('admin.about_us.add_officer') }}";
            const updateUrlTemplate = "{{ route('admin.about_us.update_officer', ['index' => '__IDX__']) }}";
            const removeUrlTemplate = "{{ route('admin.about_us.remove_officer', ['index' => '__IDX__']) }}";

            function buildServerOfficerCard(index, officer) {
                const col = document.createElement('div');
                col.className = 'col-6 col-sm-4 col-md-3 officer-card';

                const imageHtml = officer.image ?
                    `<img src="${escapeHtml(getImageUrl(officer.image))}" class="img-fluid mt-1" style="max-height:100px;">` :
                    '';

                const updateAction = updateUrlTemplate.replace('__IDX__', index);
                const removeAction = removeUrlTemplate.replace('__IDX__', index);

                col.innerHTML = `
                    <div class="border p-2 h-100">
                        <form action="${updateAction}" method="POST" enctype="multipart/form-data" class="server-update-form">
                            <input type="hidden" name="_token" value="${csrfToken}">
                            <div class="mb-1">
                                <input type="text" name="name" class="form-control form-control-sm"
                                    placeholder="Name" value="${escapeHtml(officer.name || '')}" required>
                            </div>
                            <div class="mb-1">
                                <input type="text" name="position" class="form-control form-control-sm"
                                    placeholder="Position" value="${escapeHtml(officer.position || '')}" required>
                            </div>
                            <div class="mb-1">
                                <input type="file" name="image" class="form-control form-control-sm"
                                    data-max-size="10240" accept="image/*">
                                <div class="file-size-info">Max: 10MB</div>
                                <div class="preview-wrap">${imageHtml}</div>
                            </div>
                            <button type="submit" class="btn btn-primary btn-sm w-100">Save</button>
                        </form>
                        <button type="button" class="btn btn-danger btn-sm w-100 mt-1 server-remove-btn">Remove</button>
                    </div>
                `;

                const fileInput = col.querySelector('input[type="file"]');

                fileInput.addEventListener('change', function() {
                    validateFileSize(this);
                });

                const updateForm = col.querySelector('.server-update-form');

                updateForm.addEventListener('submit', async function(ev) {
                    ev.preventDefault();

                    if (!validateFileSize(fileInput)) return;

                    const formData = new FormData(this);

                    try {
                        const resp = await fetch(this.action, {
                            method: 'POST',
                            headers: {
                                'X-CSRF-TOKEN': csrfToken,
                                'Accept': 'application/json'
                            },
                            body: formData
                        });

                        const json = await resp.json();

                        if (json.success) {
                            if (json.officer && json.officer.image) {
                                updateForm.querySelector('.preview-wrap').innerHTML =
                                    `<img src="${escapeHtml(getImageUrl(json.officer.image))}" class="img-fluid mt-1" style="max-height:100px;">`;
                            }

                            showSuccessModal('Officer saved successfully!');
                        } else {
                            showErrorModal(json.message || 'Save failed');
                        }
                    } catch (err) {
                        console.error(err);
                        showErrorModal('Save error');
                    }
                });

                col.querySelector('.server-remove-btn').addEventListener('click', async () => {
                    const confirmed = await showConfirmModal(
                        'Remove Officer?',
                        'Are you sure you want to remove this officer?'
                    );

                    if (!confirmed) return;

                    try {
                        const resp = await fetch(removeAction, {
                            method: 'POST',
                            headers: {
                                'X-CSRF-TOKEN': csrfToken,
                                'Accept': 'application/json'
                            }
                        });

                        const json = await resp.json();

                        if (json.success) {
                            col.remove();
                        } else {
                            alert(json.message || 'Remove failed');
                        }
                    } catch (err) {
                        console.error(err);
                        alert('Remove error');
                    }
                });

                return col;
            }

            function buildLocalOfficerCard() {
                const col = document.createElement('div');
                col.className = 'col-6 col-sm-4 col-md-3 officer-card';

                col.innerHTML = `
                    <div class="border p-2 h-100">
                        <div class="mb-1">
                            <input type="text" class="form-control form-control-sm local-name" placeholder="Name">
                        </div>
                        <div class="mb-1">
                            <input type="text" class="form-control form-control-sm local-position" placeholder="Position">
                        </div>
                        <div class="mb-1">
                            <input type="file" class="form-control form-control-sm local-image"
                                data-max-size="10240" accept="image/*">
                            <div class="file-size-info">Max: 10MB</div>
                            <div class="preview-wrap"></div>
                        </div>
                        <div class="d-grid gap-1">
                            <button type="button" class="btn btn-success btn-sm local-save-btn">Save</button>
                            <button type="button" class="btn btn-secondary btn-sm local-cancel-btn">Cancel</button>
                        </div>
                    </div>
                `;

                const fileInput = col.querySelector('.local-image');

                fileInput.addEventListener('change', function() {
                    validateFileSize(this);
                });

                col.querySelector('.local-cancel-btn').addEventListener('click', () => col.remove());

                col.querySelector('.local-save-btn').addEventListener('click', async function() {
                    const name = col.querySelector('.local-name').value.trim();
                    const position = col.querySelector('.local-position').value.trim();

                    if (fileInput.files.length > 0 && !validateFileSize(fileInput)) return;

                    if (!name || !position || fileInput.files.length === 0) {
                        await showConfirmModal(
                            'Missing Data',
                            'Please provide the name, position, and image before saving.'
                        );
                        return;
                    }

                    try {
                        const addResp = await fetch(addUrl, {
                            method: 'POST',
                            headers: {
                                'X-CSRF-TOKEN': csrfToken,
                                'Accept': 'application/json'
                            }
                        });

                        const addJson = await addResp.json();

                        if (!addJson.success || typeof addJson.index === 'undefined') {
                            alert('Server failed to create new officer entry.');
                            return;
                        }

                        const newIndex = addJson.index;
                        const updateUrl = updateUrlTemplate.replace('__IDX__', newIndex);

                        const fd = new FormData();
                        fd.append('name', name);
                        fd.append('position', position);
                        fd.append('image', fileInput.files[0]);

                        const updResp = await fetch(updateUrl, {
                            method: 'POST',
                            headers: {
                                'X-CSRF-TOKEN': csrfToken,
                                'Accept': 'application/json'
                            },
                            body: fd
                        });

                        const updJson = await updResp.json();

                        if (!updJson.success) {
                            alert(updJson.message || 'Failed to save officer.');
                            return;
                        }

                        const serverCard = buildServerOfficerCard(newIndex, updJson.officer || {
                            name,
                            position,
                            image: ''
                        });

                        col.replaceWith(serverCard);

                        serverCard.scrollIntoView({
                            behavior: 'smooth',
                            block: 'center'
                        });
                    } catch (err) {
                        console.error(err);
                        alert('Network error while saving officer.');
                    }
                });

                return col;
            }

            (function initServerOfficerCards() {
                const serverCols = Array.from(officersContainer.querySelectorAll('.officer-card'));

                serverCols.forEach((col, idx) => {
                    const nameInput = col.querySelector('input[name="name"]');
                    const posInput = col.querySelector('input[name="position"]');
                    const previewImg = col.querySelector('img');

                    const name = nameInput ? nameInput.value : '';
                    const position = posInput ? posInput.value : '';
                    const image = previewImg ? getImagePathFromSrc(previewImg.getAttribute('src')) : '';

                    col.replaceWith(buildServerOfficerCard(idx, {
                        name,
                        position,
                        image
                    }));
                });
            })();

            addBtn.addEventListener('click', function(e) {
                e.preventDefault();

                const local = buildLocalOfficerCard();
                officersContainer.appendChild(local);

                local.scrollIntoView({
                    behavior: 'smooth',
                    block: 'center'
                });
            });
        });
    </script>
@endsection
