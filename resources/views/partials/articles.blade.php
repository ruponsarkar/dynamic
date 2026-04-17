<div class="p-2">
    @foreach ($articles as $article)
        <div class="card-c p-3 mb-2">



            <div>
                <b>
                    {{ $article->name }}
                </b>
            </div>
            <div>
                <b>Author(s):</b>{{ $article->aname }}
            </div>

            @if ($article->doi != null && $article->doi != '' && $article->doi != 'undefined')
                <div>
                    <b>DOI:</b>{{ $article->doi }}
                </div>
            @endif

            <div>
                <b>Page:</b>{{ $article->page }}
            </div>

            <div>
                <a href="/article/{{ $article->slug }}">View</a>
                <a href="/assets/articles/{{ $article->file }}">Download PDF</a>
            </div>


        </div>
    @endforeach
</div>
