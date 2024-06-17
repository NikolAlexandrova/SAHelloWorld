<x-dashboard-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Article Creation') }}
        </h2>
    </x-slot>
    <div class="container">
        <h1>Create Article</h1>
        <form action="{{ route('articles.store') }}" method="POST" enctype="multipart/form-data">
            @csrf
            <div class="form-group">
                <label for="title">Title</label>
                <input type="text" class="form-control" id="title" name="title" required>
            </div>
            <div class="form-group">
                <label for="body">Body</label>
                <textarea class="form-control" id="body" name="body"></textarea>
                <!-- Include the SimpleMDE CSS -->
                <link rel="stylesheet" href="https://cdn.jsdelivr.net/simplemde/latest/simplemde.min.css">
                <!-- Include the SimpleMDE JavaScript -->
                <script src="https://cdn.jsdelivr.net/simplemde/latest/simplemde.min.js"></script>
                <script>
                    var simplemde = new SimpleMDE({ element: document.getElementById("body") });
                </script>
            </div>
            <div class="form-group">
                <label for="articles_img">Banner Image</label>
                <input type="file" class="form-control" id="articles_img" name="articles_img">
            </div>
            <div class="form-group">
                <label for="scheduled_post">Scheduled Post (optional)</label>
                <input type="datetime-local" class="form-control" id="scheduled_post" name="scheduled_post">
                <button type="button" onclick="document.getElementById('scheduled_post').value = ''">Clear</button>
            </div>
            <div class="form-group">
                <label for="status">Status</label>
                <select class="form-control" id="status" name="status">
                    <option value="save">Save</option>
                    <option value="post">Post</option>
                    <option value="archive">Archive</option> <!-- New option -->
                </select>
            </div>
            <script>
                function checkStatusAndConfirm() {
                    var status = document.getElementById('status').value;
                    if (status === 'post') {
                        return confirm('Are you sure you want to post this article?');
                    }
                    return true;
                }
            </script>
            <button type="submit" class="btn btn-primary" onclick="return checkStatusAndConfirm();">Submit</button>

        </form>
    </div>
</x-dashboard-layout>
