<!DOCTYPE html>
<html>

<head>
    <title>Admin - Manage Contents</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">

    <style>
        /* Page layout */
        :root {
            --accent: #6f42c1;
            --accent-2: #4f46e5;
            --muted: #6c757d;
            --card-bg: #ffffff;
            --glass: rgba(255, 255, 255, 0.75);
        }

        html,
        body {
            height: 100%;
        }

        body {
            background: linear-gradient(160deg, #f4f7ff 0%, #eef6ff 40%, #ffffff 100%);
            font-family: Inter, system-ui, -apple-system, "Segoe UI", Roboto, "Helvetica Neue", Arial;
            color: #1f2937;
            padding: 36px;
        }

        /* Header */
        .page-header {
            display: flex;
            align-items: center;
            justify-content: space-between;
            gap: 16px;
            margin-bottom: 24px;
        }

        .page-title {
            margin: 0;
            font-size: 24px;
            font-weight: 700;
            letter-spacing: -0.2px;
            color: #0f172a;
            display: flex;
            align-items: center;
            gap: 12px;
        }

        .page-title .badge {
            font-weight: 600;
            background: linear-gradient(90deg, var(--accent), var(--accent-2));
            color: white;
            padding: 6px 10px;
            border-radius: 8px;
            box-shadow: 0 6px 18px rgba(79, 70, 229, 0.12);
            font-size: 12px;
        }

        /* Top controls */
        .top-controls {
            display: flex;
            gap: 8px;
            align-items: center;
        }

        .btn-primary.custom {
            background: linear-gradient(90deg, var(--accent), var(--accent-2));
            border: none;
            box-shadow: 0 6px 18px rgba(79, 70, 229, 0.12);
            padding: 8px 14px;
            border-radius: 10px;
        }

        /* Cards (kept custom look) */
        .card {
            border: none;
            border-radius: 12px;
            background: linear-gradient(180deg, rgba(255, 255, 255, 0.85), rgba(250, 250, 255, 0.95));
            box-shadow: 0 8px 30px rgba(15, 23, 42, 0.04);
            overflow: hidden;
            transition: transform .18s ease, box-shadow .18s ease;
            height: 100%;
        }

        .card-body {
            padding: 18px;
            display: flex;
            flex-direction: column;
            justify-content: space-between;
            gap: 12px;
        }

        .card h5 {
            font-size: 20px;
            margin-bottom: 10px;
            color: #0f172a;
        }

        .thumb {
            width: 100%;
            max-width: 220px;
            height: auto;
            object-fit: cover;
            border-radius: 10px;
            border: 1px solid rgba(15, 23, 42, 0.06);
            background: #f8fafc;
        }

        .meta-small {
            font-size: 12px;
            color: var(--muted);
        }

        .card .actions {
            margin-top: 12px;
            display: flex;
            gap: 8px;
            align-items: center;
        }

        /* Replace bootstrap small buttons with more pill-like look */
        .btn-sm {
            border-radius: 10px;
            padding: 6px 10px;
            font-weight: 600;
            letter-spacing: 0.2px;
        }

        .btn-warning {
            border: none;
            background: #f59e0b;
            color: #05202b;
        }

        .btn-danger {
            border: none;
            background: #ef4444;
            color: white;
        }

        /* Modal custom */
        .modal-backdrop.show {
            background-color: rgba(2, 6, 23, 0.45);
            backdrop-filter: blur(2px);
        }

        .modal-content {
            border-radius: 14px;
            border: none;
            overflow: hidden;
            background: linear-gradient(180deg, rgba(255, 255, 255, 0.95), var(--glass));
            box-shadow: 0 20px 50px rgba(8, 15, 48, 0.12);
        }

        .modal-header {
            padding: 18px 22px;
            border-bottom: 0;
            background: linear-gradient(90deg, rgba(111, 66, 193, 0.06), rgba(79, 70, 229, 0.03));
            display: flex;
            align-items: center;
            justify-content: space-between;
        }

        .modal-title {
            font-size: 18px;
            font-weight: 700;
            color: #0b1220;
            margin: 0;
        }

        .modal-body {
            padding: 20px 22px;
        }

        .modal-footer {
            padding: 16px 22px;
            border-top: 0;
            background: linear-gradient(180deg, rgba(255, 255, 255, 0.98), rgba(250, 250, 255, 0.99));
            display: flex;
            justify-content: flex-end;
            gap: 10px;
        }

        /* Form fields */
        .modal-body h4 {
            margin-top: 6px;
            margin-bottom: 8px;
            font-size: 14px;
            color: #1f2937;
            font-weight: 700;
        }

        .form-control {
            border-radius: 10px;
            padding: 10px 12px;
            border: 1px solid rgba(15, 23, 42, 0.08);
            box-shadow: none;
            transition: box-shadow .12s ease, border-color .12s ease, transform .08s ease;
        }

        .form-control:focus {
            outline: none;
            border-color: var(--accent-2);
            box-shadow: 0 6px 18px rgba(79, 70, 229, 0.08);
            transform: translateY(-1px);
        }

        input[type="file"].form-control {
            padding: 7px 10px;
            height: auto;
        }

        small img {
            vertical-align: middle;
            margin-left: 8px;
            border-radius: 8px;
            border: 1px solid rgba(15, 23, 42, 0.06);
        }

        /* Responsive tweaks */
        @media (max-width: 992px) {
            body {
                padding: 22px;
            }

            .thumb {
                max-width: 180px;
            }
        }

        @media (max-width: 768px) {
            body {
                padding: 18px;
            }

            .thumb {
                max-width: 100%;
            }

            .card-body {
                padding: 14px;
            }

            .card h5 {
                font-size: 15px;
            }

            /* stack actions on mobile */
            .card .actions {
                flex-direction: column;
                align-items: stretch;
            }

            .card .actions .btn {
                width: 100%;
            }
        }

        @media (max-width: 420px) {
            .page-header {
                flex-direction: column;
                align-items: flex-start;
                gap: 12px;
            }

            .top-controls {
                width: 100%;
                justify-content: space-between;
            }
        }
    </style>
</head>

<body>
    <div class="page-header">
        <h1 class="page-title">
            Admin Panel
            <span class="badge">Manage</span>
        </h1>

        <div class="top-controls">
            <!-- Button to trigger modal -->
            <button class="btn btn-primary custom" data-bs-toggle="modal" data-bs-target="#createModal">
                + Add Courses
            </button>
        </div>
    </div>

    <!-- Create Modal (use fullscreen on small devices) -->
    <div class="modal fade" id="createModal" tabindex="-1">
        <div class="modal-dialog modal-lg modal-dialog-centered modal-fullscreen-sm-down">
            <form method="POST" action="{{ route('courses.store') }}" enctype="multipart/form-data"
                class="modal-content">
                @csrf
                <div class="modal-header">
                    <h2 class="modal-title">Add Course</h2>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <h4>Langer Section</h4>
                    <input type="text" name="langer_Mtitle" class="form-control mb-2" placeholder="Title" required>
                    <input type="file" name="langer_Mimage" class="form-control mb-3" accept="image/*">

                    <h4>Couples Section</h4>
                    <input type="text" name="couples_Mtitle" class="form-control mb-2" placeholder="Title" required>
                    <input type="file" name="couples_Mimage" class="form-control" accept="image/*">
                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-success">Create</button>
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                </div>
            </form>
        </div>
    </div>

    <!-- List of Posts: switch to bootstrap grid for responsiveness -->
    <div class="container-fluid p-0">
        <div class="row g-3">
            @foreach ($courses as $course)
                <div class="col-12 col-sm-6 col-lg-4">
                    <div class="card mb-0 h-100">
                        <div class="card-body">
                            <div>
                                <h5 class="mb-2">{{ $course->langer_Mtitle }}</h5>

                                <div class="d-flex flex-column flex-sm-row align-items-start gap-3 mb-3">
                                    <div class="flex-shrink-0">
                                        @if ($course->langer_Mimage)
                                            <img class="thumb img-fluid"
                                                src="{{ asset('storage/' . $course->langer_Mimage) }}"
                                                alt="langer image">
                                        @else
                                            <div class="thumb d-flex align-items-center justify-content-center text-muted"
                                                style="max-width:220px;">
                                                No image
                                            </div>
                                        @endif
                                    </div>
                                </div>

                                <h5 class="mb-2">{{ $course->couples_Mtitle }}</h5>

                                <div class="d-flex flex-column flex-sm-row align-items-start gap-3">
                                    <div class="flex-shrink-0">
                                        @if ($course->couples_Mimage)
                                            <img class="thumb img-fluid"
                                                src="{{ asset('storage/' . $course->couples_Mimage) }}"
                                                alt="couples image">
                                        @else
                                            <div class="thumb d-flex align-items-center justify-content-center text-muted"
                                                style="max-width:220px;">
                                                No image
                                            </div>
                                        @endif
                                    </div>
                                </div>
                            </div>

                            <!-- Edit and Delete Buttons -->
                            <div class="actions mt-3">
                                <button class="btn btn-warning btn-sm me-2" data-bs-toggle="modal"
                                    data-bs-target="#editModal{{ $course->id }}">Edit</button>

                                <form method="POST" action="{{ route('courses.destroy', $course) }}" class="d-inline">
                                    @csrf
                                    @method('DELETE')
                                    <button class="btn btn-danger btn-sm"
                                        onclick="return confirm('Delete this post?')">Delete</button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Edit Modal (fullscreen on small devices) -->
                <div class="modal fade" id="editModal{{ $course->id }}" tabindex="-1">
                    <div class="modal-dialog modal-lg modal-dialog-centered modal-fullscreen-sm-down">
                        <form method="POST" action="{{ route('courses.update', $course) }}"
                            enctype="multipart/form-data" class="modal-content">
                            @csrf
                            @method('PUT')
                            <div class="modal-header">
                                <h5 class="modal-title">Edit Course</h5>
                                <button type="button" class="btn-close" data-bs-dismiss="modal"
                                    aria-label="Close"></button>
                            </div>

                            <div class="modal-body">
                                <!--Langer-->
                                <h4>Langer Section</h4>
                                <input type="text" name="langer_Mtitle" class="form-control mb-2"
                                    value="{{ $course->langer_Mtitle }}" required>
                                <input type="file" name="langer_Mimage" class="form-control mb-2" accept="image/*">
                                @if ($course->langer_Mimage)
                                    <small class="meta-small">Current image:
                                        <img src="{{ asset('storage/' . $course->langer_Mimage) }}" width="100"
                                            alt="current langer">
                                    </small>
                                @endif

                                <div class="mt-3"></div>

                                <!--Couples-->
                                <h4>Couples Section</h4>
                                <input type="text" name="couples_Mtitle" class="form-control mb-2"
                                    value="{{ $course->couples_Mtitle }}" required>
                                <input type="file" name="couples_Mimage" class="form-control mb-2"
                                    accept="image/*">
                                @if ($course->couples_Mimage)
                                    <small class="meta-small">Current image:
                                        <img src="{{ asset('storage/' . $course->couples_Mimage) }}" width="100"
                                            alt="current couples">
                                    </small>
                                @endif
                            </div>

                            <div class="modal-footer">
                                <button type="submit" class="btn btn-primary">Update</button>
                                <button type="button" class="btn btn-secondary"
                                    data-bs-dismiss="modal">Cancel</button>
                            </div>
                        </form>
                    </div>
                </div>
            @endforeach
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>
