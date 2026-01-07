@extends('layouts.app')

@section('title', 'Minutes of the Annual Stock Holding Meeting')

@push('styles')
    <link href="{{ asset('css/repetitiveDocs.css') }}" rel="stylesheet">
    <link href="{{ asset('images/RivieraHeaderLogo3.png') }}" rel="icon">
@endpush

@section('content')
    <div class="container-fluid custom-bg d-flex align-items-center p-0">
        <h1 class="text-white custom-title m-0">CORPORATE GOVERNANCE</h1>
    </div>

    <!-- Background wrapper only outside container -->
    <div class="custom-bg-wrapper py-5">
        <div class="container">
            <h2 class="custom-label text-center">MINUTES OF THE ANNUAL STOCK HOLDING MEETING</h2>

            <div class="d-flex justify-content-center">
                <div class="year-container shadow bg-white rounded p-3">
                    <div class="table-wrapper">
                        <table class="table table-bordered table-hover text-center mb-0 align-middle">
                            <thead class="table-header">
                                <tr>
                                    <th scope="col">📄 Meeting Date</th>
                                </tr>
                            </thead>

                            <tbody>
                                @foreach ($documents as $doc)
                                    <tr>
                                        <td>
                                            <a href="{{ asset('storage/' . $doc->file_path) }}" target="_blank"
                                                class="year-link">
                                                {{ $doc->formatted_date }}
                                            </a>
                                        </td>
                                    </tr>
                                @endforeach

                                @if ($documents->isEmpty())
                                    <tr>
                                        <td class="text-muted">No available documents.</td>
                                    </tr>
                                @endif
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
