$(function () {

    // get mall list
    $('#place').change(function (evt) {
        evt.preventDefault();

        getMallList();
    });

    // save feedback
    $('#saveFeedback').click(function (evt) {
        evt.preventDefault();

        saveFeedback();
    });
});

function saveFeedback() {

    var place = $('#place').val();
    var mall = $('#mall').val();
    var feedback = $('#feedback').val();

    if (place === "-1") {
        alert("Please select place");
        return false;
    }

    if (mall === "-1") {
        alert("Please select mall");
        return false;
    }

    if (feedback === "") {
        alert("Please enter feedback");
        return false;
    }

    $.ajax({
        url: $('#formFeedback').attr('action'),
        type: $('#formFeedback').attr('method'),
        dataType: 'json',
        data: $('#formFeedback').serialize(),
        success: function (data, textStatus, jqXHR) {

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

}

function getMallList() {

    $.ajax({
        url: $('#formFeedback').attr('action'),
        type: 'GET',
        dataType: 'json',
        data: {
            command: 'getMallList',
            place: $("#place").val()
        },
        success: function (data, textStatus, jqXHR) {

            if (data.success) {

                var mallList = data.data;

                $('#mall').empty();
                $('#mall').append('<option value="-1">-- Select Mall --</option>');

                $.each(mallList, function (index, value) {
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