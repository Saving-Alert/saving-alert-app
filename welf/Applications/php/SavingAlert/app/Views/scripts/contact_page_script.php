<script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>

<script>
$(document).ready(function() {

    const btnSend = $("#btn_send_mes");

    btnSend.on("click", function() {
        const button = $(this);
        button.prop("disabled", true);

        // Collect form values
        const from_email   = $("#form_email").val();
        const from_phone   = $("#form_phone").val();
        const from_subject = $("#form_subject").val();
        const from_message = $("#form_message").val(); // Fixed

        // Basic validation
        if (!from_email || !from_phone || !from_subject || !from_message) {
            Swal.fire({
                icon: 'error',
                title: 'Oops...',
                text: 'Mandatory fields are missing!'
            });
            button.prop("disabled", false);
            return;
        }

        $.ajax({
            url: '<?= base_url("contact/contact_xyz") ?>',
            type: 'POST',
            data: $("#contact_form_1").serialize(),
            dataType: "json",
            cache: false,
            success: function(data) {
                if (data.success) {
                    Swal.fire(
                        'Done!',
                        'Your message has been sent!',
                        'success'
                    ).then(() => {
                        $("#contact_form_1")[0].reset();
                        button.prop("disabled", false);
                    });
                } else {
                    Swal.fire({
                        icon: 'error',
                        title: 'Oops...',
                        text: 'Something went wrong, please check all fields.'
                    }).then(() => {
                        button.prop("disabled", false);
                    });
                }
            },
            error: function() {
                Swal.fire({
                    icon: 'error',
                    title: 'Oops...',
                    text: 'Server error, please try again later.'
                }).then(() => {
                    button.prop("disabled", false);
                });
            }
        });
    });
});
</script>
