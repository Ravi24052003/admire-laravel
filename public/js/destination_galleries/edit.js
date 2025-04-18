
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

    
    
});