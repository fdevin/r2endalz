<?php

/**
 * @package WordPress
 * @subpackage R2Endalz
 * Template Name: Front Page
 */
get_header(); ?>
<!-- ***************************** START CONTENT ZONE ********************************* -->

<main>
    <?php if (have_rows('hero_block')) : ?>
    <?php while (have_rows('hero_block')) : the_row(); ?>
    <section class="container-fluid homeHero"
        style="background:url('<?php the_sub_field('hero_bg_image'); ?>') no-repeat; background-size:cover">
        <div class="container">
            <div class="innerHero">
                <h1><?php the_sub_field('hero_title'); ?></h1>
                <p class="intro"><?php the_sub_field('intro_text'); ?></p>
                <?php $button_link = get_sub_field('button_link'); ?>
                <?php if ($button_link) { ?>
                <a class="btn CTA2" href="<?php echo $button_link; ?>"><?php the_sub_field('button_text'); ?></a>
                <?php } ?>
            </div>
        </div>
    </section>

    <?php endwhile; ?>
    <?php endif; ?>

    <!-- ******* START FLEXIBLE FIELDS ******* -->
    <?php if (have_rows('flexible_fields')) : ?>
    <?php while (have_rows('flexible_fields')) : the_row(); ?>
    <?php if (get_row_layout() == 'default_editor') : ?>
    <?php if (get_sub_field('use_default_editor') == 1) {
                    include(get_template_directory() . '/includes/default.php');
                } else {
                    // echo 'false'; 
                } ?>
    <?php elseif (get_row_layout() == 'default_text') : ?>
    <?php if (have_rows('free_content')) : ?>
    <?php while (have_rows('free_content')) : the_row(); ?>
    <?php if (get_sub_field('add_free_content') == 1) {
                            include(get_template_directory() . '/includes/freeContent.php');
                        } else {
                            // echo 'false'; 
                        } ?>

    <?php endwhile; ?>
    <?php endif; ?>
    <?php elseif (get_row_layout() == 'intro_block') : ?>
    <section class="introText">
        <div class="container">
            <div class="row">
                <div class="intro">
                    <?php the_sub_field('intro_text'); ?>
                </div>
            </div>
        </div>
    </section>

    <?php elseif (get_row_layout() == 'three_columns') : ?>
    <section class="firstRow">
        <div class="container">
            <div class="row">
                <div class="col-lg-5 ">
                    <?php $woc_image = get_sub_field('woc_image');?>
                    <?php if ($woc_image) { ?>
                    <div class="miniBox wocBox"
                        style="background:url('<?php echo $woc_image['url']; ?>' ) no-repeat 50%; background-size:cover; ">
                        <? } else { ?>
                        <div class="miniBox wocBox">
                            <?php } ?>

                            <a href="<?php $woc_link = the_sub_field('woc_link'); ?>" class="arrowBut"><?php the_sub_field( 'woc_button_text' ); ?></a>
                        </div>
                    </div>
                    <div class="col-lg-2 ">
                        <div class="miniBox wtdBox">
                            <h2><?php the_sub_field('ways_to_donate'); ?></h2>
                            <p>So many ways you can help </p>
                            <a href="#donate" class="arrowBut inverse">Find Out More</a>
                        </div>
                    </div>
                    <div class="col-lg-5 ">
                        <div class="miniBox videoBox">

                            <a href="#videoModalBox" class="modalTrigger" data-bs-toggle="modal"
                                data-bs-target="#videoModal"><img
                                    src="<?php $video_poster = the_sub_field('video_poster'); ?>" alt="Video" /></a>
                        </div>
                        <!-- Modal -->
                        <div class="modal fade" id="videoModal" tabindex="-1" aria-labelledby="videoModalLabel"
                            aria-hidden="true">
                            <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable">
                                <div class="modal-content">

                                    <div class="modal-body">
                                        <style>
                                        .embed-container {
                                            position: relative;
                                            padding-bottom: 56.25%;
                                            height: 0;
                                            overflow: hidden;
                                            max-width: 100%;
                                        }

                                        .embed-container iframe,
                                        .embed-container object,
                                        .embed-container embed {
                                            position: absolute;
                                            top: 0;
                                            left: 0;
                                            width: 100%;
                                            height: 100%;
                                        }
                                        </style>
                                        <div class='embed-container'><?php the_sub_field('video_embed'); ?></div>
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary"
                                            data-bs-dismiss="modal">Close</button>

                                    </div>
                                    <script>
                                    (function($) {

                                        function iframeModalOpen() {

                                            $('.modal').on('hidden.bs.modal', function() {
                                                $(".modal iframe").attr("src", $(".modal iframe").attr(
                                                    "src"));
                                            });
                                        }

                                        $(document).ready(function() {
                                            iframeModalOpen();
                                        });

                                    })(jQuery);
                                    </script>
                                </div>
                            </div>
                        </div>



                    </div>
                </div>
            </div>
    </section>

    <?php elseif (get_row_layout() == 'four_columns') : ?>
    <?php if (get_sub_field('add_4_columns_block') == 1) {
                    include(get_template_directory() . '/includes/fourCols.php');
                } else {
                    // echo 'false'; 
                } ?>
    <?php elseif (get_row_layout() == 'add_donate_block') : ?>
    <?php if (get_sub_field('add_the_donate_block') == 1) {
                    include(get_template_directory() . '/includes/donateBlock.php');
                } else {
                    // echo 'false'; 
                } ?>
    <!-- start about -->
    <?php elseif (get_row_layout() == 'our_story') : ?>
        <?php if ( get_sub_field( 'add_default_padding' ) == 1 ) { 
			 echo '<section class="aboutR2EA">'; 
			} else { 
			 echo '<section class="aboutR2EA noPadding">'; 
			} ?>
    
        <div class="container">
            <div class="row">
                <div class="col-12 bigPhoto">
                    <?php $big_photo = get_sub_field('big_photo'); ?>
                    <?php if ($big_photo) { ?>
                    <?php echo wp_get_attachment_image($big_photo, 'gallery-top'); ?>
                    <?php } ?>
                </div>
                <?php if ( get_sub_field( 'add_default_padding' ) == 1 ) { 
			 echo '<div class="row galleryLeft">'; 
			} else { 
			 echo '<div class="row galleryLeft" style="margin:0 -1rem">'; 
			} ?>
                
                    <div class="col-lg-7 theGallery">
                        <?php $left_image = get_sub_field('left_image'); ?>
                        <?php if ($left_image) { ?>
                        <?php echo wp_get_attachment_image($left_image, 'gallery'); ?>
                        <?php } ?>
                        <?php $right_image_top = get_sub_field('right_image_top'); ?>
                        <?php if ($right_image_top) { ?>
                        <?php echo wp_get_attachment_image($right_image_top, 'gallery-small'); ?>
                        <?php } ?>
                        <?php $right_image_bottom = get_sub_field('right_image_bottom'); ?>
                        <?php if ($right_image_bottom) { ?>
                        <?php echo wp_get_attachment_image($right_image_bottom, 'gallery-small'); ?>
                        <?php } ?>
                    </div>
                    <div class="col-lg-5">
                        <h2><span class="purple">Our</span> Story</h2>
                        <?php the_sub_field('text_block'); ?>
                        <div class="row buttonRow"><button class="btn CTA2">Donate Now!</button></div>
                    </div>
                </div>

            </div>
        </div>
    </section>
    <!--end about -->
    <?php elseif (get_row_layout() == 'beneficiaries_block') : ?>
    <section class="beneficiary">
        <div class="container">
            <div class="row benefTitle">
                <p class="eyebrow">Beneficiaries</p>
                <h2> <?php the_sub_field('benef_title'); ?></h2>
            </div>
            <div class="row topBenef">
                <div class="col-md-6">

                    <?php the_sub_field('benef_text'); ?>
                </div>
                <div class="col-md-6">
                    <?php if (have_rows('photos_on_right_col')) : ?>
                    <?php while (have_rows('photos_on_right_col')) : the_row(); ?>
                    <?php $photos_right = get_sub_field('photos_right'); ?>
                    <?php if ($photos_right) { ?>
                    <?php echo wp_get_attachment_image($photos_right, 'medium'); ?>
                    <?php } ?>
                    <?php endwhile; ?>
                    <?php endif; ?>
                </div>
            </div>

        </div>
    </section><!-- /beneficiary -->

    <section class="beneficiaryWhite container-fluid">

        <div class="row bottomBenef" id="theCar">
            <div class="col-12 noCarou">
                <?php if (have_rows('photos_block')) : ?>
                <?php while (have_rows('photos_block')) : the_row(); ?>
                <?php $photo = get_sub_field('photo'); ?>
                <?php if ($photo) { ?>
                <?php echo wp_get_attachment_image($photo, 'medium'); ?>
                <?php } ?>
                <?php endwhile; ?>
                <?php else : ?>
                <?php // no rows found 
                                ?>
                <?php endif; ?>
            </div>


        </div>
        <?php elseif (get_row_layout() == 'join_us_now_block') : ?>
        <div class="container">
            <div class="row lastCTA">
                <div class="col-lg-6">

                    <?php the_sub_field('text_for_join'); ?>
                </div>
                <div class="col-lg-6">
                    <a class="CTA arrowBut" href="<?php bloginfo('url'); ?>/donate/">JOIN US NOW!</a>
                </div>
            </div>
        </div>
    </section>

    <?php elseif (get_row_layout() == 'about_the_team') : ?>
    <section class="theTeam" id="theTeam">
        <div class="container">
            <div class="row">

                <div class="col-12 col-sm-8 ">

                    <h2><?php the_sub_field('team_title'); ?></h2>
                    <div class="bannerText"> <?php the_sub_field('team_text'); ?></div>
                    <button class="arrowBut inverse">JOIN THE TEAM</button>

                </div>
            </div>
        </div>
    </section>



    <?php endif; ?>
    <?php endwhile; ?>
    <?php else : ?>
    <?php // no layouts found 
        ?>
    <?php endif; ?>















    <!-- ******* END FLEXIBLE FIELDS ******* -->




    <?php if (have_rows('flexible_content')) : ?>
    <?php while (have_rows('flexible_content')) : the_row(); ?>
    <?php if (get_row_layout() == 'categories_bar') : ?>
    <?php if (get_sub_field('include_categories_bar_') == 1) {
                    include(get_template_directory() . '/includes/cat-nav.php');
                } else {
                    // echo 'false'; 
                } ?>
    <?php elseif (get_row_layout() == 'default_content') : ?>
    <?php if (get_sub_field('include_default') == 1) {
                    include(get_template_directory() . '/includes/default.php');
                } else {
                    // echo 'false'; 
                } ?>
    <?php elseif (get_row_layout() == 'articles_top') : ?>
    <?php if (get_sub_field('include_articles') == 1) {
                    include(get_template_directory() . '/includes/posts-block.php');
                } else {
                    // echo 'false'; 
                } ?>

    <?php elseif (get_row_layout() == 'bottom_banner') : ?>
    <?php if (get_sub_field('include_green_banner') == 1) {
                    include(get_template_directory() . '/includes/bottom-banner.php');
                } else {
                    // echo 'false'; 
                } ?>



    <?php elseif (get_row_layout() == 'free_content') : ?>
    <?php the_sub_field('free_content_field'); ?>
    <?php endif; ?>
    <?php endwhile; ?>
    <?php else : ?>
    <?php // no layouts found 
        ?>
    <?php endif; ?>



</main>


<?php get_footer(); ?>