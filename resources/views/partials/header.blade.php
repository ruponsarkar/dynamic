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
            var isWebView = /(wv|WebView|Instagram|FBAN|FBAV|Line\/|; wv\)|Version\/[\d.]+.*Chrome|GSA|MiuiBrowser|DuckDuckGo|YaBrowser)/i.test(ua)
                || !!window.ReactNativeWebView
                || !!(window.webkit && window.webkit.messageHandlers)
                || document.referrer.indexOf('android-app://') === 0;

            if (isWebView && hasTouch && smallScreen) {
                document.addEventListener('DOMContentLoaded', function() {
                    document.body.classList.add('mobile-webview');
                });
            }
        })();
    </script>

    {{-- <div class="px-2 py-1" style="background-color: #4571ff; text-align: right">
        <div class="text-white " style="font-size: small">
            <i class="bi bi-telephone"></i> +91 8638261097 &nbsp; &nbsp;
            <i class="bi bi-envelope"></i> 2Q5m0@example.com
        </div>
    </div> --}}

    <!-- TOP BLUE HEADING (EXACT COPY) -->
    <div class="top-banner ">
        <div class="container">
            <div class="d-flex align-items-center justify-content-between">

                <img src="{{ asset('assets/homeAssets/' . $assets->logo) }}" class="logo" alt="">
                <div>

                    <div class="journal-title">
                        {{-- P-Edu International Journal of Multidisciplinary Studies --}}
                        {{-- {{ $journal->j_name }} --}}
                        IRGS Publisher

                    </div>
                    <div>
                        <b>
                           International Research and Global Society
                        </b>
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

