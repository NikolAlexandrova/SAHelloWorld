<div class="container-fluid blog pb-5 {{ request()->is('news') ? 'py-5' : ''}}">
    <div class="container pb-5">
        <div class="pb-5">
            <h4 class="text-primary sub-title fw-bold wow fadeInUp" data-wow-delay="0.1s">Blog & News</h4>
            <h1 class="display-2 mb-0 wow fadeInUp white" data-wow-delay="0.3s">Our Latest News & Articles</h1>
        </div>
        @foreach($articles->where('is_posted', true)
            ->where('is_archived', false)
            ->where('published_on', '<=', now())
            ->sortByDesc('published_on') as $article)
            <div class="blog-img rounded-top d-flex align-items-center justify-content-center" style="overflow: hidden; height: 200px;">
                @if($article->articles_img)
                    <img src="{{ asset('storage/' . $article->articles_img) }}" class="img-fluid rounded-top w-100" alt="Image" style="object-fit: cover;">
                @endif
            </div>
            <div class="bg-light rounded-bottom p-4">
                <div class="d-flex justify-content-between mb-4">
                    <a href="#" class="text-muted"><i class="fa fa-calendar-alt text-primary"></i> {{ \Carbon\Carbon::parse($article->published_on)->format('d F Y') }}</a>
                </div>
                <a href="{{ route('articles.show', $article->articlesID) }}" class="h4 mb-3 d-block">{{ $article->title }}</a>
                <p class="mb-3">{{ Str::limit($article->body, 100, '...') }}</p>
                <a class="btn btn-primary rounded-pill text-white py-2 px-4" href="{{ route('articles.show', $article->articlesID) }}">Read More</a>
            </div>
        @endforeach
    </div>
</div>
