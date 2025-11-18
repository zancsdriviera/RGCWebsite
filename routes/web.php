<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\DB;

use App\Http\Controllers\LoginController;
use App\Http\Controllers\CoursesController;
use App\Http\Controllers\CourseContentController;
use App\Http\Controllers\EventGalleryController;
use App\Http\Controllers\HoleInOneController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\MembershipController;
use App\Http\Controllers\ContactUsController;
use App\Http\Controllers\CareerController;
use App\Http\Controllers\TournamentRatesController;
use App\Http\Controllers\ClubHouseController;
use App\Http\Controllers\DrivingRangeController;
use App\Http\Controllers\ProshopController;
use App\Http\Controllers\MembersLoungeController;
use App\Http\Controllers\LobbyController;
use App\Http\Controllers\VerandaController;
use App\Http\Controllers\LockerRoomController;

use App\Http\Controllers\AdminHoleInOneController;
use App\Http\Controllers\AdminTournamentGalleryController;
use App\Http\Controllers\AdminCoursesController;
use App\Http\Controllers\AdminHomepageController;
use App\Http\Controllers\AdminMembershipController;
use App\Http\Controllers\AdminContactUsController; 
use App\Http\Controllers\AdminCareerController;
use App\Http\Controllers\AdminTournamentRatesController; 
use App\Http\Controllers\AdminClubhouseController;
use App\Http\Controllers\AdminDrivingRangeController;
use App\Http\Controllers\AdminProshopController;
use App\Http\Controllers\AdminMembersLoungeController;
use App\Http\Controllers\AdminLobbyController;
use App\Http\Controllers\AdminVerandaController;
use App\Http\Controllers\AdminLockerRoomController;


Route::get('/home', [HomeController::class, 'index']); 
// 🔹 Admin Dashboard (main route)

// 🔹 Front-end Routes
Route::get('/membership', [MembershipController::class, 'index'])->name('membership');
Route::get('/contact', [ContactUsController::class, 'index'])->name('contact');
Route::get('/careers', [CareerController::class, 'index'])->name('careers');
Route::get('/tournament_rates', [TournamentRatesController::class, 'index'])->name('tournament.rates');
Route::get('/hole-in-one', [HoleInOneController::class, 'index'])->name('frontend.holeinone.index');
Route::get('/tournament_gallery', [EventGalleryController::class, 'show'])->name('event.gallery');
Route::get('/clubhouse', [ClubHouseController::class, 'index'])->name('clubhouse.frontend');
Route::get('/drivingrange', [DrivingRangeController::class, 'index'])->name('drivingrange.frontend');
Route::get('/proshop', [ProshopController::class, 'index'])->name('proshop.frontend');
Route::get('/membersLounge', [MembersLoungeController::class, 'index'])->name('membersLounge.frontend');
Route::get('/lobby', [LobbyController::class, 'index'])->name('lobby.frontend');
Route::get('/veranda', [VerandaController::class, 'index'])->name('veranda.frontend');
Route::get('/locker', [LockerRoomController::class, 'index'])->name('locker.frontend');

// 🔹 Admin Authentication
Route::get('admin', [LoginController::class, 'index'])->name('admin.index');
Route::post('admin/login', [LoginController::class, 'login'])->name('admin.login');
Route::get('admin/logout', [LoginController::class, 'logout'])->name('admin.logout');

