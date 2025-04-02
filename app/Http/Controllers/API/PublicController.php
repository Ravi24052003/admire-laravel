<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Http\Resources\ItineraryResource;
use App\Models\Blog;
use App\Models\DestinationImage;
use App\Models\Gallery;
use App\Models\HeroSectionVideo;
use App\Models\ImageAndTextTestimonial;
use App\Models\Itinerary;
use App\Models\SelectedDestinationVideoBanner;
use App\Models\TermsAndCondition;
use App\Models\VideoTestimonial;

class PublicController extends Controller
{

    public function getParticularItinerary($slug){
        $itinerary = Itinerary::with('video')->where('slug', $slug)->firstOrFail();

        // This will automatically include the video in the JSON response
        return response()->json($itinerary, 200)
            ->header('Access-Control-Allow-Origin', '*')
            ->header('Access-Control-Allow-Methods', 'GET, POST, PUT, DELETE, OPTIONS')
            ->header('Access-Control-Allow-Headers', 'Content-Type, Authorization');
    }


    public function getAllItineraries() {
    $allItineraries = Itinerary::where('itinerary_visibility', 'public')
                                 ->orderBy('id', 'desc')
                               ->select([
                                   'destination_thumbnail',
                                   'destination_images',
                                   'domestic_or_international',
                                   'duration',
                                   'pricing',
                                   'selected_destination',
                                   'slug',
                                   'title'
                               ])
                               ->paginate(50); // Fetch 50 items per page

    return response()->json($allItineraries)
        ->header('Access-Control-Allow-Origin', '*')
        ->header('Access-Control-Allow-Methods', 'GET, POST, PUT, DELETE, OPTIONS')
        ->header('Access-Control-Allow-Headers', 'Content-Type, Authorization');
}


 public function getItineraries($destination) {
    $itineraries = Itinerary::where('selected_destination', $destination)
                            ->where('itinerary_visibility', 'public')
                            ->orderBy('id', 'desc') // Sorting by ID in descending order
                            ->select([
                                'destination_thumbnail',
                                'destination_images',
                                'domestic_or_international',
                                'duration',
                                'pricing',
                                'selected_destination',
                                'slug',
                                'title'
                            ])
                            ->get();

    return response()->json($itineraries, 200)
        ->header('Access-Control-Allow-Origin', '*')
        ->header('Access-Control-Allow-Methods', 'GET, POST, PUT, DELETE, OPTIONS')
        ->header('Access-Control-Allow-Headers', 'Content-Type, Authorization');
}




   public function getExclusiveItineraries() {
    $itineraries = Itinerary::whereJsonContains('status_flags', ["is_exclusive"])
                            ->where('itinerary_visibility', 'public')
                            ->orderBy('id', 'desc')
                            ->limit(10)
                            ->select([
                                'destination_thumbnail',
                                'destination_images',
                                'domestic_or_international',
                                'duration',
                                'pricing',
                                'selected_destination',
                                'slug',
                                'title'
                            ])
                            ->get();

    return response()->json($itineraries, 200)
        ->header('Access-Control-Allow-Origin', '*')
        ->header('Access-Control-Allow-Methods', 'GET, POST, PUT, DELETE, OPTIONS')
        ->header('Access-Control-Allow-Headers', 'Content-Type, Authorization');
}



    public function getTrendingItineraries() {
    $itineraries = Itinerary::whereJsonContains('status_flags', ["is_trending"])
                            ->where('itinerary_visibility', 'public')
                            ->orderBy('id', 'desc')
                            ->limit(10)
                            ->select([
                                'destination_thumbnail',
                                'destination_images',
                                'domestic_or_international',
                                'duration',
                                'pricing',
                                'selected_destination',
                                'slug',
                                'title'
                            ])
                            ->get();

    return response()->json($itineraries, 200)
        ->header('Access-Control-Allow-Origin', '*')
        ->header('Access-Control-Allow-Methods', 'GET, POST, PUT, DELETE, OPTIONS')
        ->header('Access-Control-Allow-Headers', 'Content-Type, Authorization');
}





