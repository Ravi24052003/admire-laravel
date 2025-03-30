@extends('dashboard_layout.app')

@section('content')
<div class="container-fluid">
    <h1>Edit Itinerary</h1>


    <form id="editItineraryForm" enctype="multipart/form-data">
        @csrf

        <div id="_json_strings" data-pricing="{{$itineraryResource->pricing}}" data-additional_inclusion="{{$itineraryResource->additional_inclusion}}" data-days_information_string="{{ json_encode($itineraryResource->days_information)}}" data-duration="{{$itineraryResource->duration}}"  data-hotel_details_string = "{{ json_encode($itineraryResource->hotel_details) }}"

            data-cancellation_policy = "{{$itineraryResource->cancellation_policy}}"
            data-payment_mode = "{{$itineraryResource->payment_mode}}" 

        data-terms_and_conditions="{{json_encode($termsAndConditions)}}" data-special_notes="{{json_encode($specialNotes)}}" data-cancellation_policies="{{json_encode($cancellationPolicies)}}" data-payment_modes="{{json_encode($paymentModes)}}"
            
            ></div>

        <div class="row">
            <div class="col-md-6">
                <!-- Form fields for itinerary details -->

                <div class="form-group">
                    <label for="title">Title</label>
                    <input type="text" class="form-control" id="title" name="title" value="{{ $itineraryResource->title }}" required>
                    <p id="titleErr" class="text-danger small"></p>
                </div>

                <div class="form-group">
                    <label for="selected_destination">Select Destination</label>
                    <select class="form-control" name="selected_destination" id="selected_destination" required>
                        <option value="">Select Destination</option>
                        <!-- Populate options dynamically -->
                        <option value="{{ $itineraryResource->selected_destination }}" selected>{{ $itineraryResource->selected_destination }}</option>
                    </select>
                    <p id="selected_destinationErr" class="text-danger small"></p>
                </div>



                <div class="form-group">
                    <label for="destination_thumbnail_file">Destination Thumbnail</label>
                    <input type="file" class="form-control" id="destination_thumbnail_file" name="destination_thumbnail_file">
                    <p id="destination_thumbnail_fileErr" class="text-danger small"></p>
                    <!-- Display existing thumbnail -->
                    @if ($itineraryResource->destination_thumbnail)
                        <img src="{{ asset($itineraryResource->destination_thumbnail) }}" alt="Thumbnail" width="100" class="mt-2">
                    @endif
                </div>
                <div class="form-group">
                    <label for="destination_images_files">Destination Images</label>
                    <input type="file" class="form-control" id="destination_images_files" name="destination_images_files[]" multiple>
                    <p id="destination_images_filesErr" class="text-danger small"></p>
                    <!-- Display existing images -->
                    @if ($itineraryResource->destination_images)
                        @foreach ($itineraryResource->destination_images as $image)
                            <img src="{{ asset($image) }}" alt="Destination Image" width="100" class="mt-2">
                        @endforeach
                    @endif
                </div>


                <div class="form-group">
                    <label for="slug">Slug</label>
                    <input type="text" class="form-control" id="slug" name="slug" value="{{ $itineraryResource->slug }}" required>
                    <p id="slugPreview" class="text-muted"></p>
                    <p id="slugErr" class="text-danger small"></p>
                </div>
                <div class="form-group">
                    <label for="domestic_or_international">Domestic or International</label>
                    <select class="form-control" id="domestic_or_international" name="domestic_or_international" required>
                        <option value="domestic" {{$itineraryResource->domestic_or_international === "domestic" ? 'selected' : '' }} >Domestic</option>
                        <option value="international" {{$itineraryResource->domestic_or_international === "international" ? 'selected' : ''}}>International</option>
                    </select>
                    <p id="domestic_or_internationalErr" class="text-danger small"></p>
                </div>
                <div class="form-group">
                    <label for="duration">Duration</label>
                    <select class="form-control" id="duration" name="duration" required>
                       @for ($i = 2; $i <= 22; $i++)
    <option value="{{ $i }}D/{{ $i - 1 }}N"  
        {{ ($itineraryResource->duration == $i."D/" . ($i - 1) . "N") ? 'selected' : '' }}>
        {{ $i }}D/{{ $i - 1 }}N
    </option>
