<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Comment;
use App\Jobs\MailJob;
use Illuminate\Support\Facades\Gate;
use App\Models\Article;
use App\Models\User;

class CommentController extends Controller
{
    public function index(){
        Gate::authorize('create', [self::class]);
        $comments = Comment::latest()->paginate(10);
        return view('comments/index', ['comments'=>$comments]);
    }
    public function accept(int $id){
        $comment = Comment::findOrFail($id);
        $comment->status = 1;
        $comment->save();
        return redirect()->route('comment.index');
    }
    public function reject(int $id){
        $comment = Comment::findOrFail($id);
        $comment->status = 0;
        $comment->save();
        return redirect()->route('comment.index');
    }
    public function store(Request $request) {
        $request->validate([
            'title'=> 'required',
            'text'=> 'required',
        ]);
        $comment = new Comment;
        $comment->title = $request->title;
        $comment->text = $request->text;
        $comment->article_id = $request->article_id;
        $comment->user_id = auth()->id();
        $res = $comment->save();
        if ($res) MailJob::dispatch($comment);
        return redirect(route('article.show', ['article'=>$request->article_id, 'res'=>$res]));
    }
    public function edit($id){
        $comment = Comment::findOrFail($id);
        Gate::authorize('comment', $comment);
        return view('comments.edit', ['comment' => $comment]);
    }
    public function update(Request $request, $id){
        $request->validate([
            'title'=> 'required',
            'text'=> 'required',        
        ]);

        $comment = Comment::findOrFail($id);
        Gate::authorize('comment', $comment);
        $comment->title = $request->title;
        $comment->text = $request->text;
        $comment->save();
        return redirect()->route('article.show', ['article'=>$comment->article_id]);
    }
    public function destroy($id){
        $comment = Comment::findOrFail($id);
        Gate::authorize('comment', $comment);
        $comment->delete();
        return redirect()->route('article.show', ['article'=>$comment->article_id]);
    }
}
