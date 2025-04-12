@extends('dashboard_layout.app')

@section('content')
<div class="container-fluid">
    <h1>Create Itinerary</h1>

    <div id="_terms_and_policies_strings" data-special_notes="{{json_encode($specialNotes)}}" data-cancellation_policies="{{json_encode($cancellationPolicies)}}" data-payment_modes="{{json_encode($paymentModes)}}" ></div>


    <div id="_json_strings" data-terms_and_conditions="{{json_encode($termsAndConditions)}}"></div>



    <form method="GET" action="{{ route('itinerary.create') }}">
        <div class="form-group">
            <label for="domestic_or_international">Domestic or International</label>
            <select class="form-control" id="domestic_or_international" name="domestic_or_international" onchange="this.form.submit()" required>
                <option value="">Select Destination Type</option>
                <option value="domestic" {{ $type == 'domestic' ? 'selected' : '' }}>Domestic</option>
                <option value="international" {{ $type == 'international' ? 'selected' : '' }}>International</option>
            </select>
            <p id="domestic_or_internationalErr" class="text-danger small"></p>
        </div>
    </form>


    <form id="createItineraryForm" enctype="multipart/form-data">
        @csrf
        <div class="row">
            <div class="col-md-6">
                <!-- Form fields for itinerary details -->

                <div class="form-group">
                    <label for="selected_destination">Select Destination</label>
                    <div class="input-group">
                        <select class="form-control" name="selected_destination" id="selected_destination" required>
                            <option value="">Select Destination</option>
                            @foreach($destinations as $destination)
                                <option value="{{ $destination->destination_name }}">{{ $destination->destination_name }}</option>
                            @endforeach
                        </select>
                        <div class="input-group-append">

                            <a href="{{ route('destinations.create', ['redirect_back_to' => url()->current()]) }}" 
                                class="btn btn-primary" type="button">
                                 <i class="fas fa-plus"></i>
                             </a>

                        </div>
                    </div>
                    <p id="selected_destinationErr" class="text-danger small"></p>
                </div>



                <div class="form-group">
                    <label for="title">Title</label>
                    <input type="text" class="form-control" id="title" name="title">
                    <p id="titleErr" class="text-danger small"></p>
                </div>


                <div class="form-group">
                    <label for="destination_thumbnail_file">Destination Thumbnail</label>
                    <input type="file" class="form-control" id="destination_thumbnail_file" name="destination_thumbnail_file" required>
                    <p id="destination_thumbnail_fileErr" class="text-danger small"></p>
                </div>

                <div class="form-group">
                    <label for="destination_images_files">Destination Images</label>
                    <input type="file" class="form-control" id="destination_images_files" name="destination_images_files[]" multiple required>
                    <p id="destination_images_filesErr" class="text-danger small"></p>
                </div>


                <div class="form-group">
                    <label for="slug">Slug</label>
                    <input type="text" class="form-control" id="slug" name="slug" required>
                    <p id="slugPreview" class="text-muted"></p>
                    <p id="slugErr" class="text-danger small"></p>
                </div>
               
                <div class="form-group">
                    <label for="duration">Duration</label>
                    <select class="form-control" id="duration" name="duration" required>
                        @for ($i = 2; $i <= 22; $i++)
                            <option value="{{ $i }}D/{{ $i - 1 }}N">{{ $i }}D/{{ $i - 1 }}N</option>
                        @endfor
                    </select>
                    <p id="durationErr" class="text-danger small"></p>
                </div>
                
                <div class="form-group">
                    <label for="destination_detail">Destination Detail</label>
                    <textarea class="form-control" id="destination_detail" name="destination_detail" rows="3" required></textarea>

                    <p id="destination_detailErr" class="text-danger small"></p>
                </div>



                <div class="form-group">
                    <label for="tour_highlight">Tour Highlight</label>
                    <textarea class="form-control" id="tour_highlight" name="tour_highlight" rows="3"></textarea>
                    <p id="tour_highlightErr" class="text-danger small"></p>
                </div>




                <div class="form-group">
                    <label for="inclusion">Inclusion</label>
                    <textarea class="form-control" id="inclusion" name="inclusion" rows="3"></textarea>
                    <p id="inclusionErr" class="text-danger small"></p>
                </div>




                   <!-- Checkbox -->
            <div class="form-group">
                <label for="additionalInclusionCheckbox">
                    <input type="checkbox" id="additionalInclusionCheckbox" name="additionalInclusionCheckbox">
                    Additional Inclusion
                </label>
            </div>

            <!-- Placeholder for Additional Inclusion Textarea -->
            <div id="additionalInclusionPlaceholder"></div>




                <div class="form-group">
                    <label for="exclusion">Exclusion</label>
                    <textarea class="form-control" id="exclusion" name="exclusion" rows="3"></textarea>
                    <p id="exclusionErr" class="text-danger small"></p>
                </div>



             


                <div class="form-group">
                    <label for="terms_and_conditions">Terms and Conditions</label>
                    <textarea class="form-control" id="terms_and_conditions" name="terms_and_conditions" rows="3"></textarea>
                    <p id="terms_and_conditionsErr" class="text-danger small"></p>
                </div>


                
                    <div class="form-group">
                        <label>Pricing</label> <br>
                        <label for="quotationCheckbox">
                            <input type="checkbox" id="quotationCheckbox" name="quotationCheckbox" value="Request for Quotation" checked>
                            Request for Quotation
                        </label>
                    </div>

                    <div class="form-group" id="priceFieldContainer">
                    </div>


                <div class="form-group">
                    <label for="itinerary_visibility">Itinerary Visibility</label>

                    <select class="form-control" id="itinerary_visibility" name="itinerary_visibility" required>
                            <option value="public">Public</option>
                            <option value="private">Private</option>
                    </select>
                    <p id="itinerary_visibilityErr" class="text-danger small"></p>
                </div>

                <div class="form-group">
                    <label for="itinerary_type">Itinerary Type</label>
                    <select class="form-control" name="itinerary_type" id="itinerary_type" required>
                        <option value="flexible">Flexible departure</option>
                        <option value="fixed">Fixed departure</option>
                    </select>
                    <p id="itinerary_typeErr" class="text-danger small"></p>
                </div>

                

              
            </div>
            <div class="col-md-6">
                <!-- Form fields for meta information -->
                <div class="form-group">
                    <label for="meta_title">Meta Title</label>
                    <input type="text" class="form-control" id="meta_title" name="meta_title">
                    <p id="meta_titleErr" class="text-danger small"></p>
                </div>
                <div class="form-group">
                    <label for="keyword">Keyword</label>
                    <input type="text" class="form-control" id="keyword" name="keyword">
                    <p id="keywordErr" class="text-danger small"></p>
                </div>

                <div class="form-group">
                    <label for="meta_description">Meta Description</label>
                    <textarea class="form-control" id="meta_description" name="meta_description" rows="3"></textarea>
                    <p id="meta_descriptionErr" class="text-danger small"></p>
                </div>


                {{-- Status Flags  --}}
                <div class="form-group">
                    <label>Status Flags</label><br>
                    <label><input type="checkbox" name="status_flags[]" value="is_trending" > Is Trending</label><br>
                    <label><input type="checkbox" name="status_flags[]" value="is_exclusive" > Is Exclusive</label><br>
                    <label><input type="checkbox" name="status_flags[]" value="is_weekend" > Is Weekend</label><br>
                    <label><input type="checkbox" name="status_flags[]" value="is_gateway" > Is Gateway</label><br>
                </div>


                 <!-- Interests Checkboxes -->
                 <div class="form-group">
                    <label>Select Itinerary Themes</label><br>
                    <label><input type="checkbox" name="itinerary_theme[]" value="Adventure"> Adventure</label><br>
                    <label><input type="checkbox" name="itinerary_theme[]" value="Art"> Art</label><br>
                    <label><input type="checkbox" name="itinerary_theme[]" value="Backpacking"> Backpacking</label><br>
                    <label><input type="checkbox" name="itinerary_theme[]" value="Beach"> Beach</label><br>
                    <label><input type="checkbox" name="itinerary_theme[]" value="Culture"> Culture</label><br>
                    <label><input type="checkbox" name="itinerary_theme[]" value="Desert"> Desert</label><br>
                    <label><input type="checkbox" name="itinerary_theme[]" value="Eco-Friendly"> Eco-Friendly</label><br>
                    <label><input type="checkbox" name="itinerary_theme[]" value="Family Holidays"> Family Holidays</label><br>
                    <label><input type="checkbox" name="itinerary_theme[]" value="Festivals"> Festivals</label><br>
                    <label><input type="checkbox" name="itinerary_theme[]" value="Food"> Food</label><br>
                    <label><input type="checkbox" name="itinerary_theme[]" value="Hills"> Hills</label><br>
                    <label><input type="checkbox" name="itinerary_theme[]" value="History"> History</label><br>
                    <label><input type="checkbox" name="itinerary_theme[]" value="Honeymoon"> Honeymoon</label><br>
                    <label><input type="checkbox" name="itinerary_theme[]" value="Luxury"> Luxury</label><br>
                    <label><input type="checkbox" name="itinerary_theme[]" value="Pilgrimage"> Pilgrimage</label><br>
                    <label><input type="checkbox" name="itinerary_theme[]" value="Road Trips"> Road Trips</label><br>
                    <label><input type="checkbox" name="itinerary_theme[]" value="Romance"> Romance</label><br>
                    <label><input type="checkbox" name="itinerary_theme[]" value="Solo trips"> Solo trips</label><br>
                    <label><input type="checkbox" name="itinerary_theme[]" value="Trekking"> Trekking</label><br>
                    <label><input type="checkbox" name="itinerary_theme[]" value="Wellness"> Wellness</label><br>
                    <label><input type="checkbox" name="itinerary_theme[]" value="Wildlife"> Wildlife</label><br>
                    <label><input type="checkbox" name="itinerary_theme[]" value="Yoga"> Yoga</label><br>

                    <p id="itinerary_theme_stringErr" class="text-danger small"></p>
                </div>



            </div>
        </div>







           <!-- Checkbox -->
           <div class="form-group">
            <label for="hotelRequirementsCheckbox">
                <input type="checkbox" id="hotelRequirementsCheckbox" name="hotelRequirementsCheckbox" value="According to your requirements" checked>
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
                <input type="checkbox" id="specialNoteCheckbox" name="specialNoteCheckbox">
                Special Note
            </label>
        </div>


        <div id="specialNotePlaceholder"></div>



        <div class="form-group">
            <label for="cancellationPolicyCheckbox">
                <input type="checkbox" id="cancellationPolicyCheckbox" name="cancellationPolicyCheckbox">
                Cancellation Policy
            </label>
        </div>


        <div id="cancellationPolicyPlaceholder"></div>



        <div class="form-group">
            <label for="paymentModeCheckbox">
                <input type="checkbox" id="paymentModeCheckbox" name="paymentModeCheckbox">
                Payment Mode
            </label>
        </div>


        <div id="paymentModePlaceholder"></div>


        <button id="itinerary_create_button" type="submit" class="btn btn-primary my-5">Create Itinerary</button>
    </form>
</div>
@endsection


@section('script')
<script src="{{asset('js/itinerary/create.js')}}"></script>
@endsection