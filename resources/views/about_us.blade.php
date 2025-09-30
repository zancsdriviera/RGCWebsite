@extends('layouts.app')

@section('title', 'About Us')

@push('styles')
    <link href="{{ asset('css/about_us.css') }}" rel="stylesheet">
    <link href="{{ asset('images/RivieraHeaderLogo3.png') }}" rel="icon">
@endpush
@section('content')
    <div class="container-fluid custom-bg text-center d-flex align-items-center justify-content-center">
        <h1 class="text-white">ABOUT US</h1>
    </div>

    <div class="profile_container container my-5">
        <div class="row align-items-center">
            <!-- Left side: caption + description -->
            <div class="col-md-6">
                <h2 class="mb-3">Club Profile</h2>
                <p>
                    Our Club is an exciting concept unparalleled in the Philippines for its vision to be among Asia’s
                    most outstanding golf courses. The Riviera is destined to be a golf Mecca, while providing at the
                    same time the ultimate in comfort and elegance. Situated amidst the breathtaking landscape of cool
                    Silang, Cavite, The Riviera is the ideal golf course for all ages and skills. At 1,000 feet above
                    sea level, Riviera Golf Club is both nature’s beauty and a golfer’s dream course. Just about an
                    hour-drive from Makati, it is the nearest coolest golf haven accessible to major population centers
                    in Metropolitan Manila.
                </p>
            </div>
            <!-- Right side: image -->
            <div class="col-md-6 text-center">
                <img src="/images/ABOUT_US/ClubProfileImage.png" class="img-fluid rounded shadow" alt="About Golf">
            </div>
        </div>
    </div>

    <div class="container-fluid my-0 mission_container">
        <div class="row align-items-stretch">
            <!-- Left side: image -->
            <div class="col-md-6 p-0">
                <img src="/images/ABOUT_US/DrivingRange.png" class="img-fluid w-100 h-100" style="object-fit: cover;"
                    alt="Clubhouse">
            </div>

            <!-- Right side: solid color with text -->
            <div class="MV_caption col-md-6 text-center text-white p-5 d-flex flex-column justify-content-center"
                style="background-color: #256335;">
                <h2 class="mb-3">Our Mission</h2>
                <p>
                    With uniquely designed Championship Golf Courses, we provide world-class facilities & services:
                </p>
                <p class="text-start">We are committed to ensure premium year-round playing conditions while protecting
                    our environment.
                </p>
                <ul class="text-start">
                    <li>We provide friendly, efficient and personalized service to Members, guests and their families.
                    </li>
                    <li>We promote business, social and leisure opportunities through tournaments and special events.
                    </li>
                    <li>We serve quality food and beverage to the delight of our Members, visitors and guests.</li>
                    <li>We are committed to sustain our corporate social responsibility.</li>
                </ul>
                <p>Together we create an atmosphere and experience that is distinctly THE RIVIERA.</p>
            </div>
        </div>
    </div>

    <div class="container-fluid mb-5 vision_container">
        <div class="row">
            <!-- Left side: solid color with text -->
            <div class="MV_caption col-md-6 text-center text-white p-5 d-flex flex-column justify-content-center"
                style="background-color: #256335;">
                <h2 class="mb-3">Our Vision</h2>
                <p>
                    A world-class Golf Club and a preferred venue of prestigious Events providing Asia’s finest golfing
                    experience.
                </p>
            </div>
            <!-- Right side: image -->
            <div class="col-md-6 p-0">
                <img src="/images/ABOUT_US/RivieraStoneImage.png" class="img-fluid w-100 h-100" style="object-fit: cover;"
                    alt="Clubhouse">
            </div>
        </div>
    </div>

    <div class="board_caption my-0 text-center">
        <!-- Section Header -->
        <h2 class="board-title">BOARD OF DIRECTORS</h2>
        <p class="text-muted mb-4">2024-2025</p>

        <!-- Cards Row  First-->
        <div class="row justify-content-center">
            <!-- Card 1 -->
            <div class="col-md-3 mb-4">
                <div class="card h-100 shadow-sm rounded-0">
                    <img src="/images/ABOUT_US/BOD/Legaspi.png" class="card-img-top rounded-0" alt="Director 1">
                    <div class="card-body">
                        <h5 class="card-title" style="color: white">LEGASPI, NORMAN C.</h5>
                        <p class="card-text" style="color: white">CHAIRMAN</p>
                    </div>
                </div>
            </div>

            <!-- Card 2 -->
            <div class="col-md-3 mb-4">
                <div class="card h-100 shadow-sm rounded-0">
                    <img src="/images/ABOUT_US/BOD/Kawamura.png" class="card-img-top rounded-0" alt="Director 2">
                    <div class="card-body">
                        <h5 class="card-title" style="color: white">KAWAMURA, TAKUYA</h5>
                        <p class="card-text" style="color: white">VICE CHAIRMAN</p>
                    </div>
                </div>
            </div>

            <!-- Card 3 -->
            <div class="col-md-3 mb-4">
                <div class="card h-100 shadow-sm rounded-0">
                    <img src="/images/ABOUT_US/BOD/Escalona.png" class="card-img-top rounded-0" alt="Director 3">
                    <div class="card-body">
                        <h5 class="card-title" style="color: white">ESCALONA, ALEX L.</h5>
                        <p class="card-text" style="color: white">PRESIDENT</p>
                    </div>
                </div>
            </div>
        </div>

        <!-- Cards Row  Second-->
        <div class="row justify-content-center">
            <!-- Card 1 -->
            <div class="col-md-3 mb-4">
                <div class="card h-100 shadow-sm rounded-0">
                    <img src="/images/ABOUT_US/BOD/Crisostomo.png" class="card-img-top rounded-0" alt="Director 1">
                    <div class="card-body">
                        <h5 class="card-title" style="color: white">CRISOSTOMO, JOSE M.</h5>
                        <p class="card-text" style="color: white">VICE PRESIDENT</p>
                    </div>
                </div>
            </div>

            <!-- Card 2 -->
            <div class="col-md-3 mb-4">
                <div class="card h-100 shadow-sm rounded-0">
                    <img src="/images/ABOUT_US/BOD/Balboa.png" class="card-img-top rounded-0" alt="Director 2">
                    <div class="card-body">
                        <h5 class="card-title" style="color: white">BALBOA, JAY SEBASTIAN L.</h5>
                        <p class="card-text" style="color: white">MEMBER</p>
                    </div>
                </div>
            </div>

            <!-- Card 3 -->
            <div class="col-md-3 mb-4">
                <div class="card h-100 shadow-sm rounded-0">
                    <img src="/images/ABOUT_US/BOD/Carranza.png" class="card-img-top rounded-0" alt="Director 3">
                    <div class="card-body">
                        <h5 class="card-title" style="color: white">CARRANZA, EDWARD E.</h5>
                        <p class="card-text" style="color: white">MEMBER</p>
                    </div>
                </div>
            </div>
        </div>

        <!-- Cards Row  Third-->
        <div class="row justify-content-center">
            <!-- Card 1 -->
            <div class="col-md-3 mb-4">
                <div class="card h-100 shadow-sm rounded-0">
                    <img src="/images/ABOUT_US/BOD/Conception.png" class="card-img-top rounded-0" alt="Director 1">
                    <div class="card-body">
                        <h5 class="card-title" style="color: white">CONCEPCION, FLORIAN O.</h5>
                        <p class="card-text" style="color: white">MEMBER</p>
                    </div>
                </div>
            </div>

            <!-- Card 2 -->
            <div class="col-md-3 mb-4">
                <div class="card h-100 shadow-sm rounded-0">
                    <img src="/images/ABOUT_US/BOD/Hwang.png" class="card-img-top rounded-0" alt="Director 2">
                    <div class="card-body">
                        <h5 class="card-title" style="color: white">HWANG, JEONG SOON</h5>
                        <p class="card-text" style="color: white">MEMBER</p>
                    </div>
                </div>
            </div>

            <!-- Card 3 -->
            <div class="col-md-3 mb-4">
                <div class="card h-100 shadow-sm rounded-0">
                    <img src="/images/ABOUT_US/BOD/Mateo.png" class="card-img-top rounded-0" alt="Director 3">
                    <div class="card-body">
                        <h5 class="card-title" style="color: white">MATEO, ORLANDO M.</h5>
                        <p class="card-text" style="color: white">MEMBER</p>
                    </div>
                </div>
            </div>
        </div>

        <!-- Cards Row  Fourth-->
        <div class="row justify-content-center">
            <!-- Card 1 -->
            <div class="col-md-3 mb-4">
                <div class="card h-100 shadow-sm rounded-0">
                    <img src="/images/ABOUT_US/BOD/Rapadas.png" class="card-img-top rounded-0" alt="Director 1">
                    <div class="card-body">
                        <h5 class="card-title" style="color: white">RAPADAS, ROBERTO R.</h5>
                        <p class="card-text" style="color: white">MEMBER</p>
                    </div>
                </div>
            </div>

            <!-- Card 2 -->
            <div class="col-md-3 mb-4">
                <div class="card h-100 shadow-sm rounded-0">
                    <img src="/images/ABOUT_US/BOD/Valencia.png" class="card-img-top rounded-0" alt="Director 2">
                    <div class="card-body">
                        <h5 class="card-title" style="color: white">VALENCIA, RAFAEL C.</h5>
                        <p class="card-text" style="color: white">MEMBER</p>
                    </div>
                </div>
            </div>

            <!-- Card 3 -->
            <div class="col-md-3 mb-4">
                <div class="card h-100 shadow-sm rounded-0">
                    <img src="/images/ABOUT_US/BOD/Fernandez.png" class="card-img-top rounded-0" alt="Director 3">
                    <div class="card-body">
                        <h5 class="card-title" style="color: white">ATTY. FERNANDEZ, CHRISTOPHER REY L.</h5>
                        <p class="card-text" style="color: white">MEMBER</p>
                    </div>
                </div>
            </div>
        </div>

        <!-- Cards Row  Fifth-->
        <div class="row justify-content-center">
            <!-- Card 1 -->
            <div class="col-md-3 mb-4">
                <div class="card h-100 shadow-sm rounded-0">
                    <img src="/images/ABOUT_US/BOD/Ilagan.png" class="card-img-top rounded-0" alt="Director 1">
                    <div class="card-body">
                        <h5 class="card-title" style="color: white">ATTY. ILAGAN JR., ANGEL SEVERINO RAUL B.</h5>
                        <p class="card-text" style="color: white">MEMBER</p>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Bottom facility container -->
    <div class="container-fluid bot_container py-5">
        <div class="container">
            <p class="caption_txt text-center mb-5 ">WITH UNIQUELY DESIGNED CHAMPIONSHIP GOLF COURSES, WE PROVIDE WORLD
                CLASS
                FACILITIES AND SERVICES</p>
            <div class="row align-items-center">
                <!-- Left side - Bullet points -->
                <div class="col-md-6">
                    <ul>
                        <li>We are committed to ensure premium year-round playing conditions while protecting our
                            environment.</li>
                        <li>We provide friendly, efficient and personalized service to members, guests and their
                            families.</li>
                        <li>We promote business, social and leisure opportunities through tournaments and special
                            events.</li>
                        <li>We serve quality food and beverage to the delight of our members, visitors and guests.</li>
                        <li>We are committed to sustain our corporate social responsibility.</li>
                        <li>Together, we create an atmosphere and experience that is distinctly RIVIERA.</li>
                    </ul>
                </div>

                <!-- Right side - Image -->
                <div class="col-md-6 text-center">
                    <img src="/images/ABOUT_US/bottomImage.png" class="img-fluid" alt="Mission Image">
                </div>
            </div>
        </div>
    </div>

    <div class="mt-4 text-center bottom_card">
        <!-- Cards Row  First-->
        <div class="row justify-content-center">
            <!-- Card 1 -->
            <div class="col-md-3 mb-4">
                <div class="card h-100 shadow-sm rounded-0">
                    <img src="/images/ABOUT_US/BottomCards/Lobby.png" class="card-img-top rounded-0" alt="Director 1">
                    <div class="card-body">
                        <h5 class="card-title" style="color: white">RIVIERA VISION</h5>
                        <p class="card-text">A world-class golf club and a preferred venue of
                            prestigious events, providing Asia’s finest golfing experience.</p>
                    </div>
                </div>
            </div>
            <!-- Card 2 -->
            <div class="col-md-3 mb-4">
                <div class="card h-100 shadow-sm rounded-0">
                    <img src="/images/ABOUT_US/BottomCards/Team1.png" class="card-img-top rounded-0" alt="Director 1">
                    <div class="card-body">
                        <h5 class="card-title" style="color: white">CORE VALUES</h5>
                        <p class="card-text">In undertaking our mission, we uphold the following values:</p>
                    </div>
                </div>
            </div>
            <!-- Card 3 -->
            <div class="col-md-3 mb-4">
                <div class="card h-100 shadow-sm rounded-0">
                    <img src="/images/ABOUT_US/BottomCards/Team2.png" class="card-img-top rounded-0" alt="Director 1">
                    <div class="card-body">
                        <h5 class="card-title" style="color: white">MORAL UPRIGHTNESS</h5>
                        <p class="card-text">We are guided by a high sense of integrity and fairness.</p>
                    </div>
                </div>
            </div>
        </div>
        <!-- Cards Row  Second-->
        <div class="row justify-content-center">
            <!-- Card 1 -->
            <div class="col-md-3 mb-4">
                <div class="card h-100 shadow-sm rounded-0">
                    <img src="/images/ABOUT_US/BottomCards/Team3.png" class="card-img-top rounded-0" alt="Director 1">
                    <div class="card-body">
                        <h5 class="card-title" style="color: white">EXCELLENCE</h5>
                        <p class="card-text">We provide quality and value in our products and services, consistent with
                            the expectation of our members.</p>
                    </div>
                </div>
            </div>

            <!-- Card 2 -->
            <div class="col-md-3 mb-4">
                <div class="card h-100 shadow-sm rounded-0">
                    <img src="/images/ABOUT_US/BottomCards/Team4.png" class="card-img-top rounded-0" alt="Director 1">
                    <div class="card-body">
                        <h5 class="card-title" style="color: white">TEAMWORK</h5>
                        <p class="card-text">We are highly motivated and well-organized, working for a common goal.</p>
                    </div>
                </div>
            </div>

            <!-- Card 3 -->
            <div class="col-md-3 mb-4">
                <div class="card h-100 shadow-sm rounded-0">
                    <img src="/images/ABOUT_US/BottomCards/GrillRoom.png" class="card-img-top rounded-0"
                        alt="Director 1">
                    <div class="card-body">
                        <h5 class="card-title" style="color: white">SOCIAL RESPONSIBILITY
                        </h5>
                        <p class="card-text">We are a responsible corporate member of society.</p>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="board_caption my-0 text-center">
        <!-- Section Header -->
        <h2 class="gallery-title">GALLERY</h2>
    </div>

    <div class="gallery_container px-3 "> <!-- gap on left and right -->
        <div class="row g-0"> <!-- no gap between images -->
            <div class="col-6 col-lg-3">
                <img src="images/ABOUT_US/Gallery/Gal1.png" class="img-fluid" alt="">
            </div>
            <div class="col-6 col-lg-3">
                <img src="images/ABOUT_US/Gallery/Gal2.png" class="img-fluid" alt="">
            </div>
            <div class="col-6 col-lg-3">
                <img src="images/ABOUT_US/Gallery/Gal3.png" class="img-fluid" alt="">
            </div>
            <div class="col-6 col-lg-3">
                <img src="images/ABOUT_US/Gallery/Gal4.png" class="img-fluid" alt="">
            </div>
        </div>
    </div>
    <div class="gallery_container px-3 "> <!-- gap on left and right -->
        <div class="row g-0"> <!-- no gap between images -->
            <div class="col-6 col-lg-3">
                <img src="images/ABOUT_US/Gallery/Gal5.png" class="img-fluid" alt="">
            </div>
            <div class="col-6 col-lg-3">
                <img src="images/ABOUT_US/Gallery/Gal6.png" class="img-fluid" alt="">
            </div>
            <div class="col-6 col-lg-3">
                <img src="images/ABOUT_US/Gallery/Gal7.png" class="img-fluid" alt="">
            </div>
            <div class="col-6 col-lg-3">
                <img src="images/ABOUT_US/Gallery/Gal8.png" class="img-fluid" alt="">
            </div>
        </div>
    </div>
    <div class="gallery_container px-3 "> <!-- gap on left and right -->
        <div class="row g-0"> <!-- no gap between images -->
            <div class="col-6 col-lg-3">
                <img src="images/ABOUT_US/Gallery/Gal9.png" class="img-fluid" alt="">
            </div>
            <div class="col-6 col-lg-3">
                <img src="images/ABOUT_US/Gallery/Gal10.png" class="img-fluid" alt="">
            </div>
            <div class="col-6 col-lg-3">
                <img src="images/ABOUT_US/Gallery/Gal11.png" class="img-fluid" alt="">
            </div>
            <div class="col-6 col-lg-3">
                <img src="images/ABOUT_US/Gallery/Gal12.png" class="img-fluid" alt="">
            </div>
        </div>
    </div>
@endsection
