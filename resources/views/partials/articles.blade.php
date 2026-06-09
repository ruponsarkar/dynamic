<style>
    .article-card-wrap {
        overflow-wrap: anywhere;
        word-break: break-word;
    }

    .article-card-links a {
        overflow-wrap: anywhere;
        word-break: break-word;
    }
</style>

<div class="p-2">
    @foreach ($articles as $article)
        <div class="card-c p-3 mb-2 article-card-wrap">



            <div>
                {{-- <b>
                    {{ $article->name }}
                </b> --}}

                <b><a class="text-dark" href="/article/{{ $article->slug }}">{{ $article->name }}</a></b>
            </div>
            <div>
                <b>Author(s):</b>{{ $article->aname }}
            </div>

            {{-- <div>
                <b>DOI:</b>{{ $article->doi }}
            </div> --}}
            @if ($article->doi)
                <div>
                    <b>DOI:</b> <a class="text-dark" href="{{ $article->doi }}" target="_blank">{{ $article->doi }}</a>
                </div>
            @endif
            <div>
                <b>Page:</b>{{ $article->page }}
            </div>

            <div class="article-card-links">
                <a href="/article/{{ $article->slug }}">View</a>
                <a href="/assets/articles/{{ $article->file }}">Download PDF</a>
            </div>


        </div>
    @endforeach
</div>
