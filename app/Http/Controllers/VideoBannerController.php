<?php

namespace App\Http\Controllers;

use App\Models\SelectedDestinationVideoBanner;
use App\Http\Requests\StoreVideoBannerRequest;
use App\Http\Requests\UpdateVideoBannerRequest;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class VideoBannerController extends Controller
{
    public function index()
    {
        $videoBanners = SelectedDestinationVideoBanner::all();
        return view('video_banners.index', compact('videoBanners'));
    }

    public function create()
    {
        return view('video_banners.create');
    }

    public function store(StoreVideoBannerRequest $request)
    {
        $data = $request->validated();

        $directory = public_path('video_banners');

        // Handle video upload
        if ($request->hasFile('video_file')) {
            $video_file = $request->file("video_file");
            $video_filename = time() . '_' . uniqid() . Str::random(8) . '.' . $video_file->getClientOriginalExtension();
            $video_file->move($directory, $video_filename);
            $data["video_url"] = 'video_banners/' . $video_filename;
        }

        Arr::forget($data, ["video_file"]);

        SelectedDestinationVideoBanner::create($data);

        return redirect()->route('selected-destination-video-banner.index')->with('success', 'Video Banner created successfully.');
    }

    public function show(SelectedDestinationVideoBanner $video_banner)
    {
        return view('video_banners.show', compact('video_banner'));
    }

    public function edit(SelectedDestinationVideoBanner $video_banner)
    {
        return view('video_banners.edit', compact('video_banner'));
    }

    public function update(UpdateVideoBannerRequest $request, SelectedDestinationVideoBanner $video_banner)
    {
        $data = $request->validated();

        $directory = public_path('video_banners');

        if ($request->hasFile("video_file")){
            // Delete the old thumbnail if it exists
            if (!empty($video_banner->video_url)){
                $oldVideoPath = public_path($video_banner->video_url);
                if (file_exists($oldVideoPath)) {
                    unlink($oldVideoPath);
                }
            }

            $video_file = $request->file("video_file");
            $video_filename = time() . '_' . uniqid() . Str::random(8) . '.' . $video_file->getClientOriginalExtension();
            $video_file->move($directory, $video_filename);
            $data["video_url"] = 'video_banners/' . $video_filename;
        }


        Arr::forget($data, ["video_file"]);

        $video_banner->update($data);

        return redirect()->route('selected-destination-video-banner.index')->with('success', 'Video Banner updated successfully.');
    }

    public function destroy(SelectedDestinationVideoBanner $video_banner)
    {
        // Delete video file
        if (!empty($video_banner->video_url)) {
            $videoPath = public_path($video_banner->video_url);
            if (file_exists($videoPath)) {
                unlink($videoPath);
            }
        }

        $video_banner->delete();

        return redirect()->route('selected-destination-video-banner.index')->with('success', 'Video Banner deleted successfully.');
    }
}