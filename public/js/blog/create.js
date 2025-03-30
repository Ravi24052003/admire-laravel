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




});