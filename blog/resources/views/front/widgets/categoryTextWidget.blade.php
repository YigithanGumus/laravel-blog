@if (count($articles) > 0)
    @foreach ($articles as $article)
        <!-- Post preview-->
        <div class="post-preview">
            <a href="{{ route('single', [$article->getCategory->slug, $article->slug]) }}">
                <h2 class="post-title" style="border-bottom:0.1pt solid rgb(196, 192, 192);">
                    {{ $article->title }}
                </h2>
                <img src="{{ $article->image }}" alt="" class="img-fluid">
                <h3 class="post-subtitle">
                    {{ Str::limit($article->content, 75) }}

                </h3>
            </a>
            <div class="row">
                <div class="col-md-6" style="margin-top:-25px;">
                    <p class="post-meta"> Kategori:
                        <a href="#">{{ $article->getCategory->name }}</a>
                    </p>
                </div>
                <div class="col-md-6" style="margin-top:-25px;">
                    <p class="post-meta">
                        <span>{{ $article->created_at->diffForHumans() }}</span>
                    </p>
                </div>
            </div>
            <span style="color:Red;">Okunma Sayısı : {{ $article->hit }}</span>
        </div>
        @if (!$loop->last)
            <hr>
        @endif
    @endforeach
    {{ $articles->links() }}
@else
    <div class="alert alert-danger">
        <h1>Bu kategoriye ait yazı bulunamadı!</h1>
    </div>
@endif
