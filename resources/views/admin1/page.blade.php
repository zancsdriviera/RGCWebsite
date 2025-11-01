@extends('admin.layout')

@section('title', isset($page) ? $page : 'Page Editor')

@section('content')
    <div class="container-fluid">
        @if (session('success'))
            <div class="alert alert-success">{{ session('success') }}</div>
        @endif

        <div class="row g-4">
            <div class="col-12">
                <div class="card shadow-sm">
                    <div class="card-body">
                        <h5 class="card-title mb-3 text-capitalize">{{ $page }} Page Elements</h5>

                        <div class="row">
                            @foreach ($contents as $key => $content)
                                <div class="col-md-6 mb-3">
                                    <form method="POST" action="{{ route('admin.update', $key) }}"
                                        enctype="multipart/form-data" class="p-2 border rounded bg-white">
                                        @csrf
                                        <div class="d-flex justify-content-between align-items-center mb-2">
                                            <strong class="text-muted">{{ $key }}</strong>
                                            <small class="text-muted">{{ $content->type }}</small>
                                        </div>

                                        @if ($content->type === 'image')
                                            <div class="mb-2 text-center">
                                                <img src="{{ $content->value ? asset('storage/' . $content->value) : asset('images/placeholder.png') }}"
                                                    class="img-fluid img-preview rounded"
                                                    style="max-height:160px; object-fit:cover;">
                                            </div>
                                            <div class="mb-2">
                                                <input type="file" name="value">
                                            </div>
                                            <div class="d-flex gap-2">
                                                <button class="btn btn-primary btn-sm">Upload</button>
                                                <a href="{{ url()->current() }}"
                                                    class="btn btn-outline-secondary btn-sm">Reset</a>
                                            </div>
                                        @else
                                            <div class="mb-2">
                                                <textarea name="value" rows="4" class="form-control">{{ old('value', $content->value) }}</textarea>
                                            </div>
                                            <div class="d-flex gap-2">
                                                <button class="btn btn-success btn-sm">Save</button>
                                                <a href="{{ url()->current() }}"
                                                    class="btn btn-outline-secondary btn-sm">Reset</a>
                                            </div>
                                        @endif
                                    </form>
                                </div>
                            @endforeach
                        </div> {{-- row --}}
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
