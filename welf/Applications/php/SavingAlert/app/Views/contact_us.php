<?php helper('form'); ?>
<section class="our-contact pb0 bgc-f7">
    <div class="container">
        <div class="row">
            <!-- Contact Form -->
            <div class="col-lg-7 col-xl-8">
                <div class="form_grid">
                    <h4 class="mb-4">Send Us An Email</h4>
                    <form id="contact_form_1" name="contact_form" novalidate="novalidate">
                        <?= csrf_field() ?> <!-- CSRF Token -->
                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <input id="form_name" name="form_name" class="form-control" type="text" placeholder="Name" required>
                            </div>
                            <div class="col-md-6 mb-3">
                                <input id="form_email" name="form_email" class="form-control" type="email" placeholder="Email" required>
                            </div>
                            <div class="col-md-6 mb-3">
                                <input id="form_phone" name="form_phone" class="form-control" type="text" placeholder="Phone" required>
                            </div>
                            <div class="col-md-6 mb-3">
                                <input id="form_subject" name="form_subject" class="form-control" type="text" placeholder="Subject" required>
                            </div>
                            <div class="col-12 mb-3">
                                <textarea id="form_message" name="form_message" class="form-control" rows="6" placeholder="Your Message" required></textarea>
                            </div>
                            <div class="col-12">
                                <button type="button" class="btn btn-lg btn-thm" id="btn_send_mes">Send Message</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>

            <!-- Contact Info -->
            <div class="col-lg-5 col-xl-4">
                <div class="contact_localtion">
                    <h4>Contact Us</h4>
                    <div class="content_list mb-3">
                        <h5>Phone</h5>
                        <p>775731785</p>
                    </div>
                    <h5>Follow Us</h5>
                    <ul class="contact_form_social_area list-inline">
                        <li class="list-inline-item"><a href="https://www.facebook.com/"><i class="fa fa-facebook"></i></a></li>
                        <!-- Add other social links if needed -->
                    </ul>
                </div>
            </div>
        </div>
    </div>

    <!-- Map -->
    <div class="container-fluid p-0 mt-5">
        <div class="row">
            <div class="col-12">
                <div class="h-600" id="map-canvas"></div>
            </div>
        </div>
    </div>
</section>

<!-- SweetAlert & AJAX Script -->
<script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script>
$(document).ready(function() {
    $("#btn_send_mes").on("click", function() {
        let btn = $(this);
        btn.prop("disabled", true);

        let formData = {
            form_name: $("#form_name").val(),
            form_email: $("#form_email").val(),
            form_phone: $("#form_phone").val(),
            form_subject: $("#form_subject").val(),
            form_message: $("#form_message").val(),
            <?= csrf_token() ?>: '<?= csrf_hash() ?>' // Include CSRF token
        };

        // Simple validation
        for (const key in formData) {
            if (!formData[key]) {
                Swal.fire({
                    icon: 'error',
                    title: 'Oops...',
                    text: 'Please fill all fields!'
                });
                btn.prop("disabled", false);
                return;
            }
        }

        $.ajax({
            url: '<?= site_url("contact/contact_xyz") ?>',
            type: 'POST',
            data: formData,
            dataType: 'json',
            success: function(res) {
                if (res.success) {
                    Swal.fire('Done!', 'Your message has been sent!', 'success').then(() => {
                        $("#contact_form_1")[0].reset();
                        btn.prop("disabled", false);
                    });
                } else {
                    Swal.fire({
                        icon: 'error',
                        title: 'Oops...',
                        text: res.message || 'Failed to send message'
                    }).then(() => btn.prop("disabled", false));
                }
            },
            error: function(xhr, status, error) {
                Swal.fire({
                    icon: 'error',
                    title: 'Server Error',
                    text: 'Please try again later.'
                }).then(() => btn.prop("disabled", false));
            }
        });
    });
});
</script>