@endfor
                    </select>
                    <p id="durationErr" class="text-danger small"></p>
                </div>
                <div class="form-group">
                    <label for="destination_detail">Destination Detail</label>
                    <textarea class="form-control" id="destination_detail" name="destination_detail" rows="3" required>{{ $itineraryResource->destination_detail }}</textarea>
                    <p id="destination_detailErr" class="text-danger small"></p>
                </div>
                <div class="form-group">
                    <label for="inclusion">Inclusion</label>
                    <textarea class="form-control" id="inclusion" name="inclusion" rows="3">{{ $itineraryResource->inclusion }}</textarea>
                    <p id="inclusionErr" class="text-danger small"></p>
                </div>



                         <!-- Checkbox -->
            <div class="form-group">
                <label for="additionalInclusionCheckbox">
                    <input type="checkbox" id="additionalInclusionCheckbox" name="additionalInclusionCheckbox" {{ $itineraryResource->additional_inclusion ? 'checked' : '' }}>
                    Additional Inclusion
                </label>
            </div>

            <!-- Placeholder for Additional Inclusion Textarea -->
            <div id="additionalInclusionPlaceholder"></div>



                <div class="form-group">
                    <label for="exclusion">Exclusion</label>
                    <textarea class="form-control" id="exclusion" name="exclusion" rows="3">{{ $itineraryResource->exclusion }}</textarea>
                    <p id="exclusionErr" class="text-danger small"></p>
                </div>
                <div class="form-group">
                    <label for="terms_and_conditions">Terms and Conditions</label>
                    <textarea class="form-control" id="terms_and_conditions" name="terms_and_conditions" rows="3">{{ $itineraryResource->terms_and_conditions }}</textarea>
                    <p id="terms_and_conditionsErr" class="text-danger small"></p>
                </div>


                <div class="form-group">
                    <label>Pricing</label> <br>
                    <label for="quotationCheckbox">
                        <input type="checkbox" id="quotationCheckbox" name="quotationCheckbox" value="Request for Quotation" {{$itineraryResource->pricing == "Request for Quotation"? "checked" : ""}}>
                        Request for Quotation
                    </label>
                </div>

                <div class="form-group" id="priceFieldContainer">
                </div>



                <div class="form-group">
                    <label for="itinerary_visibility">Itinerary Visibility</label>
                    <select class="form-control" id="itinerary_visibility" name="itinerary_visibility" required>
                        <option value="public" {{ $itineraryResource->itinerary_visibility === 'public' ? 'selected' : '' }}>Public</option>
                        <option value="private" {{ $itineraryResource->itinerary_visibility === 'private' ? 'selected' : '' }}>Private</option>
                    </select>
                    <p id="itinerary_visibilityErr" class="text-danger small"></p>
                </div>
                <div class="form-group">
                    <label for="itinerary_type">Itinerary Type</label>
                    <select class="form-control" name="itinerary_type" id="itinerary_type" required>
                        <option value="flexible" {{ $itineraryResource->itinerary_type === 'flexible' ? 'selected' : '' }}>Flexible departure</option>
                        <option value="fixed" {{ $itineraryResource->itinerary_type === 'fixed' ? 'selected' : '' }}>Fixed departure</option>
                    </select>
                    <p id="itinerary_typeErr" class="text-danger small"></p>
                </div>
               
            
            </div>
            <div class="col-md-6">
                <!-- Form fields for meta information -->
                <div class="form-group">
                    <label for="meta_title">Meta Title</label>
                    <input type="text" class="form-control" id="meta_title" name="meta_title" value="{{ $itineraryResource->meta_title }}">
                    <p id="meta_titleErr" class="text-danger small"></p>
                </div>
                <div class="form-group">
                    <label for="keyword">Keyword</label>
                    <input type="text" class="form-control" id="keyword" name="keyword" value="{{ $itineraryResource->keyword }}">
                    <p id="keywordErr" class="text-danger small"></p>
                </div>
                <div class="form-group">
                    <label for="meta_description">Meta Description</label>
                    <textarea class="form-control" id="meta_description" name="meta_description" rows="3">{{ $itineraryResource->meta_description }}</textarea>
                    <p id="meta_descriptionErr" class="text-danger small"></p>
                </div>




                <div class="form-group">
                    <label>Status Flags</label><br>
                    @php
                    $selectedFlags = $itineraryResource->status_flags;
                @endphp
                    <label>
                        <input type="checkbox" name="status_flags[]" value="is_trending" {{ in_array('is_trending', $selectedFlags) ? 'checked' : '' }}> Is Trending
                    </label><br>

                    <label>
                        <input type="checkbox" name="status_flags[]" value="is_exclusive" {{ in_array('is_exclusive', $selectedFlags) ? 'checked' : '' }}> Is Exclusive
                    </label><br>

                    <label>
                        <input type="checkbox" name="status_flags[]" value="is_weekend" {{ in_array('is_weekend', $selectedFlags) ? 'checked' : '' }}> Is Weekend
                    </label><br>
                </div>


                <!-- Interests Checkboxes -->
                <div class="form-group">
                    <label>Select Itinerary Themes</label><br>
                    @php
                        $selectedThemes = $itineraryResource->itinerary_theme;
                    @endphp
                    @foreach (['Adventure', 'Art', 'Backpacking', 'Beach', 'Culture', 'Desert', 'Eco-Friendly', 'Family Holidays', 'Festivals', 'Food', 'Hills', 'History', 'Honeymoon', 'Luxury', 'Pilgrimage', 'Road Trips', 'Romance', 'Solo trips', 'Trekking', 'Wellness', 'Wildlife', 'Yoga'] as $theme)
                        <label>
                            <input type="checkbox" name="itinerary_theme[]" value="{{ $theme }}" {{ in_array($theme, $selectedThemes) ? 'checked' : '' }}> {{ $theme }}
                        </label><br>
                    @endforeach
                    <p id="itinerary_theme_stringErr" class="text-danger small"></p>
                </div>
            </div>
        </div>

        <div class="form-group">
            <label for="hotelRequirementsCheckbox">
                <input type="checkbox" id="hotelRequirementsCheckbox" name="hotelRequirementsCheckbox" value="According to your requirements" 
                {{ count($itineraryResource->hotel_details) == 1 ? 'checked' : '' }}>
                According to your requirements
            </label>
        </div>


        <div id="hotelDetailsPlaceholder"></div>



           
        <div class="row">
            <div class="col-md-12">
                <h3 id="days_info_heading">Day 1 Information</h3>
                <div id="days_navigation_buttons" class="mb-3">
                    <!-- Navigation buttons will be dynamically added here -->
                </div>
                <div id="days_information_container">
                    <div class="form-group">
                        <label for="day_title">Enter location title</label>
                        <input type="text" class="form-control" id="day_title" name="days_information[0][title]" required>
                    </div>
                    <div class="form-group">
                        <label for="day_detail">Enter location description</label>
                        <textarea class="form-control" id="day_detail" name="days_information[0][detail]" rows="3" required></textarea>
                    </div>

                    <p id="days_information_stringErr" class="text-danger small"></p>
                </div>
                <div class="d-flex justify-content-between mt-3">
                    <button type="button" class="btn btn-secondary" id="backButton" disabled>Back</button>
                    <button type="button" class="btn btn-primary" id="nextButton">Next</button>
                </div>
            </div>
        </div>

        
     
        <div class="form-group">
            <label for="specialNoteCheckbox">
                <input type="checkbox" id="specialNoteCheckbox" name="specialNoteCheckbox" {{$itineraryResource->special_note? "checked" : ""}} >
                Special Note
            </label>
        </div>


        <div id="specialNotePlaceholder"></div>



        <div class="form-group">
            <label for="cancellationPolicyCheckbox">
                <input type="checkbox" id="cancellationPolicyCheckbox" name="cancellationPolicyCheckbox" {{$itineraryResource->cancellation_policy? "checked" : ""}} >
                Cancellation Policy
            </label>
        </div>


        <div id="cancellationPolicyPlaceholder"></div>



        <div class="form-group">
            <label for="paymentModeCheckbox">
                <input type="checkbox" id="paymentModeCheckbox" name="paymentModeCheckbox"
                {{$itineraryResource->payment_mode? "checked" : ""}}
                >
                Payment Mode
            </label>
        </div>


        <div id="paymentModePlaceholder"></div>

        <button id="itinerary_update_button" type="submit" class="btn btn-primary my-5">Update Itinerary</button>
    </form>
</div>

@endsection

@section('script')
<script src="{{ asset('js/itinerary/edit.js') }}"></script>
@endsection