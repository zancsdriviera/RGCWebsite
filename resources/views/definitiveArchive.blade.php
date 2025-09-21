@extends('layouts.app')

@section('title', 'Definitive Information Statement')

@push('styles')
    <link href="{{ asset('css/repetitiveDocs.css') }}" rel="stylesheet">
@endpush
@section('content')
    <div class="container-fluid custom-bg d-flex align-items-center p-0">
        <h1 class="text-white custom-title m-0">CORPORATE GOVERNANCE</h1>
    </div>

    <!-- Background wrapper only outside container -->
    <div class="custom-bg-wrapper py-5">
        <div class="container">
            <h2 class="custom-label text-center">DEFINITIVE INFORMATION STATEMENT</h2>


            <div class="d-flex justify-content-center">
                <div class="year-container shadow bg-white rounded p-3">
                    <div class="table-wrapper">
                        <table class="table table-bordered table-hover text-center mb-0 align-middle">
                            <thead class="table-header">
                                <tr>
                                    <th scope="col">📄 Year</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td><a href="docs/2025.pdf" target="_blank" class="year-link">2025</a></td>
                                </tr>
                                <tr>
                                    <td><a href="docs/2024.pdf" target="_blank" class="year-link">2024</a></td>
                                </tr>
                                <tr>
                                    <td><a href="docs/2023.pdf" target="_blank" class="year-link">2023</a></td>
                                </tr>
                                <tr>
                                    <td><a href="docs/2022.pdf" target="_blank" class="year-link">2022</a></td>
                                </tr>
                                <tr>
                                    <td><a href="docs/2021.pdf" target="_blank" class="year-link">2021</a></td>
                                </tr>
                                <tr>
                                    <td><a href="docs/2020.pdf" target="_blank" class="year-link">2020</a></td>
                                </tr>
                                <tr>
                                    <td><a href="docs/2019.pdf" target="_blank" class="year-link">2019</a></td>
                                </tr>
                                <tr>
                                    <td><a href="docs/2018.pdf" target="_blank" class="year-link">2018</a></td>
                                </tr>
                                <tr>
                                    <td><a href="docs/2017.pdf" target="_blank" class="year-link">2017</a></td>
                                </tr>
                                <tr>
                                    <td><a href="docs/2016.pdf" target="_blank" class="year-link">2016</a></td>
                                </tr>
                                <tr>
                                    <td><a href="docs/2015.pdf" target="_blank" class="year-link">2015</a></td>
                                </tr>
                                <tr>
                                    <td><a href="docs/2014.pdf" target="_blank" class="year-link">2014</a></td>
                                </tr>
                                <tr>
                                    <td><a href="docs/2013.pdf" target="_blank" class="year-link">2013</a></td>
                                </tr>
                                <tr>
                                    <td><a href="docs/2012.pdf" target="_blank" class="year-link">2012</a></td>
                                </tr>
                                <tr>
                                    <td><a href="docs/2011.pdf" target="_blank" class="year-link">2011</a></td>
                                </tr>
                                <tr>
                                    <td><a href="docs/2010.pdf" target="_blank" class="year-link">2010</a></td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <style>
        /* Background wrapper only around content */
        .custom-bg-wrapper {
            background: url('images/samplefield.png') no-repeat center center;
            background-size: cover;
            /* always fills width */
            background-attachment: fixed;
            background-color: #e6f4ea;
            /* fallback */
        }


        /* Optional overlay */
        .custom-bg-wrapper::before {
            content: "";
            position: absolute;
            inset: 0;
            background: rgba(255, 255, 255, 0.041);
            z-index: 0;
        }

        .custom-bg-wrapper .container {
            position: relative;
            z-index: 1;
        }

        /* Paper-like container */
        .year-container {
            width: 100%;
            max-width: 600px;
            border: 1px solid #ddd;
        }

        /* Scrollable table */
        .table-wrapper {
            max-height: 420px;
            overflow-y: auto;
        }

        /* Header styling */
        .table-header th {
            background: #0d6efd;
            color: #fff;
            font-size: 1.2rem;
            font-weight: 700;
            letter-spacing: 1px;
        }

        /* Year links */
        .year-link {
            display: block;
            font-size: 1.1rem;
            font-weight: 600;
            color: #212529;
            text-decoration: none;
            transition: 0.2s;
            padding: 6px 0;
        }

        .year-link:hover {
            color: #0d6efd;
            text-decoration: underline;
        }

        .custom-label {
            text-align: center;
            margin-left: auto;
            margin-right: auto;
            display: block;
            color: white;
            font-family: "Anton", Arial, sans-serif;
            font-size: 3rem !important
        }
    </style>
@endsection
