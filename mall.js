$(function () {

    // add mall
    $('#btnAddSlot').click(function (evt) {
        evt.preventDefault();

        // todo: validation

        $.ajax({
            url: $('#formAddMall').attr('action'),
            type: $('#formAddMall').attr('method'),
            dataType: 'json',
            processData: false,
            contentType: false,
            data: new FormData($('#formAddMall')[0]),
            success: function (data, textStatus, jqXHR) {
                console.log(data);

                if (data.success) {
                    alert(data.data);
                    location.reload();
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