<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\DB;
use App\Models\FaqContent;
use App\Models\Course;

use App\Http\Controllers\{
    LoginController,
    CoursesController,
    CourseContentController,
    EventGalleryController,
    HoleInOneController,
    HomeController,
    UserController,
    MembershipController,
    ContactUsController,
    CareerController,
    TournamentRatesController,
    ClubHouseController,
    DrivingRangeController,
    ProshopController,
    MembersLoungeController,
    LobbyController,
    VerandaController,
    LockerRoomController,
    DefinitiveController,
    AsmMinutesController,
    AcgrController,
    CourseScheduleController,
    IconController,
    AboutUsController,
    CPRatesController,
    CLRatesController,
    TeehouseController,
    GrillController,
    FaqController,
    ClientT_EventController,
};

use App\Http\Controllers\{
    AdminHoleInOneController,
    AdminTournamentGalleryController,
    AdminCoursesController,
    AdminHomepageController,
    AdminMembershipController,
    AdminContactUsController,
    AdminCareerController,
    AdminTournamentRatesController,
    AdminClubhouseController,
    AdminDrivingRangeController,
    AdminProshopController,
    AdminMembersLoungeController,
    AdminLobbyController,
    AdminVerandaController,
    AdminLockerRoomController,
    AdminDefinitiveController,
    AdminAsmMinutesController,
    AdminAcgrController,
    AdminCourseScheduleController,
    AdminFaqController,
    AdminAboutUsController,
    AdminGleanController,
    AdminGPeakController,
    AdminTeehouseController,
    AdminGrillController,
    AdminT_EventController,
};


Route::get('/home', [HomeController::class, 'index'])->name('home.frontend');
// 🔹 Admin Dashboard (main route)

// 🔹 New Admin Panel Resource
Route::resource('Admin', CoursesController::class);

// 🔹 Front-end Routes
Route::get('/membership', [MembershipController::class, 'index'])->name('membership.frontend');
Route::get('/contact', [ContactUsController::class, 'index'])->name('contact.frontend');
Route::get('/careers', [CareerController::class, 'index'])->name('careers.frontend');
Route::get('/tournament_rates', [TournamentRatesController::class, 'index'])->name('tournament.rates.frontend');
Route::get('/hole-in-one', [HoleInOneController::class, 'index'])->name('frontend.holeinone.index');
Route::get('/tournament_gallery', [EventGalleryController::class, 'show'])->name('event.gallery');
Route::get('/corpgovernance', fn() => view('corpgovernance'));
Route::get('/coursesched', [CourseScheduleController::class, 'index'])->name('coursesched');

Route::get('/clubhouse', [ClubHouseController::class, 'index'])->name('clubhouse.frontend');
Route::get('/drivingrange', [DrivingRangeController::class, 'index'])->name('drivingrange.frontend');
Route::get('/proshop', [ProshopController::class, 'index'])->name('proshop.frontend');
Route::get('/membersLounge', [MembersLoungeController::class, 'index'])->name('membersLounge.frontend');
Route::get('/lobby', [LobbyController::class, 'index'])->name('lobby.frontend');
Route::get('/veranda', [VerandaController::class, 'index'])->name('veranda.frontend');
Route::get('/locker', [LockerRoomController::class, 'index'])->name('locker.frontend');
Route::get('/definitive', [DefinitiveController::class, 'index'])->name('definitive.frontend');
Route::get('/asm_minutes', [AsmMinutesController::class, 'index'])->name('asm_minutes.frontend');
Route::get('/acgr', [AcgrController::class, 'index'])->name('acgr.frontend');
Route::get('/faq', [App\Http\Controllers\FaqController::class, 'show'])->name('faq');

Route::get('/about_us', [AboutUsController::class, 'index'])->name('aboutus.frontend');
Route::get('/rates', [CLRatesController::class, 'index'])->name('rates.frontend');
Route::get('/rates2', [CPRatesController::class, 'index'])->name('rates2.frontend');
Route::get('/teehouse', [TeehouseController::class, 'index'])->name('teehouse.frontend');
Route::get('/grill', [GrillController::class, 'index'])->name('grill.frontend');
Route::get('/tourna_and_events', [ClientT_EventController::class, 'index'])->name('client.tournaments');

// Courses front-end
Route::get('/courses', function () {$courses = Course::all();
    return view('courses', compact('courses'));
})->name('courses');

// Langer child page
Route::get('/langer', function () {$langer = Course::first();
    return view('langer', compact('langer'));
})->name('langer');