// 🔹 Admin – Prefix group for CMS
Route::prefix('admin')
    ->name('admin.')
    ->middleware('admin')
    ->group(function () {

        // Dashboard
        Route::get('/home', [AdminHomepageController::class, 'index'])->name('home');
        Route::post('/home/update', [AdminHomepageController::class, 'update'])->name('homepage.update');

        // Membership CMS
        Route::get('/membership', [AdminMembershipController::class, 'index'])->name('membership.index');
        Route::get('/membership/edit/{id}', [AdminMembershipController::class, 'edit'])->name('membership.edit');
        Route::post('/membership/store', [AdminMembershipController::class, 'store'])->name('membership.store');
        Route::put('/membership/{id}', [AdminMembershipController::class, 'update'])->name('membership.update');
        Route::delete('/membership/delete/{id}', [AdminMembershipController::class, 'destroy'])->name('membership.destroy');

        // Contact CMS
        Route::get('/contact', [AdminContactUsController::class, 'index'])->name('contact.index');
        Route::post('/contact/main/update', [AdminContactUsController::class, 'updateMain'])->name('contact.updateMain');
        Route::post('/contact/department/store', [AdminContactUsController::class, 'storeDepartment'])->name('contact.storeDepartment');
        Route::put('/contact/department/{id}', [AdminContactUsController::class, 'updateDepartment'])->name('contact.updateDepartment');
        Route::delete('/contact/department/{id}', [AdminContactUsController::class, 'destroyDepartment'])->name('contact.destroyDepartment');

        // Careers CMS
        Route::get('/careers', [AdminCareerController::class, 'index'])->name('careers.index');
        Route::post('/careers', [AdminCareerController::class, 'store'])->name('careers.store');
        Route::put('/careers/{career}', [AdminCareerController::class, 'update'])->name('careers.update');
        Route::delete('/careers/{career}', [AdminCareerController::class, 'destroy'])->name('careers.destroy');

        // Tournament Rates CMS
        Route::get('/tournament_rates', [AdminTournamentRatesController::class, 'index'])->name('tournament_rates.index');
        Route::put('/tournament_rates/{tournament_rate}', [AdminTournamentRatesController::class, 'update'])->name('tournament_rates.update');

        // Hole-in-One CMS
        Route::get('/hole-in-one', [AdminHoleInOneController::class, 'index'])->name('holeinone.index');
        Route::post('/hole-in-one/{type}', [AdminHoleInOneController::class, 'store'])->name('holeinone.store');
        Route::put('/hole-in-one/{type}/{id}', [AdminHoleInOneController::class, 'update'])->name('holeinone.update');
        Route::delete('/hole-in-one/{type}/{id}', [AdminHoleInOneController::class, 'destroy'])->name('holeinone.destroy');

        // Tournament Gallery CMS
        Route::get('/tournament_gallery', [AdminTournamentGalleryController::class, 'index'])->name('tournament_gallery.index');
        Route::post('/tournament_gallery', [AdminTournamentGalleryController::class, 'storeGallery'])->name('tournament_gallery.store');
        Route::post('/tournament_gallery/{id}/images', [AdminTournamentGalleryController::class, 'storeImages'])->name('tournament_gallery.images.store');
        Route::delete('/tournament_gallery/{id}', [AdminTournamentGalleryController::class, 'destroyGallery'])->name('tournament_gallery.destroy');
        Route::delete('/tournament_gallery/images/{id}', [AdminTournamentGalleryController::class, 'destroyImage'])->name('tournament_gallery.images.destroy');
        Route::put('/tournament_gallery/images/{id}', [AdminTournamentGalleryController::class, 'updateImage'])->name('tournament_gallery.images.update');

        // Clubhouse CMS
        Route::get('/clubhouse', [AdminClubhouseController::class, 'index'])->name('clubhouse');
        Route::post('/clubhouse/update-description', [AdminClubhouseController::class, 'updateDescription'])->name('clubhouse.updateDescription');
        Route::post('/clubhouse/upload-images', [AdminClubhouseController::class, 'uploadImages'])->name('clubhouse.uploadImages');
        Route::put('/clubhouse/update-image/{id}', [AdminClubhouseController::class, 'updateImage'])->name('clubhouse.updateImage');
        Route::delete('/clubhouse/delete-image/{id}', [AdminClubhouseController::class, 'deleteImage'])->name('clubhouse.deleteImage');

        // Driving Range CMS
        Route::get('/drivingrange', [AdminDrivingRangeController::class, 'index'])->name('drivingrange');
        Route::post('/drivingrange/update-description', [AdminDrivingRangeController::class, 'updateDescription'])->name('drivingrange.updateDescription');
        Route::post('/drivingrange/upload-images', [AdminDrivingRangeController::class, 'uploadImages'])->name('drivingrange.uploadImages');
        Route::put('/drivingrange/update-image/{id}', [AdminDrivingRangeController::class, 'updateImage'])->name('drivingrange.updateImage');
        Route::delete('/drivingrange/delete-image/{id}', [AdminDrivingRangeController::class, 'deleteImage'])->name('drivingrange.deleteImage');

        // Proshop CMS
        Route::get('/proshop', [AdminProshopController::class, 'index'])->name('proshop');
        Route::post('/proshop/update-description', [AdminProshopController::class, 'updateDescription'])->name('proshop.updateDescription');
        Route::post('/proshop/upload-images', [AdminProshopController::class, 'uploadImages'])->name('proshop.uploadImages');
        Route::put('/proshop/update-image/{id}', [AdminProshopController::class, 'updateImage'])->name('proshop.updateImage');
        Route::delete('/proshop/delete-image/{id}', [AdminProshopController::class, 'deleteImage'])->name('proshop.deleteImage');

        // Member's Lounge CMS
        Route::get('/membersLounge', [AdminMembersLoungeController::class, 'index'])->name('membersLounge');
        Route::post('/membersLounge/update-description', [AdminMembersLoungeController::class, 'updateDescription'])->name('membersLounge.updateDescription');
        Route::post('/membersLounge/upload-images', [AdminMembersLoungeController::class, 'uploadImages'])->name('membersLounge.uploadImages');
        Route::put('/membersLounge/update-image/{id}', [AdminMembersLoungeController::class, 'updateImage'])->name('membersLounge.updateImage');
        Route::delete('/membersLounge/delete-image/{id}', [AdminMembersLoungeController::class, 'deleteImage'])->name('membersLounge.deleteImage');

        // Lobby CMS
        Route::get('/lobby', [AdminLobbyController::class, 'index'])->name('lobby');
        Route::post('/lobby/update-description', [AdminLobbyController::class, 'updateDescription'])->name('lobby.updateDescription');
        Route::post('/lobby/upload-images', [AdminLobbyController::class, 'uploadImages'])->name('lobby.uploadImages');
        Route::put('/lobby/update-image/{id}', [AdminLobbyController::class, 'updateImage'])->name('lobby.updateImage');
        Route::delete('/lobby/delete-image/{id}', [AdminLobbyController::class, 'deleteImage'])->name('lobby.deleteImage');

        // Veranda CMS
        Route::get('/veranda', [AdminVerandaController::class, 'index'])->name('veranda');
        Route::post('/veranda/update-description', [AdminVerandaController::class, 'updateDescription'])->name('veranda.updateDescription');
        Route::post('/veranda/upload-images', [AdminVerandaController::class, 'uploadImages'])->name('veranda.uploadImages');
        Route::put('/veranda/update-image/{id}', [AdminVerandaController::class, 'updateImage'])->name('veranda.updateImage');
        Route::delete('/veranda/delete-image/{id}', [AdminVerandaController::class, 'deleteImage'])->name('veranda.deleteImage');

        // Locker Room CMS
        Route::get('/locker', [AdminLockerRoomController::class, 'index'])->name('locker');
        Route::post('/locker/update-description', [AdminLockerRoomController::class, 'updateDescription'])->name('locker.updateDescription');
        Route::post('/locker/upload-images', [AdminLockerRoomController::class, 'uploadImages'])->name('locker.uploadImages');
        Route::put('/locker/update-image/{id}', [AdminLockerRoomController::class, 'updateImage'])->name('locker.updateImage');
        Route::delete('/locker/delete-image/{id}', [AdminLockerRoomController::class, 'deleteImage'])->name('locker.deleteImage');
    });


