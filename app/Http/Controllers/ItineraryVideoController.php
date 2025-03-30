<?php

// app/Http/Controllers/ItineraryVideoController.php

namespace App\Http\Controllers;

use App\Models\ItineraryVideo;
use App\Http\Requests\StoreItineraryVideoRequest;
use App\Http\Requests\UpdateItineraryVideoRequest;
use Illuminate\Support\Arr;
use Illuminate\Support\Str;

class ItineraryVideoController extends Controller
{
    public function index()
    {
        $itineraryVideos = ItineraryVideo::latest()->paginate(50);
        return view('itinerary_videos.index', compact('itineraryVideos'));
    }

    public function create($itinerary_id)
    {
        return view('itinerary_videos.create', compact('itinerary_id'));
    }

    public function store(StoreItineraryVideoRequest $request)
    {
        $data = $request->validated();

        $directory = public_path('itinerary_videos');

        // Handle video upload
        if ($request->hasFile('video_file')) {
            $video_file = $request->file("video_file");
            $video_filename = time() . '_' . uniqid() . Str::random(8) . '.' . $video_file->getClientOriginalExtension();
            $video_file->move($directory, $video_filename);
            $data["video_url"] = 'itinerary_videos/' . $video_filename;
        }

        Arr::forget($data, ["video_file"]);

        ItineraryVideo::create($data);

        return redirect()->route('itinerary-video.index')->with('success', 'Itinerary Video created successfully.');
    }

    public function show(ItineraryVideo $itinerary_video)
    {
        return view('itinerary_videos.show', compact('itinerary_video'));
    }

    public function edit(ItineraryVideo $itinerary_video)
    {
        return view('itinerary_videos.edit', compact('itinerary_video'));
    }

    public function update(UpdateItineraryVideoRequest $request, ItineraryVideo $itinerary_video)
    {


        $data = $request->validated();

        $directory = public_path('itinerary_videos');

        if ($request->hasFile("video_file")){
            // Delete the old thumbnail if it exists
            if (!empty($itinerary_video->video_url)){
                $oldVideoPath = public_path($itinerary_video->video_url);
                if (file_exists($oldVideoPath)) {
                    unlink($oldVideoPath);
                }
            }

            $video_file = $request->file("video_file");
            $video_filename = time() . '_' . uniqid() . Str::random(8) . '.' . $video_file->getClientOriginalExtension();
            $video_file->move($directory, $video_filename);
            $data["video_url"] = 'itinerary_videos/' . $video_filename;
        }


        Arr::forget($data, ["video_file"]);

        $itinerary_video->update($data);

        return redirect()->route('itinerary-video.index')->with('success', 'Itinerary video updated successfully.');

    }

    public function destroy(ItineraryVideo $itinerary_video)
    {
        if (!empty($itinerary_video->video_url)) {
            $videoPath = public_path($itinerary_video->video_url);
            if (file_exists($videoPath)) {
                unlink($videoPath);
            }
        }

        $itinerary_video->delete();

        return redirect()->route('itinerary-video.index')
            ->with('success', 'Video deleted successfully');
    }

}