// Couples child page
Route::get('/couples', function () {$couples = Course::first();
    return view('couples', compact('couples'));
})->name('couples');

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
        Route::put('/tournament-gallery/{id}/thumbnail', [AdminTournamentGalleryController::class, 'updateThumbnail'])->name('tournament_gallery.updateThumbnail');

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

        // Definitive Information Statement CMS
        Route::get('definitive', [AdminDefinitiveController::class, 'index'])->name('definitive');
        Route::post('definitive/store', [AdminDefinitiveController::class, 'store'])->name('definitive.store');
        Route::put('definitive/{id}', [AdminDefinitiveController::class, 'update'])->name('definitive.update');
        Route::delete('definitive/{id}', [AdminDefinitiveController::class, 'destroy'])->name('definitive.delete');

        // ASM Minutes CMS
        Route::get('asm_minutes', [AdminAsmMinutesController::class, 'index'])->name('asm_minutes');
        Route::post('asm_minutes/store', [AdminAsmMinutesController::class, 'store'])->name('asm_minutes.store');
        Route::put('asm_minutes/{id}', [AdminAsmMinutesController::class, 'update'])->name('asm_minutes.update');
        Route::delete('asm_minutes/{id}', [AdminAsmMinutesController::class, 'destroy'])->name('asm_minutes.delete');

        // ACGR CMS
        Route::get('acgr', [AdminAcgrController::class, 'index'])->name('acgr');
        Route::post('acgr/store', [AdminAcgrController::class, 'store'])->name('acgr.store');
        Route::put('acgr/{id}', [AdminAcgrController::class, 'update'])->name('acgr.update');
        Route::delete('acgr/{id}', [AdminAcgrController::class, 'destroy'])->name('acgr.delete');

        // Course Schedule CMS
        Route::get('/coursesched', [AdminCourseScheduleController::class, 'index'])->name('coursesched.index');
        Route::post('/coursesched/store', [AdminCourseScheduleController::class, 'store'])->name('coursesched.store');
        Route::put('/coursesched/{id}/update', [AdminCourseScheduleController::class, 'update'])->name('coursesched.update');
        Route::delete('/coursesched/{id}/delete', [AdminCourseScheduleController::class, 'destroy'])->name('coursesched.delete');

        // FAQ Management
        Route::get('/faq', [AdminFaqController::class, 'show'])->name('faq');
        Route::post('/faq/create', [AdminFaqController::class, 'create'])->name('faq.create');
        Route::put('/faq/update/{id}', [AdminFaqController::class, 'update'])->name('faq.update');
        Route::delete('/faq/delete/{id}', [AdminFaqController::class, 'delete'])->name('faq.delete');
        Route::post('/faq/toggle/{id}', [AdminFaqController::class, 'toggleStatus'])->name('faq.toggle');

        // About Us CMS
        Route::get('about_us', [AdminAboutUsController::class, 'edit'])->name('about_us.edit');
        Route::post('about_us/update/{section}', [AdminAboutUsController::class, 'update'])->name('about_us.update');
        // Boards
        Route::post('about_us/boards/add', [AdminAboutUsController::class, 'addBoard'])->name('about_us.add_board');
        Route::post('about_us/boards/update/{index}', [AdminAboutUsController::class, 'updateBoard'])->name('about_us.update_board');
        Route::post('about_us/boards/remove/{index}', [AdminAboutUsController::class, 'removeBoard'])->name('about_us.remove_board');
        // Facilities bullets
        Route::post('about_us/bullets/add', [AdminAboutUsController::class, 'addBullet'])->name('about_us.add_bullet');
        Route::post('about_us/bullets/update/{index}', [AdminAboutUsController::class, 'updateBullet'])->name('about_us.update_bullet');
        Route::post('about_us/bullets/remove/{index}', [AdminAboutUsController::class, 'removeBullet'])->name('about_us.remove_bullet');
        // Values
        Route::get('about_us', [AdminAboutUsController::class, 'index'])->name('about_us.index');
        Route::post('about_us/values/add', [AdminAboutUsController::class, 'addValue'])->name('about_us.add_value');
        Route::post('about_us/values/update/{index}', [AdminAboutUsController::class, 'updateValue'])->name('about_us.update_value');
        Route::post('about_us/values/remove/{index}', [AdminAboutUsController::class, 'removeValue'])->name('about_us.remove_value');

        // Golf Rate Lean Season CMS
        Route::get('/glean', [AdminGleanController::class, 'index'])->name('glean.index');
        Route::post('/glean/store', [AdminGleanController::class, 'store'])->name('glean.store');
        Route::put('/glean/{id}/update', [AdminGleanController::class, 'update'])->name('glean.update');
        Route::delete('/glean/{id}/delete', [AdminGleanController::class, 'destroy'])->name('glean.destroy');

        // Golf Rate Peak Season CMS
        Route::get('/gpeak', [AdminGpeakController::class, 'index'])->name('gpeak.index');
        Route::post('/gpeak/store', [AdminGpeakController::class, 'store'])->name('gpeak.store');
        Route::put('/gpeak/{id}/update', [AdminGpeakController::class, 'update'])->name('gpeak.update');
        Route::delete('/gpeak/{id}/delete', [AdminGpeakController::class, 'destroy'])->name('gpeak.destroy');

        // Teehouse CMS
        Route::get('teehouse', [AdminTeehouseController::class, 'index'])->name('teehouse');
        Route::post('teehouse/description', [AdminTeehouseController::class, 'updateDescription'])->name('teehouse.update_description');

        Route::post('teehouse/{group}/upload', [AdminTeehouseController::class, 'uploadImages'])->name('teehouse.upload_images');
        Route::post('teehouse/{group}/remove/{index}', [AdminTeehouseController::class, 'removeImage'])->name('teehouse.remove_image');
        Route::post('teehouse/{group}/replace/{index}', [AdminTeehouseController::class, 'replaceImage'])->name('teehouse.replace_image');

        // Grill CMS
        Route::get('grill', [AdminGrillController::class, 'index'])->name('grill');
        Route::post('grill/carousel/upload', [AdminGrillController::class, 'uploadCarousel'])->name('grill.carousel.upload');
        Route::post('grill/carousel/update/{index}', [AdminGrillController::class, 'updateCarousel'])->name('grill.carousel.update');
        Route::post('grill/carousel/remove/{index}', [AdminGrillController::class, 'removeCarousel'])->name('grill.carousel.remove');

        Route::post('grill/menu/add', [AdminGrillController::class, 'addMenuItem'])->name('grill.menu.add');
        Route::post('grill/menu/update/{index}', [AdminGrillController::class, 'updateMenuItem'])->name('grill.menu.update');
        Route::post('grill/menu/remove/{index}', [AdminGrillController::class, 'removeMenuItem'])->name('grill.menu.remove');

        // Courses Management Routes
        Route::get('/courses', [AdminCoursesController::class, 'index'])->name('courses');
        Route::post('/courses/store', [AdminCoursesController::class, 'store'])->name('courses.store');
        Route::put('/courses/{id}', [AdminCoursesController::class, 'update'])->name('courses.update');     
        Route::delete('/courses/{id}', [AdminCoursesController::class, 'destroy'])->name('courses.destroy');
        // Per-image operations
        Route::put('/courses/{id}/update-image/{type}/{index}', [AdminCoursesController::class, 'updateImageField'])->name('courses.update_image');
        Route::get('/courses/{id}/delete-image/{type}/{index}', [AdminCoursesController::class, 'deleteImageField'])->name('courses.delete_image');
        Route::post('/courses/{id}/add-image/{type}', [AdminCoursesController::class, 'addImageField'])->name('courses.add_image');
        
        // Tournament & Event Management (CMS back-end) 
        Route::get('/tournaments', [AdminT_EventController::class,'index'])->name('tournaments.index');
        Route::post('/tournaments', [AdminT_EventController::class,'store'])->name('tournaments.store');
        Route::put('/tournaments/{event}', [AdminT_EventController::class,'update'])->name('tournaments.update');
        Route::delete('/tournaments/{event}', [AdminT_EventController::class,'destroy'])->name('tournaments.destroy');
    });


