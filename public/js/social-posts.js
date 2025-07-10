$(document).ready(function () {
    $('.social-post-like-icon').on('click', function () {
        var likeIcon = $(this);
        var socialPostId = $(this).data('social-post-id');
        // console.log(socialPostId);
        var url = $(this).data('like-url');

        $.ajax({
            url: url,
            type: 'POST',
            data: {
                _token: $('meta[name="csrf-token"]').attr('content'),
                post_id: socialPostId
            },
            success: function (response) {

                if (response.liked) {
                    likeIcon.removeClass('fa-regular').addClass('fa-solid');
                    $('#like-count-' + socialPostId).text(response.like_count);
                } else {
                    likeIcon.removeClass('fa-solid').addClass('fa-regular');
                    $('#like-count-' + socialPostId).text(response.like_count);

                }
            },
            error: function (xhr) {
                console.error('Error liking post:', xhr);
            }
        });


    });

    $('.comment-store').on('submit', function (e) {
        e.preventDefault();
        var form = $(this);
        var url = form.attr('action');
        var commentContent = form.find('textarea[name="comment"]').val();

        $.ajax({
            url: url,
            type: 'POST',
            data: {
                _token: $('meta[name="csrf-token"]').attr('content'),
                content: commentContent
            },
            success: function (response) {

                // Optionally, you can clear the textarea after submission
                form.find('textarea[name="comment"]').val('');
                $('#comments-body').html('');

                // Display comments from response.comments
                if (response.comments) {

                    response.comments.forEach(comment => {
                        const li = document.createElement('li');
                        li.className = 'mb-4 border-bottom pb-2';

                        // const timeAgo = timeSince(new Date(comment.created_at));

                        li.innerHTML = `
                            <div class="d-flex align-items-center mb-1">
                                <img src="/src/assets/images/default-user-image.svg" width="24px" alt="" class="me-2">
                                <strong>${comment.user.name}</strong>
                            </div>
                            <div>${comment.content}</div>
                        `;

                        $('#comments-body').append(li);
                    });

                    $('.comments-count').text(response.comments.length);







                    // $('#comments-body').html(commentsHtml);
                    // Assuming you have a container to display comments
                    // form.closest('.social-post').find('.comments-list').html(commentsHtml);
                }
            },
            error: function (xhr) {
                console.error('Error submitting comment:', xhr);
            }
        });

    });

});
