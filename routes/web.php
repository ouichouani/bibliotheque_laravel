<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\BookController;


/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::resource('book', BookController::class)->middleware('auth');

Route::get('/', function () {
    return view('main');
})->name('index');

Route::get('/contact', function () {
    return view('contact');
})->name('contact');

Route::get('/list', function () {
    return view('list');
})->name('list');

Route::get('/details', function () {
    return view('details');
})->name('details');

Route::get('/about', function () {
    return view('about');
})->name('about');

Route::get('/signup', function () {
    return view('signup');
})->name('signup');

Route::get('/profile', function () {
    return view('profile');
})->name('profile');

Route::get('/Profile/{id}', 'App\Http\Controllers\UserController@show')->name('Profile');
Route::post('/signup', 'App\Http\Controllers\UserController@store');
Route::post('/login', 'App\Http\Controllers\UserController@login')->name('login');
Route::get('/logout', 'App\Http\Controllers\UserController@logout')->name('logout');

Route::get('/login', function () {
    return view('login');
})->name('login');

route::fallback(function () {
    return view('notfound');
}, 404);


Route::get('/books', [BookController::class, 'index'])->name('book.index');

Route::get('/test', function (){
    dd(Auth::user()) ;
});











use App\Events\CreateBookEvent;
Route::get('/fire-event', function () {
    $book = \App\Models\Book::first(); // Get any book
    event(new CreateBookEvent($book));
    return 'Event Fired!';
});