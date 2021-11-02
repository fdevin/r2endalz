<?php

/**
 * @package WordPress
 * @subpackage R2Endalz
 * Template Name: Add a Champion
 */
get_header(); ?>
<!-- ***************************** START CONTENT ZONE ********************************* -->


<main>
    <section class=" donateHero" style="background:<?php the_field('hero_background_color'); ?> url(<?php the_post_thumbnail_url('full'); ?>) no-repeat top center; background-size:cover">

    <?php if ( get_field( 'add_top_content' ) == 1 ) { ?>
        <div class="container">
            <div class="row">
                <div class="col-12 ">

                    <h1><?php the_field('heading'); ?></h1>
                    <p class="strongest"><?php the_field('sub-heading'); ?></p>

                </div>

            </div>
        </div>
    </section>
    <section class="subHero">
        <div class="container ">
            <div class="row">
                <div class="col-12 col-md-4">
                    <?php the_field('top_left_column'); ?>
                </div>
                <div class="col-12 col-md-4">
                    <?php the_field('top_right_column'); ?>
                </div>
            </div>
        </div>

                    
			<?php } ?>

        
    </section>

    <?php if (get_field('enable_default_editor') == 1) {
        include(get_template_directory() . '/includes/default.php');
    } else {
        // echo 'nooo'; 
    } ?>
    <section class="content donateFormPage" style="background:<?php the_field('page_background_color'); ?>;">
        <div class="container" style="background:<?php the_field('form_background_color'); ?>;">


           
            <?php $campaign = get_field('campaign'); ?>

            <?php echo do_shortcode('[contact-form-7 id="2391" campaign="' . $campaign . '"]'); ?>
            <div class="bottomForm">
            <?php the_field( 'form_bottom_content' ); ?>
            </div>
        </div>
    </section>


    <?php $content = get_field('content_block'); ?>

    <section class="finalContent">
        <div class="container defaultContent">
            <div class="row">
                <div class="col">
                    <?php echo ($content); ?>
                </div>
            </div>
        </div>
    </section>

</main>



<?php get_footer(); ?>