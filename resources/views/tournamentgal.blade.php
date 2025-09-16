@extends('layouts.app')

@section('title', 'Tournament Gallery')

@push('styles')
    <link href="{{ asset('css/tournamentgal.css') }}" rel="stylesheet">
@endpush
@section('content')
    <div class="container-fluid custom-bg d-flex align-items-center p-0">
        <h1 class="text-white custom-title m-0">TOURNAMENT GALLERY</h1>
    </div>

    <section class="news-grid">
        <div class="grid" id="newsGrid">
            <!-- Add as many cards as you want -->
            <article class="news-card">
                <a class="card-link" href="#">
                    <div class="media">
                        <img src="{{ asset('images/COURSES/Couples/Couples1.jpg') }}" alt="Riviera golf course">
                    </div>
                    <div class="content">
                        <h3 class="title">2025 ICTSI PRADERA VERDE CHAMPIONSHIP</h3>
                        <time class="date">May 04, 2025</time>
                    </div>
                </a>
            </article>
            <article class="news-card">
                <a class="card-link" href="#">
                    <div class="media">
                        <img src="{{ asset('images/COURSES/Couples/Couples2.jpg') }}" alt="Riviera golf course">
                    </div>
                    <div class="content">
                        <h3 class="title">2025 RIVIERA QUALIFYING SCHOOL</h3>
                        <time class="date">June 04, 2025</time>
                    </div>
                </a>
            </article>
            <article class="news-card">
                <a class="card-link" href="#">
                    <div class="media">
                        <img src="{{ asset('images/COURSES/Couples/Couples3.jpg') }}" alt="Riviera golf course">
                    </div>
                    <div class="content">
                        <h3 class="title">2025 THE COUNTRY CLUB INVITATIONAL</h3>
                        <time class="date">December 08, 2025</time>
                    </div>
                </a>
            </article>
            <article class="news-card">
                <a class="card-link" href="#">
                    <div class="media">
                        <img src="{{ asset('images/COURSES/Couples/Couples4.jpg') }}" alt="Riviera golf course">
                    </div>
                    <div class="content">
                        <h3 class="title">2024 ICTSI NEGROS OCCIDENTAL CLASSIC</h3>
                        <time class="date">January 04, 2024</time>
                    </div>
                </a>
            </article>
            <article class="news-card">
                <a class="card-link" href="#">
                    <div class="media">
                        <img src="{{ asset('images/COURSES/Couples/Couples5.jpg') }}" alt="Riviera golf course">
                    </div>
                    <div class="content">
                        <h3 class="title">2024 ICTSI BACOLOD GOLF CHALLENGE</h3>
                        <time class="date">August 06, 2024</time>
                    </div>
                </a>
            </article>
            <article class="news-card">
                <a class="card-link" href="#">
                    <div class="media">
                        <img src="{{ asset('images/COURSES/Couples/Couples6.jpg') }}" alt="Riviera golf course">
                    </div>
                    <div class="content">
                        <h3 class="title">2024 ICTSI ILOILO GOLF CHALLENGE</h3>
                        <time class="date">November 20, 2025</time>
                    </div>
                </a>
            </article>
            <article class="news-card">
                <a class="card-link" href="#">
                    <div class="media">
                        <img src="{{ asset('images/COURSES/Couples/Couples1.jpg') }}" alt="Riviera golf course">
                    </div>
                    <div class="content">
                        <h3 class="title">Card7</h3>
                        <time class="date">June 04, 2025</time>
                    </div>
                </a>
            </article>
            <article class="news-card">
                <a class="card-link" href="#">
                    <div class="media">
                        <img src="{{ asset('images/COURSES/Couples/Couples1.jpg') }}" alt="Riviera golf course">
                    </div>
                    <div class="content">
                        <h3 class="title">Card8</h3>
                        <time class="date">June 04, 2025</time>
                    </div>
                </a>
            </article>
            <article class="news-card">
                <a class="card-link" href="#">
                    <div class="media">
                        <img src="{{ asset('images/COURSES/Couples/Couples1.jpg') }}" alt="Riviera golf course">
                    </div>
                    <div class="content">
                        <h3 class="title">Card9</h3>
                        <time class="date">June 04, 2025</time>
                    </div>
                </a>
            </article>
            <article class="news-card">
                <a class="card-link" href="#">
                    <div class="media">
                        <img src="{{ asset('images/COURSES/Couples/Couples1.jpg') }}" alt="Riviera golf course">
                    </div>
                    <div class="content">
                        <h3 class="title">Card10</h3>
                        <time class="date">June 04, 2025</time>
                    </div>
                </a>
            </article>
            <article class="news-card">
                <a class="card-link" href="#">
                    <div class="media">
                        <img src="{{ asset('images/COURSES/Couples/Couples1.jpg') }}" alt="Riviera golf course">
                    </div>
                    <div class="content">
                        <h3 class="title">Card11</h3>
                        <time class="date">June 04, 2025</time>
                    </div>
                </a>
            </article>
            <article class="news-card">
                <a class="card-link" href="#">
                    <div class="media">
                        <img src="{{ asset('images/COURSES/Couples/Couples1.jpg') }}" alt="Riviera golf course">
                    </div>
                    <div class="content">
                        <h3 class="title">Card12</h3>
                        <time class="date">June 04, 2025</time>
                    </div>
                </a>
            </article>
            <article class="news-card">
                <a class="card-link" href="#">
                    <div class="media">
                        <img src="{{ asset('images/COURSES/Couples/Couples1.jpg') }}" alt="Riviera golf course">
                    </div>
                    <div class="content">
                        <h3 class="title">Card13</h3>
                        <time class="date">June 04, 2025</time>
                    </div>
                </a>
            </article>
            <article class="news-card">
                <a class="card-link" href="#">
                    <div class="media">
                        <img src="{{ asset('images/COURSES/Couples/Couples1.jpg') }}" alt="Riviera golf course">
                    </div>
                    <div class="content">
                        <h3 class="title">Card14</h3>
                        <time class="date">June 04, 2025</time>
                    </div>
                </a>
            </article>
            <article class="news-card">
                <a class="card-link" href="#">
                    <div class="media">
                        <img src="{{ asset('images/COURSES/Couples/Couples1.jpg') }}" alt="Riviera golf course">
                    </div>
                    <div class="content">
                        <h3 class="title">Card15</h3>
                        <time class="date">June 04, 2025</time>
                    </div>
                </a>
            </article>
            <article class="news-card">
                <a class="card-link" href="#">
                    <div class="media">
                        <img src="{{ asset('images/COURSES/Couples/Couples1.jpg') }}" alt="Riviera golf course">
                    </div>
                    <div class="content">
                        <h3 class="title">Card16</h3>
                        <time class="date">June 04, 2025</time>
                    </div>
                </a>
            </article>
            <article class="news-card">
                <a class="card-link" href="#">
                    <div class="media">
                        <img src="{{ asset('images/COURSES/Couples/Couples1.jpg') }}" alt="Riviera golf course">
                    </div>
                    <div class="content">
                        <h3 class="title">Card17</h3>
                        <time class="date">June 04, 2025</time>
                    </div>
                </a>
            </article>
            <article class="news-card">
                <a class="card-link" href="#">
                    <div class="media">
                        <img src="{{ asset('images/COURSES/Couples/Couples1.jpg') }}" alt="Riviera golf course">
                    </div>
                    <div class="content">
                        <h3 class="title">Card18</h3>
                        <time class="date">June 04, 2025</time>
                    </div>
                </a>
            </article>

            <!-- repeat many more cards... -->
        </div>

        <nav class="pagination" aria-label="Pagination">
            <button class="page-btn" onclick="prevPage()">«</button>
            <button class="page-btn" onclick="changePage(1)">1</button>
            <button class="page-btn" onclick="changePage(2)">2</button>
            <button class="page-btn" onclick="changePage(3)">3</button>
            <button class="page-btn" onclick="nextPage()">»</button>
        </nav>
    </section>
@endsection
