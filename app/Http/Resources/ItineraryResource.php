<?php

namespace App\Http\Resources;

use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class ItineraryResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
           'id' => $this->id,
            'user_id' => $this->user_id,
            'domestic_or_international' => $this->domestic_or_international,
            'days_information' => $this->days_information,
            'destination_detail' => $this->destination_detail,
            'inclusion' => $this->inclusion,
            'exclusion' => $this->exclusion,
            'terms_and_conditions' => $this->terms_and_conditions,
            'pricing' => $this->pricing,
            'hotel_details' => $this->hotel_details,
            'title' => $this->title,
            'slug' => $this->slug,
            'meta_title' => $this->meta_title,
            'keyword' => $this->keyword,
            'meta_description' => $this->meta_description,
            'itinerary_visibility' => $this->itinerary_visibility,
            'itinerary_type' => $this->itinerary_type,
            'duration' => $this->duration,
            'selected_destination' => $this->selected_destination,
            'itinerary_theme' => $this->itinerary_theme,
            'is_trending' => $this->is_trending,
            'is_exclusive' => $this->is_exclusive,
            'is_weekend' => $this->is_weekend,
            'destination_thumbnail' => $this->destination_thumbnail,
            'destination_images' => $this->destination_images,
            'created_at' => (new Carbon($this->created_at)),
            'updated_at' => (new Carbon($this->updated_at))
        ];
    }
}
