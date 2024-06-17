
    <div class="container">
        <h1>Articles</h1>
        <a href="{{ route('articles.create') }}" class="btn btn-primary">Create Article</a>
        <table class="table">
            <thead>
            <tr>
                <th>Title</th>
                <th>Author</th>
                <th>Actions</th>
            </tr>
            </thead>
            <tbody>
            @foreach($articles as $article)
                <tr>
                    <td>{{ $article->title }}</td>
                    <td>{{ $article->user->name }}</td>
                    <td>
                        <a href="{{ route('articles.show', $article->articlesID) }}" class="btn btn-info">View</a>
                        <a href="{{ route('articles.edit', $article->articlesID) }}" class="btn btn-warning">Edit</a>
                        <form action="{{ route('articles.destroy', $article->articlesID) }}" method="POST" style="display:inline;">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger">Delete</button>
                        </form>
                    </td>
                </tr>
            @endforeach
            </tbody>
        </table>
    </div>

