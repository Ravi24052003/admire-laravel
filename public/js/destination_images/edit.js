
document.addEventListener('DOMContentLoaded', function(){

    let dBDestination = document.getElementById("_destination")?.dataset?.destination;

    const optionsArray = [
        { value: "Kerala", label: "Kerala" },
        { value: "Goa", label: "Goa" },
        { value: "Delhi", label: "Delhi" },
        { value: "Rajasthan", label: "Rajasthan" },
        { value: "Ladakh", label: "Ladakh" },
        { value: "Andaman", label: "Andaman" },
        { value: "Andhra-Pradesh", label: "Andhra Pradesh" },
        { value: "Arunachal-Pradesh", label: "Arunachal Pradesh" },
        { value: "Assam", label: "Assam" },
        { value: "Bihar", label: "Bihar" },
        { value: "Chhattisgarh", label: "Chhattisgarh" },
        { value: "Gujarat", label: "Gujarat" },
        { value: "Haryana", label: "Haryana" },
        { value: "Himachal-Pradesh", label: "Himachal Pradesh" },
        { value: "Jharkhand", label: "Jharkhand" },
        { value: "Karnataka", label: "Karnataka" },
        { value: "Kashmir", label: "Kashmir" },
        { value: "Madhya-Pradesh", label: "Madhya Pradesh" },
        { value: "Maharashtra", label: "Maharashtra" },
        { value: "Manipur", label: "Manipur" },
        { value: "Meghalaya", label: "Meghalaya" },
        { value: "Mizoram", label: "Mizoram" },
        { value: "Nagaland", label: "Nagaland" },
        { value: "Odisha", label: "Odisha" },
        { value: "Punjab", label: "Punjab" },
        { value: "Sikkim", label: "Sikkim" },
        { value: "Tamil-Nadu", label: "Tamil Nadu" },
        { value: "Telangana", label: "Telangana" },
        { value: "Tripura", label: "Tripura" },
        { value: "Uttar-Pradesh", label: "Uttar Pradesh" },
        { value: "Uttarakhand", label: "Uttarakhand" },
        { value: "West-Bengal", label: "West Bengal" },
        { value: "Chandigarh", label: "Chandigarh" },
        { value: "Lakshadweep", label: "Lakshadweep" },
        { value: "Puducherry", label: "Puducherry" },
        { value: "Thailand", label: "Thailand" },
        { value: "UAE", label: "UAE" },
        { value: "Indonesia", label: "Indonesia" },
        { value: "Maldives", label: "Maldives" },
        { value: "Saudi-Arabia", label: "Saudi Arabia" },
        { value: "Malaysia", label: "Malaysia" },
        { value: "USA", label: "USA" },
        { value: "Spain", label: "Spain" },
        { value: "Israel", label: "Israel" },
        { value: "France", label: "France" },
        { value: "China", label: "China" },
        { value: "Vietnam", label: "Vietnam" },
        { value: "UK", label: "United Kingdom" },
        { value: "Tunisia", label: "Tunisia" },
        { value: "Sri-Lanka", label: "Sri Lanka" },
        { value: "Russia", label: "Russia" },
        { value: "Japan", label: "Japan" },
        { value: "Great-Britain", label: "Britain" },
        { value: "Italy", label: "Italy" },
        { value: "Estonia", label: "Estonia" },
        { value: "Australia", label: "Australia" },
        { value: "Turkey", label: "Turkey" }
    ];
    
    // Get the select element
    const selectedDestination = document.getElementById("destination");

    if(dBDestination){
        optionsArray.forEach(option => {
            const optionElement = document.createElement("option");
            optionElement.value = option.value;
            if(dBDestination==option.value){
                optionElement.selected = true;
            }
            optionElement.innerText = option.label;
            selectedDestination.appendChild(optionElement);
        });
    }
    else{
        optionsArray.forEach(option => {
            const optionElement = document.createElement("option");
            optionElement.value = option.value;
            optionElement.innerText = option.label;
            selectedDestination.appendChild(optionElement);
        });
    }


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

    
    
});