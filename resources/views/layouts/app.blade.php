<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>@yield('title', 'IRGS Publisher')</title>

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
