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

