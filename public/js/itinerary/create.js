$(document).ready(function() {
    $('#destination_detail').summernote({
    placeholder: '',
    tabsize: 2,
    height: 400
    });

    $('#inclusion').summernote({
    placeholder: '',
    tabsize: 2,
    height: 300
    });

    $('#exclusion').summernote({
    placeholder: '',
    tabsize: 2,
    height: 300
    });

    $('#terms_and_conditions').summernote({
        placeholder: '',
        tabsize: 2,
        height: 300
        });

    $('#tour_highlight').summernote({
        placeholder: '',
        tabsize: 2,
        height: 300
        });
    

  });

let currentDay = 1;
let daysInformation = [];

const itineraryTheme = [];
const statusFlags = [];

const durationSelect = document.getElementById('duration');
const daysInfoHeading = document.getElementById('days_info_heading');
const daysNavigationButtons = document.getElementById('days_navigation_buttons');
const daysInformationContainer = document.getElementById('days_information_container');
const backButton = document.getElementById('backButton');
const nextButton = document.getElementById('nextButton');
const dayTitleInput = document.getElementById('day_title');
const dayDetailTextarea = document.getElementById('day_detail');

// Get the select element
const selectedDestination = document.getElementById("selected_destination");

// Loop through the array and create options
// optionsArray.forEach(option => {
//     const optionElement = document.createElement("option");
//     optionElement.value = option.value;
//     optionElement.innerText = option.label;
//     selectedDestination.appendChild(optionElement);
// });
    


    // day information whole logic starts here

// Initialize days information array with default duration (2D/1N)
// Initialize duration with value 2, duration = 2
const initializeDaysInformation = (duration) => {

    if(daysInformation.length > duration) {
       daysInformation = daysInformation.slice(0, duration);
    }

    if(daysInformation.length < duration) {

        if(daysInformation.length === 0) {
            for (let i = daysInformation.length; i < duration; i++) {
                daysInformation.push({title: '', detail: '', day: i + 1});
              }
        }
        else{
            let newDaysInformation = [...daysInformation];
            for (let i = (daysInformation.length); i < duration; i++) {
                newDaysInformation.push({title: '', detail: '', day: i + 1});
              }
                daysInformation = newDaysInformation;
        }
       
    }
    
};

// Update navigation buttons based on duration
// Initialize duration with value 2, duration = 2
const updateNavigationButtons = (duration) => {
    daysNavigationButtons.innerHTML = '';
    for (let i = 0; i < duration; i++) {
        const button = document.createElement('button');
        button.type = 'button';
        button.className = 'btn btn-outline-primary mr-2';
        button.textContent = `Day ${i+1}`;
        button.addEventListener('click', (e) => navigateToDay(i+1));
        daysNavigationButtons.appendChild(button);
    }
};

// Navigate to a specific day
// Intialize currentDay with value 1, day = 1

// navigateToDay function is called when click on button or click on next and back button
const navigateToDay = (day) => {
    // durationSelect is a select element whose values are like this 2D/1N, 3D/2N, .... 22D/21N
    if (day < 1 || day > parseInt(durationSelect.value)) return;

      // Save the current day's data before switching
      // this function modifies the property of the object in the daysInformation array
    //   saveCurrentDayData();

    // Check if previous days are filled
    for (let i = 0; i < (day-1); i++) {
        // daysInformation is an array of objects
        if (!daysInformation[i].title.trim() || !daysInformation[i].detail.trim()){

            Array.from(daysNavigationButtons.getElementsByTagName('button')).forEach((btn, i) => {
                btn.classList.remove('bg-primary', 'text-white');
            });


            daysNavigationButtons.getElementsByTagName('button')[i].classList.add('bg-primary', 'text-white');

            dayTitleInput.value =  "";

            // dayDetailTextarea.value =  "";
            $('#day_detail').summernote("reset");


            document.getElementById('days_info_heading').textContent = `Day ${i+1} Information`;
            alert(`Please fill in the information for Day ${i+1} first.`);

            return;
        }
    }

    currentDay = day;


    Array.from(daysNavigationButtons.getElementsByTagName('button')).forEach((btn, i) => {
        btn.classList.remove('bg-primary', 'text-white');
    });

    daysNavigationButtons.getElementsByTagName('button')[day-1].classList.add('bg-primary', 'text-white');

    document.getElementById('days_info_heading').textContent = `Day ${currentDay} Information`;

    // UpdateFormFields function is used to inject data in the form fields which are day_title and day_detail
    updateFormFields();

    // UpdateButtons function is used to update the back and next buttons state ie. disabled or not
    updateButtons();
};

