<div>
    <style>
        .floating-submit-btn {
            position: fixed;
            bottom: 18px;
            left: 18px;
            /* top: 18px;
            right: 18px; */
            z-index: 1055;
            gap: 8px;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            padding: 10px 18px;
            border-radius: 999px;
            background-color: #dc3545;
            color: #fff;
            border: 2px solid #ffffff;
            font-size: 14px;
            font-weight: 600;
            text-decoration: none;
            box-shadow: 0 10px 24px rgba(0, 0, 0, 0.2);
            transition: background-color 0.2s ease, transform 0.2s ease;
        }

        .floating-submit-btn:hover {
            background-color: #bb2d3b;
            color: #fff;
            transform: translateY(-1px);
        }

        @media (max-width: 576px) {
            .floating-submit-btn {
                inset: auto 12px 12px auto;
                padding: 8px 14px;
                font-size: 12px;
                width: auto;
                max-width: calc(100vw - 24px);
            }
        }

        @media (max-width: 991.98px) {
            body.mobile-webview #navMenu {
                display: block !important;
            }

            body.mobile-webview .navbar-toggler {
                display: none;
            }

            body.mobile-webview .navbar-nav {
                align-items: flex-start !important;
            }

            body.mobile-webview .navbar-nav .nav-link,
            body.mobile-webview .navbar-nav .dropdown-item {
                white-space: normal;
            }
        }

        .header-search-form {
            width: 260px;
            padding-top: 5px;
        }

        .header-search-form .form-control {
            min-height: 36px;
            font-size: 14px;
        }

        .header-search-form .btn {
            min-width: 42px;
        }

        @media (max-width: 991.98px) {
            .header-search-form {
                width: 100%;
                margin-top: 10px;
            }
        }
    </style>

    <a href="/manuscript" class="floating-submit-btn">
        <i class="bi bi-upload"></i>
        <span>Submit Manuscript</span>
    </a>

    <script>
        (function() {
            var ua = navigator.userAgent || navigator.vendor || window.opera || '';
            var hasTouch = navigator.maxTouchPoints > 0 || 'ontouchstart' in window;
            var smallScreen = Math.min(window.screen.width || 0, window.screen.height || 0) <= 1024;
            var isWebView =
                /(wv|WebView|Instagram|FBAN|FBAV|Line\/|; wv\)|Version\/[\d.]+.*Chrome|GSA|MiuiBrowser|DuckDuckGo|YaBrowser)/i
                .test(ua) ||
                !!window.ReactNativeWebView ||
                !!(window.webkit && window.webkit.messageHandlers) ||
                document.referrer.indexOf('android-app://') === 0;

            if (isWebView && hasTouch && smallScreen) {
                document.addEventListener('DOMContentLoaded', function() {
                    document.body.classList.add('mobile-webview');
                });
            }
        })();
    </script>

    <div class="px-2 py-1" style="background-color: #4571ff; text-align: right">
        <div class="text-white " style="font-size: small">
            <i class="bi bi-telephone"></i> +91 8638261097 &nbsp; &nbsp;
            <i class="bi bi-envelope"></i> 2Q5m0@example.com
        </div>
    </div>

    <!-- TOP BLUE HEADING (EXACT COPY) -->
    <div class="top-banner ">
        <div class="container">
            {{-- <div class="d-flex align-items-center justify-content-between"> --}}
            <div class="d-flex align-items-center gap-4">

                <img src="{{ asset('assets/homeAssets/' . $assets->logo) }}" class="logo" alt="">
                <div style="text-align: left;">

                    <div class="journal-title">
                        {{-- Research Journal of Medical Science --}}
                        {{ $journal->j_name }}

                    </div>
                    <div class="text-small" style="font-size: small;">
                        <div>
                            <b>Abbreviation: </b> {{ $journal->abbr_title }}
                        </div>
                        <div>
                            <b> ISSN (Print): </b> 2957-3610 | <b> ISSN (Online): </b> 2957-3629
                        </div>
                        <div>
                            <b>Frequency: </b> {{ $journal->frequency }}
                        </div>
                    </div>
                </div>



                <nav class="navbar navbar-expand-lg bg-white shadow-sm">
                    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navMenu">
                        <span class="navbar-toggler-icon"></span>
                    </button>
            </div>

        </div>
    </div>
</div>

