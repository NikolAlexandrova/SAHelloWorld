<?php

namespace App\Http\Controllers;

use App\Models\Article;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class ArticleController extends Controller
{
    public function index()
    {
        $articles = Article::all();
        return view('dashboard', compact('articles'));
    }

    public function news()
    {
        $articles = Article::where('is_posted', true)
            ->where('is_archived', false)
            ->where('published_on', '<=', now())
            ->orderBy('published_on', 'desc')
            ->get();
        return view('dashboard', compact('articles'));
    }

    public function publicNews()
{
    $articles = Article::where('is_posted', true)
        ->where('is_archived', false)
        ->where('published_on', '<=', now())
        ->orderBy('published_on', 'desc')
        ->get();
    return view('news', compact('articles'));
}

    public function create()
    {
        return view('articles.create');
    }

    public function store(Request $request)
{
    $request->validate([
        'title' => 'required|string|max:255',
        'body' => 'required',
        'articles_img' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        'published_on' => 'date|nullable',
        'status' => 'required|in:save,post,archive',
    ]);

    $articles_img = null;
    if ($request->hasFile('articles_img')) {
        $articles_img = $request->file('articles_img')->store('banners', 'public');
    }

    $is_archived = $request->status === 'archive';
    $is_posted = $request->status === 'post';
    $published_on = $request->status === 'post' ? now() : null;
    $scheduled_post = $request->scheduled_post;
    if ($request->status === 'post') {
        if ($scheduled_post && $scheduled_post > now()) {
            // If a scheduled post date is selected and it's in the future, don't post the article immediately
            $is_posted = false;
        } else {
            // If no scheduled post date is selected or it's in the past, post the article immediately
            $is_posted = true;
            $published_on = now();
        }
    } elseif ($request->status === 'archive') {
        $scheduled_post = null;
    }

    // If the article is being archived, it should not be posted
    if ($is_archived) {
        $is_posted = false;
    }

    Article::create([
        'title' => $request->title,
        'body' => $request->body,
        'articles_img' => $articles_img,
        'userID' => Auth::id(),
        'published_on' => $published_on,
        'is_archived' => $is_archived,
        'is_posted' => $is_posted,
        'scheduled_post' => $scheduled_post,
    ]);

    return redirect()->route('dashboard');
}

    public function show($id)
    {
        $article = Article::findOrFail($id);

        // Only allow viewing if the article is posted
        if ($article->is_posted) {
            return view('articles.show', compact('article'));
        }

        abort(404); // If the article is not posted, return a 404 error

    }

    public function dashboardShow($id)
    {
        $article = Article::findOrFail($id);

        // Allow viewing of both posted and not posted articles
        return view('articles.show', compact('article'));
    }


    public function edit($id)
    {
        $article = Article::findOrFail($id);
        return view('articles.edit', compact('article'));
    }

    public function update(Request $request, $id)
    {
    $request->validate([
        'title' => 'required|string|max:255',
        'body' => 'required',
        'articles_img' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        'published_on' => 'date|nullable',
        'status' => 'required|in:save,post,archive',
    ]);

    $article = Article::findOrFail($id);
    $articles_img = $article->articles_img;
    $published_on = $request->status === 'post' ? now() : $article->published_on;
    $scheduled_post = $request->scheduled_post;
    $is_posted = $article->is_posted;
    $is_archived = $request->status === 'archive';
    if ($request->status === 'post') {
        if ($scheduled_post && $scheduled_post > now()) {
            // If a scheduled post date is selected and it's in the future, don't post the article immediately
            $is_posted = false;
            $published_on = null;
        } else {
            // If no scheduled post date is selected or it's in the past, post the article immediately
            $is_posted = true;
            $published_on = now();
        }
    } elseif ($is_archived) {
        $is_posted = false;
        $scheduled_post = null;
    }

    if ($request->hasFile('articles_img')) {
        $articles_img = $request->file('articles_img')->store('banners', 'public');
    }

    $article->update([
        'title' => $request->title,
        'body' => $request->body,
        'articles_img' => $articles_img,
        'published_on' => $published_on,
        'is_archived' => $is_archived,
        'is_posted' => $is_posted,
        'scheduled_post' => $scheduled_post,
    ]);

    return redirect()->route('dashboard');
    }

    public function destroy($id)
    {
    $article = Article::findOrFail($id);

    // Delete the image file associated with the article
    if ($article->articles_img) {
        Storage::disk('public')->delete($article->articles_img);
    }

    $article->delete();
    // keep the user on the same page after deleting an article
    return redirect()->back();
    }
}
