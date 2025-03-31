<?php

namespace App\Http\Controllers;

use App\Models\HeroSectionVideo;
use App\Http\Requests\StoreHeroSectionVideoRequest;
use App\Http\Requests\UpdateHeroSectionVideoRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Arr;
use Illuminate\Support\Str;

class HeroSectionVideoController extends Controller
{
    // Display a list of all hero section videos
    public function index()
    {
        $videos = HeroSectionVideo::all();
        return view('hero_section_videos.index', compact('videos'));
    }

    // Show the form to create a new hero section video
    public function create()
    {
        return view('hero_section_videos.create');
    }

    // Save the new hero section video
    public function store(StoreHeroSectionVideoRequest $request)
    {
        $data = $request->validated();

        $directory = public_path('hero_section_videos');

        if ($request->hasFile('video_file')) {
            $video_file = $request->file("video_file");

            $video_filename = time() . '_' . uniqid() . Str::random(8) . '.' . $video_file->getClientOriginalExtension();

            $video_file->move($directory, $video_filename);

            $data["video_url"] = 'hero_section_videos/' . $video_filename;
        }

        Arr::forget($data, ["video_file"]);

        HeroSectionVideo::create($data);
        
        return redirect()->route('hero-section-videos.index')->with('success', 'Video created successfully.');
    }

    // Display a single hero section video
    public function show($hero_section_video)
    {
        $video = HeroSectionVideo::findOrFail($hero_section_video);
        return view('hero_section_videos.show', compact('video'));
    }

    // Show the form to edit an existing hero section video
    public function edit($hero_section_video)
    {
        $video = HeroSectionVideo::findOrFail($hero_section_video);
        return view('hero_section_videos.edit', compact('video'));
    }

    // Update the hero section video
    public function update(UpdateHeroSectionVideoRequest $request, $hero_section_video)
    {
        $data = $request->validated();

        $video = HeroSectionVideo::findOrFail($hero_section_video);

        $directory = public_path('hero_section_videos');

        if ($request->hasFile("video_file")){
            // Delete the old thumbnail if it exists
            if (!empty($video->video_url)){
                $oldVideoPath = public_path($video->video_url);
                if (file_exists($oldVideoPath)) {
                    unlink($oldVideoPath);
                }
            }

            $video_file = $request->file("video_file");
            $video_filename = time() . '_' . uniqid() . Str::random(8) . '.' . $video_file->getClientOriginalExtension();
            $video_file->move($directory, $video_filename);
            $data["video_url"] = 'hero_section_videos/' . $video_filename;
        }


        Arr::forget($data, ["video_file"]);

        $video->update($data);

        return redirect()->route('hero-section-videos.index')->with('success', 'Hero section video updated successfully.');
    }

    // Delete the hero section video
    public function destroy($hero_section_video)
    {
        $video = HeroSectionVideo::findOrFail($hero_section_video);

        if (!empty($video->video_url)) {
            $videoPath = public_path($video->video_url);
            if (file_exists($videoPath)) {
                unlink($videoPath);
            }
        }

        $video->delete();

        return redirect()->route('hero-section-videos.index')->with('success', 'Video deleted successfully.');
    }

    
}
