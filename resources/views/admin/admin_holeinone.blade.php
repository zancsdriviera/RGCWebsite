@extends('admin.layout')
@section('title', 'Hole-In-One Editor')

@section('content')
    <div class="container-fluid">
        <h2 class="mb-4">Hole-In-One</h2>

        @if (session('success'))
            <div class="alert alert-success">{{ session('success') }}</div>
        @endif

        @if (session('error'))
            <div class="alert alert-danger">{{ session('error') }}</div>
        @endif

        @if ($errors->any())
            <div class="alert alert-danger">
                <ul class="mb-0">
                    @foreach ($errors->all() as $err)
                        <li>{{ $err }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <div class="row g-4">
            {{-- Couples Section --}}
            <div class="col-md-6">
                <div class="card shadow-sm p-4 mb-4">
                    <h5 class="text-primary fw-bold mb-3">
                        <i class="bi bi-flag-fill me-2"></i> Couples
                    </h5>

                    <form action="{{ route('admin.holeinone.store', 'couples') }}" method="POST">
                        @csrf
                        <div class="row g-3">
                            <div class="col-md-6">
                                <label class="form-label">First Name</label>
                                <input type="text" name="first_name" class="form-control" required
                                    value="{{ old('first_name') }}">
                            </div>
                            <div class="col-md-6">
                                <label class="form-label">Last Name</label>
                                <input type="text" name="last_name" class="form-control" required
                                    value="{{ old('last_name') }}">
                            </div>
                            <div class="col-md-6">
                                <label class="form-label">Hole #</label>
                                <input type="number" name="hole_number" class="form-control" required min="1"
                                    max="18" value="{{ old('hole_number') }}">
                            </div>
                            <div class="col-md-6">
                                <label class="form-label">Date</label>
                                <input type="date" name="date" class="form-control" required
                                    value="{{ old('date') }}">
                            </div>
                        </div>
                        <button type="submit" class="btn btn-primary mt-3">Add Record</button>
                    </form>

                    <hr>

                    <table class="table table-striped table-hover mt-3 text-center">
                        <thead>
                            <tr>
                                <th>First Name</th>
                                <th>Last Name</th>
                                <th>Hole #</th>
                                <th>Date</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($couples as $player)
                                <tr>
                                    <td>{{ $player->first_name }}</td>
                                    <td>{{ $player->last_name }}</td>
                                    <td>{{ $player->hole_number }}</td>
                                    <td>{{ $player->date }}</td>
                                    <td>
                                        <button class="btn btn-sm btn-warning" data-bs-toggle="modal"
                                            data-bs-target="#editModal" data-id="{{ $player->id }}" data-type="couples"
                                            data-first_name="{{ $player->first_name }}"
                                            data-last_name="{{ $player->last_name }}"
                                            data-hole_number="{{ $player->hole_number }}"
                                            data-date="{{ $player->date }}">Edit</button>

                                        <form
                                            action="{{ route('admin.holeinone.destroy', ['type' => 'couples', 'id' => $player->id]) }}"
                                            method="POST" class="d-inline"
                                            onsubmit="return confirm('Delete this record?')">
                                            @csrf @method('DELETE')
                                            <button class="btn btn-sm btn-danger">Delete</button>
                                        </form>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>

            {{-- Langer Section --}}
            <div class="col-md-6">
                <div class="card shadow-sm p-4 mb-4">
                    <h5 class="text-success fw-bold mb-3">
                        <i class="bi bi-flag-fill me-2"></i> Langer
                    </h5>

                    <form action="{{ route('admin.holeinone.store', 'langer') }}" method="POST">
                        @csrf
                        <div class="row g-3">
                            <div class="col-md-6">
                                <label class="form-label">First Name</label>
                                <input type="text" name="first_name" class="form-control" required
                                    value="{{ old('first_name') }}">
                            </div>
                            <div class="col-md-6">
                                <label class="form-label">Last Name</label>
                                <input type="text" name="last_name" class="form-control" required
                                    value="{{ old('last_name') }}">
                            </div>
                            <div class="col-md-6">
                                <label class="form-label">Hole #</label>
                                <input type="number" name="hole_number" class="form-control" required min="1"
                                    max="18" value="{{ old('hole_number') }}">
                            </div>
                            <div class="col-md-6">
                                <label class="form-label">Date</label>
                                <input type="date" name="date" class="form-control" required
                                    value="{{ old('date') }}">
                            </div>
                        </div>
                        <button type="submit" class="btn btn-success mt-3">Add Record</button>
                    </form>

                    <hr>

                    <table class="table table-striped table-hover mt-3 text-center">
                        <thead>
                            <tr>
                                <th>First Name</th>
                                <th>Last Name</th>
                                <th>Hole #</th>
                                <th>Date</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($langer as $player)
                                <tr>
                                    <td>{{ $player->first_name }}</td>
                                    <td>{{ $player->last_name }}</td>
                                    <td>{{ $player->hole_number }}</td>
                                    <td>{{ $player->date }}</td>
                                    <td>
                                        <button class="btn btn-sm btn-warning" data-bs-toggle="modal"
                                            data-bs-target="#editModal" data-id="{{ $player->id }}" data-type="langer"
                                            data-first_name="{{ $player->first_name }}"
                                            data-last_name="{{ $player->last_name }}"
                                            data-hole_number="{{ $player->hole_number }}"
                                            data-date="{{ $player->date }}">Edit</button>

                                        <form
                                            action="{{ route('admin.holeinone.destroy', ['type' => 'langer', 'id' => $player->id]) }}"
                                            method="POST" class="d-inline"
                                            onsubmit="return confirm('Delete this record?')">
                                            @csrf @method('DELETE')
                                            <button class="btn btn-sm btn-danger">Delete</button>
                                        </form>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

    {{-- Edit Modal --}}
    <div class="modal fade" id="editModal" tabindex="-1" aria-labelledby="editModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <form id="editForm" method="POST">
                @csrf
                @method('PUT')
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="editModalLabel">Edit Record</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <input type="hidden" id="editType" name="type">
                        <div class="mb-3">
                            <label class="form-label">First Name</label>
                            <input type="text" id="editFirstName" name="first_name" class="form-control" required>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Last Name</label>
                            <input type="text" id="editLastName" name="last_name" class="form-control" required>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Hole #</label>
                            <input type="number" id="editHoleNumber" name="hole_number" class="form-control" required
                                min="1" max="18">
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Date</label>
                            <input type="date" id="editDate" name="date" class="form-control" required>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                        <button type="submit" class="btn btn-success">Save Changes</button>
                    </div>
                </div>
            </form>
        </div>
    </div>

    <script>
        const editModal = document.getElementById('editModal');
        editModal.addEventListener('show.bs.modal', function(event) {
            const button = event.relatedTarget;
            const id = button.getAttribute('data-id');
            const type = button.getAttribute('data-type');
            const firstName = button.getAttribute('data-first_name');
            const lastName = button.getAttribute('data-last_name');
            const holeNumber = button.getAttribute('data-hole_number');
            const date = button.getAttribute('data-date');

            const form = document.getElementById('editForm');
            // Use route helper with placeholders
            form.action = "{{ route('admin.holeinone.update', ['type' => '__TYPE__', 'id' => '__ID__']) }}"
                .replace('__TYPE__', type)
                .replace('__ID__', id);

            document.getElementById('editType').value = type;
            document.getElementById('editFirstName').value = firstName;
            document.getElementById('editLastName').value = lastName;
            document.getElementById('editHoleNumber').value = holeNumber;
            document.getElementById('editDate').value = date;
        });
    </script>


    <style>
        .form-label {
            font-weight: 600;
        }
    </style>
@endsection
