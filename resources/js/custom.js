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

    function send_log(action) {
        var data = {};
        data['_token'] = document.querySelector('meta[name="csrf-token"]').content;
        data['view'] = window.location.pathname;
        data['action'] = action;
        $.ajax({
            url: consoleRoute,
            type: 'POST',
            data: data
        });
        console.log(action);
    }

    $('input, select').on('focusout', function(e) {
        send_log(e.type+' in '+e.target.tagName+':'+e.target.name+', value is '+e.target.value);
    });

    $(document).on('click', function(e) {
        var listTags = ['A', 'BUTTON'];
        if (listTags.includes(e.target.tagName)) {
            send_log(e.type+' in '+e.target.tagName+':'+e.target.name+', value is '+e.target.outerText);
        }
    });

    function startTimer() {
        function secondsToArray(seconds) {
            var hour = Math.floor(seconds / 3600);
            hour = (hour < 10)? '0' + hour : hour;
            var minute = Math.floor((seconds / 60) % 60);
            minute = (minute < 10)? '0' + minute : minute;
            var second = seconds % 60;
            second = (second < 10)? '0' + second : second;
            return [ hour, minute, second ];
        }
        var second = 0;
        var countdownTimer = setInterval(function() {
            second += 30;
            var timeResult = secondsToArray(second);
            console.log('time-count: ' + timeResult[1] + ' minutes and ' + timeResult[2] + ' seconds');

            if (second == 180) {
                clearInterval(countdownTimer);
            }
        }  , 30000);
    }

    startTimer();
});
