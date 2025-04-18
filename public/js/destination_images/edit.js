
document.addEventListener('DOMContentLoaded', function(){

    document.querySelectorAll('.remove-img-btn').forEach(button => {
        button.addEventListener('click', function(e){


            let imgSrcToBeRemoved = e.target.getAttribute("data-image_path");
    
            const imageContainer = e.target.closest('.image-container');
    
            // Hide the image container
            imageContainer.style.display = 'none';
    
            // Add the image path to the hidden input
            const removedImagesInput = document.getElementById('removed_images');

            let removedImages = removedImagesInput.value ? JSON.parse(removedImagesInput.value) : [];

            removedImages.push(imgSrcToBeRemoved);

            removedImagesInput.value = JSON.stringify(removedImages);
        });
    });


    const selectedImagesInput = document.getElementById('public_images');
    let selectedImages = selectedImagesInput.value ? JSON.parse(selectedImagesInput.value) : [];

    document.querySelectorAll('.public-img-checkbox').forEach(checkbox => {
        checkbox.addEventListener('change', function(e) {
            console.log("edit.js public_images", e.target, "data image path", e.target.getAttribute('data-image_path'));
            const imagePath = e.target.getAttribute('data-image_path');

            if (e.target.checked) {
                selectedImages.push(imagePath);
                console.log("imagePath inside checked", imagePath, "selectedImages",selectedImages);
            } else {
                selectedImages = selectedImages.filter(path => path !== imagePath);
                console.log("imagePath inside unchecked",imagePath, "selectedImages", selectedImages);
            }

            selectedImagesInput.value = JSON.stringify(selectedImages);

            console.log("selectedImagesInput", selectedImagesInput.value);
        });
    });








    // destination type whole logic starts here 
         // Array to hold selected values
let dBDestinationType = document.getElementById("_destination").dataset.destination_type;

console.log("DbDestinationType", JSON.parse(dBDestinationType));



  const destinationTypeValues = JSON.parse(dBDestinationType);
  
  // Get all checkboxes
  const checkboxes = document.querySelectorAll('.checkbox-group input[type="checkbox"]');
  
  // Get the hidden input field
  const destinationType = document.getElementById('destination_type');
  
  // Function to update the hidden field
  function updateHiddenField() {
    destinationType.value = JSON.stringify(destinationTypeValues);
    console.log('Updated hidden field:', destinationType.value);
  }
  
  // Add event listeners to all checkboxes
  checkboxes.forEach(checkbox => {
    checkbox.addEventListener('change', function() {
      const value = this.value;
      
      let domesticOrInternationalValue = document.getElementById("domestic_or_international").value;
      
      if(!domesticOrInternationalValue){
       this.checked = false;
       alert("Please first select domestic or international");
       return;
      }

      if(this.value == "domestic"){
        if(domesticOrInternationalValue == "international"){
            this.checked = false;

            alert("You can't select domestic");

            return;
        }
      }


      if(this.value == "international"){
        if(domesticOrInternationalValue == "domestic"){
           this.checked = false;
            
            alert("You can't select international");

            return;
        }
      }

      if (this.checked) {
        // Add to array if not already present
        if (!destinationTypeValues.includes(value)) {
          destinationTypeValues.push(value);
        }
      } else {
        // Remove from array
        const index = destinationTypeValues.indexOf(value);
        if (index > -1) {
          destinationTypeValues.splice(index, 1);
        }
      }
      
      updateHiddenField();
    });
  });

    // destination type whole logic ends here


});