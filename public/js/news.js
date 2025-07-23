let pairIndex = 1;

$('#add-more-contents').on('click', function () {
    let newPair = `
        <div class="content-pair mb-3 border-top pt-3" data-index="${pairIndex}">
            <div class="form-group">
                <div class="d-flex justify-content-between align-items-end mb-2">
                    <label>Content</label>
                    <button type="button" class="btn btn-danger text-white remove-pair"><i class="fa-regular fa-circle-xmark"></i></button>
                </div>
                <textarea class="form-control content-summernote" name="news[${pairIndex}][content]" rows="4"></textarea>
                <div class="invalid-feedback" data-error-for="news[${pairIndex}][content]"></div>

            </div>

            <div class="form-group">
                <label>Image</label>
                <input type="file" class="form-control" name="news[${pairIndex}][image]" required>
                <div class="invalid-feedback" data-error-for="news[${pairIndex}][image]"></div>
            </div>
        </div>
    `;
    $('#content-container').append(newPair);

    //  Initialize Summernote for the new textarea
    $('#content-container .content-summernote').last().summernote({
       height: 300,   // set editor height
            placeholder: 'Enter content here...',
            fontSizes: ['8', '9', '10', '11', '12', '14', '16', '18', '20', '22', '24', '28', '32', '36', '48', '64'],
            toolbar: [
                ['style', ['bold', 'italic', 'underline', 'clear']],
                ['font', ['strikethrough', 'superscript', 'subscript']],
                ['fontsize', ['fontsize']],
                ['para', ['ul', 'ol']],
                ['insert', ['link']],
                ['view', ['codeview']]
            ]
    });

    pairIndex++;

});

$(document).on('click', '.remove-pair', function () {
    $(this).closest('.content-pair').remove();
});

