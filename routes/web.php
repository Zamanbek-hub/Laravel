<?php

use App\Http\Controllers\HomeController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\ResumeController;
use App\Http\Controllers\VacancyController;
use App\Http\Controllers\FavoriteResumeController;
use App\Http\Controllers\FavoriteVacanciesController;

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

Route::get('/home_s', [ResumeController::class, 'index'] )->name('home_student');
Route::get('/home_s/create', [ResumeController::class, 'create'] ) -> name('resume_create');
Route::post('/home_s', [ResumeController::class, 'store'] );
Route::get('/home_s/{id}', [ResumeController::class, 'show'] ) -> name('resume_show');
Route::post('/home_s/update', [ResumeController::class, 'update'] );
Route::delete('/home_s/{id}', [ResumeController::class, 'destroy'] );

Route::get('/home_e', [VacancyController::class, 'index'] )->name('home_employer');
Route::get('/home_e/create', [VacancyController::class, 'create'] )->name('vacancy_create');
Route::post('/home_e', [VacancyController::class, 'store'] )->name('home_employer');
Route::get('/home_e/{id}', [VacancyController::class, 'show'] ) -> name('vacancy_show');
Route::delete('/home_e/{id}', [VacancyController::class, 'destroy'] );
Route::post('/home_e/update', [VacancyController::class, 'update'] );


Route::post('/resume_select', [ResumeController::class, 'select'] );
Route::post('/selected_resumes', [HomeController::class, 'selected_resumes'] );

Route::post('/save_favorite_resume', [FavoriteResumeController::class, 'saveFavoriteResume'] );


Route::get('/home_a', [AdminController::class, 'index'] )->name('home_admin');
Route::get('/home_a/students', [AdminController::class, 'index_students'] );
Route::get('/home_a/skills', [AdminController::class, 'index_skills'] );
Route::get('/home_a/specialties', [AdminController::class, 'index_specialties'] );
Route::get('/home_a/users', [AdminController::class, 'index_users'] );
Route::get('/home_a/employers', [AdminController::class, 'index_employers'] );
Route::get('/home_a/vacancies', [AdminController::class, 'index_vacancies'] );
Route::get('/home_a/resumes', [AdminController::class, 'index_resumes'] );
Route::get('/home_a/regions', [AdminController::class, 'index_regions'] );
Route::get('/home_a/my_profile', [AdminController::class, 'index_my_profile'] );

Route::post('/home_a/skills', [AdminController::class, 'store_skill'] );
Route::post('/home_a/specialties', [AdminController::class, 'store_specialty'] );
Route::post('/home_a/students', [AdminController::class, 'store_student'] );
Route::post('/home_a/employers', [AdminController::class, 'store_employer'] );
Route::post('/home_a/users', [AdminController::class, 'store_user'] );
Route::post('/home_a/regions', [AdminController::class, 'store_region'] );

 Route::post('/home_a/skills/update', [AdminController::class, 'update_skill'] );
 Route::post('/home_a/specialties/update', [AdminController::class, 'update_specialty'] );
 Route::post('/home_a/students/update', [AdminController::class, 'update_student'] );
 Route::post('/home_a/employers/update', [AdminController::class, 'update_employer'] );
 Route::post('/home_a/users/update', [AdminController::class, 'update_user'] );
 Route::post('/home_a/regions/update', [AdminController::class, 'update_region'] );

 Route::post('/home_a/users/change', [AdminController::class, 'change_user_password'] );

Route::get('/home_a/vacancies/{id}', [AdminController::class, 'show_vacancy'] );
Route::get('/home_a/resumes/{id}', [AdminController::class, 'show_resume'] );

Route::delete('/home_a/employers/{id}', [AdminController::class, 'destroy_employer'] );
Route::delete('/home_a/skills/{id}', [AdminController::class, 'destroy_skill'] );
Route::delete('/home_a/specialties/{id}', [AdminController::class, 'destroy_specialty'] );
Route::delete('/home_a/students/{id}', [AdminController::class, 'destroy_student'] );
Route::delete('/home_a/regions/{id}', [AdminController::class, 'destroy_region'] );
Route::delete('/home_a/vacancies/{id}', [AdminController::class, 'destroy_vacancy'] );
Route::delete('/home_a/resumes/{id}', [AdminController::class, 'destroy_resume'] );
Route::delete('/home_a/users/{id}', [AdminController::class, 'destroy_user'] );


Route::post('/save_favorite_resume', [FavoriteResumeController::class, 'saveFavoriteResume'] );
Route::post('/save_favorite_vacancy', [FavoriteVacanciesController::class, 'saveFavoriteVacancy'] );


Route::get('/resume_pdf', [PDFController::class, 'resume_pdf']);
Route::get('/resume_pdf_init', [PDFController::class, 'resume_pdf_init']);
Route::get('/resume_pdf_view', [HomeController::class, 'resume_pdf_view']);
