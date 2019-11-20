$(function () {

    // get malls by place
    $('#place').change(function (evt) {
        evt.preventDefault();

        _getMallsList($('#place').val());
    });

    // add slot
    $('#btnAddSlot').click(function (evt) {
        evt.preventDefault();

        $.ajax({
            url: $('#formAddSlot').attr('action'),
            type: $('#formAddSlot').attr('method'),
            dataType: 'json',
            data: $('#formAddSlot').serialize(),
            success: function (data, textStatus, jqXHR) {
                console.log(data);

                if (data.sucess) {
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

function _getMallsList(placeId) {
    if (placeId) {
        $.ajax({
            url: "actions.php",
            type: 'GET',
            dataType: 'json',
            data: {
                command: 'getMalls',
                placeId: placeId
            },
            success: function (data, textStatus, jqXHR) {
                console.log(data);

                if (data.success) {

                    var mallsList = data.data;

                    $('#mall').empty();
                    $('#mall').append('<option value="-1">-- Select Place --</option>');

                    $.each(mallsList, function (index, value) {
                        $('#mall').append('<option value="' + value.mall_rid + '">' + value.mall_name + '</option>');
                    });

                } else {
                    alert(data.data);
                }
            },
            error: function (jqXHR, textStatus, errorThrown) {
                alert(errorThrown);
            }
        });
    }
}