// Update form fields with current day's data
const updateFormFields = () => {
    // dayTitleInput and dayDetailTextarea are input, textarea elements respectively and daysInformation is an array of objects
    dayTitleInput.value = daysInformation[currentDay - 1]?.title || "";

    $('#day_detail').summernote({
        placeholder: '',
        tabsize: 2,
        height: 500
    });

     // dayDetailTextarea.value = daysInformation[currentDay - 1]?.detail || "";
    $('#day_detail').summernote('code', (daysInformation[currentDay - 1]?.detail || ""));

};

// Update back and next buttons state
const updateButtons = () => {
    // backButton and nextButton are button elements
    // durationSelect is a select element whose values are like this 2D/1N, 3D/2N, .... 22D/21N
    backButton.disabled = currentDay === 1;
    nextButton.disabled = currentDay > parseInt(durationSelect.value);
};

// Save current day's data
const saveCurrentDayData = () => {
    daysInformation[currentDay - 1].title = dayTitleInput?.value || "";
    daysInformation[currentDay - 1].detail = dayDetailTextarea?.value || "";
};

// Event listener for duration change
durationSelect.addEventListener('change', () => {
    const duration = parseInt(durationSelect.value);
    initializeDaysInformation(duration);

    // updateNavigationButtons function is used to update the navigation buttons based on the duration ie. if duration is 4D/3N then 4 buttons will be created
    updateNavigationButtons(duration);
    navigateToDay(1);
});

// Event listener for back button
backButton.addEventListener('click', () => {
    saveCurrentDayData();
    navigateToDay(currentDay - 1);
});

// Event listener for next button
nextButton.addEventListener('click', () => {
    if (!dayTitleInput.value || !dayDetailTextarea.value) {
        alert('Please fill in the title and detail for the current day.');
        return;
    }

    // saveCurrentDayData function is used to modify the property of the object in the daysInformation array
    saveCurrentDayData();
    navigateToDay(currentDay + 1);
});

// Initialize with default duration (2D/1N)
initializeDaysInformation(2);
updateNavigationButtons(2);
navigateToDay(1);

// day information whole logic ends here





// Function to transform slug
document.getElementById('slug').addEventListener('input', function() {
    const slugInput = this.value;
    const slugPreview = document.getElementById('slugPreview');
    const transformedSlug = slugInput
        .toLowerCase()
        .replace(/\s+/g, '-') // Replace spaces with -
        .replace(/[^a-z0-9-_]/g, ''); // Remove special characters except underscores and hyphens
    slugPreview.textContent = `Slug: ${transformedSlug}`;
    this.value = transformedSlug; // Update the input value
});





