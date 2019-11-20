$(function () {

    // user registration
    $('#btnRegister').click(function (evt) {
        evt.preventDefault();

        var name = $('#name').val();
        var contactno = $('#contactno').val();
        var email = $('#email').val();
        var address = $('#address').val();
        var username = $('#username').val();
        var password = $('#password').val();

        if (name === "") {
            alert("Please enter name");
            return false;
        }

        if (contactno === "" || contactno.length !== 10 || isNaN(contactno)) {
            alert("Please valid 10 digits contact number");
            return false;
        }

        if (email === "") {
            alert("Please enter email");
            return false;
        }

        if (address === "") {
            alert("Please enter address");
            return false;
        }

        if (username === "") {
            alert("Please enter user name");
            return false;
        }

        if (password === "") {
            alert("Please enter password");
            return false;
        }

        $.ajax({
            url: $('#formRegistration').attr('action'),
            type: $('#formRegistration').attr('method'),
            dataType: 'json',
            data: $('#formRegistration').serialize(),
            success: function (data, textStatus, jqXHR) {
                console.log(data);

                if (data.success) {
                    alert(data.data);
                    location.href = '../index.php';
                } else {
                    alert(data.data);
                }

            },
            error: function (jqXHR, textStatus, errorThrown) {
                alert(errorThrown);
            }
        });
    });

});