 public function getWeekendTrendingItineraries(){
    $itineraries = Itinerary::whereJsonContains('status_flags', ["is_weekend", "is_trending"])
                            ->where('itinerary_visibility', 'public')
                            ->orderBy('id', 'desc')
                            ->limit(10)
                            ->select([
                                'destination_thumbnail',
                                'destination_images',
                                'domestic_or_international',
                                'duration',
                                'pricing',
                                'selected_destination',
                                'slug',
                                'title'
                            ])
                            ->get();

    return response()->json($itineraries, 200)
        ->header('Access-Control-Allow-Origin', '*')
        ->header('Access-Control-Allow-Methods', 'GET, POST, PUT, DELETE, OPTIONS')
        ->header('Access-Control-Allow-Headers', 'Content-Type, Authorization');
}


   public function getWeekendItineraries() {
    $itineraries = Itinerary::whereJsonContains('status_flags', ["is_weekend"])
                            ->where('itinerary_visibility', 'public')
                            ->orderBy('id', 'desc')
                            ->limit(10)
                            ->select([
                                'destination_thumbnail',
                                'destination_images',
                                'domestic_or_international',
                                'duration',
                                'pricing',
                                'selected_destination',
                                'slug',
                                'title'
                            ])
                            ->get();

    return response()->json($itineraries, 200)
        ->header('Access-Control-Allow-Origin', '*')
        ->header('Access-Control-Allow-Methods', 'GET, POST, PUT, DELETE, OPTIONS')
        ->header('Access-Control-Allow-Headers', 'Content-Type, Authorization');
}



  public function getDomesticItineraries() {
    $itineraries = Itinerary::where("domestic_or_international", "domestic")
                            ->orderBy('id', 'desc') // Sorting by ID in descending order
                            ->select([
                                'destination_thumbnail',
                                'destination_images',
                                'domestic_or_international',
                                'duration',
                                'pricing',
                                'selected_destination',
                                'slug',
                                'title'
                            ])
                            ->paginate(50);

    return response()->json($itineraries, 200)
        ->header('Access-Control-Allow-Origin', '*')
        ->header('Access-Control-Allow-Methods', 'GET, POST, PUT, DELETE, OPTIONS')
        ->header('Access-Control-Allow-Headers', 'Content-Type, Authorization');
}



