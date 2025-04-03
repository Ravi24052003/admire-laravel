<?php

namespace App\Http\Controllers;

use App\Models\VideoTestimonial;
use Illuminate\Support\Arr;
use Illuminate\Support\Str;
use App\Http\Requests\StoreVideoTestimonialRequest;
use App\Http\Requests\UpdateVideoTestimonialRequest;
use Illuminate\Http\Request;

class VideoTestimonialController extends Controller
{
    public function index()
    {
        $video_testimonials = VideoTestimonial::latest()->get();
        return view('video_testimonials.index', compact('video_testimonials'));
    }

    public function create()
    {
        return view('video_testimonials.create');
    }

    public function store(StoreVideoTestimonialRequest $request)
    {
        $data = $request->validated();

        $directory = public_path('video_testimonials');

        if ($request->hasFile('video_file')) {
            $video_file = $request->file("video_file");
            $video_filename = time() . '_' . uniqid() . Str::random(8) . '.' . $video_file->getClientOriginalExtension();
            $video_file->move($directory, $video_filename);
            $data["video_url"] = 'video_testimonials/' . $video_filename;
        }

        Arr::forget($data, ["video_file"]);

        VideoTestimonial::create($data);

        return redirect()->route('video-testimonials.index')
            ->with('success', 'Video testimonial created successfully.');
    }

    public function show(VideoTestimonial $video_testimonial)
    {
        return view('video_testimonials.show', compact('video_testimonial'));
    }

    public function edit(VideoTestimonial $video_testimonial)
    {
        return view('video_testimonials.edit', compact('video_testimonial'));
    }

    public function update(UpdateVideoTestimonialRequest $request, VideoTestimonial $video_testimonial)
    {
        $data = $request->validated();
        $directory = public_path('video_testimonials');

        if ($request->hasFile("video_file")) {
            // Delete the old video if it exists
            if (!empty($video_testimonial->video_url)) {
                $oldVideoPath = public_path($video_testimonial->video_url);
                if (file_exists($oldVideoPath)) {
                    unlink($oldVideoPath);
                }
            }

            $video_file = $request->file("video_file");
            $video_filename = time() . '_' . uniqid() . Str::random(8) . '.' . $video_file->getClientOriginalExtension();
            $video_file->move($directory, $video_filename);
            $data["video_url"] = 'video_testimonials/' . $video_filename;
        }

        Arr::forget($data, ["video_file"]);

        $video_testimonial->update($data);

        return redirect()->route('video-testimonials.index')
            ->with('success', 'Video testimonial updated successfully.');
    }

    public function destroy(VideoTestimonial $video_testimonial)
    {
        // Delete the video file if it exists
        if (!empty($video_testimonial->video_url)) {
            $videoPath = public_path($video_testimonial->video_url);
            if (file_exists($videoPath)) {
                unlink($videoPath);
            }
        }

        $video_testimonial->delete();

        return redirect()->route('video-testimonials.index')
            ->with('success', 'Video testimonial deleted successfully.');
    }
    
}