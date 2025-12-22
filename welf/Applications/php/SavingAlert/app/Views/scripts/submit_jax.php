<script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script src="<?php echo base_url(); ?>/assets/js/progressbar.js"></script>
<script src="<?php echo base_url(); ?>/assets/js/wow.min.js"></script>
<script src="<?php echo base_url(); ?>/assets/js/dashboard-script.js"></script>

<script>
$(document).on("click", "#saveBtn", function () {
    let $btn = $(this);
    $btn.prop("disabled", true);

    let my_form = document.getElementById('submit_form');
    let form_data = new FormData(my_form);

    // Handle optional file
    let fileInput = document.getElementById('imageUpload');
    let property = fileInput?.files[0];

    if (property) {
        let allowedExtensions = ['jpg', 'jpeg', 'png', 'gif'];
        let extension = property.name.split('.').pop().toLowerCase();

        if (!allowedExtensions.includes(extension)) {
            Swal.fire('Invalid File', 'Only JPG, JPEG, PNG, GIF files are allowed.', 'error');
            $btn.prop("disabled", false);
            return;
        }

        form_data.append("file", property);
        form_data.append("donation_have", true);
    } else {
        form_data.append("donation_have", false);
    }

    $.ajax({
        url: '<?php echo base_url();?>/SubmitDonation/submit_donation',
        type: 'POST',
        data: form_data,
        cache: false,
        contentType: false,
        processData: false,
        success: function (data) {
            let bdata;
            try {
                bdata = JSON.parse(data);
            } catch (e) {
                console.error('Invalid JSON:', e, data);
                Swal.fire('Error', 'Server returned an invalid response.', 'error');
                $btn.prop("disabled", false);
                return;
            }

            if (bdata.success) {
                Swal.fire('Done!', 'Thank you for your donation!', 'success').then(() => {
                    my_form.reset(); // reset form
                    $btn.prop("disabled", false);
                });
            } else {
                Swal.fire('Oops...', 'Mandatory fields are missing!', 'error').then(() => {
                    $btn.prop("disabled", false);
                });

                // Highlight missing fields
                ['dondescription', 'dontitile', 'main_area', 'sub_area'].forEach(field => {
                    if (!bdata[field]) {
                        $("#" + field).css('border', '1px solid red');
                    } else {
                        $("#" + field).css('border', ''); // reset if exists
                    }
                });
            }
        },
        error: function (xhr, status, error) {
            console.error('AJAX Error:', error);
            Swal.fire('Error', 'Something went wrong. Please try again.', 'error');
            $btn.prop("disabled", false);
        }
    });
});
</script>
