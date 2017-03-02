$(document).ready(function () {
    $(document).submit(function () {
        $('.check-button').click();
        return false;
    });

    $('.check-button').click(function () {
        var password = $('#demo_passwords_pass').val();
        if (password.length < 2) {
            return false;
        }
        $.ajax({
            data: {password: password},
            type: 'POST',
            url: "/check_password",
            statusCode: {
                500: function () {
                    alert('Something went wrong, this is 500 error')
                },
                403: function () {
                    alert('Something went wrong, this is 403 error')
                }
            },
            success: function (data) {
                var number = data.number;
                var $answerPlace = $('.server-answer');
                $answerPlace.empty();
                if (number > 0) {
                    $('<span>').addClass('text-danger').text('This password was found in list, his number ' + number).appendTo($answerPlace);
                } else {
                    $('<span>').addClass('text-success').text('Congratulations! Your password is a hard nut to crack').appendTo($answerPlace);
                }
            }
        });
    })
});