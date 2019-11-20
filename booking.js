$(function () {

    // get slot list
    $('#mall').change(function (evt) {
        evt.preventDefault();

        getSlotList();
    });

    // check slots
    $('#btnCheckSlot').click(function (evt) {
        evt.preventDefault();

        checkSlot();
    });

    // book slots
    $('#btnBookslot').click(function (evt) {
        evt.preventDefault();

        bookSlot();
    });

});

function getSlotList() {
    $.ajax({
        url: $('#formBookSlot').attr('action'),
        type: 'GET',
        dataType: 'json',
        data: {
            command: 'getSlots',
            mall: $('#mall').val(),
            slot: $('#slot').val()
        },
        success: function (data, textStatus, jqXHR) {
            console.log(data);

            if (data.success) {

                var slotsList = data.data;

                $('#slot').empty();
                $('#slot').append('<option value="-1">-- Select Slot --</option>');

                $.each(slotsList, function (index, value) {
                    $('#slot').append('<option value="' + value.slot_rid + '">' + value.slot_name + '</option>');
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

function checkSlot() {

    var date = $('#date').val();
    var time = $('#time').val();
    var mall = $('#mall').val();
    var slot = $('#slot').val();

    if (date === "") {
        alert("Please enter date");
        return false;
    }

    if (time === "-1") {
        alert("Please select time");
        return false;
    }

    if (mall === "-1") {
        alert("Please select mall");
        return false;
    }

    if (slot === "-1") {
        alert("Please select slot");
        return false;
    }

    $.ajax({
        url: $('#formBookSlot').attr('action'),
        type: 'GET',
        dataType: 'json',
        data: {
            command: 'checkSlot',
            date: $('#date').val(),
            time: $('#time').val(),
            mall: $('#mall').val(),
            slot: $('#slot').val()
        },
        success: function (data, textStatus, jqXHR) {
            console.log(data);

            if (data.success) {
                alert(data.data);

                $('#btnBookslot').removeClass('d-none');
                $('#btnPay').removeClass('d-none');

            } else {
                alert(data.data);
                $('#btnBookslot').addClass()('d-none');
                $('#btnPay').addClass('d-none');
            }

        },
        error: function (jqXHR, textStatus, errorThrown) {
            alert(errorThrown);
        }
    });
}

function bookSlot() {

    var date = $('#date').val();
    var time = $('#time').val();
    var mall = $('#mall').val();
    var slot = $('#slot').val();

    if (date === "") {
        alert("Please enter date");
        return false;
    }

    if (time === "-1") {
        alert("Please select time");
        return false;
    }

    if (mall === "-1") {
        alert("Please select mall");
        return false;
    }

    if (slot === "-1") {
        alert("Please select slot");
        return false;
    }

    $.ajax({
        url: $('#formBookSlot').attr('action'),
        type: $('#formBookSlot').attr('method'),
        dataType: 'json',
        data: $('#formBookSlot').serialize(),
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
}