// Form submission handling
document.getElementById('createItineraryForm').addEventListener('submit', async function(event) {


    console.log("Form submitted, create.js");

    event.preventDefault(); // Prevent default form submission


     // Check if previous days are filled
     for (let i = 0; i < parseInt(durationSelect.value); i++) {
        // daysInformation is an array of objects
        if (!daysInformation[i].title.trim() || !daysInformation[i].detail.trim()){
            alert(`Please fill in the information for Day ${i+1} first.`);
            return;
        }
    }


      // Collect selected interests
      document.querySelectorAll('input[name="itinerary_theme[]"]:checked').forEach(checkbox => {
        itineraryTheme.push(checkbox.value);
    });


    if(itineraryTheme.length == 0){
        alert("Please select at least one itinerary theme.");
        return;
    }



    // collect selected status flags
    document.querySelectorAll('input[name="status_flags[]"]:checked').forEach(checkbox => {
        statusFlags.push(checkbox.value);
    });



    let formData = new FormData();

    // Append simple input fields

    formData.append("title", document.getElementById("title").value);
    formData.append("slug", document.getElementById("slug").value);
    formData.append("domestic_or_international", document.getElementById("domestic_or_international").value);
    formData.append("duration", document.getElementById("duration").value);
    formData.append("destination_detail", document.getElementById("destination_detail").value);
    formData.append("inclusion", document.getElementById("inclusion").value);

    if(document.getElementById("additional_inclusion")){
    formData.append("additional_inclusion", document.getElementById("additional_inclusion").value);
    }

    formData.append("exclusion", document.getElementById("exclusion").value);

    formData.append("tour_highlight", document.getElementById("tour_highlight").value);

    formData.append("terms_and_conditions", document.getElementById("terms_and_conditions").value);

    if(document.getElementById("specialNotePlaceholder").innerHTML){
     formData.append("special_note", document.getElementById("specialNotePlaceholder").innerHTML);
    }

    if(document.getElementById("cancellationPolicyText")){
    if(document.getElementById("cancellationPolicyText").innerHTML){
        formData.append("cancellation_policy", document.getElementById("cancellationPolicyText").innerHTML);
    }
    }

    if(document.getElementById("paymentModeText")){
     if(document.getElementById("paymentModeText").innerHTML){
        formData.append("payment_mode", document.getElementById("paymentModeSelect").value);
     }   
    }
    

    if(document.getElementById("quotationCheckbox").checked){
        formData.append("pricing", document.getElementById("quotationCheckbox").value);
    }
    else{
        formData.append("pricing", document.getElementById("pricing").value);
    }

    
    formData.append("itinerary_visibility", document.getElementById("itinerary_visibility").value);
    formData.append("itinerary_type", document.getElementById("itinerary_type").value);
    formData.append("selected_destination", document.getElementById("selected_destination").value);


    // Add interests to form data
    formData.append('itinerary_theme_string', JSON.stringify(itineraryTheme));
    
    formData.append('status_flags_string', JSON.stringify(statusFlags));

    // Append meta information
    if(document.getElementById("meta_title").value){
        formData.append("meta_title", document.getElementById("meta_title").value);
    }

    if(document.getElementById("keyword").value){
        formData.append("keyword", document.getElementById("keyword").value);
    }

    if(document.getElementById("meta_description").value){
        formData.append("meta_description", document.getElementById("meta_description").value);
    }
  
   
   

    // Append files (single file)
    let thumbnail = document.getElementById("destination_thumbnail_file").files[0];
    if (thumbnail) {
        formData.append("destination_thumbnail_file", thumbnail);
    }

    // Append multiple files
    let images = document.getElementById("destination_images_files").files;
    for (let i = 0; i < images.length; i++) {
        formData.append("destination_images_files[]", images[i]);
    }



    // Save current day's data before submission
    saveCurrentDayData();

    // Create a new FormData instance

    // Append days information as an array of objects
    formData.append('days_information_string', JSON.stringify(daysInformation));

    // Append hotel details as an array of objects (if any)


    if(document.getElementById("hotelRequirementsCheckbox").checked){
    const hotelDetailFromCheckbox = ['According to your requirements'];
    formData.append('hotel_details_string', JSON.stringify(hotelDetailFromCheckbox));
    }
    else{

        const hotelDetails = [
            {
                hotel_type: 'Super Delux',
                room_type: document.getElementById('room_type_1').value,
                price: document.getElementById('price_1').value,
                discount: document.getElementById('discount_1').value
            },
            {
                hotel_type: 'Delux',
                room_type: document.getElementById('room_type_2').value,
                price: document.getElementById('price_2').value,
                discount: document.getElementById('discount_2').value
            },
            {
                hotel_type: 'Standard',
                room_type: document.getElementById('room_type_3').value,
                price: document.getElementById('price_3').value,
                discount: document.getElementById('discount_3').value
            }
        ];

        formData.append('hotel_details_string', JSON.stringify(hotelDetails));
    }


    

    // Send the form data using Fetch API
    try {

        document.getElementById("itinerary_create_button").disabled = true;
        document.getElementById("itinerary_create_button").textContent = "Creating Itinerary...";
        document.getElementById("itinerary_create_button").classList.remove("btn-primary");
        document.getElementById("itinerary_create_button").classList.add("bg-danger");
        document.getElementById("itinerary_create_button").classList.add("text-white");

        let csrfToken = document.querySelector('meta[name="csrf-token"]').getAttribute('content');

        const response = await fetch("/itinerary", {
            method: 'POST',
            headers: {
                "Accept": "application/json",
                "X-CSRF-TOKEN": csrfToken
            },
            body: formData
        });
    
        const data = await response.json();

        document.getElementById("itinerary_create_button").disabled = false;
        document.getElementById("itinerary_create_button").textContent = "Create Itinerary";
        document.getElementById("itinerary_create_button").classList.remove("bg-danger");
        document.getElementById("itinerary_create_button").classList.add("btn-primary");
    
        if (!response.ok) { // 👈 Handle validation errors here
            console.log("Validation Errors:", data);
        
            if (data.errors) {
                // Loop through errors and inject into respective p tags
                Object.keys(data.errors).forEach(field => {
                    const errorElement = document.getElementById(field + "Err");
                    if (errorElement) {
                        errorElement.textContent = data.errors[field][0]; // Set only the first error message
                    }

                    if(field.includes("destination_images_files.")){
                       document.getElementById("destination_images_filesErr").textContent = data.errors[field][0];
                    }

                });
            }


          
        
            alert("Validation failed: " + JSON.stringify(data.errors));
            return; // Exit the function
        }


        window.location.href = "/itinerary";


        console.log('Success:', data);
        alert('Itinerary created successfully!');
    
    } catch (error) {

        document.getElementById("itinerary_create_button").disabled = false;
        document.getElementById("itinerary_create_button").textContent = "Create Itinerary";
        document.getElementById("itinerary_create_button").classList.remove("bg-danger");
        document.getElementById("itinerary_create_button").classList.add("btn-primary");

        console.error('Network error:', error);
        alert('Failed to create itinerary.');
    }
});





