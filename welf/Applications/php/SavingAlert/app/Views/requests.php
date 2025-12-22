<section class="our-listing bgc-f7 py-5">
    <div class="container">
        <div class="row mb-4">
            <div class="col-12 text-center">
                <h2 class="text-danger">Blood Donation Requests</h2>
                <p class="text-muted">Find urgent blood requests near you</p>
            </div>
        </div>

        <div class="row">
            <?php if (!empty($donations)) : ?>
                <?php foreach ($donations as $row) : ?>
                    <?php if ($row->active !== 'Y') continue; ?>

                    <div class="col-md-4 mb-4">
                        <div class="card shadow-sm h-100 btn_claim"
                             data-id="<?= esc($row->id) ?>"
                             style="cursor:pointer">

                            <div class="card-body">
                                <h5 class="card-title text-danger">
                                    <?= esc($row->blood_group) ?> Blood Needed
                                </h5>

                                <p class="card-text mb-1">
                                    <strong>Hospital:</strong>
                                    <?= esc($row->title) ?>
                                </p>

                                <p class="card-text mb-1">
                                    <strong>District:</strong>
                                    <?= esc($row->area_1) ?>
                                </p>

                                <p class="card-text mb-1">
                                    <strong>City:</strong>
                                    <?= esc($row->area_2) ?>
                                </p>

                                <p class="card-text text-muted mt-2">
                                    <?= esc(word_limiter($row->description, 20)) ?>
                                </p>
                            </div>

                            <div class="card-footer bg-white text-center">
                                <button class="btn btn-outline-danger btn-sm">
                                    View Details
                                </button>
                            </div>
                        </div>
                    </div>

                <?php endforeach; ?>
            <?php else : ?>
                <div class="col-12 text-center">
                    <p class="text-muted">No blood requests available right now.</p>
                </div>
            <?php endif; ?>
        </div>
    </div>
</section>
