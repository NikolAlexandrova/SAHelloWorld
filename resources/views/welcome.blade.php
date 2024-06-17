<x-article>
    <x-slot name="title">Welcome to Bugslayer's Media Database!</x-slot>
    <x-slot name="subtitle">This is the home page</x-slot>
    <div class="columns">

        <div class="column is-8-desktop is-12-tablet">
            <article class="content">
                <p><strong>Keep track of your entertainment journey.</strong></p>
                <p>
                    Experience the ultimate organization tool for your movie, TV show, and game adventures.
                    Bugslayer's Media Database allows you to effortlessly add, remove, and modify items in
                    your collection, ensuring you never lose track of what you've watched or played. Say
                    goodbye to forgetting titles or missing out on hidden gems!
                </p>
                <p><i>Discover, rate, and reminisce.</i></p>
                <p>
                    Explore our vast database filled with thousands of titles across various genres and
                    platforms. From classic films to the latest releases, there's something for every taste.
                    Rate each item based on your personal enjoyment and leave insightful reviews to share your
                    thoughts with the Bugslayer community. Whether you're reliving fond memories or uncovering
                    new favorites, Bugslayer's Media Database keeps your entertainment journey alive.
                </p>
                <p><strong>Start curating your media collection today!</strong></p>
                <p>
                    Join Bugslayer's Media Database now and take control of your entertainment experience.
                    Create your personalized library, track your progress, and connect with like-minded
                    enthusiasts. With intuitive features and seamless navigation, managing your media collection
                    has never been easier. Don't wait any longer—start building your dream database today!
                </p>
            </article>
        </div>

        <div class="column is-4-desktop is-12-tablet">
            <p class="title is-4">Latest news</p>

            <div class="columns is-multiline">

                @foreach($latestArticles as $article)
                    <div class="column is-12">
                        <div class="card">

                            <div class="card-image">
                                <img src="{{ $article->img_url }}" alt="Article picture">
                            </div>

                            <div class="card-content">
                                <div class="content">

                                    <a class="title is-4" href="/articles/{{$article->id}}">{{$article->title}}</a>

                                    <p>{{$article->excerpt}}</p>
                                </div>
                                <div class="has-text-centered">
                                    <a href="/articles/{{$article->id}}" class="button is-primary">Read more...</a>
                                </div>
                            </div>
                            <footer class="card-footer">
                                <p class="card-footer-item"><small>Published: {{ $article->published_at->diffForHumans() }}</small></p>
                            </footer>
                        </div>
                    </div>
                @endforeach

            </div>
        </div>
    </div>
</x-article>
