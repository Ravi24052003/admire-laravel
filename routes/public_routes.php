<?php

use App\Http\Controllers\API\PublicController;
use Illuminate\Support\Facades\Route;

// Publicly available API routes
Route::get('public-itineraries', [PublicController::class, 'getAllItineraries']); // Fetch all
Route::get('public-itineraries/{destination}', [PublicController::class, 'getItineraries']); // Fetch by destination
Route::get('public-itineraries-exclusive', [PublicController::class, 'getExclusiveItineraries']); // Exclusive itineraries
Route::get('public-itineraries-trending', [PublicController::class, 'getTrendingItineraries']); // Exclusive itineraries
Route::get('public-itineraries-weekend', [PublicController::class, 'getWeekendItineraries']); // Exclusive itineraries
Route::get('public-itinerary/{slug}', [PublicController::class, 'getParticularItinerary']); // Fetch by ID

// International Itineraries (Optional limit via query parameter)
Route::get('public-itineraries-international', [PublicController::class, 'getInternationalItineraries']); // Use ?limit=5 or ?limit=30

// Domestic Itineraries (Optional limit via query parameter)
Route::get('public-itineraries-domestic', [PublicController::class, 'getDomesticItineraries']); // Use ?limit=5 or ?limit=30

Route::get('public-destination-video/{destination}', [PublicController::class, 'getDestinationVideo']);

Route::get('public-gallery-images', [PublicController::class, 'getGalleryImages']);

Route::get('public-weekend-trending-itineraries', [PublicController::class, 'getWeekendTrendingItineraries']);

Route::get('public-destination-images/{destination}', [PublicController::class, 'getDestinationImages']);

Route::get('public-domestic-destinations-images', [PublicController::class, 'getDomesticDestinationsImages']);

Route::get('public-international-destinations-images', [PublicController::class, 'getInternationalDestinationsImages']);

Route::get('public-hero-section-videos', [PublicController::class, 'getHeroSectionPublicVideos']);

Route::get('public-blog/{slug}', [PublicController::class, 'getParticularBlog']);

Route::get('public-blogs', [PublicController::class, 'getPublicBlogs']);

Route::get('public-image-text-testimonials', [PublicController::class, 'getImageTextTestimonials']);

Route::get('public-video-testimonials', [PublicController::class, 'getVideoTestimonials']);