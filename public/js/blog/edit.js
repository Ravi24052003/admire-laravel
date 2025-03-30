document.addEventListener("DOMContentLoaded", function(){

    $('#blog_content').summernote({
        placeholder: '',
        tabsize: 2,
        height: 400
        });

    document.getElementById('blog_slug').addEventListener('input', function() {
        const slugInput = this.value;
        const slugPreview = document.getElementById('slugPreview');
        const transformedSlug = slugInput
            .toLowerCase()
            .replace(/\s+/g, '-') // Replace spaces with -
            .replace(/[^a-z0-9-_]/g, ''); // Remove special characters except underscores and hyphens
        slugPreview.textContent = `Slug: ${transformedSlug}`;
        this.value = transformedSlug; // Update the input value
    });



    window.copyImageUrl = function(url) {
        // Use the modern Clipboard API if available
        if (navigator.clipboard) {
            navigator.clipboard.writeText(url).then(() => {
                showFlashMessage(url);
            }).catch(err => {
                console.error('Failed to copy: ', err);
                fallbackCopy(url);
            });
        } else {
            fallbackCopy(url);
        }
    };

    function fallbackCopy(url) {
        // Fallback for older browsers
        const tempInput = document.createElement('input');
        tempInput.value = url;
        document.body.appendChild(tempInput);
        tempInput.select();
        document.execCommand('copy');
        document.body.removeChild(tempInput);
        showFlashMessage(url);
    }

    function showFlashMessage(url) {
        const flashMessage = document.getElementById('flash-message');
        const urlDisplay = document.querySelector('.copied-url');
        
        urlDisplay.innerHTML = `URL copied: <code>${url}</code>`;
        flashMessage.classList.remove('d-none');
        
        setTimeout(() => {
            flashMessage.classList.add('d-none');
        }, 3000);
    }

});