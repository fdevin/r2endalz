<?php if (have_posts()) : while (have_posts()) : the_post(); ?>
<section class="defaultContent">
<div class="container defaultContent">
    <div class="row">
        <div class="col">
            <?php the_content();?>
       
        </div>
    </div>
</div>
</section>
<?php endwhile; ?>
<?php endif; ?>
