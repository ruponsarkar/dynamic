<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    @php
        $metaTitle = trim($__env->yieldContent('title', 'Research Journal of Medical Science'));
        $metaDescription = trim($__env->yieldContent(
            'description',
            'IRGS Publisher is a leading academic publisher specializing in high-quality journals across various disciplines. We are committed to advancing research and knowledge dissemination through our rigorous peer-review process and open access policies.',
        ));
        $metaImage = trim($__env->yieldContent('meta_image', asset('fav/android-icon-192x192.png')));
        $metaType = trim($__env->yieldContent('meta_type', 'website'));
        $metaRobots = trim($__env->yieldContent('meta_robots', 'index,follow'));
        $canonicalUrl = url()->current();
    @endphp

    <title>{{ $metaTitle }}</title>
    <meta name="description" content="{{ $metaDescription }}">
    <meta name="robots" content="{{ $metaRobots }}">
    <meta name="author" content="IRGS Publisher">
    <meta name="theme-color" content="#0056a3">
    <meta name="msapplication-TileColor" content="#0056a3">
    <meta name="msapplication-config" content="{{ asset('fav/browserconfig.xml') }}">
    <meta name="apple-mobile-web-app-capable" content="yes">
    <meta name="apple-mobile-web-app-status-bar-style" content="default">
    <meta name="apple-mobile-web-app-title" content="{{ $metaTitle }}">

    <link rel="canonical" href="{{ $canonicalUrl }}">
    <link rel="icon" type="image/x-icon" href="{{ asset('fav/favicon.ico') }}">
    <link rel="shortcut icon" href="{{ asset('fav/favicon.ico') }}">
    <link rel="icon" type="image/png" sizes="16x16" href="{{ asset('fav/favicon-16x16.png') }}">
    <link rel="icon" type="image/png" sizes="32x32" href="{{ asset('fav/favicon-32x32.png') }}">
    <link rel="icon" type="image/png" sizes="96x96" href="{{ asset('fav/favicon-96x96.png') }}">
    <link rel="apple-touch-icon" sizes="57x57" href="{{ asset('fav/apple-icon-57x57.png') }}">
    <link rel="apple-touch-icon" sizes="60x60" href="{{ asset('fav/apple-icon-60x60.png') }}">
    <link rel="apple-touch-icon" sizes="72x72" href="{{ asset('fav/apple-icon-72x72.png') }}">
    <link rel="apple-touch-icon" sizes="76x76" href="{{ asset('fav/apple-icon-76x76.png') }}">
    <link rel="apple-touch-icon" sizes="114x114" href="{{ asset('fav/apple-icon-114x114.png') }}">
    <link rel="apple-touch-icon" sizes="120x120" href="{{ asset('fav/apple-icon-120x120.png') }}">
    <link rel="apple-touch-icon" sizes="144x144" href="{{ asset('fav/apple-icon-144x144.png') }}">
    <link rel="apple-touch-icon" sizes="152x152" href="{{ asset('fav/apple-icon-152x152.png') }}">
    <link rel="apple-touch-icon" sizes="180x180" href="{{ asset('fav/apple-icon-180x180.png') }}">
    <link rel="manifest" href="{{ asset('fav/manifest.json') }}">

    <meta property="og:locale" content="en_US">
    <meta property="og:type" content="{{ $metaType }}">
    <meta property="og:title" content="{{ $metaTitle }}">
    <meta property="og:description" content="{{ $metaDescription }}">
    <meta property="og:url" content="{{ $canonicalUrl }}">
    <meta property="og:site_name" content="Research Journal of Medical Science">
    <meta property="og:image" content="{{ $metaImage }}">
    <meta property="og:image:alt" content="{{ $metaTitle }}">

    <meta name="twitter:card" content="summary_large_image">
    <meta name="twitter:title" content="{{ $metaTitle }}">
    <meta name="twitter:description" content="{{ $metaDescription }}">
    <meta name="twitter:image" content="{{ $metaImage }}">

    <!-- Bootstrap 5 -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.css" rel="stylesheet">

    <link href="{{ url('assets/vendor/swiper/swiper-bundle.min.css') }}" rel="stylesheet">

    <link rel="stylesheet" href="/assets/css/styles.css">



    <!-- Custom -->
    <style>
        body {
            font-family: Arial, sans-serif;
        }

        .navbar-nav .nav-link {
            /* font-weight: 600; */
            font-size: 14px;
        }

        .hero-title {
            font-size: 28px;
            font-weight: 700;
        }

        .hero-sub {
            font-size: 18px;
            font-weight: 500;
            color: #555;
        }
    </style>

    <style>
        body {
            background-color: #f3f3f3;
        }

        .journal-title {
            font-size: 28px;
            font-weight: 700;
            line-height: 1.4;
        }

        @media (max-width: 544px) {
            .journal-title {
                font-size: 13px;
            }
        }

        .subhead {
            font-size: 18px;
            font-weight: 500;
            margin-top: 5px;
        }

        .section-title {
            background: #0056a3;
            padding: 10px;
            color: white;
            font-weight: bold;
            font-size: 18px;
        }

        .card-title-custom {
            background: #0056a3;
            color: white;
            padding: 10px;
            font-size: 18px;
            font-weight: 600;
        }

        .link-list a {
            display: block;
            padding: 6px 0;
            border-bottom: 1px solid #ddd;
            color: #0056a3;
            text-decoration: none;
            font-size: 15px;
        }

        .link-list a:hover {
            text-decoration: underline;
        }

        .footer {
            background: #343539;
            color: white;
            padding: 15px;
            /* text-align: center; */
            /* margin-top: 40px; */
        }
    </style>
</head>

<body>

    <div class="">
        @include('partials.header')
    </div>
    <div class="pb-2">

    </div>

    {{-- <nav class="navbar navbar-expand-lg navbar-dark bg-nav-dark">
        <div class="container">
    
            <a class="navbar-brand d-lg-none text-white" href="{{ url('/') }}">
                <span class="h6 mb-0">WAFR</span>
            </a>
    
            <button class="navbar-toggler" type="button"
                    data-bs-toggle="collapse" data-bs-target="#mainNavbar">
                <span class="navbar-toggler-icon"></span>
            </button>
    
            <div class="collapse navbar-collapse" id="mainNavbar">
                ...
            </div>
    
        </div>
    </nav> --}}



    <main class="">
        @yield('content')
    </main>

    @include('partials.footer')

    <script src="{{ url('assets/vendor/swiper/swiper-bundle.min.js') }}"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    <script src="{{ url('assets/js/main.js') }}"></script>

</body>

</html>
