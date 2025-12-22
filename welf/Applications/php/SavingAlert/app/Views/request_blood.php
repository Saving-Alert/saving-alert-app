<section class="bgc-f7 py-5">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-lg-8">

                <div class="card shadow">
                    <div class="card-header bg-danger text-white">
                        <h4 class="mb-0">Create Blood Request</h4>
                    </div>

                    <div class="card-body">
                        <form id="submit_form" method="post">

                            <div class="mb-3">
                                <label class="form-label">Hospital / Organization</label>
                                <input type="text"
                                       class="form-control"
                                       name="dontitile"
                                       value="<?= esc(get_user_info(front_user_id())->name) ?>"
                                       required>
                            </div>

                            <div class="mb-3">
                                <label class="form-label">Blood Group</label>
                                <select class="form-select" name="blod_group" required>
                                    <option value="">Select</option>
                                    <?php
                                    $groups = ['A+','A-','B+','B-','AB+','AB-','O+','O-'];
                                    foreach ($groups as $group):
                                    ?>
                                        <option value="<?= $group ?>"><?= $group ?></option>
                                    <?php endforeach; ?>
                                </select>
                            </div>

                            <div class="mb-3">
                                <label class="form-label">Description</label>
                                <textarea class="form-control"
                                          name="dondescription"
                                          rows="4"
                                          placeholder="Patient condition, urgency, notes..."
                                          required></textarea>
                            </div>

                            <div class="mb-3">
                                <label class="form-label">Contact Phone</label>
                                <input type="text"
                                       class="form-control"
                                       name="don_pub_phone"
                                       value="<?= esc(get_user_info(front_user_id())->phone_number) ?>"
                                       required>
                            </div>

                            <div class="row">
                                <div class="col-md-6 mb-3">
                                    <label class="form-label">District</label>
                                    <input type="text"
                                           class="form-control"
                                           name="main_area"
                                           value="<?= esc(get_user_info(front_user_id())->district) ?>"
                                           required>
                                </div>

                                <div class="col-md-6 mb-3">
                                    <label class="form-label">City / Area</label>
                                    <input type="text"
                                           class="form-control"
                                           name="sub_area"
                                           value="<?= esc(get_user_info(front_user_id())->city) ?>"
                                           required>
                                </div>
                            </div>

                            <div class="text-end mt-4">
                                <button type="button"
                                        class="btn btn-danger"
                                        id="saveBtn">
                                    Submit Blood Request
                                </button>
                            </div>

                        </form>
                    </div>
                </div>

            </div>
        </div>
    </div>
</section>
<script>
    const base_url = "<?= base_url() ?>";
</script>

<script src="<?= base_url('assets/js/request-blood.js') ?>"></script>
