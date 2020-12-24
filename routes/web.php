<?php

use App\Http\Controllers\HomeController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ResumeController;
use App\Http\Controllers\VacancyController;
use App\Http\Controllers\FavoriteResumeController;
use App\Http\Controllers\FavoriteVacanciesController;
use App\Http\Controllers\AdminController;

use App\Http\Controllers\PDFController;

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

//dfdfgdfg
Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
Route::get('/favorites', [App\Http\Controllers\HomeController::class, 'favorites'])->name('favorites');

Route::get('/resume', [ResumeController::class, 'index'] );
Route::get('/resume/create', [ResumeController::class, 'create'] ) -> name('resume_create');
Route::post('/resume', [ResumeController::class, 'store'] );
Route::get('/resume/{id}', [ResumeController::class, 'show'] ) -> name('resume_show');
Route::post('/resume/update', [ResumeController::class, 'update'] );
Route::delete('/resume/{id}', [ResumeController::class, 'destroy'] );

Route::get('/vacancy', [VacancyController::class, 'index'] );
Route::get('/vacancy/create', [VacancyController::class, 'create'] );
Route::post('/vacancy', [VacancyController::class, 'store'] );
Route::get('/vacancy/{id}', [VacancyController::class, 'show'] ) -> name('vacancy_show');
Route::delete('/vacancy/{id}', [VacancyController::class, 'destroy'] );
Route::post('/vacancy/update', [VacancyController::class, 'update'] );


Route::post('/resume_select', [ResumeController::class, 'select'] );
Route::post('/selected_resumes', [HomeController::class, 'selected_resumes'] );



Route::post('/save_favorite_resume', [FavoriteResumeController::class, 'saveFavoriteResume'] );
Route::post('/save_favorite_vacancy', [FavoriteVacanciesController::class, 'saveFavoriteVacancy'] );


Route::get('/resume_pdf', [PDFController::class, 'resume_pdf']);
Route::get('/resume_pdf_init', [PDFController::class, 'resume_pdf_init']);
Route::get('/resume_pdf_view', [HomeController::class, 'resume_pdf_view']);

Route::get('/admin', [AdminController::class, 'index']);
Route::get('/admin/stat/vacancy', [AdminController::class, 'vacancyStat']);


Route::group(['prefix' => 'backend'], function () {
    Voyager::routes();
});