// 🔹 Admin – Courses Management
// Route::middleware(['web'])->group(function () {
//     Route::get('/admin/courses', [AdminCoursesController::class, 'index'])->name('admin.courses');
//     Route::post('/admin/courses/store', [AdminCoursesController::class, 'store'])->name('courses.store');
//     Route::put('/admin/courses/{id}', [AdminCoursesController::class, 'update'])->name('courses.update');
//     Route::delete('/admin/courses/{id}', [AdminCoursesController::class, 'destroy'])->name('courses.destroy');

//     // ✅ New routes for per-image operations
//     Route::put('/admin/courses/{id}/update-image/{type}/{index}', [AdminCoursesController::class, 'updateImageField'])->name('courses.update_image');
//     Route::get('/admin/courses/{id}/delete-image/{type}/{index}', [AdminCoursesController::class, 'deleteImageField'])->name('courses.delete_image');
//     Route::post('/admin/courses/{id}/add-image/{type}', [AdminCoursesController::class, 'addImageField'])->name('courses.add_image');
// });


// 🔹 Corporate Governance
Route::get('/cbce', fn() => view('cbce'))->name('cbce');
Route::get('/boardCharter', fn() => view('boardCharter'))->name('boardCharter');
Route::get('/corpGovManual', fn() => view('corpGovManual'))->name('corpGovManual');

