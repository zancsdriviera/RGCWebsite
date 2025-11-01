<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Riviera Golf Club')</title>

    <!-- Global CSS -->
    <link href="{{ asset('css/bootstrap.min.css') }}" rel="stylesheet">
    <link href="{{ asset('css/bootstrap-icons.css') }}" rel="stylesheet">
    <link rel="icon" type="image/png" href="{{ asset('public/favicon.png') }}">

    <link href="{{ asset('css/m_body.css') }}" rel="stylesheet">
    <link href="{{ asset('css/footer.css') }}" rel="stylesheet">
    <link href="{{ asset('css/header.css') }}" rel="stylesheet">
    <link href="{{ asset('css/fonts.css') }}" rel="stylesheet">

    @stack('styles') {{-- Page-specific CSS --}}
</head>

<body>

    {{-- Header --}}
    @include('partials.header')

    {{-- Main content --}}
    <main class="m_body">
        @yield('content')
    </main>

    {{-- Footer --}}
    @include('partials.footer')

    <!-- Global JS -->
    <script src="{{ asset('js/bootstrap.bundle.min.js') }}"></script>
    <script src="{{ asset('js/script.js') }}"></script>
    @stack('scripts') {{-- Page-specific JS --}}
</body>

</html>
