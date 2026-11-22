<?php

namespace App\Http\Controllers;

use App\Models\NewsArticle;

class NewsController extends Controller
{
    public function index()
    {
        $articles = NewsArticle::published()->latest('published_at')->paginate(9);

        return view('pages.news.index', compact('articles'));
    }

    public function show(NewsArticle $article)
    {
        abort_unless($article->active && $article->published_at, 404);
        $related = NewsArticle::published()->where('id', '!=', $article->id)->latest('published_at')->take(3)->get();

        return view('pages.news.show', compact('article', 'related'));
    }
}
