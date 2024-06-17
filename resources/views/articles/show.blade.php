<x-app-layout>
    <div class="container py-5">
        <div style="height: 100px;"></div> <!-- Blank div to add space -->
        <div class="card">
            <div class="card-header">
                <h1 class="card-title">{{ $article->title }}</h1>
            </div>
            <div class="card-body">
                @if($article->articles_img)
                    <div class="d-flex justify-content-center mb-3">
                        <img src="{{ asset('storage/' . $article->articles_img) }}" class="img-fluid rounded" alt="Banner Image" style="object-fit: cover; max-height: 500px;">
                    </div>
                @endif
                <div class="mb-3">
                    <div class="d-flex justify-content-between align-items-center mb-2">
                        <p class="mb-0"><strong>By:</strong> {{ $article->user->name }}</p>
                        <p class="mb-0"><strong>Published on:</strong> {{ $article->published_on }}</p>
                    </div>
                </div>
                <div>{!! Parsedown::instance()->text($article->body) !!}</div>
            </div>
        </div>
    </div>
</x-app-layout>
