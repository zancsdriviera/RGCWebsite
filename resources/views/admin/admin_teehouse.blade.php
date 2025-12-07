@extends('admin.layout')
@section('title', 'Teehouse')

@section('content')
    <div class="container-fluid px-4 py-3">
        <h3 class="fw-bold mb-4">Teehouse</h3>


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
                                <label>Upload images</label>
                                <input type="file" name="images[]" multiple class="form-control mb-2" required>
                                <button class="btn btn-primary btn-sm"><i
                                        class="bi bi-file-earmark-arrow-up me-2"></i>Upload</button>
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
                                            {{-- Update --}}
                                            <button class="btn btn-warning btn-sm w-100 mt-2" data-bs-toggle="modal"
                                                data-bs-target="#updateModal{{ $key }}{{ $i }}">
                                                <i class="bi bi-arrow-repeat"></i> Update
                                            </button>

                                            {{-- Delete --}}
                                            <button class="btn btn-danger btn-sm w-100 mt-1" data-bs-toggle="modal"
                                                data-bs-target="#deleteModal{{ $key }}{{ $i }}">
                                                <i class="bi bi-trash me-1"></i> Delete
                                            </button>
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
                                                    <div class="modal-header bg-primary text-white">
                                                        <h5 class="modal-title">Update image</h5>
                                                        <button class="btn-close btn-close-white"
                                                            data-bs-dismiss="modal"></button>
                                                    </div>
                                                    <div class="modal-body">
                                                        <img src="{{ asset('storage/' . $img) }}" class="img-fluid mb-2"
                                                            style="width:100%; object-fit:cover;">
                                                        <input type="file" name="image" required class="form-control">
                                                    </div>
                                                    <div class="modal-footer">
                                                        <button class="btn btn-success"><i
                                                                class="bi bi-check2-square me-2"></i>Save Changes</button>
                                                    </div>
                                                </form>
                                            </div>
                                        </div>
                                    </div>

                                    {{-- Delete Modal --}}
                                    <div class="modal fade" id="deleteModal{{ $key }}{{ $i }}"
                                        tabindex="-1">
                                        <div class="modal-dialog modal-dialog-centered">
                                            <div class="modal-content">
                                                <div class="modal-header bg-danger text-white">
                                                    <h5 class="modal-title">Delete Image</h5>
                                                    <button class="btn-close btn-close-white"
                                                        data-bs-dismiss="modal"></button>
                                                </div>
                                                <div class="modal-body text-center">
                                                    Are you sure you want to delete this image?
                                                    <img src="{{ asset('storage/' . $img) }}" class="img-fluid mt-2"
                                                        style="width:100%; object-fit:cover;">
                                                </div>
                                                <div class="modal-footer">

                                                    {{-- Delete button triggers form submission via JS --}}
                                                    <button class="btn btn-success"
                                                        onclick="document.getElementById('deleteForm{{ $key }}{{ $i }}').submit();"><i
                                                            class="bi bi-check2-square me-2"></i>Confirm</button>
                                                </div>
                                                {{-- Hidden form --}}
                                                <form id="deleteForm{{ $key }}{{ $i }}"
                                                    action="{{ route('admin.teehouse.remove_image', [$key, $i]) }}"
                                                    method="POST" style="display:none;">
                                                    @csrf
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
    </div>
    <script>
        document.addEventListener('DOMContentLoaded', () => {
            @if (session('success'))
                const modalEl = document.getElementById('successModal');
                const modalBody = modalEl.querySelector('.modal-body');
                modalBody.textContent = "{{ session('success') }}";
                modalBody.style.color = 'green'; // optional: color

                const modal = new bootstrap.Modal(modalEl);
                modal.show();

                // Auto-close after 1.5s
                setTimeout(() => modal.hide(), 5000);
            @endif
        });
    </script>
@endsection
