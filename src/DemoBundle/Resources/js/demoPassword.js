$(document).ready(function () {
    $('.check-button').click(function () {
        var password = $('#demo_passwords_pass').val();
        $.ajax({
            data: {password: password},
            type: 'POST',
            url: "/check_password",
            statusCode: {
                500: function () {
                    //todo
                },
                403: function () {
                    //todo
                }
            },
            success: function (data) {
                var number = data.number;
                alert(number);
            }
        });
    })
});