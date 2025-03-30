document.addEventListener("DOMContentLoaded", function(){

    $('#blog_content').summernote({
        placeholder: '',
        tabsize: 2,
        height: 400
        });


        // if(destination){
        //     setTimeout(() => {
        //         $('#terms_and_conditions').summernote('code', destination.terms_and_conditions);
        //     }, 0);
        // }
        // else{
        //     $('#terms_and_conditions').summernote('reset');
        //     alert("Didn't find terms and conditions for the selected destination");
        // }

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