<div>
    <div class="px-2 py-1" style="background-color: #4571ff; text-align: right">
        <div class="text-white " style="font-size: small">
            <i class="bi bi-telephone"></i> +91 8638261097 &nbsp; &nbsp;
            <i class="bi bi-envelope"></i> 2Q5m0@example.com
        </div>
    </div>

    <!-- TOP BLUE HEADING (EXACT COPY) -->
    <div class="top-banner ">
        <div class="container">
            <div class="d-flex align-items-center justify-content-center">

                <img src="{{ asset('assets/homeAssets/' . $assets->logo) }}" class="logo" alt="">
                <div>

                    <div class="journal-title">
                        {{-- P-Edu International Journal of Multidisciplinary Studies --}}
                        {{-- {{ $journal->j_name }} --}}
                        Global Scholars Academic & Scientific Research Publisher


                    </div>
                    <div>
                        <b>
                            A publisher of scholarly journals and other academic resources.
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

<nav class="navbar navbar-expand-lg shadow-sm" style="background-color: #4571ff">

    <div class="container">

        {{-- <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navMenu">
                <span class="navbar-toggler-icon"></span>
            </button> --}}

        <div class="collapse navbar-collapse" id="navMenu">
            <ul class="navbar-nav mx-auto mb-2 mb-lg-0">

                <li class="nav-item"><a class="nav-link {{ request()->is('/') ? 'active' : '' }}"
                        href="/">HOME</a></li>
                <li class="nav-item"><a class="nav-link {{ request()->is('/about-us') ? 'active' : '' }}"
                        href="/about-us">ABOUT US</a></li>



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
                                                {{ request()->is('review-process') ? 'active' : '' }}"
                                href="/review-process">
                                REVIEW PROCESS
                            </a>
                        </li>
                        <li>
                            <a class="dropdown-item 
                                                {{ request()->is('privacy-policy') ? 'active' : '' }}"
                                href="/privacy-policy">
                                PRIVECY POLICY
                            </a>
                        </li>
                    </ul>
                </li>

                <li class="nav-item dropdown">
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
                </li>

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
                    </ul>
                </li>




                {{-- <li class="nav-item"><a class="nav-link {{ request()->is('editorial-board') ? 'active' : '' }}"
                            href="/editorial-board">EDITORIAL BOARD</a></li> --}}
                <li class="nav-item"><a class="nav-link {{ request()->is('journals') ? 'active' : '' }}"
                        href="/journals">JOURNALS</a></li>
                {{-- <li class="nav-item"><a
                            class="nav-link {{ request()->is('instructons-for-authors') ? 'active' : '' }}"
                            href="/instructons-for-authors">INSTRUCTIONS FOR
                            AUTHORS</a></li> --}}
                <li class="nav-item"><a class="nav-link {{ request()->is('copyright-policy') ? 'active' : '' }}"
                        href="/copyright-policy">COPYRIGHT</a></li>
                <li class="nav-item"><a class="nav-link {{ request()->is('manuscript') ? 'active' : '' }}"
                        href="/manuscript">SUBMIT MANUSCRIPT</a></li>
                {{-- <li class="nav-item"><a class="nav-link {{ request()->is('current-issue') ? 'active' : '' }}"
                            href="/current-issue">CURRENT ISSUE</a></li> --}}
                {{-- <li class="nav-item"><a class="nav-link {{ request()->is('archives') ? 'active' : '' }}"
                            href="/archives">ARCHIVES</a></li> --}}
                {{-- <li class="nav-item"><a class="nav-link {{ request()->is('conference') ? 'active' : '' }}"
                            href="/conference">CONFERENCE PROCEEDING</a></li> --}}
                <li class="nav-item"><a class="nav-link {{ request()->is('contact-us') ? 'active' : '' }}"
                        href="#">PAYMENTS</a></li>
                <li class="nav-item"><a class="nav-link {{ request()->is('contact-us') ? 'active' : '' }}"
                        href="/contact-us">CONTACT US</a></li>

            </ul>
        </div>

    </div>
</nav>
