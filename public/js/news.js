// Initialize pairIndex from existing content-pairs in DOM
let pairIndex = $('#content-container .content-pair').length;

$('#add-more-contents').on('click', function () {
    // Generate new content pair with updated pairIndex
    let newPair = `
        <div class="content-pair mb-3 border-top pt-3" data-index="${pairIndex}">
            <div class="form-group">
                <div class="d-flex justify-content-between align-items-end mb-2">
                    <label>Content</label>
                    <button type="button" class="btn btn-danger text-white remove-pair">
                        <i class="fa-regular fa-circle-xmark"></i>
                    </button>
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
    // Append new pair to the container
    $('#content-container').append(newPair);

    // Initialize Summernote for the newly added textarea
    $('#content-container .content-summernote').last().summernote({
        height: 300,   // Set editor height
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

    // Increment pairIndex for the next added pair
    pairIndex++;
});


// Handle removal of content pair
$(document).on('click', '.remove-pair', function () {
    let pair = $(this).closest('.content-pair');

    // Ensure the ID input field is removed

    // Remove the content pair element
    pair.remove();

    // Reindex the remaining content pairs
    reindexPairs();
});

function reindexPairs() {
    let pairIndex = 0;

    $('#content-container .content-pair').each(function () {
        $(this).attr('data-index', pairIndex);

        // Update name for content
        $(this).find('textarea.content-summernote')
            .attr('name', `news[${pairIndex}][content]`);

        // Update name for image
        $(this).find('input[type="file"]')
            .attr('name', `news[${pairIndex}][image]`)
            .attr('id', `image_${pairIndex}`);

        // Update error feedbacks
        $(this).find('.invalid-feedback[data-error-for]').each(function () {
            const errorFor = $(this).attr('data-error-for');
            if (errorFor.includes('[content]')) {
                $(this).attr('data-error-for', `news[${pairIndex}][content]`);
            } else if (errorFor.includes('[image]')) {
                $(this).attr('data-error-for', `news[${pairIndex}][image]`);
            }
        });

        // Update ID field name if exists
        const idField = $(this).find('input[name^="news["][name$="[id]"]');
        if (idField.length) {
            idField.attr('name', `news[${pairIndex}][id]`);
        }

        pairIndex++;
    });
}




