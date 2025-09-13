<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\UserController;


Route::get('/', function () {
    return view('welcome');
});

Route::get('/home', [UserController::class, 'index']);

// About Us page
Route::get('/about_us', function () {
    return view('about_us');
});

Route::get('/courses', function () {
    return view('courses');
});

Route::get('/membership', function () {
    return view('membership');
});
Route::get('/coursesched', function () {
    return view('coursesched');
});
Route::get('/contact_us', function () {
    return view('contact_us');
});
Route::get('/rates', function () {
    return view('rates');
});
Route::get('/rates2', function () {
    return view('rates2');
});
Route::get('/contact_us_2', function () {
    return view('contact_us_2');
});
Route::get('/faq', function () {
    return view('faq');
});
Route::get('/tournament_rates', function () {
    return view('tournament_rates');
});
Route::get('/langer', function () {
    return view('langer');
});
Route::get('/tournamentgal', function () {
    return view('tournamentgal');
});
Route::get('/facilities', function () {
    return view('facilities');
});

