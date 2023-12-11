<?php

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
Route::get('/signup', [AuthController::class,'create']);
Route::post('/auth/login', [AuthController::class,'signUp']);

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