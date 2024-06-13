<link rel="stylesheet" href="<?php echo base_url(); ?>/assets/css/dashbord_navitaion.css">

<!-- Our Dashbord -->
<section class="our-dashbord dashbord bgc-f7 pb50">
    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-3 col-xl-2 dn-992 pl0">
                <div class="card">
                    <div class="card-header">
                        <a href="<?php echo base_url(); ?>/Account">Account</a>
                    </div>
                    <?php require("account_menu.php"); ?>
                </div>
            </div>

            <div class="col-lg-9 col-xl-10 maxw100flex-992">
                <div class="row">
                    <div class="col-lg-12">
                        <div class="dashboard_navigationbar dn db-992">
                            <?php require("account_mobile_menu.php"); ?>
                        </div>
                    </div>

                    <!-- Ensure the form has the onsubmit attribute -->
                    <form id="submit_form" method="post" onsubmit="return validateForm()">
                        <div class="col-lg-12">
                            <div class="my_dashboard_review">
                                <div class="row">
                                    <div class="col-lg-12">
                                        <h4 class="mb30">Profile</h4>

                                        <div class="my_profile_setting_input form-group">
                                            <label for="prof_name">Name</label>
                                            <input type="text" class="form-control" id="prof_name" name="prof_name" value="<?php echo get_user_info(front_user_id())->name ?>">
                                        </div>

                                        <div class="my_profile_setting_input form-group">
                                            <label for="prof_nic">NIC</label>
                                            <input type="text" class="form-control" id="prof_nic" name="prof_nic" value="<?php echo get_user_info(front_user_id())->nic ?>">
                                        </div>

                                        <div class="my_profile_setting_input form-group">
                                            <label for="prof_dob">Date of Birth</label>
                                            <input type="date" class="form-control" id="prof_dob" name="prof_dob" value="<?php echo get_user_info(front_user_id())->dob ?>">
                                        </div>

                                        <div class="my_profile_setting_input form-group">
                                            <label for="prof_gender">Gender</label>
                                            <select class="form-control" id="prof_gender" name="prof_gender">
                                                <?php
                                                if(get_user_info(front_user_id())->gender != "N"){
                                                    echo '<option value="'.get_user_info(front_user_id())->gender.'" selected>'.get_user_info(front_user_id())->gender.'</option>';
                                                    if(get_user_info(front_user_id())->gender == "Male"){
                                                        echo '<option value="Female">Female</option>';
                                                    }
                                                    if(get_user_info(front_user_id())->gender == "Female"){
                                                        echo '<option value="Male">Male</option>';
                                                    }
                                                } else {
                                                    echo '<option value="Male" selected>Male</option>
                                                              <option value="Female">Female</option>';
                                                }
                                                ?>
                                            </select>
                                        </div>

                                        <div class="my_profile_setting_input form-group">
                                            <label for="blood_group">Blood Group</label>
                                            <select class="form-control" id="blood_group" name="blood_group">
                                                <?php
                                                $blood_arr = array("O-", "O+", "A-", "A+", "B-", "B+", "AB-", "AB+");
                                                $diseases = get_user_info(front_user_id())->blood_type;
                                                foreach($blood_arr as $blood){
                                                    if($diseases == $blood){
                                                        echo ' <option value="'.$diseases.'" selected>'.$blood.'</option> ';
                                                    } else {
                                                        echo '<option value="'.$blood.'">'.$blood.'</option>';
                                                    }
                                                }
                                                ?>
                                            </select>
                                        </div>

                                        <div class="my_profile_setting_input form-group">
                                            <label for="prof_weight">Weight (kg)</label>
                                            <input type="text" class="form-control" id="prof_weight" name="prof_weight" value="<?php echo get_user_info(front_user_id())->weight ?>">
                                        </div>

                                        <div class="my_profile_setting_input form-group">
                                            <label for="prof_height">Height (cm)</label>
                                            <input type="text" class="form-control" id="prof_height" name="prof_height" value="<?php echo get_user_info(front_user_id())->height ?>">
                                        </div>

                                        <script>
                                            function calculateBMI() {
                                                var weight = parseFloat(document.getElementById('prof_weight').value);
                                                var height = parseFloat(document.getElementById('prof_height').value) / 100; // Convert height from cm to meters

                                                if (!isNaN(weight) && !isNaN(height) && height > 0 && weight > 0) {
                                                    var bmi = weight / (height * height);
                                                    document.getElementById('bmi_value').value = bmi.toFixed(2); // Display BMI with 2 decimal places
                                                } else {
                                                    document.getElementById('bmi_value').value = ''; // Clear BMI field if height or weight is invalid
                                                }
                                            }

                                            // Call calculateBMI function whenever height or weight changes
                                            document.getElementById('prof_weight').addEventListener('input', calculateBMI);
                                            document.getElementById('prof_height').addEventListener('input', calculateBMI);

                                            // Initial calculation of BMI when the page loads
                                            window.onload = calculateBMI;
                                        </script>

                                        <div class="my_profile_setting_input form-group">
                                            <label for="bmi_value">BMI</label>
                                            <input type="text" class="form-control" id="bmi_value" name="bmi" readonly value="<?php echo get_user_info(front_user_id())->bmi_value ?>">
                                        </div>

                                        <div class="my_profile_setting_input form-group">
                                            <label for="diseases">Diseases</label>
                                            <select class="form-control" id="diseases" name="diseases">
                                                <?php
                                                $blood_arr = array("None", "One or More", "HIV/AIDS", "Hepatitis B and C", "Syphilis and Gonorrhea", "Malaria", "Tuberculosis", "Cancer", "Heart Disease", "Chronic Kidney Disease", "Chronic Respiratory Diseases", "Autoimmune Diseases", "Diabetes", "Blood Disorders", "Prion Diseases", "Zika Virus", "COVID-19");
                                                $diseases = get_user_info(front_user_id())->diseases;
                                                foreach($blood_arr as $blood){
                                                    if($diseases == $blood){
                                                        echo ' <option value="'.$diseases.'" selected>'.$blood.'</option> ';
                                                    } else {
                                                        echo '<option value="'.$blood.'">'.$blood.'</option>';
                                                    }
                                                }
                                                ?>
                                            </select>
                                        </div>

                                        <div class="my_profile_setting_input form-group">
                                            <label for="health_status">Health Status</label>
                                            <select class="form-control" id="health_status" name="health_status">
                                                <?php
                                                $blood_arr = array("None", "Drug usage", "Smoking", "Drinking Alcohol", "One or More");
                                                $health_status = get_user_info(front_user_id())->health_status;
                                                foreach($blood_arr as $blood){
                                                    if($health_status == $blood){
                                                        echo ' <option value="'.$health_status.'" selected>'.$blood.'</option> ';
                                                    } else {
                                                        echo '<option value="'.$blood.'">'.$blood.'</option>';
                                                    }
                                                }
                                                ?>
                                            </select>
                                        </div>

                                        <div class="my_profile_setting_input form-group">
                                            <label for="user_status">User Status</label>
                                            <select class="form-control" id="user_status" name="user_status" onchange="toggleDonationDate()">
                                                <?php
                                                $user_info = get_user_info(front_user_id());
                                                $user_status = $user_info->user_status;

                                                if ($user_status != "N") {
                                                    echo '<option value="' . $user_status . '" selected>' . ucfirst(str_replace('_', ' ', $user_status)) . '</option>';
                                                    if ($user_status != "already_user") {
                                                        echo '<option value="already_user">Already user</option>';
                                                    }
                                                    if ($user_status != "new_user") {
                                                        echo '<option value="new_user">New user</option>';
                                                    }
                                                } else {
                                                    echo '<option value="already_user" selected>Already user</option>
                                                              <option value="new_user">New user</option>';
                                                }
                                                ?>
                                            </select>
                                        </div>

                                        <div class="my_profile_setting_input form-group" id="donation_date_field" style="display: none;">
                                            <label for="last_donate_date">Last Donation Date</label>
                                            <input type="date" class="form-control" id="last_donate_date" name="donation_date" value="<?php echo get_user_info(front_user_id())->last_donate_date ?>">
                                        </div>

                                        <script>
                                            function toggleDonationDate() {
                                                var userStatus = document.getElementById('user_status').value;
                                                var donationDateField = document.getElementById('donation_date_field');

                                                if (userStatus === 'already_user') {
                                                    donationDateField.style.display = 'block';
                                                } else {
                                                    donationDateField.style.display = 'none';
                                                }
                                            }

                                            // Initial check to show/hide the donation date field based on the current status
                                            window.onload = function() {
                                                toggleDonationDate();
                                                calculateBMI();
                                            };
                                        </script>

                                        <!-- Checkbox for location tracking -->
                                        <div class="form-check my_profile_setting_input form-group">
                                            <input type="checkbox" class="form-check-input" id="location_tracking" name="location_tracking">
                                            <label class="form-check-label" for="location_tracking">I agree to allow the application to track my location every 5 minutes.</label>
                                        </div>

                                        <div class="my_profile_setting_input">
                                            <button type="submit" class="btn btn2 float-right" id="saveProfname">Save Personal Data</button>
                                        </div>
                                    </div>

                                    <div class="col-lg-3 col-xl-6">
                                        <div class="my_profile_setting_input ui_kit_select_search form-group">
                                            <label>Phone Number</label>
                                            <input type="text" class="form-control" id="prof_phone" name="prof_phone" value="<?php echo get_phone_number() ?>">
                                        </div>

                                        <div class="my_profile_setting_input">
                                            <button type="button" class="btn btn2 float-right" id="verifyphone">Verify Phone</button>
                                        </div>
                                    </div>

                                    <div class="col-lg-3 col-xl-3">
                                        <div class="my_profile_setting_input ui_kit_select_search form-group">
                                            <?php
                                            if(user_phone_verified()){
                                                echo '<label>This Number is Verified</label>';
                                            } else {
                                                echo '<label>Phone Number Must be verified to submit donations</label>';
                                            }
                                            ?>
                                        </div>
                                    </div>

                                    <div class="col-xl-12"></div>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</section>
<a class="scrollToHome" href="#"><i class="flaticon-arrows"></i></a>

<div id="mobile_verify_mod" class="modal" tabindex="-1" role="dialog">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">SMS OTP Verification</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div>
                    <label>Enter Six Digit OTP Code</label><br>
                    <input type="text" id="otp_ins">
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-primary" id="otp_submit_otp">Submit</button>
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>

<script>
    function validateForm() {
        var locationTracking = document.getElementById('location_tracking').checked;
        if (!locationTracking) {
            alert('You must agree to allow the application to track your location every 5 minutes.');
            return false;
        }
        return true;
    }
</script>
