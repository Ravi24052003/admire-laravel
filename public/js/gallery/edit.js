
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
    
});