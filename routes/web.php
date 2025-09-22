<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\UserController;



Route::get('/home', [UserController::class, 'home'])->name('home');



Route::get('/holeinone', function () {
    $couples = DB::table('players_couples')->get();
    $langer  = DB::table('players_langer')->get();
    return view('holeinone', compact('couples', 'langer'));
});


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
    return view('coursesched'); // resources/views/rates2.blade.php
})->name('coursesched');
Route::get('/tournamentgal', function () {
    return view('tournamentgal'); // resources/views/rates2.blade.php
})->name('tournamentgal');

// Route::get('/holeinone', function () {
//     return view('holeinone'); // resources/views/rates2.blade.php
// })->name('holeinone');



Route::get('/rates', function () {
    return view('rates'); // resources/views/rates.blade.php
})->name('rates');
Route::get('/rates2', function () {
    return view('rates2'); // resources/views/rates2.blade.php
})->name('rates2');
Route::get('/tournament_rates', function () {
    return view('tournament_rates'); // resources/views/tournament_rates.blade.php
})->name('tournament_rates');


Route::get('/contact_us', function () {
    return view('contact_us'); // resources/views/rates2.blade.php
})->name('contact_us');
Route::get('/contact_us_2', function () {
    return view('contact_us_2'); // resources/views/rates2.blade.php
})->name('contact_us_2');


Route::get('/faq', function () {
    return view('faq');
});
Route::get('/langer', function () {
    return view('langer');
})->name('langer');



Route::get('/lobby', function () {
    return view('lobby'); // resources/views/rates2.blade.php
})->name('lobby');
Route::get('/drivingrange', function () {
    return view('drivingrange'); // resources/views/rates2.blade.php
})->name('drivingrange');
Route::get('/clubhouse', function () {
    return view('clubhouse'); // resources/views/rates2.blade.php
})->name('clubhouse');
Route::get('/locker', function () {
    return view('locker'); // resources/views/rates2.blade.php
})->name('locker');

Route::get('/corpgovernance', function () {
    return view('corpgovernance');
});

Route::get('/definitiveArchive', function () {
    return view('definitiveArchive');
})->name('definitiveArchive');

Route::get('/asmMinutes', function () {
    return view('asmMinutes');
})->name('asmMinutes');

Route::get('/ACGR', function () {
    return view('ACGR');
})->name('ACGR');

Route::get('/cbce', function () {
    return view('cbce');
})->name('cbce');

Route::get('/cbce', function () {
    return view('cbce');
})->name('cbce');

Route::get('/boardCharter', function () {
    return view('boardCharter');
})->name('boardCharter');

Route::get('/corpGovManual', function () {
    return view('corpGovManual');
})->name('corpGovManual');

