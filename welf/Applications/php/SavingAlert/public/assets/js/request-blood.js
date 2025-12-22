$(document).ready(function () {

    $('#saveBtn').on('click', function () {

        let form = $('#submit_form');

        $.ajax({
            url: base_url + '/request-blood/submit',
            type: 'POST',
            data: form.serialize(),
            dataType: 'json',

            beforeSend: function () {
                $('#saveBtn').prop('disabled', true).text('Submitting...');
            },

            success: function (res) {

                if (res.success) {
                    alert('Blood request submitted successfully!');
                    form.trigger('reset');
                } else {
                    alert(res.message ?? 'Something went wrong');
                }

                $('#saveBtn').prop('disabled', false).text('Submit Blood Request');
            },

            error: function () {
                alert('Server error. Please try again.');
                $('#saveBtn').prop('disabled', false).text('Submit Blood Request');
            }
        });

    });

});
