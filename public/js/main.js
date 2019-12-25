$(document).ready(function() {

    $('.selectpicker').selectpicker();

    $('.select_send_ajax').on('change', function() {
        $(this.form).submit();
    });

    $('form').submit(function(event) { //Отправка всех форм

        if ($(this).attr('type') == 'no_ajax') {
            return;
        }

        $('.errorText').remove();
        $('input').removeClass('inputError');

        var json;
        event.preventDefault();
        $.ajax({
            type: $(this).attr('method'),
            url: $(this).attr('action'),
            data: new FormData(this),
            contentType: false,
            cache: false,
            processData: false,
            success: function(result)
            {
                json = jQuery.parseJSON(result);

                if (json.url != '' || json.url == '') {//Вроде работает, если что поменять
                    window.location.href = '/' + json.url;
                } else {
                    message = json.message; //Получаем все сообщения об ошибках
                    for (key in message) //Вывод ошибок в полях
                    {
                        this_input = $('[name='+ key +']');
                        $(this_input).addClass('inputError');
                        $(this_input).after('<p class="errorText">' + message[key] +'</p>');
                    }


                    // alert(json.status + ' - ' + json.message);
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

                if (json.url != '' || json.url == '') {
                    window.location.href = '/' + json.url;
                } else {
                    alert(json.status + ' - ' + json.message);
                }
            }
        });

    });

    $('a').on('click', function ()
    {
        if ($(this).attr('data-href') == 'false')
        {
            event.preventDefault();
            var this_href;
            this_href = $(this).attr('href');
            window.location.href = this_href;

            //Возможно переделать для history
        }

    });


});