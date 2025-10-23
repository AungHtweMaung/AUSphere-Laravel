    $('.noti-icon').on('click', function(e) {
        e.preventDefault();
         $.ajax({
            url: '/notifications/unread',
            type: 'GET',
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') // Laravel CSRF support
            },
            success: function (response) {
                

            },
            error: function (xhr) {
                console.log('Error fetching notifications');
            }
        });

    })
