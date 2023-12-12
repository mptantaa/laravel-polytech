<?php

namespace App\Http\Controllers;

use App\Jobs\MailJob;
use App\Models\Article;
use App\Models\Comment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Gate;


class ArticleController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $articles = Article::latest()->paginate(5);
        return view('articles/index', ['articles'=> $articles]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        Gate::authorize('create', [self::class]);
        return view('articles/create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        Gate::authorize('create', [self::class]);

        $request->validate([
            'datePublic'=> 'required',
            'title'=> 'required',
            'desc'=> 'required',
            'shortDesc'=> 'required',
        ]);

        $article = new Article;
        $article->datePublic = $request->datePublic;
        $article->title = $request->title;
        $article->shortDesc = $request->shortDesc;
        $article->desc = $request->desc;
        $article->user_id = auth()->id();
        $res = $article->save();
        return redirect(route('article.index'));
    }

    /**
     * Display the specified resource.
     */
    public function show(Article $article)
    {
        $comments = Comment::where('article_id', $article->id)->where('status',1)->latest()->get();
        return view('articles/show', ['article'=>$article, 'comments'=>$comments]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Article $article)
    {
        Gate::authorize('create', [self::class]);
        return view('articles/edit', ['article' => $article]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Article $article)
    {
        Gate::authorize('create', [self::class]);

        $request->validate([
            'datePublic'=> 'required',
            'title'=> 'required',
            'desc'=> 'required',
        ]);

        $article->datePublic = $request->datePublic;
        $article->title = $request->title;
        $article->shortDesc = $request->shortDesc;
        $article->desc = $request->desc;
        $article->save();
        return redirect(route('article.show', ['article' => $article]));
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Article $article)
    {
        Gate::authorize('create', [self::class]);

        Comment::where('article_id', $article->id)->delete();
        $article->delete();
        return redirect()->route('article.index');
    }
}