// 🔹 Admin – Courses Management
Route::middleware(['web'])->group(function () {
    Route::get('/admin/courses', [AdminCoursesController::class, 'index'])->name('admin.courses');

    Route::post('/admin/courses/store', [AdminCoursesController::class, 'store'])->name('courses.store');

    Route::put('/admin/courses/{id}', [AdminCoursesController::class, 'update'])->name('courses.update');

    Route::delete('/admin/courses/{id}', [AdminCoursesController::class, 'destroy'])->name('courses.destroy');
});


// 🔹 New Admin Panel Resource
Route::resource('Admin', CoursesController::class);


// 🔹 About / Membership
Route::get('/about_us', fn() => view('about_us'));
Route::get('/courses', function () {
    $courses = DB::table('courses')->get();
    return view('courses', compact('courses'));
});

// 🔹 Misc Pages
Route::get('/coursesched', fn() => view('coursesched'))->name('coursesched');

// 🔹 Tournament & Events
Route::get('/tourna_and_events', fn() => view('tourna_and_events'))->name('tourna_and_events');

// 🔹 Rates
Route::get('/rates', fn() => view('rates'))->name('rates');
Route::get('/rates2', fn() => view('rates2'))->name('rates2');

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
Route::get('/grill', fn() => view('grill'))->name('grill');
Route::get('/teehouse', fn() => view('teehouse'))->name('teehouse');

// 🔹 Corporate Governance
Route::get('/corpgovernance', fn() => view('corpgovernance'));
Route::get('/definitiveArchive', fn() => view('definitiveArchive'))->name('definitiveArchive');
Route::get('/asmMinutes', fn() => view('asmMinutes'))->name('asmMinutes');
Route::get('/ACGR', fn() => view('ACGR'))->name('ACGR');
Route::get('/cbce', fn() => view('cbce'))->name('cbce');
Route::get('/boardCharter', fn() => view('boardCharter'))->name('boardCharter');
Route::get('/corpGovManual', fn() => view('corpGovManual'))->name('corpGovManual');