  public function getInternationalItineraries() {
    $itineraries = Itinerary::where("domestic_or_international", "international")
                              ->orderBy('id', 'desc')
                            ->select([
                                'destination_thumbnail',
                                'destination_images',
                                'domestic_or_international',
                                'duration',
                                'pricing',
                                'selected_destination',
                                'slug',
                                'title'
                            ])
                            ->paginate(50);

    return response()->json($itineraries, 200)
        ->header('Access-Control-Allow-Origin', '*')
        ->header('Access-Control-Allow-Methods', 'GET, POST, PUT, DELETE, OPTIONS')
        ->header('Access-Control-Allow-Headers', 'Content-Type, Authorization');
}




public function getDestinationVideo($destination) {
    $destinationVideo = SelectedDestinationVideoBanner::where('destination', $destination)->firstOrFail();

    return response()->json($destinationVideo, 200)
        ->header('Access-Control-Allow-Origin', '*')
        ->header('Access-Control-Allow-Methods', 'GET, POST, PUT, DELETE, OPTIONS')
        ->header('Access-Control-Allow-Headers', 'Content-Type, Authorization');
}


public function getGalleryImages(){
    $gallery = Gallery::where('visibility', 'public')->firstOrFail();

    return response()->json($gallery, 200)
        ->header('Access-Control-Allow-Origin', '*')
        ->header('Access-Control-Allow-Methods', 'GET, POST, PUT, DELETE, OPTIONS')
        ->header('Access-Control-Allow-Headers', 'Content-Type, Authorization');
}


public function getDestinationImages($destination) {
    $destination = strtolower($destination); // Convert input to lowercase

    $destinationImages = DestinationImage::whereRaw('LOWER(destination) = ?', [$destination])->firstOrFail();
    $itineraryCount = Itinerary::whereRaw('LOWER(selected_destination) = ?', [$destination])->count();

    return response()->json([
        'destinationImages' => $destinationImages,
        'itineraryCount' => $itineraryCount
    ], 200)
    ->header('Access-Control-Allow-Origin', '*')
    ->header('Access-Control-Allow-Methods', 'GET, POST, PUT, DELETE, OPTIONS')
    ->header('Access-Control-Allow-Headers', 'Content-Type, Authorization');
}


public function getDomesticDestinationsImages()
{
    $destinationsImages = DestinationImage::where('domestic_or_international', 'domestic')
        ->withCount('itineraries') // Count itineraries for each destination
        ->get();

    return response()->json($destinationsImages, 200)
        ->header('Access-Control-Allow-Origin', '*')
        ->header('Access-Control-Allow-Methods', 'GET, POST, PUT, DELETE, OPTIONS')
        ->header('Access-Control-Allow-Headers', 'Content-Type, Authorization');
}

public function getInternationalDestinationsImages()
{
    $destinationsImages = DestinationImage::where('domestic_or_international', 'international')
        ->withCount('itineraries') // Count itineraries for each destination
        ->get();

    return response()->json($destinationsImages, 200)
        ->header('Access-Control-Allow-Origin', '*')
        ->header('Access-Control-Allow-Methods', 'GET, POST, PUT, DELETE, OPTIONS')
        ->header('Access-Control-Allow-Headers', 'Content-Type, Authorization');
}



public function getHeroSectionPublicVideos(){
    $videos = HeroSectionVideo::where('visibility', 'public')->get();

    return response()->json($videos, 200)
    ->header('Access-Control-Allow-Origin', '*')
    ->header('Access-Control-Allow-Methods', 'GET, POST, PUT, DELETE, OPTIONS')
    ->header('Access-Control-Allow-Headers', 'Content-Type, Authorization');
}


public function getPublicBlogs()
{
    $blogs = Blog::where('blog_visibility', 'public')
    ->select([
        'blog_title',
        'blog_slug',
        'blog_description',
        'blog_author_name',
        'blog_category',
       'blog_image'
    ])
    ->get();


    return response()->json($blogs, 200)
    ->header('Access-Control-Allow-Origin', '*')
    ->header('Access-Control-Allow-Methods', 'GET, POST, PUT, DELETE, OPTIONS')
    ->header('Access-Control-Allow-Headers', 'Content-Type, Authorization');
}


public function getParticularBlog($slug)
{
$blog = Blog::where('blog_slug', $slug)->where('blog_visibility', 'public')->firstOrFail();

return response()->json($blog, 200)
->header('Access-Control-Allow-Origin', '*')
->header('Access-Control-Allow-Methods', 'GET, POST, PUT, DELETE, OPTIONS')
->header('Access-Control-Allow-Headers', 'Content-Type, Authorization');
}

public function getImageTextTestimonials()
{
    $testimonials =   ImageAndTextTestimonial::where('visibility', 'public')->get();

    return response()->json($testimonials, 200)
    ->header('Access-Control-Allow-Origin', '*')
    ->header('Access-Control-Allow-Methods', 'GET, POST, PUT, DELETE, OPTIONS')
    ->header('Access-Control-Allow-Headers', 'Content-Type, Authorization');

}


public function getVideoTestimonials()
{
    $testimonials =   VideoTestimonial::where('visibility', 'public')->get();

    return response()->json($testimonials, 200)
    ->header('Access-Control-Allow-Origin', '*')
    ->header('Access-Control-Allow-Methods', 'GET, POST, PUT, DELETE, OPTIONS')
    ->header('Access-Control-Allow-Headers', 'Content-Type, Authorization');

}

}