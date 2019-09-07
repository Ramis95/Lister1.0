$(document).ready(function() {

    $('form').submit(function(event) {
        if ($(this).attr('type') == 'no_ajax') {
            return;
        }
        var json;
        event.preventDefault();
        $.ajax({
            type: $(this).attr('method'),
            url: $(this).attr('action'),
            data: new FormData(this),
            contentType: false,
            cache: false,
            processData: false,
            success: function(result) {
                json = jQuery.parseJSON(result);
                if (json.url) {
                    window.location.href = '/' + json.url;
                } else {
                    alert(json.status + ' - ' + json.message);
                }
            },
        });
    });

    $('.log_out').on('click', function () {

        $.ajax({
            type: 'POST',
            url: '/account/logout',
            data: {'action':'logout'},
            success: function (result) {

                json = jQuery.parseJSON(result);

                if (json.url) {
                    window.location.href = json.url;
                } else {
                    alert(json.status + ' - ' + json.message);
                }
            }
        });

    });

});