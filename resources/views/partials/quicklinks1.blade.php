<style>
    .quicklinks-btn {
        /* background-color: #031e87; */
        border-bottom: 1px solid #eeeff0;
        color: rgb(15, 14, 14);
        padding: 8px 10px;
        width: 100%;
        display: block;
    }

    .quicklinks-btn:hover {
        background-color: #eeeff0;
        /* color: white; */
    }
</style>

<div>
    <div class="card-c">
        <div class="card-header">
            <div class="h-box">
                <div class="h-box-text p-2">
                    Quick Links
                </div>
            </div>
        </div>

        <div>

            @foreach($useful_links as $link)
                <div class="p-2">
                    <a href="{{ $link->path }}" class="quicklinks-btn">{{ $link->page_title }}</a>
                </div>
            @endforeach
            {{-- <div class="p-2">
                <a href="/journals" class="quicklinks-btn">Journals</a>
            </div>
            <div class="p-2">
                <a href="/instructons-for-authors" class="quicklinks-btn">Author Instructions</a>
            </div>
            <div class="p-2">
                <a href="/manuscript" class="quicklinks-btn">Submit Manuscript</a>
            </div>
            <div class="p-2">
                <a href="/payments" class="quicklinks-btn">Payments</a>
            </div>
            <div class="p-2">
                <a href="/contact-us" class="quicklinks-btn">Contact Us</a>
            </div> --}}

        </div>
    </div>
</div>
