<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreItineraryRequest;
use App\Http\Requests\UpdateItineraryRequest;
use App\Http\Resources\ItineraryResource;
use App\Models\CancellationPolicy;
use App\Models\Destination;
use App\Models\Itinerary;
use App\Models\PaymentMode;
use App\Models\SpecialNote;
use App\Models\TermsAndCondition;
use Carbon\Carbon;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;

class ItineraryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
         // Validate date first
    if ($request->filled('from_date') && $request->filled('to_date')) {
        $fromDate = Carbon::parse($request->from_date)->startOfDay();
        $toDate = Carbon::parse($request->to_date)->endOfDay();

        if ($fromDate > $toDate) {
            return redirect()->back()->withErrors(['dateError' => "From date can't be greater than to date"]);
        }
    }
      
        $query = Itinerary::query();
    
        // Default sorting
        $sortDirection = $request->input('sort', 'desc');
        $query->orderBy('id', $sortDirection);
    
        // Apply filters
        $query->when($request->filled('selected_destination'), function ($q) use ($request) {
            return $q->where('selected_destination', 'like', '%'.$request->selected_destination.'%');
        });
    
        $query->when($request->filled('domestic_or_international'), function ($q) use ($request) {
            return $q->where('domestic_or_international', $request->domestic_or_international);
        });
    
        $query->when($request->filled('itinerary_visibility'), function ($q) use ($request) {
            return $q->where('itinerary_visibility', $request->itinerary_visibility);
        });
    
        $query->when($request->filled('itinerary_type'), function ($q) use ($request) {
            return $q->where('itinerary_type', $request->itinerary_type);
        });


        $query->when($request->filled('status_flags'), function ($q) use ($request) {
            foreach ($request->status_flags as $flag) {
                $q->whereJsonContains('status_flags', $flag);
            }
            return $q;
        });
        


        $query->when($request->filled('from_date') && $request->filled('to_date'), function($q) use($request){
         $fromDate = Carbon::parse($request->from_date)->startOfDay();
         $toDate = Carbon::parse($request->to_date)->endOfDay();

            return $q->whereBetween("created_at", [$fromDate, $toDate]);
        });


        // or

        // $query->when($request->filled('from_date') && $request->filled('to_date'), function($q) use($request){
            // $fromDate = Carbon::parse($request->from_date)->format('Y-m-d');
            // $toDate = Carbon::parse($request->to_date)->format('Y-m-d');
   
        //        return $q->whereDate("created_at", ">=", $fromDate)
        //                  ->whereDate("created_at", "<=", $toDate);
        //    });



    // Get paginated itineraries
    $itineraries = $query->paginate(50);

     // extra code only for refrence
//     $items = $itineraries->getCollection()
//             ->filter(function ($item) {
//         $fromDate = Carbon::parse(request()->input('from_date'))->startOfDay();
//         $toDate = Carbon::parse(request()->input('to_date'))->endOfDay();

//         if(($item->created_at >= $fromDate) && ($item->created_at <= $toDate)){
//             return $item;
//         }

//             })
//          ->map(function($item){
//         unset($item->days_information);
//         unset($item->terms_and_conditions);

//         return $item;
//      });

