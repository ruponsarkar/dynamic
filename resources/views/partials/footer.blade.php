<footer class="publisher-footer">
    <div class="container">
        <div class="publisher-footer-grid">
            <div>
                <a class="publisher-footer-brand" href="{{ url('/') }}">Corpus Scientific Publisher</a>
                <p>A home for scholarly research.<br>Connecting authors, readers and ideas.</p>
                <div class="publisher-social">
                    <a href="https://www.facebook.com/share/15mpNfjkmR7/?mibextid=wwXIfr" aria-label="Visit Corpus Scientific Publisher on Facebook" title="Facebook" target="_blank" rel="noopener noreferrer"><i class="bi bi-facebook" aria-hidden="true"></i></a>
                    <a href="https://www.instagram.com/RJMS_publisher?igsh=NXZ4d3RreW96MWlt&amp;utm_source=qr" aria-label="Visit Corpus Scientific Publisher on Instagram" title="Instagram" target="_blank" rel="noopener noreferrer"><i class="bi bi-instagram" aria-hidden="true"></i></a>
                    <a href="https://wa.me/917002207076" aria-label="Contact Corpus Scientific Publisher on WhatsApp" title="WhatsApp" target="_blank" rel="noopener noreferrer"><i class="bi bi-whatsapp" aria-hidden="true"></i></a>
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
                <h2>Get in touch</h2>
                <a href="mailto:editor@csp.com">editor@csp.com</a>
                <p>Ngong Road, Upperhill<br>PO Box 206, Kenya · 20100</p>
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
