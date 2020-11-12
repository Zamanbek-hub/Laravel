<?php

use Illuminate\Support\Facades\Route;

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


Route::get('/', function () {
    return view('home_without_reg');
});

Route::get('/home', function () {
    return view('home');
});

Route::get('/home_emp', function () {
    return view('home_employers');
});

Route::get('/auth', function () {
    return view('auth');
});


Route::get('/contact_us', function () {
    return view('contact_us');
});

Route::get('/reg', function () {
    return view('reg');
});

Route::get('/resume', function () {
    return view('resume');
});

Route::get('/resume_hire', function () {
    return view('resume_hire');
});


Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
