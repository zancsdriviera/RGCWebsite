<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\CoursesController;
use App\Http\Controllers\CourseContentController;
use App\Models\LangerCourse;
use App\Models\CouplesCourse;
use App\Http\Controllers\AdminCoursesController;
use App\Http\Controllers\AdminHomepageController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\UserController;


/*========================================
=              ADMIN ROUTES              =
========================================*/

// 🔹 Old Admin Group (commented out)
/*
Route::prefix('admin')->group(function () {
    Route::get('/', [CoursesController::class, 'create'])->name('courses.create');
    Route::post('/store', [CoursesController::class, 'store'])->name('courses.store');
    Route::put('/update/{courses}', [CoursesController::class, 'update'])->name('courses.update');
    Route::delete('/delete/{courses}', [CoursesController::class, 'destroy'])->name('courses.destroy');
});
*/
Route::get('/home', [HomeController::class, 'index']);
// 🔹 Admin Dashboard (main route)


// 🔹 Admin Authentication
Route::get('admin', [LoginController::class, 'index'])->name('admin.index');
Route::post('admin/login', [LoginController::class, 'login'])->name('admin.login');
Route::get('admin/logout', [LoginController::class, 'logout'])->name('admin.logout');

// 🔹 Admin – Home / Dashboard
Route::prefix('admin')->name('admin.')->group(function () {
    // Default home page after login
    Route::get('/home', [AdminHomepageController::class, 'index'])->name('home');
    Route::post('/home/update', [AdminHomepageController::class, 'update'])->name('homepage.update'); // ✅ add this
});

// 🔹 Admin – Courses Management
Route::middleware(['web'])->group(function () {
    Route::get('/admin/courses', [AdminCoursesController::class, 'index'])->name('admin.courses');

    // Route::post('admin/courses/store', [CoursesController::class, 'store'])->name('courses.store');
    Route::post('/admin/courses/store', [AdminCoursesController::class, 'store'])->name('courses.store');

    // Route::put('admin/courses/update/{id}', [CoursesController::class, 'update'])->name('courses.update');
    Route::put('/admin/courses/{id}', [AdminCoursesController::class, 'update'])->name('courses.update');

    // Route::delete('admin/courses/delete/{id}', [CoursesController::class, 'destroy'])->name('courses.destroy');
    Route::delete('/admin/courses/{id}', [AdminCoursesController::class, 'destroy'])->name('courses.destroy');
});

/*
// 🔹 Alternative Admin – Courses Management (commented)
Route::prefix('admin')->group(function () {
    Route::get('/courses', [CourseContentController::class, 'index'])->name('admin.courses');
    Route::post('/courses', [CourseContentController::class, 'store'])->name('courses.store');
    Route::put('/courses', [CourseContentController::class, 'update'])->name('courses.update');
    Route::delete('/courses/{id}', [CourseContentController::class, 'destroy'])->name('courses.destroy');
});
*/

/*
// 🔹 Debug Routes (commented)
Route::get('/debug-admin-routes', function() {
    $routes = [
        'admin.update' => Route::has('admin.update'),
        'admin.langer.update' => Route::has('admin.langer.update'),
        'admin.couples.update' => Route::has('admin.couples.update'),
    ];

    $urls = [
        'admin.update_url' => route('admin.update', ['key' => 'test'], false),
        'admin.langer.update_url' => route('admin.langer.update', [], false),
        'current_url' => url()->current(),
    ];

    return response()->json(['routes' => $routes, 'urls' => $urls]);
});
*/

// 🔹 New Admin Panel Resource
Route::resource('Admin', CoursesController::class);


/*========================================
=               USER PAGES               =
========================================*/

// 🔹 Home
// Route::get('/', fn() => view('home'));
// Route::get('/home', [UserController::class, 'home'])->name('home');

// 🔹 Event Gallery
Route::get('/event-gallery', [\App\Http\Controllers\EventGalleryController::class, 'show'])->name('event.gallery');

// 🔹 About / Membership
Route::get('/about_us', fn() => view('about_us'));
Route::get('/courses', function () {
    $courses = DB::table('courses')->get();
    return view('courses', compact('courses'));
});
Route::get('/membership', fn() => view('membership'));

// 🔹 Misc Pages
Route::get('/coursesched', fn() => view('coursesched'))->name('coursesched');
Route::get('/tournaments', fn() => view('tournamentgal'))->name('tournaments');

// 🔹 Hole-in-One
Route::get('/holeinone', function () {
    $couples = DB::table('players_couples')->get();
    $langer  = DB::table('players_langer')->get();
    return view('holeinone', compact('couples', 'langer'));
});

// 🔹 Tournament & Events
Route::get('/tourna_and_events', fn() => view('tourna_and_events'))->name('tourna_and_events');

// 🔹 Rates
Route::get('/rates', fn() => view('rates'))->name('rates');
Route::get('/rates2', fn() => view('rates2'))->name('rates2');
Route::get('/tournament_rates', fn() => view('tournament_rates'))->name('tournament_rates');

// 🔹 Contact Pages
Route::get('/contact_us', fn() => view('contact_us'))->name('contact_us');
Route::get('/contact_us_2', fn() => view('contact_us_2'))->name('contact_us_2');

// 🔹 FAQ
Route::get('/faq', fn() => view('faq'));

// 🔹 Course Pages (Langer / Couples)
Route::get('/langer', function () {
    $langer = LangerCourse::first();

    if (!$langer) {
        $langer = LangerCourse::create([
            'title' => 'The Bernhard Langer Course',
            'description' => 'Known for being one of the toughest courses in the Philippines...',
        ]);
    }

    return view('langer', compact('langer'));
})->name('langer');

Route::get('/couples', function () {
    $couples = CouplesCourse::first();

    if (!$couples) {
        $couples = CouplesCourse::create([
            'title' => 'The Fred Couples Course',
            'description' => 'Designed by everybody’s favorite golfer Freddie Couples, this 7,102 yard par 72 course is challenging yet enjoyable.',
        ]);
    }

    return view('couples', compact('couples'));
})->name('couples');

// 🔹 Facilities
Route::get('/clubhouse', fn() => view('clubhouse'))->name('clubhouse');
Route::get('/drivingrange', fn() => view('drivingrange'))->name('drivingrange');
Route::get('/proshop', fn() => view('proshop'))->name('proshop');
Route::get('/locker', fn() => view('locker'))->name('locker');
Route::get('/membersLounge', fn() => view('membersLounge'))->name('membersLounge');
Route::get('/lobby', fn() => view('lobby'))->name('lobby');
Route::get('/veranda', fn() => view('veranda'))->name('veranda');
Route::get('/grill', fn() => view('grill'))->name('grill');
Route::get('/teehouse', fn() => view('teehouse'))->name('teehouse');

// 🔹 Corporate Governance
Route::get('/corpgovernance', fn() => view('corpgovernance'));
Route::get('/definitiveArchive', fn() => view('definitiveArchive'))->name('definitiveArchive');
Route::get('/asmMinutes', fn() => view('asmMinutes'))->name('asmMinutes');
Route::get('/acgr', fn() => view('acgr'))->name('acgr');
Route::get('/cbce', fn() => view('cbce'))->name('cbce');
Route::get('/boardCharter', fn() => view('boardCharter'))->name('boardCharter');
Route::get('/corpGovManual', fn() => view('corpGovManual'))->name('corpGovManual');

