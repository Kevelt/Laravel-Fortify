$(document).ready(function(){
    $('.customform').submit(function( event ) {
        event.preventDefault();
        $('.invalid-feedback').text('');
        $('.form-message').text('');
        $('.is-invalid').removeClass('is-invalid');
        var form = $(this);
        var data = {};
        $.each(form.serializeArray(), function(i, v) {
            data[v.name] = v.value;
        });
        $.ajax({
            url: form.attr('action'),
            type: form.attr('method'),
            data: data,
            success: function(response){
                if(response) {
                    $('.form-message').text(response.message);
                    if(response.success) {
                        form[0].reset();
                    }
                }
            },
            error: function (data) {
                var response = $.parseJSON(data.responseText);
                if (response.errors) {
                    $.each(response.errors, function (key, value) {
                        $('#' + key).addClass('is-invalid').next().html("<strong>" + value.join("<br />") + "</strong>");
                    });
                    $('.form-message').text(response.message);
                } else {
                    $('.form-message').text('Error');
                }
            }
        });
    });

    $('.dataTable').DataTable();
});
