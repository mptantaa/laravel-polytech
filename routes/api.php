<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\API\ArticleController;
use App\Http\Controllers\API\CommentController;
use App\Http\Controllers\API\AuthController;
/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/
//Auth
Route::post('/signup', [AuthController::class,'signUp']);
Route::post('/signin', [AuthController::class,'signIn']);
Route::get('/logout', [AuthController::class,'logout']);


//Article
Route::resource('article', ArticleController::class)->middleware('auth:sanctum');
Route::get('article/{article}', [ArticleController::class, 'show'])->middleware('stats', 'auth:sanctum')->name('article.show');

//Comment
Route::middleware('auth:sanctum')->prefix('/comment')->group(function () {
    Route::get('', [CommentController::class, 'index'])->name('comment.index');;
    Route::post('', [CommentController::class, 'store']);
    Route::put('{comment}', [CommentController::class, 'update']);
    Route::delete('{comment}', [CommentController::class, 'destroy']);
    Route::get('{comment}/accept', [CommentController::class, 'accept']);
    Route::get('{comment}/reject', [CommentController::class, 'reject']);
});

