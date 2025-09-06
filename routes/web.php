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
    return view('about_us'); // will look for resources/views/about_us.blade.php
});

Route::get('/courses', function () {
    return view('courses'); // will look for resources/views/about_us.blade.php
});

Route::get('/membership', function () {
    return view('membership'); // will look for resources/views/about_us.blade.php
});
Route::get('/announcement', function () {
    return view('announcement'); // will look for resources/views/about_us.blade.php
});
Route::get('/contact_us', function () {
    return view('contact_us'); // will look for resources/views/about_us.blade.php
});
Route::get('/rates', function () {
    return view('rates'); // will look for resources/views/about_us.blade.php
});
Route::get('/rates2', function () {
    return view('rates2'); // will look for resources/views/about_us.blade.php
});
Route::get('/contact_us_2', function () {
    return view('contact_us_2'); // will look for resources/views/about_us.blade.php
});
Route::get('/faq', function () {
    return view('faq'); // will look for resources/views/about_us.blade.php
});