<nav class="navbar navbar-expand-lg shadow-sm" style="background-color: #01654e; border-top: 4px solid #f66b08;">

    <div class="container">

        {{-- <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navMenu">
                <span class="navbar-toggler-icon"></span>
            </button> --}}

        <div class="collapse navbar-collapse" id="navMenu" style="font-weight: bold;">
            <ul class="navbar-nav mx-auto mb-2 mb-lg-0">

                <li class="nav-item"><a class="nav-link {{ request()->is('/') ? 'active' : '' }}"
                        href="/">Home</a></li>

                {{-- <li class="nav-item"><a class="nav-link {{ request()->is('journals') ? 'active' : '' }}"
                        href="/journals">JOURNALS</a></li> --}}

                {{-- <li class="nav-item"><a class="nav-link {{ request()->is('/about-us') ? 'active' : '' }}"
                        href="/about-us">ABOUT US</a></li> --}}



                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle 
                                        {{ request()->is('instructons-for-authors') ? 'active' : '' }}"
                        href="#" id="forAuthorsDropdown" role="button" data-bs-toggle="dropdown"
                        aria-expanded="false">
                        About the Journal
                    </a>

                    <ul class="dropdown-menu" aria-labelledby="forAuthorsDropdown">
                        <li>
                            <a class="dropdown-item 
                                                {{ request()->is('aim-and-scope') ? 'active' : '' }}"
                                href="/aim-and-scope">
                                Aim and Scope
                            </a>
                        </li>

                        <li>
                            <a class="dropdown-item {{ request()->is('editorial-board/*') ? 'active' : '' }}"
                                href="{{ url('editorial-board/' . $journal->slug) }}">
                                Editorial board
                            </a>
                        </li>
                        <li>
                            <a class="dropdown-item 
                                                {{ request()->is('news') ? 'active' : '' }}"
                                href="/news">
                                News
                            </a>
                        </li>
                        <li>
                            <a class="dropdown-item 
                                                {{ request()->is('announcements') ? 'active' : '' }}"
                                href="/announcements">
                                Announcements
                            </a>
                        </li>
                         <li>
                            <a class="dropdown-item {{ request()->is('indexings/*') ? 'active' : '' }}"
                                href="{{ url('indexings/' . $journal->slug) }}">
                                Indexings
                            </a>
                        </li>

                    </ul>
                </li>


                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle 
                                        {{ request()->is('instructons-for-authors') ? 'active' : '' }}"
                        href="#" id="forAuthorsDropdown" role="button" data-bs-toggle="dropdown"
                        aria-expanded="false">
                        For Authors
                    </a>

                    <ul class="dropdown-menu" aria-labelledby="forAuthorsDropdown">

                        <li>
                            <a class="dropdown-item 
                                                {{ request()->is('copyrights') ? 'active' : '' }}"
                                href="/copyrights">
                                Copyright
                            </a>
                        </li>

                        <li>
                            <a class="dropdown-item 
                                                {{ request()->is('authors-guidelines') ? 'active' : '' }}"
                                href="/authors-guidelines">
                                Author Guidelines
                            </a>
                        </li>

                        <li>
                            <a class="dropdown-item 
                                                {{ request()->is('review-process') ? 'active' : '' }}"
                                href="/review-process">
                                Review Process
                            </a>
                        </li>


                        <li>
                            <a class="dropdown-item 
                                                {{ request()->is('publication-ethics') ? 'active' : '' }}"
                                href="/publication-ethics">
                                Publication Ethics
                            </a>
                        </li>

                        <li>
                            <a class="dropdown-item 
                                                {{ request()->is('processing-fee') ? 'active' : '' }}"
                                href="/processing-fee">
                                Article Processing Charges
                            </a>
                        </li>


                        {{-- <li>
                            <a class="dropdown-item 
                                                {{ request()->is('open-access-policy') ? 'active' : '' }}"
                                href="/open-access-policy">
                                Publication Criteria
                            </a>
                        </li> --}}
                    </ul>
                </li>


                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle 
                                        {{ request()->is('instructons-for-authors') ? 'active' : '' }}"
                        href="#" id="forAuthorsDropdown" role="button" data-bs-toggle="dropdown"
                        aria-expanded="false">
                        Archives
                    </a>

                    <ul class="dropdown-menu" aria-labelledby="forAuthorsDropdown">

                        <li>
                            <a class="dropdown-item {{ request()->is('archives/*') ? 'active' : '' }}"
                                href="{{ url('archives/' . $journal->slug) }}">
                                Archives
                            </a>
                        </li>
                        {{-- <li>
                            <a class="dropdown-item 
                                                {{ request()->is('copyrights') ? 'active' : '' }}"
                                href="/copyrights">
                                Article in-Press
                            </a>
                        </li> --}}

                    </ul>
                </li>


                {{-- <li class="nav-item"><a class="nav-link {{ request()->is('manuscript') ? 'active' : '' }}"
                        href="/manuscript">SUBMIT MANUSCRIPT</a></li> --}}

                {{-- <li class="nav-item"><a class="nav-link {{ request()->is('payments') ? 'active' : '' }}"
                        href="/payments">PAYMENTS</a></li> --}}
                <li class="nav-item"><a class="nav-link {{ request()->is('contact-us') ? 'active' : '' }}"
                        href="/contact-us">Contact Us</a></li>

            </ul>
            <form class="header-search-form d-flex ms-lg-3" action="{{ route('article.search') }}" method="GET" role="search">
                <input class="form-control form-control-sm" type="search" name="q" value="{{ request('q') }}"
                    placeholder="Search articles" aria-label="Search articles">
                <button class="btn btn-sm btn-light ms-1" type="submit" aria-label="Search">
                    <i class="bi bi-search"></i>
                </button>
            </form>
        </div>

    </div>
</nav>
