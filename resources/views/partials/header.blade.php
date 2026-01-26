    <!-- TOP BLUE HEADING (EXACT COPY) -->
    <div class="top-banner ">
        <div class="container">
            <div class="d-flex align-items-center justify-content-center">

                <img src="{{ asset('assets/homeAssets/' . $assets->logo) }}" class="logo" alt="">
                <div class="journal-title">
                    {{-- P-Edu International Journal of Multidisciplinary Studies --}}
                    {{ $journal->j_name }}
                </div>

                <nav class="navbar navbar-expand-lg bg-white shadow-sm">
                    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navMenu">
                        <span class="navbar-toggler-icon"></span>
                    </button>
                </div>

            </div>
        </div>
    </div>

    <nav class="navbar navbar-expand-lg shadow-sm">

        <div class="container">

            {{-- <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navMenu">
                <span class="navbar-toggler-icon"></span>
            </button> --}}

            <div class="collapse navbar-collapse" id="navMenu">
                <ul class="navbar-nav mx-auto mb-2 mb-lg-0">

                    <li class="nav-item"><a class="nav-link {{ request()->is('/') ? 'active' : '' }}"
                            href="/">HOME</a></li>
                    <li class="nav-item"><a class="nav-link {{ request()->is('editorial-board') ? 'active' : '' }}"
                            href="/editorial-board">EDITORIAL BOARD</a></li>
                    <li class="nav-item"><a
                            class="nav-link {{ request()->is('instructons-for-authors') ? 'active' : '' }}"
                            href="/instructons-for-authors">INSTRUCTIONS FOR
                            AUTHORS</a></li>
                    <li class="nav-item"><a class="nav-link {{ request()->is('manuscript') ? 'active' : '' }}"
                            href="/manuscript">SUBMIT ARTICLE</a></li>
                    <li class="nav-item"><a class="nav-link {{ request()->is('current-issue') ? 'active' : '' }}"
                            href="/current-issue">CURRENT ISSUE</a></li>
                    <li class="nav-item"><a class="nav-link {{ request()->is('archives') ? 'active' : '' }}"
                            href="/archives">ARCHIVES</a></li>
                    <li class="nav-item"><a class="nav-link {{ request()->is('conference') ? 'active' : '' }}"
                            href="/conference">CONFERENCE PROCEEDING</a></li>
                    <li class="nav-item"><a class="nav-link {{ request()->is('contact-us') ? 'active' : '' }}"
                            href="/contact-us">CONTACT</a></li>

                </ul>
            </div>

        </div>
    </nav>
