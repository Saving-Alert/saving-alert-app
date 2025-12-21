<section class="our-listing bgc-f7 pb30-991">
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="row">
                    <?php if (!empty($donations)) : ?>
                        <?php foreach ($donations as $row) : ?>
                            <?php 
                                if(in_array($row->active, ['P', 'D', 'S'])) continue;

                                $food_type = match ($row->food_type) {
                                    'D' => 'Dry Food',
                                    'C' => 'Cooked Food',
                                    'R' => 'Request',
                                    default => 'Unknown',
                                };
                            ?>
                            <div class="col-md-4 col-lg-4">
                                <div class="feat_property home7 agency btn_claim" attr="<?= $row->id ?>">
                                    <div class="thumb">
                                        <img class="img-fluid" src="<?= base_url('/uploads/' . $row->image_url) ?>">
                                        <div class="thmb_cntnt"></div>
                                    </div>
                                    <div class="details">
                                        <div class="tc_content">
                                            <h4><?= esc($row->title) ?></h4>
                                            <p class="text-thm"><?= $food_type ?></p>
                                            <p><?= esc($row->description) ?></p>
                                        </div>
                                        <div class="fp_footer">
                                            <ul class="fp_meta float-left mb0">
                                                <li class="list-inline-item">District: <?= esc($row->area_1) ?></li>
                                                <li class="list-inline-item">City/Area: <?= esc($row->area_2) ?></li>
                                            </ul>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        <?php endforeach; ?>
                    <?php else: ?>
                        <p>No donation requests found.</p>
                    <?php endif; ?>
                </div>
            </div>
        </div>
    </div>
</section>
