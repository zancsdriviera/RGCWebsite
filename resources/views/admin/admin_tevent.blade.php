@extends('admin.layout')

@section('title', 'Tournament & Event')

@section('content')
    <div class="container-fluid px-4 py-3">

        <h2 class="fw-bold">Tournament Events</h2>

        <button class="btn btn-success mb-2" data-bs-toggle="modal" data-bs-target="#tournamentModal" onclick="openAddModal()">
            <i class="bi bi-plus-circle"></i> Add Tournament Event
        </button>

        @if (session('success'))
            <div class="alert alert-success">{{ session('success') }}</div>
        @endif

        <table class="table table-bordered text-center table-striped">
            <thead class="table-dark">
                <tr>
                    <th>Main Image</th>
                    <th>QR Image</th>
                    <th>Title</th>
                    <th>Event Date</th>
                    <th style="width:250px;">Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($events->sortByDesc('event_date') as $event)
                    <tr>
                        <td>
                            @if ($event->main_image)
                                <img src="{{ asset('storage/' . $event->main_image) }}" width="130" height="80"
                                    style="border:1px solid black">
                            @endif
                        </td>
                        <td>
                            @if ($event->secondary_image)
                                <img src="{{ asset('storage/' . $event->secondary_image) }}" width="80" height="80"
                                    style="border:1px solid black">
                            @endif
                        </td>
                        <td>{{ $event->title }}</td>
                        <td>{{ \Carbon\Carbon::parse($event->event_date)->format('F d, Y') }}</td>
                        <td>
                            <button class="btn btn-primary btn-sm" data-bs-toggle="modal" data-bs-target="#tournamentModal"
                                onclick="openEditModal({{ $event }})">
                                <i class="bi bi-pencil-square"></i> Edit
                            </button>
                            <button class="btn btn-danger btn-sm" data-bs-toggle="modal"
                                data-bs-target="#deleteModal{{ $event->id }}">
                                <i class="bi bi-trash"></i> Delete
                            </button>

                            <div class="modal fade" id="deleteModal{{ $event->id }}" tabindex="-1" aria-hidden="true">
                                <div class="modal-dialog">
                                    <div class="modal-content">
                                        <div class="modal-header bg-danger text-white">
                                            <h5 class="modal-title">Confirm Delete Tournament Event</h5>
                                            <button type="button" class="btn-close btn-close-white"
                                                data-bs-dismiss="modal"></button>
                                        </div>
                                        <div class="modal-body">
                                            Are you sure you want to delete "{{ $event->title }}"?
                                        </div>
                                        <div class="modal-footer">
                                            <form method="POST"
                                                action="{{ route('admin.tournaments.destroy', $event->id) }}">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn btn-danger">Delete</button>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            </div>

                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>

        @if ($events->hasPages())
            <div class="d-flex justify-content-end mt-3">
                <nav>
                    <ul class="pagination pagination-sm mb-0">
                        {{-- Previous Page Link --}}
                        @if ($events->onFirstPage())
                            <li class="page-item disabled"><span class="page-link">&laquo;</span></li>
                        @else
                            <li class="page-item"><a class="page-link" href="{{ $events->previousPageUrl() }}">&laquo;</a>
                            </li>
                        @endif

                        {{-- Page Numbers --}}
                        @foreach ($events->getUrlRange(1, $events->lastPage()) as $page => $url)
                            <li class="page-item {{ $events->currentPage() == $page ? 'active' : '' }}">
                                <a class="page-link" href="{{ $url }}">{{ $page }}</a>
                            </li>
                        @endforeach

                        {{-- Next Page Link --}}
                        @if ($events->hasMorePages())
                            <li class="page-item"><a class="page-link" href="{{ $events->nextPageUrl() }}">&raquo;</a></li>
                        @else
                            <li class="page-item disabled"><span class="page-link">&raquo;</span></li>
                        @endif
                    </ul>
                </nav>
            </div>
        @endif

    </div>

    <!-- Add/Edit Modal -->
    <div class="modal fade" id="tournamentModal">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <form id="tournamentForm" method="POST" enctype="multipart/form-data">
                    @csrf
                    <input type="hidden" name="_method" id="formMethod" value="POST">
                    <input type="hidden" name="event_id" id="eventId">
                    <div class="modal-header btn-success text-white">
                        <h5 class="modal-title" id="modalTitle"></h5>
                        <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"></button>
                    </div>
                    <div class="modal-body">
                        <div class="mb-2">
                            <label>Title</label>
                            <input type="text" class="form-control" name="title" id="title" required>
                        </div>
                        <div class="mb-2">
                            <label>Event Date</label>
                            <input type="date" class="form-control" name="event_date" id="event_date" required>
                        </div>
                        <div class="mb-2">
                            <label>Main Image</label>
                            <input type="file" class="form-control" name="main_image">
                        </div>
                        <div class="mb-2">
                            <label>QR Scanner Image</label>
                            <input type="file" class="form-control" name="secondary_image">
                        </div>

                        <div class="mb-2">
                            <button type="button" class="btn btn-success mb-2" id="addRow">Add Details</button>
                        </div>

                        <div id="subtitleContainer">
                            <div class="row mb-2 subtitle-row">
                                <div class="col-md-5">
                                    <input type="text" class="form-control subtitle-input" name="subtitles[]"
                                        placeholder="Subtitle" required>
                                </div>
                                <div class="col-md-7">
                                    <textarea class="form-control text-input" name="texts[]" rows="2" placeholder="Details" required></textarea>
                                </div>
                                <div class="col-md-12 mt-1">
                                    <button type="button" class="btn btn-danger remove-row"
                                        style="display:none;">Remove</button>
                                </div>
                            </div>
                        </div>

                        <div class="mb-2">
                            <label>Terms Of Competition</label>
                            <input type="file" class="form-control" name="file1">
                        </div>
                        <div class="mb-2">
                            <label>Club Advisory</label>
                            <input type="file" class="form-control" name="file2">
                        </div>

                    </div>
                    <div class="modal-footer">
                        <button type="submit" class="btn btn-success">Save</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <script>
        function openAddModal() {
            document.getElementById('modalTitle').innerText = 'Add Tournament Event';
            document.getElementById('tournamentForm').action = '{{ route('admin.tournaments.store') }}';
            document.getElementById('formMethod').value = 'POST';
            document.getElementById('title').value = '';
            document.getElementById('event_date').value = '';
            document.getElementById('eventId').value = '';
            document.getElementById('subtitleContainer').innerHTML = document.querySelector('.subtitle-row').outerHTML;
        }

        function openEditModal(event) {
            document.getElementById('modalTitle').innerText = 'Edit Tournament Event';
            document.getElementById('tournamentForm').action = '/admin/tournaments/' + event.id;
            document.getElementById('formMethod').value = 'PUT';
            document.getElementById('eventId').value = event.id;
            document.getElementById('title').value = event.title;
            document.getElementById('event_date').value = event.event_date;

            const container = document.getElementById('subtitleContainer');
            container.innerHTML = '';
            if (event.subtitles_texts) {
                JSON.parse(event.subtitles_texts).forEach((row, i) => {
                    const html = `<div class="row mb-2 subtitle-row">
                <div class="col-md-5">
                    <input type="text" class="form-control subtitle-input" name="subtitles[]" value="${row.subtitle}" required>
                </div>
                <div class="col-md-7">
                    <textarea class="form-control text-input" name="texts[]" rows="2" required>${row.text}</textarea>
                </div>
                <div class="col-md-12 mt-1">
                    <button type="button" class="btn btn-danger remove-row" ${i===0?'style="display:none;"':''}>Remove</button>
                </div>
            </div>`;
                    container.insertAdjacentHTML('beforeend', html);
                });
            }
        }

        document.getElementById('addRow').addEventListener('click', function() {
            const container = document.getElementById('subtitleContainer');
            const newRow = container.querySelector('.subtitle-row').cloneNode(true);
            newRow.querySelector('.subtitle-input').value = '';
            newRow.querySelector('.text-input').value = '';
            newRow.querySelector('.remove-row').style.display = 'inline-block';
            container.appendChild(newRow);
            newRow.querySelector('.remove-row').addEventListener('click', function() {
                newRow.remove();
            });
        });
    </script>
@endsection