<nav class="navbar navbar-expand-lg shadow-sm" style="background-color: #031e87; border-top: 4px solid #207daf;">

    <div class="container">

        {{-- <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navMenu">
                <span class="navbar-toggler-icon"></span>
            </button> --}}

        <div class="collapse navbar-collapse" id="navMenu">
            <ul class="navbar-nav mx-auto mb-2 mb-lg-0">

                <li class="nav-item"><a class="nav-link {{ request()->is('/') ? 'active' : '' }}"
                        href="/">HOME</a></li>

                <li class="nav-item"><a class="nav-link {{ request()->is('journals') ? 'active' : '' }}"
                        href="/journals">JOURNALS</a></li>

                {{-- <li class="nav-item"><a class="nav-link {{ request()->is('/about-us') ? 'active' : '' }}"
                        href="/about-us">ABOUT US</a></li> --}}



                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle 
                                        {{ request()->is('instructons-for-authors') ? 'active' : '' }}"
                        href="#" id="forAuthorsDropdown" role="button" data-bs-toggle="dropdown"
                        aria-expanded="false">
                        FOR AUTHORS
                    </a>

                    <ul class="dropdown-menu" aria-labelledby="forAuthorsDropdown">
                        <li>
                            <a class="dropdown-item 
                                                {{ request()->is('instructons-for-authors') ? 'active' : '' }}"
                                href="/instructons-for-authors">
                                INSTRUCTIONS FOR AUTHORS
                            </a>
                        </li>
                        <li>
                            <a class="dropdown-item 
                                                {{ request()->is('publication-ethics') ? 'active' : '' }}"
                                href="/publication-ethics">
                                PUBLICATION ETHICS
                            </a>
                        </li>
                        <li>
                            <a class="dropdown-item 
                                                {{ request()->is('open-access-policy') ? 'active' : '' }}"
                                href="/open-access-policy">
                                OPEN ACCESS POLICY
                            </a>
                        </li>
                        <li>
                            <a class="dropdown-item 
                                                {{ request()->is('review-process') ? 'active' : '' }}"
                                href="/review-process">
                                PEER REVIEW PROCESS
                            </a>
                        </li>
                        <li>
                            <a class="dropdown-item 
                                                {{ request()->is('copyrights') ? 'active' : '' }}"
                                href="/copyrights">
                                COPYRIGHTS
                            </a>
                        </li>

                        <li>
                            <a class="dropdown-item 
                                                {{ request()->is('processing-fee') ? 'active' : '' }}"
                                href="/processing-fee">
                                PROCESSING FEE
                            </a>
                        </li>
                        <li>
                            <a class="dropdown-item 
                                                {{ request()->is('plagiarism-policy') ? 'active' : '' }}"
                                href="/plagiarism-policy">
                                PLAGIARISM POLICY
                            </a>
                        </li>
                        <li>
                            <a class="dropdown-item 
                                                {{ request()->is('waiver-policy') ? 'active' : '' }}"
                                href="/waiver-policy">
                                WAIVER POLICY
                            </a>
                        </li>


                        {{-- <li>
                            <a class="dropdown-item 
                                                {{ request()->is('privacy-policy') ? 'active' : '' }}"
                                href="/privacy-policy">
                                PRIVACY POLICY
                            </a>
                        </li> --}}
                    </ul>
                </li>

                {{-- <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle 
                                        {{ request()->is('instructions-for-authors') ? 'active' : '' }}"
                        href="#" id="forAuthorsDropdown" role="button" data-bs-toggle="dropdown"
                        aria-expanded="false">
                        FOR REVIEWERS
                    </a>

                    <ul class="dropdown-menu" aria-labelledby="forAuthorsDropdown">
                        <li>
                            <a class="dropdown-item 
                                                {{ request()->is('instructions-for-reviewers') ? 'active' : '' }}"
                                href="/instructions-for-reviewers">
                                REVIEWERS GUIDELINES
                            </a>
                        </li>
                        <li>
                            <a class="dropdown-item 
                                                {{ request()->is('join-reviewers') ? 'active' : '' }}"
                                href="/join-reviewer">
                                JOIN REVIEWERS
                            </a>
                        </li>
                    </ul>
                </li> --}}

                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle 
                                        {{ request()->is('instructions-for-editors') ? 'active' : '' }}"
                        href="#" id="forAuthorsDropdown" role="button" data-bs-toggle="dropdown"
                        aria-expanded="false">
                        FOR EDITORS
                    </a>

                    <ul class="dropdown-menu" aria-labelledby="forAuthorsDropdown">
                        <li>
                            <a class="dropdown-item 
                                                {{ request()->is('instructions-for-editors') ? 'active' : '' }}"
                                href="/instructions-for-editors">
                                EDITORS GUIDELINES
                            </a>
                        </li>
                        <li>
                            <a class="dropdown-item 
                                                {{ request()->is('join-editors') ? 'active' : '' }}"
                                href="/join-editor">
                                JOIN EDITORS
                            </a>
                        </li>

                         <li>
                            <a class="dropdown-item 
                                                {{ request()->is('instructions-for-reviewers') ? 'active' : '' }}"
                                href="/instructions-for-reviewers">
                                REVIEWERS GUIDELINES
                            </a>
                        </li>

                        <li>
                            <a class="dropdown-item 
                                                {{ request()->is('join-reviewers') ? 'active' : '' }}"
                                href="/join-reviewer">
                                JOIN REVIEWERS
                            </a>
                        </li>
                    </ul>
                </li>




                {{-- <li class="nav-item"><a class="nav-link {{ request()->is('editorial-board') ? 'active' : '' }}"
                            href="/editorial-board">EDITORIAL BOARD</a></li> --}}
                {{-- <li class="nav-item"><a class="nav-link {{ request()->is('journals') ? 'active' : '' }}"
                        href="/journals">JOURNALS</a></li> --}}
                {{-- <li class="nav-item"><a
                            class="nav-link {{ request()->is('instructons-for-authors') ? 'active' : '' }}"
                            href="/instructons-for-authors">INSTRUCTIONS FOR
                            AUTHORS</a></li> --}}
                {{-- <li class="nav-item"><a class="nav-link {{ request()->is('copyright-policy') ? 'active' : '' }}"
                        href="/copyright-policy">COPYRIGHT</a></li> --}}
                <li class="nav-item"><a class="nav-link {{ request()->is('manuscript') ? 'active' : '' }}"
                        href="/manuscript">SUBMIT MANUSCRIPT</a></li>
                {{-- <li class="nav-item"><a class="nav-link {{ request()->is('current-issue') ? 'active' : '' }}"
                            href="/current-issue">CURRENT ISSUE</a></li> --}}
                {{-- <li class="nav-item"><a class="nav-link {{ request()->is('archives') ? 'active' : '' }}"
                            href="/archives">ARCHIVES</a></li> --}}
                {{-- <li class="nav-item"><a class="nav-link {{ request()->is('conference') ? 'active' : '' }}"
                            href="/conference">CONFERENCE PROCEEDING</a></li> --}}
                <li class="nav-item"><a class="nav-link {{ request()->is('payments') ? 'active' : '' }}"
                        href="/payments">PAYMENTS</a></li>
                <li class="nav-item"><a class="nav-link {{ request()->is('contact-us') ? 'active' : '' }}"
                        href="/contact-us">CONTACT US</a></li>

            </ul>
        </div>

    </div>
</nav>
