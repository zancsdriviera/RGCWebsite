@extends('layouts.app')

@section('title', 'About Us')

@push('styles')
    <link href="{{ asset('images/RivieraHeaderLogo3.png') }}" rel="icon">
    <link href="{{ asset('css/about_us.css') }}" rel="stylesheet">
@endpush
@section('content')
    <div class="container-fluid custom-bg text-center d-flex align-items-center justify-content-center">
        <h1 class="text-white">ABOUT US</h1>
    </div>
    <div class="divider1">

    </div>
    <div class="top_caption container-fluid p-0 m-0">
        <div class="row g-0 align-items-stretch">
            <!-- Left side: Image (3/4 width) -->
            <div class="col-lg-90 col-md-8 col-15">
                <img src="https://ik.imagekit.io/w87y1vfrm/ABOUT_US/ClubHistoryImg.png" class="w-100 h-100"
                    style="object-fit: cover; display: block;" alt="Driving Range">
            </div>

            <!-- Right side: Text (1/4 width) -->
            <div class="col-lg-100% col-md-4 col-12 d-flex flex-column justify-content-center text-center text-white bg1"
                style="background-color: #202123; min-height: 100%;">
                <h2 class="mb-3 px-4">CLUB HISTORY</h2>
            </div>
        </div>
    </div>

    <section class="profile_container py-6"> <!-- full-bleed background -->
        <div class="container my-0">
            <div class="row align-items-center">
                <!-- Left side: caption + description -->
                <div class="col-md-6">
                    <h2 class="mb-3">BACKSWING</h2>
                    <p class="con1_p1">
                        Perhaps it was just fitting that the main guest of honor at the Riviera Golf Club opening of the
                        Riviera Golf Club driving range is a huge part of modern Philippine history: Fidel V. Ramos, former
                        president of the republic, and one of the icons of the 1986 EDSA Revolution. <br>
                        <br>
                        Perhaps it was doubly fitting that the event took place in a place of unassailable history
                        itself-Cavite, home to numerous heroes of the 1898 Philippine Revolution. That’s because the day,
                        August 17, 1997, ushered in a revolution in Philippine golf courses in that a truly championship
                        course—the best in Asia then, for sure—was inaugurated. <br>
                        <br>
                    <p>Fidel V. Ramos, the sitting president during the 1990s, frequented Riviera for a friendly round of
                        golf with government officials and high-ranking AFP officers.</p>
                    </p>
                </div>
                <!-- Right side: image -->
                <div class="col-md-6 text-center">
                    <img src="https://ik.imagekit.io/w87y1vfrm/ABOUT_US/ClubProfileImage1.png"
                        class="img-fluid rounded shadow" alt="About Golf">
                </div>
            </div>
        </div>
    </section>

    <section class="profile_container1 py-6"> <!-- full-bleed background -->
        <div class="container my-0">
            <div class="row align-items-center">
                <!-- Left side: caption + description -->
                <div class="con2_div1 d-flex justify-content-center">
                    <img src="https://ik.imagekit.io/w87y1vfrm/ABOUT_US/ClubHistory1.jpg"
                        class="img-fluid shadow con2_div1_img1" alt="About Golf">
                </div>

                <div class="con2_div1">
                    <p class="con2_p1">
                        Historic Silang, Cavite was hotbed of insurrection during the 1890s. Now, more than a century hence,
                        the same Silang is a hotspot for the young guns in Philippine golf.
                    </p>
                </div>
            </div>
        </div>
    </section>
    <section class="profile_container py-6"> <!-- full-bleed background -->
        <div class="container my-0">
            <div class="row align-items-center">
                <!-- Left side: caption + description -->
                <div class="col-md-6">
                    <p class="con1_p1">
                        Members of the social and golfing registers witnessed then First Lady Amelita Ramos, a dedicated
                        golfer like here husband, President Ramos, cut the ribbon to officially open the Club’s driving
                        range and check the first box on the list of many Club milestones within the next few months. Among
                        the notables at the well-attended ceremony and the customary first golf ball strike were Centennial
                        Commission chairman Perfect Yasay, Cavite governor Epimacio Velasco, and Silang mayor Ruben
                        Madlansacay. <br>
                        <br>
                        To loud Cheers from the large audience of Riviera officers and staff, who had put in days to put
                        together the event, a bevy of blue and green (the Clubs’s colors) balloons was released into the
                        Silang sky to usher in the first group of golfers onto the course, all to participate in the day’s
                        Long-Drive Competition and the Golf Tips from the Pros. And speaking of pros, the more advanced at
                        that time, John Blanch, had to open more tee times to allow as many to play as the course would
                        allow. <br>
                        <br>
                </div>
                <!-- Right side: image -->
                <div class="col-md-6 text-center">
                    <img src="https://ik.imagekit.io/w87y1vfrm/ABOUT_US/ClubHistory2.jpg" class="img-fluid shadow"
                        alt="About Golf">
                </div>
                <hr class="shadow-hr">
            </div>
        </div>
    </section>
    <section class="profile_container py-0"> <!-- full-bleed background -->
        <div class="container my-0">
            <div class="row align-items-center pb-5">
                <!-- Right side: image -->
                <div class="col-md-6 text-center">
                    <img src="https://ik.imagekit.io/w87y1vfrm/ABOUT_US/ClubHistory3.jpg" class="img-fluid shadow"
                        alt="About Golf">
                </div>
                <!-- Left side: caption + description -->
                <div class="col-md-6">
                    <p class="con1_p1">
                        A string of course milestones followed in short order after the driving range was opened: the
                        Couples Course back-nine completion in December 1997; the Gala Grand Opening in January 1998; the
                        Clubhouse inauguration in March 1998; the Langer Course opening in March 1998; and the Par 3 course
                        opening in May 1998. <br>
                        <br>
                        By the turn of the 21st century, the Riviera Golf Club had already established itself on the local
                        and the international tournament circuits. <br>
                        <br>
                </div>
            </div>
        </div>
    </section>

    <section class="profile_container1 py-6"> <!-- full-bleed background -->
        <div class="container my-0">
            <div class="row align-items-center">
                <!-- Left side: caption + description -->
                <div class="con2_div1 d-flex justify-content-center">
                    <img src="https://ik.imagekit.io/w87y1vfrm/ABOUT_US/ClubHistory4.jpg"
                        class="img-fluid shadow con2_div1_img1" alt="About Golf">
                </div>
                <div class="con2_div1">
                    <p class="con2_p1">
                        The former first couple, Fidel and Amelita Ramos, leads the ribbon cutting to formally open the
                        Riviera Golf driving range. Opposite page: ceremonies at the opening of the Clubhouse.
                    </p>
                </div>
            </div>
        </div>
    </section>
    <!-- single full-bleed wrapper to avoid stray gaps between sections -->
    <section class="full-bleed-mission-vision">
        <div class="container-fluid p-0 m-0">
            <!-- Mission row -->
            <div class="row g-0 align-items-stretch">
                <div class="MV_caption col-md-6 text-center text-white p-5 d-flex flex-column justify-content-center"
                    style="background-color: #B9C19F;">
                    <h2 class="txtSwing">SWINGIN’ TO WINNIN’</h2>
                    <p class="mission_txt mb-0">
                        Tournament have become the lifeblood of Riviera golf and country since the Lange and Couples courses
                        were opened in 1998. <br>
                        <br>In March of that year Riviera hosted the Philippine Open, the most prestigious long-running
                        event in Asian golf. In November 1998, the Centennial Cup was also held at the Club. <br>
                        <br>Since the opening of the combined 36 holes of the Langer and Couples courses, tournaments have
                        been held on a regular basis beginning with the Monthly Medal Tournament and the Riviera Dengue
                        Drive Tournament.
                    </p>
                </div>
                <div class="col-md-6 p-0">
                    <img src="https://ik.imagekit.io/w87y1vfrm/ABOUT_US/ClubHistory9.png" alt="Driving Range"
                        class="img-fluid w-100 h-100 cover-img">
                </div>
            </div>

            <!-- Vision row (directly following, no extra container) -->
            <div class="row g-0 mb-5 align-items-stretch">
                <div class="col-md-6 p-0">
                    <img src="https://ik.imagekit.io/w87y1vfrm/ABOUT_US/ClubHistory8.png" alt="Riviera Stone"
                        class="img-fluid w-100 h-100 cover-img">
                </div>
                <div class="MV_caption col-md-6 text-center text-white p-5 d-flex flex-column justify-content-center"
                    style="background-color: #B9C19F;">
                    <p class="mission_txt mb-0">
                        Two years before the new millennium, Riveira launched two major tournaments: the Club Championship
                        Finals in November 1998 at the Challenging Langer Course and the 4-ball Scramble Championship
                        qualifiers at the Couples Course in December. <br>
                        <br>In July 1999, Riviera hosted the final qualifying round for the Philip Morris Golf Classic. The
                        Club was also selected as the venue for the Professional and Amateur National Finals held in August
                        1999. <br>
                        <br>The Philip Morris Golf Classic Final leg champions were then-Club president Danny Pizarro
                        (Seniors) and Grace Atienza (Ladies B). Felix “Cassius” Casas was named Tournament of Champions
                        grand-slam winner and bagged a cash prize of P150,000.
                    </p>
                </div>
            </div>
        </div>
    </section>

    <section class="profile_container2 py-6">
        <div class="container my-10">
            <div class="content-text">
                <img src="https://ik.imagekit.io/w87y1vfrm/ABOUT_US/ClubHistory10.png" alt="About Golf"
                    class="floating-img">

                <p class="con3_p1">
                    Also in 1999, two major tournaments became anticipated events in Riviera: The Invitational, where
                    members and guests participate; and the Year-end Tournaments, also known as the Family Tournament.
                </p>

                <p class="con3_p1">
                    The first Invitational was held in May 1999. Ninety-four players participated in this two-day event.
                    Day One was a team-aggregate competition using Stableford points. A cocktail party was held and
                    featured a Calcutta Draw wherein bets were placed on a team’s second-day performance and the pool
                    rose to P26,000.
                </p>

                <p class="con3_p1">
                    The second day of the First Riviera Invitational was held at the Langer Course in a one-ball,
                    two-some format. The results of the tournament were announced during a dinner party where a Toyota
                    Rav 4 was raffled off as the grand prize.
                </p>

                <p class="con3_p1 mb-0">
                    Virgilio de Silva and Oca Saldivar were declared Class A champions. Wilson Uy won a round-trip
                    ticket to San Francisco, USA, for a hole-in-one at #14 Couples, while Norton Gonzalez won a Toyota
                    Corolla for a hole-in-one at #17 Langer. <br>
                    <br>Virgilio de Silva and Oca Saldivar were declared the First
                    Riviera Invitational Class A Champions. Wilson Uy won a round-trip ticket to San Francisco, USA, for a
                    hole-in-one at #14 Couples while Norton Gonzalez a Toyota Corolla won for a hole-in-one at #17 Langer.

                    “This Even is now firmly placed as the highlight of the Riviera golfing calendar due to its mixture of
                    fun, competition, entertainment, and camaraderie,” John Blanch, the general manager then, had said about
                    the invitational. To note, no less than Sen. Tito Sotto participated in the 2nd invitational in 2000,
                    which saw 102 teams competing, and he was declared Class A champion with Ulay Garcia as teammate. <br>

                    <br>It was also in December that year that the Family Tournament held to usher in the new millennium.
                    Antonio, Christian, and Carlo Catoco, and Ambrosio de Luna were declared champions for the First Riviera
                    Family Scramble. That year, Riviera launched its junior Golf tourneys with a clinic. <br>

                    <br>By 2000, the Langer Course had become the venue for the Philippine Open, the oldest National Open
                    Golf Tournament in Asia and, therefore, the most prestigious. The event, organized by the National Golf
                    Association of the Philippines, was sanctioned by the Asian Professional Golf Association. It featured
                    top players from the Davidoff Tour as well as leading amateurs and professionals from the Philippines.
                    <br>

                    <br>That tournament made Riviera the first club in the country “to host the Open over both courses [the
                    Couples Course was played over in the 1998 Open] that can really boast having two championship courses!”
                    Blanch wrote in 2000.
                </p>
            </div>
        </div>
    </section>


    <!-- single full-bleed wrapper to avoid stray gaps between sections -->
    <section class="full-bleed-mission-vision">
        <div class="container-fluid p-0 m-0">
            <!-- Mission row -->
            <div class="row g-0 align-items-stretch">
                <div class="col-md-6 p-0">
                    <img src="https://ik.imagekit.io/w87y1vfrm/ABOUT_US/ClubHistory6.jpg" alt="Driving Range"
                        class="img-fluid w-100 h-100 cover-img">
                </div>

                <div class="MV_caption col-md-6 text-center text-white p-5 d-flex flex-column justify-content-center"
                    style="background-color: #B9C19F;">
                    <h2 class="mb-0">Our Mission</h2>
                    <p class="mission_p1 mb-0">
                        To give members and guests a great golfing experience with world-class courses, warm hospitality,
                        and a heart for the environment and the community.
                    </p>
                </div>
            </div>

            <!-- Vision row (directly following, no extra container) -->
            <div class="row g-0 mb-5 align-items-stretch">
                <div class="MV_caption col-md-6 text-center text-white p-5 d-flex flex-column justify-content-center"
                    style="background-color: #B9C19F;">
                    <h2 class="mb-0">Our Vision</h2>
                    <p class="vision_p1 mb-0">
                        To be the best golf club in the Philippines — a place where people love to play, feel valued,
                        and support nature and the community.
                    </p>
                </div>

                <div class="col-md-6 p-0">
                    <img src="https://ik.imagekit.io/w87y1vfrm/ABOUT_US/ClubHistory7.jpg" alt="Riviera Stone"
                        class="img-fluid w-100 h-100 cover-img">
                </div>
            </div>
        </div>
    </section>


    <div class="board_caption my-0 text-center">
        <!-- Section Header -->
        <h2 class="board-title">BOARD OF DIRECTORS</h2>
        <p class="text-muted mb-4">2025-2026</p>

        <!-- Cards Row  First-->
        <div class="row justify-content-center">
            <!-- Card 1 -->
            <div class="col-md-3 mb-4">
                <div class="card h-100 shadow-sm rounded-0">
                    <img src="https://ik.imagekit.io/w87y1vfrm/ABOUT_US/BOD/Legaspi1.jpg" class="card-img-top rounded-0"
                        alt="LEGASPI, NORMAN C.">
                    <div class="card-body">
                        <h5 class="card-title" style="color: white">NORMAN C. LEGASPI</h5>
                        <p class="card-text" style="color: white">CHAIRMAN</p>
                    </div>
                </div>
            </div>

            <!-- Card 2 -->
            <div class="col-md-3 mb-4">
                <div class="card h-100 shadow-sm rounded-0">
                    <img src="https://ik.imagekit.io/w87y1vfrm/ABOUT_US/BOD/Rapadas1.jpg" class="card-img-top rounded-0"
                        alt="RAPADAS, ROBERTO R.">
                    <div class="card-body">
                        <h5 class="card-title" style="color: white">ROBERTO R. RAPADAS</h5>
                        <p class="card-text" style="color: white">VICE CHAIRMAN</p>
                    </div>
                </div>
            </div>

            <!-- Card 3 -->
            <div class="col-md-3 mb-4">
                <div class="card h-100 shadow-sm rounded-0">
                    <img src="https://ik.imagekit.io/w87y1vfrm/ABOUT_US/BOD/Escalona1.jpg" class="card-img-top rounded-0"
                        alt="ESCALONA, ALEX L.">
                    <div class="card-body">
                        <h5 class="card-title" style="color: white">ALEX L. ESCANOLA</h5>
                        <p class="card-text" style="color: white">PRESIDENT</p>
                    </div>
                </div>
            </div>
        </div>

        <!-- Cards Row  Second-->
        <div class="row justify-content-center">
            <!-- Card 4 -->
            <div class="col-md-3 mb-4">
                <div class="card h-100 shadow-sm rounded-0">
                    <img src="https://ik.imagekit.io/w87y1vfrm/ABOUT_US/BOD/GM.jpg" class="card-img-top rounded-0"
                        alt="CRISOSTOMO, JOSE M.">
                    <div class="card-body">
                        <h5 class="card-title" style="color: white">JOSE M. CRISOSTOMO</h5>
                        <p class="card-text" style="color: white">VICE PRESIDENT</p>
                    </div>
                </div>
            </div>

            <div class="col-md-3 mb-4">
                <div class="card h-100 shadow-sm rounded-0">
                    <img src="https://ik.imagekit.io/w87y1vfrm/ABOUT_US/BOD/Carranza.jpg?updatedAt=1760148343088"
                        class="card-img-top rounded-0" alt="CARRANZA, EDWARD E.">
                    <div class="card-body">
                        <h5 class="card-title" style="color: white">EDWARD E. CARRANZA</h5>
                        <p class="card-text" style="color: white">DIRECTOR</p>
                    </div>
                </div>
            </div>
            <!-- Card 5 -->
            <div class="col-md-3 mb-4">
                <div class="card h-100 shadow-sm rounded-0">
                    <img src="https://ik.imagekit.io/w87y1vfrm/ABOUT_US/BOD/Conception1.jpg"
                        class="card-img-top rounded-0" alt="CONCEPCION, FLORIAN O.">
                    <div class="card-body">
                        <h5 class="card-title" style="color: white">FLORIAN O. CONCEPCION</h5>
                        <p class="card-text" style="color: white">DIRECTOR</p>
                    </div>
                </div>
            </div>
        </div>

        <!-- Cards Row  Third-->
        <div class="row justify-content-center">
            <!-- Card 7 -->
            <div class="col-md-3 mb-4">
                <div class="card h-100 shadow-sm rounded-0">
                    <img src="https://ik.imagekit.io/w87y1vfrm/ABOUT_US/BOD/Valencia.jpg" class="card-img-top rounded-0"
                        alt="VALENCIA, RAFAEL C.">
                    <div class="card-body">
                        <h5 class="card-title" style="color: white">RAFAEL C. VALENCIA</h5>
                        <p class="card-text" style="color: white">DIRECTOR</p>
                    </div>
                </div>
            </div>

            <!-- Card 8 -->
            <div class="col-md-3 mb-4">
                <div class="card h-100 shadow-sm rounded-0">
                    <img src="https://ik.imagekit.io/w87y1vfrm/ABOUT_US/BOD/Kawamura1.jpg" class="card-img-top rounded-0"
                        alt="HWANG, JEONG SOON">
                    <div class="card-body">
                        <h5 class="card-title" style="color: white">TAKUYA, KAWAMURA</h5>
                        <p class="card-text" style="color: white">INDEPENDENT DIRECTOR</p>
                    </div>
                </div>
            </div>

            <!-- Card 9 -->
            <div class="col-md-3 mb-4">
                <div class="card h-100 shadow-sm rounded-0">
                    <img src="https://ik.imagekit.io/w87y1vfrm/ABOUT_US/BOD/Balboa1.jpg" class="card-img-top rounded-0"
                        alt="MATEO, ORLANDO M.">
                    <div class="card-body">
                        <h5 class="card-title" style="color: white">JAY SEBASTIAN L. BALBOA</h5>
                        <p class="card-text" style="color: white">INDEPENDENT DIRECTOR</p>
                    </div>
                </div>
            </div>
        </div>

        <!-- Cards Row  Fourth-->


        <!-- Cards Row  Fifth-->
        <div class="row justify-content-center">
            <!-- Card 13 -->
            <div class="col-md-3 mb-4">
                <div class="card h-100 shadow-sm rounded-0">
                    <img src="https://ik.imagekit.io/w87y1vfrm/ABOUT_US/BOD/SIR%20jeong.jpg"
                        class="card-img-top rounded-0" alt="JEONG SOON HWANG">
                    <div class="card-body">
                        <h5 class="card-title" style="color: white">JEONG SOON HWANG</h5>
                        <p class="card-text" style="color: white">INDEPENDENT DIRECTOR</p>
                    </div>
                </div>
            </div>
            <div class="col-md-3 mb-4">
                <div class="card h-100 shadow-sm rounded-0">
                    <img src="https://ik.imagekit.io/w87y1vfrm/ABOUT_US/BOD/MATEO.jpg" class="card-img-top rounded-0"
                        alt="ATTY. FERNANDEZ, CHRISTOPHER REY L.">
                    <div class="card-body">
                        <h5 class="card-title" style="color: white">ORLANDO M. MATEO</h5>
                        <p class="card-text" style="color: white">INDEPENDENT DIRECTOR</p>
                    </div>
                </div>
            </div>
            <!--
                <div class="col-md-3 mb-4">
                    <div class="card h-100 shadow-sm rounded-0">
                        <img src="https://ik.imagekit.io/w87y1vfrm/ABOUT_US/BOD/TBA.png" class="card-img-top rounded-0"
                            alt="ATTY. FERNANDEZ, CHRISTOPHER REY L.">
                        <div class="card-body">
                            <h5 class="card-title" style="color: white">TBA</h5>
                            <p class="card-text" style="color: white">MEMBER</p>
                        </div>
                    </div>
                </div>
                -->
        </div>
        <br>
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
                    <img src="https://ik.imagekit.io/w87y1vfrm/ABOUT_US/bottomImage.png" class="img-fluid"
                        alt="Mission Image">
                </div>
            </div>
        </div>
    </div>

    <!-- Values / Core Principles -->
    <div class="values-container container my-5">
        <ul class="values-list list-unstyled mb-0">
            <li class="value-item d-flex align-items-center">
                <img src="https://ik.imagekit.io/w87y1vfrm/ABOUT_US/Icons/Icon1.png" alt="Integrity icon"
                    class="value-icon">
                <div class="value-copy">
                    <span class="value-title">Integrity:</span>
                    <span class="value-desc">Always Doing What's Right And Being Respectful.</span>
                </div>
            </li>

            <li class="value-item d-flex align-items-center">
                <img src="https://ik.imagekit.io/w87y1vfrm/ABOUT_US/Icons/Icon2.png" alt="Excellence icon"
                    class="value-icon">
                <div class="value-copy">
                    <span class="value-title">Excellence:</span>
                    <span class="value-desc">Doing Our Best In Everything We Do.</span>
                </div>
            </li>

            <li class="value-item d-flex align-items-center">
                <img src="https://ik.imagekit.io/w87y1vfrm/ABOUT_US/Icons/Icon3.png" alt="Teamwork icon"
                    class="value-icon">
                <div class="value-copy">
                    <span class="value-title">Teamwork:</span>
                    <span class="value-desc">Helping Each Other For The Good Of The Club.</span>
                </div>
            </li>

            <li class="value-item d-flex align-items-center">
                <img src="https://ik.imagekit.io/w87y1vfrm/ABOUT_US/Icons/Icon4.png" alt="Social Responsibility icon"
                    class="value-icon">
                <div class="value-copy">
                    <span class="value-title">Social Responsibility:</span>
                    <span class="value-desc">Caring For The Environment And Our Local Community.</span>
                </div>
            </li>

            <li class="value-item d-flex align-items-center">
                <img src="https://ik.imagekit.io/w87y1vfrm/ABOUT_US/Icons/Icon5.png" alt="Exclusivity icon"
                    class="value-icon">
                <div class="value-copy">
                    <span class="value-title">Exclusivity:</span>
                    <span class="value-desc">Making Sure Riviera Golf Club Remains A Special Place For Members.</span>
                </div>
            </li>

            <li class="value-item d-flex align-items-center">
                <img src="https://ik.imagekit.io/w87y1vfrm/ABOUT_US/Icons/Icon6.png" alt="Tradition & Heritage icon"
                    class="value-icon">
                <div class="value-copy">
                    <span class="value-title">Tradition &amp; Heritage:</span>
                    <span class="value-desc">Honoring Our History And Upholding High Standards.</span>
                </div>
            </li>
        </ul>
    </div>

@endsection