// $itineraries->setCollection($items);
    // extra code only for refrence
    
    // Convert collection to resource while keeping pagination
    $itinerariesResource = $itineraries;

    // Send to Blade view
        return view('itinerary.index', compact('itinerariesResource'));

    }    

     /**
     * Show the form for creating a new resource.
     */
    public function create(Request $request)
{
    // Fetch all required data
    $termsAndConditions = TermsAndCondition::all();
    $specialNotes = SpecialNote::all();
    $cancellationPolicies = CancellationPolicy::all();
    $paymentModes = PaymentMode::all();

    // Get the selected type from request
    $type = $request->query('domestic_or_international');
    
    // Fetch destinations based on type
    $destinations = $type 
        ? Destination::where('domestic_or_international', $type)->get()
        : collect(); // Empty collection if no type selected

    return view("itinerary.create", compact(
        'termsAndConditions',
        'specialNotes',
        'cancellationPolicies',
        'paymentModes',
        'destinations',
        'type'
    ));
}


     /**
     * Store a newly created resource in storage.
     */
    public function store(StoreItineraryRequest $request)
    {
        try {
            $data = $request->validated();

            $data["user_id"] = Auth::id();
    
            $data["days_information"] = json_decode($data["days_information_string"]);
            $data["hotel_details"] = json_decode($data["hotel_details_string"]);
            $data["itinerary_theme"] = json_decode($data["itinerary_theme_string"]);

            if(!empty($data["status_flags_string"])){
                $data["status_flags"] = json_decode($data["status_flags_string"]);
            }
    
            $directory = public_path('itinerary_images');
    
            // Handle destination_thumbnail
            if ($request->hasFile("destination_thumbnail_file")) {
                $thumbnail_file = $request->file("destination_thumbnail_file");
                $thumbnail_filename = time() . '_' . uniqid() . Str::random(8) . '.' . $thumbnail_file->getClientOriginalExtension();
                $thumbnail_file->move($directory, $thumbnail_filename);
                $data["destination_thumbnail"] = 'itinerary_images/' . $thumbnail_filename;
            }
    
            // Handle destination_images
            if ($request->hasFile("destination_images_files")) {
                $image_files = $request->file("destination_images_files");
                $images_paths = [];
    
                foreach ($image_files as $image_file) {
                    $image_filename = time() . '_' . uniqid() . Str::random(8) . '.' . $image_file->getClientOriginalExtension();
                    $image_file->move($directory, $image_filename);
                    $images_paths[] = 'itinerary_images/' . $image_filename;
                }
    
                $data["destination_images"] = $images_paths;
            }
    
            Arr::forget($data, [
                "days_information_string",
                "hotel_details_string",
                "itinerary_theme_string",
                "status_flags_string",
                "destination_thumbnail_file",
                "destination_images_files"
            ]);
    
            Itinerary::create($data);

            return response()->json(["message" => "Itinerary created successfully"], 201);
    
        } catch (Exception $e) {
            return response()->json(["message" => $e->getMessage()], 500);
        }
    }
    



       /**
     * Display the specified resource.
     */
    public function show(Itinerary $itinerary)
    {
        $itineraryResource = new ItineraryResource($itinerary);

        return view("itinerary.show", compact("itineraryResource"));
    }



    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Request $request, Itinerary $itinerary)
    {
           // Fetch all required data
           $termsAndConditions = TermsAndCondition::all();
           $specialNotes = SpecialNote::all(); // Replace with your actual model and query
           $cancellationPolicies = CancellationPolicy::all(); // Replace with your actual model and query
           $paymentModes = PaymentMode::all(); // Replace with your actual model and query
       
           $type = $itinerary->domestic_or_international; // Default type from itinerary

             // Get the selected type from request

             if(!empty($request->query('domestic_or_international'))){
                $type = $request->query('domestic_or_international');
             }
  
    
    // Fetch destinations based on type

    $destinations = $type 
        ? Destination::where('domestic_or_international', $type)->get()
        : collect(); // Empty collection if no type selected


        $itineraryResource = $itinerary;

        return view("itinerary.edit", 
        compact("itineraryResource", 
        'termsAndConditions', 
        'specialNotes', 
        'cancellationPolicies', 
        'paymentModes', 
        'destinations',
        'type'));
        
    }

         /**
     * Update the specified resource in storage.
     */
    public function update(UpdateItineraryRequest $request, Itinerary $itinerary)
    {
        try{

            $data = $request->validated();

            if(!empty($data["days_information_string"])){
                $data["days_information"] = json_decode($data["days_information_string"]);
            }
    
            if(!empty($data["hotel_details_string"])){
                $data["hotel_details"] = json_decode($data["hotel_details_string"]);
            }
    
            if(!empty($data["itinerary_theme_string"])){
                $data["itinerary_theme"] = json_decode($data["itinerary_theme_string"]);
            }

            if(!empty($data["status_flags_string"])){
                $data["status_flags"] = json_decode($data["status_flags_string"]);
            }
            
           
    
            $directory = public_path('itinerary_images');
            // Handle destination_thumbnail update
            if ($request->hasFile("destination_thumbnail_file")){
                // Delete the old thumbnail if it exists
                if (!empty($itinerary->destination_thumbnail)) {
                    $oldThumbnailPath = public_path($itinerary->destination_thumbnail);
                    if (file_exists($oldThumbnailPath)) {
                        unlink($oldThumbnailPath);
                    }
                }
    
                $thumbnail_file = $request->file("destination_thumbnail_file");
                $thumbnail_filename = time() . '_' . uniqid() . Str::random(8) . '.' . $thumbnail_file->getClientOriginalExtension();
                $thumbnail_file->move($directory, $thumbnail_filename);
                $data["destination_thumbnail"] = 'itinerary_images/' . $thumbnail_filename;
            }
    
            // Handle destination_images update
            if ($request->hasFile("destination_images_files")) {
                // Delete old images if they exist
                if (!empty($itinerary->destination_images)) {
                    $oldImages = $itinerary->destination_images;
                    foreach ($oldImages as $oldImagePath) {
                        $fullPath = public_path($oldImagePath);
                        if (file_exists($fullPath)) {
                            unlink($fullPath);
                        }
                    }
                }
    
                $image_files = $request->file("destination_images_files");
                $images_paths = [];
    
                foreach ($image_files as $image_file) {
                    $image_filename = time() . '_' . uniqid() . Str::random(8) . '.' . $image_file->getClientOriginalExtension();
                    $image_file->move($directory, $image_filename);
                    $images_paths[] = 'itinerary_images/' . $image_filename;
                }
    
                $data["destination_images"] = $images_paths;
            }
    
            Arr::forget($data, [
            "days_information_string",
            "hotel_details_string",
            "itinerary_theme_string",
            "status_flags_string",
            "destination_thumbnail_file",
            "destination_images_files"
            ]);
    
            $itinerary->update($data);
    
            return response()->json(["message" => "Itinerary updated successfully"], 200);
        }
        catch(Exception $e){
            return response()->json(["message" => $e->getMessage()], 500);
        }

    }


   /**
     * Remove the specified resource from storage.
     */
    public function destroy(Itinerary $itinerary)
    {
        // Delete thumbnail if it exists
        if (!empty($itinerary->destination_thumbnail)) {
            $thumbnailPath = public_path($itinerary->destination_thumbnail);
            if (file_exists($thumbnailPath)) {
                unlink($thumbnailPath);
            }
        }

        // Delete images if they exist
        if (!empty($itinerary->destination_images)) {
            $images = $itinerary->destination_images;
            foreach ($images as $imagePath) {
                $fullPath = public_path($imagePath);
                if (file_exists($fullPath)) {
                    unlink($fullPath);
                }
            }
        }

        $itinerary->delete();

        return to_route("itinerary.index")->with("success", "Itinerary Deleted successfully");

    }


    // public function userItineraries()
    // {
    //     $itineraries = Itinerary::where("user_id", Auth::id())->get(); // Include user relationship

    //     $itinerariesResource = ItineraryResource::collection($itineraries);
    //     return response()->json($itinerariesResource, 200);
    // }

}
