<footer class="publisher-footer">
    <div class="container">
        <div class="publisher-footer-grid">
            <div>
                <a class="publisher-footer-brand" href="{{ url('/') }}">Corpus Scientific Publisher</a>
                <p>Quality Research Trusted Publishing
                <!--<br>Connecting authors, readers and ideas.-->
                </p>
                <div class="publisher-social">
                    <a href="https://www.facebook.com/profile.php?id=100014151253407"
                        aria-label="Visit Corpus Scientific Publisher on Facebook" title="Facebook" target="_blank"
                        rel="noopener noreferrer"><i class="bi bi-facebook" aria-hidden="true"></i></a>
                    <a href="https://www.instagram.com/corpus_scientific_publisher?cplk=MWtlZGVwdG9qZXUyOQ=="
                        aria-label="Visit Corpus Scientific Publisher on Instagram" title="Instagram" target="_blank"
                        rel="noopener noreferrer"><i class="bi bi-instagram" aria-hidden="true"></i></a>
                    <a href="https://wa.me/917002756501" aria-label="Contact Corpus Scientific Publisher on WhatsApp"
                        title="WhatsApp" target="_blank" rel="noopener noreferrer"><i class="bi bi-whatsapp"
                            aria-hidden="true"></i></a>
                </div>
            </div>
            <div>
                <h2>Explore</h2>
                <a href="{{ url('journals') }}">Our journals</a>
                <a href="{{ url('about-us') }}">About us</a>
                <a href="{{ url('news') }}">News</a>
                <a href="{{ url('privacy-policy') }}">Privacy policy</a>
            </div>
            <div>
                <h2>For authors</h2>
                <a href="{{ url('instructons-for-authors') }}">Author guidelines</a>
                <a href="{{ url('submit-article') }}">Submit a manuscript</a>
                <a href="{{ url('processing-fee') }}">Publication charges</a>
                <a href="{{ url('copyrights') }}">Copyright</a>
            </div>
            <div>
                <h2>Contact Information</h2>
                {{-- <a href="mailto:editor@csp.com">editor@csp.com</a> --}}
                <p>PUB ROWARPAR, HOJAI, ASSAM - INDIA
                    +917002756501</p>
                <p>Principal Contact : Director<br>
 Email: director@cspublisher.com</p>
                <a href="{{ url('contact-us') }}">Contact our team ↗</a>
            </div>
        </div>
        <div class="publisher-footer-bottom">
            <span>© {{ date('Y') }} Corpus Scientific Publisher</span>
            <a href="https://creativecommons.org/licenses/by/4.0/legalcode">Creative Commons license</a>
            <a href="{{ url('privacy-policy') }}">Privacy policy</a>
            <span>Developed by <a href="https://pageuptechnologies.com">PageUp Technologies</a>
            </span>
        </div>
    </div>
</footer>
