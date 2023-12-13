<?php

use App\Http\Controllers\ArticleController;
use App\Http\Controllers\CommentController;

use App\Http\Controllers\AuthController;
use App\Http\Controllers\MainController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

//Auth
Route::get('/signup', [AuthController::class,'create']);
Route::post('/signup', [AuthController::class,'signUp']);
Route::get('/signin', [AuthController::class,'auth'])->name('login');
Route::post('/signin', [AuthController::class,'signIn']);
Route::get('/logout', [AuthController::class,'logout']);


//Article
Route::resource('article', ArticleController::class)->middleware('auth:sanctum');
Route::get('article/{article}', [ArticleController::class, 'show'])->middleware('stats', 'auth:sanctum')->name('article.show');

//Comment
Route::middleware('auth:sanctum')->prefix('/comment')->group(function () {
    Route::get('', [CommentController::class, 'index'])->name('comment.index');;
    Route::post('', [CommentController::class, 'store']);
    Route::get('/{comment}/edit', [CommentController::class, 'edit'])->name('comment.edit');
    Route::put('{comment}', [CommentController::class, 'update']);
    Route::delete('{comment}', [CommentController::class, 'destroy']);
    Route::get('{comment}/accept', [CommentController::class, 'accept']);
    Route::get('{comment}/reject', [CommentController::class, 'reject']);
});

Route::get('/', [MainController::class,'index']);
Route::get('/gallery/{full_image}', [MainController::class,'show']);

Route::get('/about', function () {
    return view('main/about');
});

Route::get('/contact', function () { 
    $contact = [
        'name' => 'Anton Alexeev',
        'address' => 'B.Semenovskaya',
        'phone' => '8 (999) 000-0000',
        'email' => '@ru.ru'
    ];
    return view('main/contact', ['contact' => $contact]);
});