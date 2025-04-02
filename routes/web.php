<?php

use App\Http\Controllers\ItineraryController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\BlogCategoryController;
use App\Http\Controllers\BlogContentImageController;
use App\Http\Controllers\BlogController;
use App\Http\Controllers\CancellationPolicyController;
use App\Http\Controllers\DestinationImageController;
use App\Http\Controllers\GalleryController;
use App\Http\Controllers\HeroSectionVideoController;
use App\Http\Controllers\ImageAndTextTestimonialController;
use App\Http\Controllers\ItineraryLocationDetailImageController;
use App\Http\Controllers\ItineraryVideoController;
use App\Http\Controllers\PaymentModeController;
use App\Http\Controllers\SpecialNoteController;
use App\Http\Controllers\TermsAndPolicyController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\TermsAndConditionController;
use App\Http\Controllers\VideoBannerController;
use App\Http\Controllers\VideoTestimonialController;

Route::get('/', function () {
    return view('welcome');
});


Route::get('login', function () {
    return redirect("/");
});

Route::post('login', [AuthController::class, "login"])->name("login");
Route::post('signup', [AuthController::class, "signup"]);

Route::middleware("auth")->group(function(){
    Route::resource("user", UserController::class);

    Route::resource("itinerary", ItineraryController::class);

    Route::resource('terms-and-conditions', TermsAndConditionController::class);

    Route::resource('cancellation-policies', CancellationPolicyController::class);

    Route::resource('special-notes', SpecialNoteController::class);

    Route::resource('payment-modes', PaymentModeController::class);

    Route::resource('itinerary-location-detail-images', ItineraryLocationDetailImageController::class);
 
    Route::resource('selected-destination-video-banner', VideoBannerController::class)
    ->parameters(['selected-destination-video-banner' => 'video_banner']);

    Route::resource('gallery', GalleryController::class);

    Route::resource('hero-section-videos', HeroSectionVideoController::class);

    Route::resource('destination-images', DestinationImageController::class);

    Route::resource('blogs', BlogController::class);

    Route::resource('blog-categories', BlogCategoryController::class);

    Route::resource('blog-content-images', BlogContentImageController::class);

    Route::get('itinerary-video/create/{itinerary_id}', [ItineraryVideoController::class, 'create'])
    ->name('itinerary-video.create');

    Route::resource('itinerary-video', ItineraryVideoController::class)->except(['create']);

    Route::resource('image-and-text-testimonials', ImageAndTextTestimonialController::class);

    Route::resource('video-testimonials', VideoTestimonialController::class);
    
    Route::get('logout', [AuthController::class, "logout"])->name("dashboard.logout");

    Route::view('dashboard-home', 'dashboard_home')->name("dashboard.home");
});


require __DIR__.'/public_routes.php';