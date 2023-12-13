<?php

namespace App\Http\Controllers\API;

use Illuminate\Http\Request;
use App\Models\Comment;
use App\Jobs\MailJob;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Gate;
use App\Http\Controllers\Controller;

class CommentController extends Controller
{
    public function index(){
        Gate::authorize('create', [self::class]);
        $cacheKey = 'comments_' . request('page', 1);
        $comments = Cache::remember($cacheKey, 3000, function () {
            return Comment::latest()->paginate(10);
        });
        return response()->json(['comments'=>$comments]);
    }
    public function accept(int $id){
        $comment = Comment::findOrFail($id);
        $comment->status = 1;
        $res = $comment->save();
        if ($res) Cache::flush();
        return response($res);
    }
    public function reject(int $id){
        $comment = Comment::findOrFail($id);
        $comment->status = 0;
        $res = $comment->save();
        if ($res) Cache::flush();
        return response($res);
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
        if ($res) {
            MailJob::dispatch($comment);
            for ($page = 1; Cache::has('comments_' . $page); $page++) {
                Cache::forget('comments_' . $page);
            }
        }
        return response()->json(['comment' => $comment]);
    }
    public function edit($id){
        //$comment = Comment::findOrFail($id);
        //Gate::authorize('comment', $comment);
        //return response()->json(['comment'=>$comment]);
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
        $res = $comment->save();
        if ($res) Cache::flush();
        return response()->json(['comment' => $comment, 'article'=>$request->article_id]);
    }
    public function destroy($id){
        $comment = Comment::findOrFail($id);
        Gate::authorize('comment', $comment);
        $res = $comment->delete();
        if ($res) Cache::flush();
        return response()->json(['comment' => $comment, 'article'=>$comment->article_id]);
    }
}