document.addEventListener("DOMContentLoaded", function () {
    // Function to add or remove the price field based on checkbox state
    function togglePriceField() {
        const checkbox = document.getElementById("quotationCheckbox");
        const priceFieldContainer = document.getElementById("priceFieldContainer");

        if (!checkbox.checked) {
            // Add the price field if checkbox is unchecked
            priceFieldContainer.innerHTML = `
                <div class="form-group">
                    <label for="pricing">Pricing</label>
                    <input type="number" class="form-control" id="pricing" name="pricing" required>
                    <p id="pricingErr" class="text-danger small"></p>
                </div>
            `;
        } else {
            // Remove the price field if checkbox is checked
            priceFieldContainer.innerHTML = "";
        }
    }

    // Initial call to set the price field based on default checkbox state
    togglePriceField();

    // Bind the function to the checkbox change event
    document.getElementById("quotationCheckbox").addEventListener("change", togglePriceField);


    // Hotel Details HTML Template
    const hotelDetailsHTML = `
    <div class="row">
        <div class="col-md-12">
            <h3>Hotel Details</h3>
            <div id="hotel_details_container">
                <!-- Hotel details fields -->
                <div class="form-group">
                    <label for="hotel_type_1">Hotel Type</label>
                    <input type="text" class="form-control" id="hotel_type_1" name="hotel_details[0][hotel_type]" value="Super Delux" readonly>
                    <label for="room_type_1">Room Type</label>
                    <input type="text" class="form-control" id="room_type_1" name="hotel_details[0][room_type]" required>
                    <label for="price_1">Price</label>
                    <input type="text" class="form-control" id="price_1" name="hotel_details[0][price]" required>
                    <label for="discount_1">Discount</label>
                    <input type="number" class="form-control" id="discount_1" name="hotel_details[0][discount]" required>
                </div>
                <div class="form-group">
                    <label for="hotel_type_2">Hotel Type</label>
                    <input type="text" class="form-control" id="hotel_type_2" name="hotel_details[1][hotel_type]" value="Delux" readonly>
                    <label for="room_type_2">Room Type</label>
                    <input type="text" class="form-control" id="room_type_2" name="hotel_details[1][room_type]" required>
                    <label for="price_2">Price</label>
                    <input type="text" class="form-control" id="price_2" name="hotel_details[1][price]" required>
                    <label for="discount_2">Discount</label>
                    <input type="number" class="form-control" id="discount_2" name="hotel_details[1][discount]" required>
                </div>
                <div class="form-group">
                    <label for="hotel_type_3">Hotel Type</label>
                    <input type="text" class="form-control" id="hotel_type_3" name="hotel_details[2][hotel_type]" value="Standard" readonly>
                    <label for="room_type_3">Room Type</label>
                    <input type="text" class="form-control" id="room_type_3" name="hotel_details[2][room_type]" required>
                    <label for="price_3">Price</label>
                    <input type="text" class="form-control" id="price_3" name="hotel_details[2][price]" required>
                    <label for="discount_3">Discount</label>
                    <input type="number" class="form-control" id="discount_3" name="hotel_details[2][discount]" required>
                </div>
                <p id="hotel_details_stringErr" class="text-danger small"></p>
            </div>
        </div>
    </div>
`;

    // Function to toggle Hotel Details
    function toggleHotelDetails() {
        const checkbox = document.getElementById("hotelRequirementsCheckbox");
        const placeholder = document.getElementById("hotelDetailsPlaceholder");

        if (!checkbox.checked) {
            // Inject Hotel Details if checkbox is unchecked
            placeholder.innerHTML = hotelDetailsHTML;
        } else {
            // Remove Hotel Details if checkbox is checked
            placeholder.innerHTML = "";
        }
    }

    // Initial call to set the Hotel Details based on default checkbox state
    toggleHotelDetails();

    // Bind the function to the checkbox change event
    document.getElementById("hotelRequirementsCheckbox").addEventListener("change", toggleHotelDetails);


    let dBTermsAndConditions = document.getElementById("_json_strings").dataset.terms_and_conditions;

    function termsAndConditionsEditorHandler(e) {
        let parsedDbTermsAndConditions = JSON.parse(dBTermsAndConditions);
    
        if (parsedDbTermsAndConditions.length === 0) {
            alert("Please first create some terms and conditions");
            return;
        }
    
        let destination = parsedDbTermsAndConditions.find(obj => obj.destination === e.target.value);
    
        if (destination) {
            // Inject content asynchronously to keep UI responsive
            setTimeout(() => {
                $('#terms_and_conditions').summernote('code', destination.terms_and_conditions);
            }, 0);
        } else {
            $('#terms_and_conditions').summernote('reset');
            alert("Didn't find terms and conditions for the selected destination");
        }
    }
    
    document.getElementById("selected_destination").addEventListener("change", termsAndConditionsEditorHandler);    


// logic for additionalInclusion adding or removing summernote textarea using condition whether checkbox is checked or not
    function toggleAdditionalInclusion(){
        const checkbox = document.getElementById('additionalInclusionCheckbox');
        const placeholder = document.getElementById('additionalInclusionPlaceholder');
    
        if (checkbox.checked) {
            // Add Textarea if checkbox is checked
            placeholder.innerHTML = `
                <div class="form-group">
                    <label for="additional_inclusion">Additional Inclusion Details</label>
                    <textarea class="form-control" id="additional_inclusion" name="additional_inclusion" rows="3"></textarea>
                </div>
            `;
    
    
    
            setTimeout(()=>{
                $('#additional_inclusion').summernote({
                    placeholder: '',
                    tabsize: 2,
                    height: 300
                    });
            }, 0);
          
    
        } else {
            // Remove Textarea if checkbox is unchecked
            //  Destroy Summernote before removing the textarea
             if ($('#additional_inclusion').length) {
                $('#additional_inclusion').summernote('destroy');
            }
    
            placeholder.innerHTML = '';
        }
    }


    toggleAdditionalInclusion();

    document.getElementById('additionalInclusionCheckbox').addEventListener('change', toggleAdditionalInclusion);





    let termsAndPolicies = document.getElementById("_terms_and_policies_strings").dataset;

    // special note logic 
// Define the special_notes array
let dBSpecialNotes = termsAndPolicies.special_notes;

// Get references to the checkbox and the placeholder
const specialNoteCheckbox = document.getElementById("specialNoteCheckbox");
const specialNotePlaceholder = document.getElementById("specialNotePlaceholder");

// Add an event listener to the checkbox
specialNoteCheckbox.addEventListener("change", function() {
    if (this.checked) {
        // Get the selected destination
        const selectedDestination = document.getElementById("selected_destination").value;

        let parsedDbSpecialNotes = JSON.parse(dBSpecialNotes);

        const matchingNote = parsedDbSpecialNotes.find(note => note.destination === selectedDestination);

        if (matchingNote) {
            // Inject the note into the placeholder
            specialNotePlaceholder.innerHTML = matchingNote.special_note;
        } else {
            // If no matching note is found, show an alert
            this.checked = false;
            alert("No special note found for the selected destination.");
            specialNotePlaceholder.innerHTML = ""; // Clear the placeholder
        }
    } else {
        // If the checkbox is unchecked, clear the placeholder
        specialNotePlaceholder.innerHTML = "";
    }
});

// Assuming you have a dropdown for selecting the destination
document.getElementById("selected_destination").addEventListener("change", function() {
    // If the checkbox is checked, trigger the change event to update the note
    if (specialNoteCheckbox.checked) {
        specialNoteCheckbox.dispatchEvent(new Event('change'));
    }
});


// cancellation policy logic 
// Define the cancellation_policies array
const dBcancellationPolicies = termsAndPolicies.cancellation_policies;

// Get references to the checkbox and the placeholder
const cancellationPolicyCheckbox = document.getElementById("cancellationPolicyCheckbox");
const cancellationPolicyPlaceholder = document.getElementById("cancellationPolicyPlaceholder");

// Function to truncate text to the first 20 words
function truncateTo20Words(text) {
    return text.split(" ").slice(0, 20).join(" ") + "...";
}

// Add an event listener to the checkbox
cancellationPolicyCheckbox.addEventListener("change", function () {
    if (this.checked) {

        let parsedDbCancellationPolicies = JSON.parse(dBcancellationPolicies);

        if(parsedDbCancellationPolicies.length > 0){

                    // Create a select element
        const selectElement = document.createElement("select");
        selectElement.id = "cancellationPolicySelect";
        selectElement.className = "form-control";

        // Add a default option
        const defaultOption = document.createElement("option");
        defaultOption.value = "";
        defaultOption.textContent = "Select a cancellation policy";
        selectElement.appendChild(defaultOption);

        // Populate the select element with options
       

        parsedDbCancellationPolicies.forEach((policy, index) => {
            const option = document.createElement("option");
            option.value = policy.cancellation_policy; // Use the full policy as the value
            option.innerHTML = truncateTo20Words(policy.cancellation_policy); // Show only the first 20 words
            selectElement.appendChild(option);
        });

        // Create a paragraph element to display the full policy
        const policyParagraph = document.createElement("p");
        policyParagraph.id = "cancellationPolicyText";
        policyParagraph.style.marginTop = "10px"; // Add some spacing

        // Inject the select element and paragraph into the placeholder
        cancellationPolicyPlaceholder.innerHTML = ""; // Clear any existing content
        cancellationPolicyPlaceholder.appendChild(selectElement);
        cancellationPolicyPlaceholder.appendChild(policyParagraph);

        // Add an event listener to the select element
        selectElement.addEventListener("change", function () {
            if (this.value) {
                // Update the paragraph with the selected policy's full text
                policyParagraph.innerHTML = this.value;
            } else {
                // Clear the paragraph if no policy is selected
                policyParagraph.innerHTML = "";
            }
        });


        }
        else{
            alert("Please first create some cancellation policies");
            this.checked = false;
        }

    } else {
        // If the checkbox is unchecked, clear the placeholder
        cancellationPolicyPlaceholder.innerHTML = "";
    }
});


// payment modes logic
// Define the payment_modes array (example data)

const dBpaymentModes = termsAndPolicies.payment_modes;

// Get references to the checkbox and the placeholder
const paymentModeCheckbox = document.getElementById("paymentModeCheckbox");
const paymentModePlaceholder = document.getElementById("paymentModePlaceholder");

// Add an event listener to the checkbox
paymentModeCheckbox.addEventListener("change", function () {
    if (this.checked) {
        // Create a select element

        let parsedDbpaymentModes = JSON.parse(dBpaymentModes);

        if(parsedDbpaymentModes.length > 0){
            const selectElement = document.createElement("select");
            selectElement.id = "paymentModeSelect";
            selectElement.className = "form-control";
    
            // Add a default option
            const defaultOption = document.createElement("option");
            defaultOption.value = "";
            defaultOption.textContent = "Select a payment mode";
            selectElement.appendChild(defaultOption);
    
            // Populate the select element with options
            parsedDbpaymentModes.forEach((mode, index) => {
                const option = document.createElement("option");
                option.value = mode.payment_mode; // Use the full object as the value
                option.innerHTML = mode.domestic_or_international; // Display domestic_or_international and payment_mode
                selectElement.appendChild(option);
            });
    
            // Create a paragraph element to display the full payment mode details
            const paymentModeParagraph = document.createElement("p");
            paymentModeParagraph.id = "paymentModeText";
            paymentModeParagraph.style.marginTop = "10px"; // Add some spacing
    
            // Inject the select element and paragraph into the placeholder
            paymentModePlaceholder.innerHTML = ""; // Clear any existing content
            paymentModePlaceholder.appendChild(selectElement);
            paymentModePlaceholder.appendChild(paymentModeParagraph);
    
            // Add an event listener to the select element
            selectElement.addEventListener("change", function () {
                if (this.value) {
                    // Parse the selected value (which is a JSON string)
                    const selectedMode = this.value;
                    // Update the paragraph with the full details

                    Array.from(selectElement.children).map((elem)=>{
                    if(elem.selected){
                        paymentModeParagraph.innerHTML = `
                        <div>
                        <p>Domestic Or International</p>
                        <p class="mb-2">${elem.innerText}</p>


                        <p>Payment Mode</p>
                        <p>${selectedMode}</p>
                        </div>
                        `
                    }   
                    });

                    
                } else {
                    // Clear the paragraph if no payment mode is selected
                    paymentModeParagraph.innerHTML = "";
                }
            });
        }
        else{
            alert("Please first create some payment modes");
            this.checked = false;
        }

     
    } else {
        // If the checkbox is unchecked, clear the placeholder
        paymentModePlaceholder.innerHTML = "";
    }
});

});