@extends('layouts.app')

@section('title', 'Hole-In-One')

@push('styles')
    <link href="{{ asset('css/holeinone.css') }}" rel="stylesheet">
@endpush

@section('content')
    <div class="container-fluid custom-bg d-flex align-items-center p-0">
        <h1 class="text-white custom-title m-0">HOLE-IN-ONE</h1>
    </div>

    @php
        use Illuminate\Support\Facades\DB;
        $couples = DB::table('players_couples')->get();
        $langer = DB::table('players_langer')->get();
    @endphp

    <div class="container my-5">
        <div class="row g-4">

            <!-- Couples Table -->
            <div class="col-md-6">
                <div class="card shadow-lg border-0">
                    <div class="card-header bg-primary text-white text-center fw-bold fs-5">
                        <i class="bi bi-heart-fill me-2"></i> Couples
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table table-striped table-hover align-middle text-center sortable-table">
                                <thead class="table-light">
                                    <tr>
                                        <th>First Name <i class="bi bi-arrow-down-up sort-icon"></i></th>
                                        <th>Last Name <i class="bi bi-arrow-down-up sort-icon"></i></th>
                                        <th>Hole # <i class="bi bi-arrow-down-up sort-icon"></i></th>
                                        <th>Date <i class="bi bi-arrow-down-up sort-icon"></i></th>
                                    </tr>
                                </thead>
                                <tbody>
                                <tbody>
                                    @foreach ($couples as $player)
                                        <tr>
                                            <td data-label="First Name">{{ $player->first_name }}</td>
                                            <td data-label="Last Name">{{ $player->last_name }}</td>
                                            <td data-label="Hole #">{{ $player->hole_number }}</td>
                                            <td data-label="Date">{{ $player->date }}</td>
                                        </tr>
                                    @endforeach
                                </tbody>

                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Langer Table -->
            <div class="col-md-6">
                <div class="card shadow-lg border-0">
                    <div class="card-header bg-success text-white text-center fw-bold fs-5">
                        <i class="bi bi-flag-fill me-2"></i> Langer
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table table-striped table-hover align-middle text-center sortable-table">
                                <thead class="table-light">
                                    <tr>
                                        <th>First Name <i class="bi bi-arrow-down-up sort-icon"></i></th>
                                        <th>Last Name <i class="bi bi-arrow-down-up sort-icon"></i></th>
                                        <th>Hole # <i class="bi bi-arrow-down-up sort-icon"></i></th>
                                        <th>Date <i class="bi bi-arrow-down-up sort-icon"></i></th>
                                    </tr>
                                </thead>
                                <tbody>
                                <tbody>
                                    @foreach ($langer as $player)
                                        <tr>
                                            <td data-label="First Name">{{ $player->first_name }}</td>
                                            <td data-label="Last Name">{{ $player->last_name }}</td>
                                            <td data-label="Hole #">{{ $player->hole_number }}</td>
                                            <td data-label="Date">{{ $player->date }}</td>
                                        </tr>
                                    @endforeach
                                </tbody>

                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </div>
@endsection
