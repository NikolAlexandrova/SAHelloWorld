<!-- News Start -->
<div class="container-fluid blog pb-5 {{ request()->is('news') ? 'py-5' : ''}}">
    <div class="container pb-5">

        <div class="pb-5">
            <h4 class="text-primary sub-title fw-bold wow fadeInUp" data-wow-delay="0.1s">Blog & News</h4>
            <h1 class="display-2 mb-0 wow fadeInUp white" data-wow-delay="0.3s">Our Latest News & Articles</h1>
        </div>

        <div class="blog-carousel owl-carousel pt-5 wow fadeInUp" data-wow-delay="0.1s">

            @foreach($articles as $article)
                <div class="blog-item bg-white rounded wow fadeInUp" data-wow-delay="0.1s">
                    <div class="blog-img rounded-top">
                        <img src="{{ Storage::url($article->articles_img) }}" class="img-fluid rounded-top w-100" alt="Image">
                    </div>
                    <div class="bg-light rounded-bottom p-4">
                        <div class="d-flex justify-content-between mb-4">
                            <a href="#" class="text-muted"><i class="fa fa-calendar-alt text-primary"></i> {{ \Carbon\Carbon::parse($article->published_on)->format('d F Y') }}</a>
                        </div>
                        <a href="{{ route('articles.show', $article->articlesID) }}" class="h4 mb-3 d-block">{{ $article->title }}</a>
                        <p class="mb-3">{{ Str::limit($article->body, 100) }}</p>
                        <a class="btn btn-primary rounded-pill text-white py-2 px-4" href="{{ route('articles.show', $article->articlesID) }}">Read More</a>
                    </div>
                </div>
            @endforeach

        </div>
    </div>
</div>
<!-- News End -->
