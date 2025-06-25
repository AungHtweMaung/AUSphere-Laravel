


$(document).ready(function () {
    // for select2
    $('select').select2();

    // flatpickr date time
    $(".date-picker").flatpickr({
        allowInput: true,
    });

    $('.time-picker').flatpickr({
        enableTime: true,
        noCalendar: true,
        dateFormat: "h:i K",
        allowInput: true,
    });





    // store, update form submit
    $('.form-submit').submit(function (e) {
        e.preventDefault();

        let form = $(this);
        let actionUrl = form.attr('action');
        let formData = new FormData(this);  // send as Form Data
        // Remove previous error states
        form.find('.invalid-feedback').html('');
        form.find('input, select, textarea').removeClass('is-invalid');

        $.ajax({
            url: actionUrl,
            type: 'POST',
            data: formData,
            // Prevent jQuery from automatically converting data into a query string.
            processData: false, // don't process data by jquery and send as FormData
            contentType: false, // choose correct content type by browser
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') // Laravel CSRF support
            },
            beforeSend: function() {
                $('.loader-container').show();
            },
            complete: function() {
                $('.loader-container').hide();
            },
            success: function (response) {
                $('#content').summernote('reset'); // reset to initial content
                form[0].reset();

                Swal.fire({
                    title: 'Success',
                    text: response.success,
                    icon: 'success',
                    confirmButtonText: 'OK',
                    allowOutsideClick: false, // optional: prevent closing by clicking outside
                    allowEscapeKey: false
                }).then((result) => {
                    if (result.isConfirmed) {
                        // Reset Summernote content if present in the form
                        if (response.redirectUrl) {
                            window.location.href = response.redirectUrl;
                        }
                    }
                });
            },
            error: function (xhr) {
                if (xhr.status === 422) {
                    let errors = xhr.responseJSON.errors;
                    // console.log(errors);
                    $.each(errors, function (field, messages) {
                        let errorField = form.find('[name="' + field + '"]');
                        errorField.addClass('is-invalid');
                        form.find('[data-error-for="' + field + '"]').html(messages[0]);
                    });

                } else {
                    Swal.fire({
                        title: 'Error',
                        text: 'Oops! Something went wrong.',
                        icon: 'error',
                        confirmButtonText: 'OK'
                    });
                }
            }
        });

    });



    $('.delete-data').on('click', function (e) {
        e.preventDefault();
        Swal.fire({
            title: "Are you sure to delete?",
            confirmButtonColor: '#3085d6',
            icon: 'info',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Yes',
            showCancelButton: true,
            reverseButtons: true,

        }).then((result) => {
            if (result.isConfirmed) {
                $.ajaxSetup({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    }
                });
                $.ajax({
                    method: 'DELETE',
                    url: $(this).attr('data-href'),
                    beforeSend: function() {
                        $('.loader-container').show();
                    },
                    complete: function() {
                        $('.loader-container').hide();
                    },
                    success: function(response) {

                        if (response.success) {
                            Swal.fire({
                                title: 'Success',
                                text: response.success,
                                icon: 'success',
                                confirmButtonText: 'OK',
                                allowOutsideClick: false,
                                allowEscapeKey: false
                            }).then((result) => {
                                if (result.isConfirmed) {
                                    window.location.reload();
                                }
                            });
                        }
                        if (response.error) {
                            Swal.fire({
                                title: 'Error',
                                text: response.error,
                                icon: 'error',
                                confirmButtonText: 'OK',
                                allowOutsideClick: false,
                                allowEscapeKey: false
                            }).then((result) => {
                                if (result.isConfirmed) {
                                    window.location.reload();
                                }
                            });
                        }
                    },
                    error: function(xhr, status, error) {
                        Swal.fire({
                            title: 'Error',
                            text: 'Something went wrong!',
                            icon: 'error',
                            confirmButtonText: 'OK'
                        });
                    }
                });   }
        });
    });

    $('#content').summernote({
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
});
