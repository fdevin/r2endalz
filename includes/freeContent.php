<?php if (get_sub_field('full_width') == 1) {
    echo '<div class="container-fluid freeContent">';
} else {
    echo '<div class="container freeContent">';
} ?>

<div class="row">
    <div class="col">
        <?php the_sub_field('the_content'); ?>
    </div>
</div>
</div>
