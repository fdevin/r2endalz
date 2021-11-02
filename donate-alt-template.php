<?php

/**
 * @package WordPress
 * @subpackage R2Endalz
 * Template Name: Donate Alternative
 */
get_header(); ?>
<!-- ***************************** START CONTENT ZONE ********************************* -->


<main>

    <?php if (have_rows('flexible_blocks')) : ?>
        <?php while (have_rows('flexible_blocks')) : the_row(); ?>
            <?php if (get_row_layout() == 'top_page') : ?>
                <section class=" donateHero" style="background:<?php the_sub_field('hero_background_color'); ?> url(<?php the_post_thumbnail_url('full'); ?>) no-repeat top center; background-size:cover; ">
                    <div class="container">
                        <div class="row">
                            <div class="col-12 ">

                                <h1><?php the_sub_field('heading'); ?></h1>
                                <?php $sub = get_sub_field('sub-heading'); ?>
                                <?php if ($sub) {
                                    echo '<p class="strongest">' . $sub . '</p>';
                                } ?>

                            </div>

                        </div>
                    </div>
                </section>
                <section class="subHero">
                    <div class="container ">
                        <div class="row">
                            <div class="col-12 col-md-6">
                                <?php the_sub_field('top_left_column'); ?>
                            </div>
                            <div class="col-12 col-md-6">
                                <?php the_sub_field('top_right_column'); ?>
                            </div>
                        </div>
                    </div>
                </section>



            <?php elseif (get_row_layout() == 'old_editor') : ?>

                <?php $content = get_sub_field('content_block'); ?>

                <section class="freeContent">
                    <div class="container freeContentArea">
                        <div class="row">
                            <div class="col">
                                <?php echo ($content); ?>
                            </div>
                        </div>
                    </div>
                </section>

            <?php elseif (get_row_layout() == 'video_modal_block') : ?>

                <section class="videoBlock">
                    <div class="container">
                        <div class="row <?php if (get_sub_field('video_on_left') == 1) {
                                            echo 'leftCol';
                                        } else {
                                            echo 'rightCol';
                                        } ?>">
                            <div class="col-lg-6 vidCol">
                                <div class="miniBox videoBox">

                                    <a href="#videoModalBox" class="modalTrigger" data-bs-toggle="modal" data-bs-target="#videoModal"><img src="<?php $video_poster = the_sub_field('video_poster'); ?>" alt="Video" /></a>
                                </div>
                                <!-- Modal -->
                                <div class="modal fade" id="videoModal" tabindex="-1" aria-labelledby="videoModalLabel" aria-hidden="true">
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
                                                <div class='embed-container'><?php the_sub_field('video_url'); ?></div>
                                            </div>
                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>

                                            </div>
                                            <script>
                                                (function($) {

                                                    function iframeModalOpen() {

                                                        $('.modal').on('hidden.bs.modal', function() {
                                                            $(".modal iframe").attr("src", $(".modal iframe").attr("src"));
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

                            <div class="col-lg-6 vidTextCol ">
                                <?php the_sub_field('text_content'); ?>
                            </div>
                        </div>
                    </div>
                </section>





            <?php elseif (get_row_layout() == 'default_editor') : ?>
                <?php if (get_sub_field('enable_default_editor') == 1) {
                    include(get_template_directory() . '/includes/default.php');
                } else {
                    // echo 'false'; 
                } ?>


                <!-- START FORM -->
            <?php elseif (get_row_layout() == 'form_area') : ?>
                <?php if (get_sub_field('include_donate_form') == 1) {
                    include(get_template_directory() . '/includes/altDonate.php');
                } else {
                    // echo 'false'; 
                } ?>
            <?php endif; ?>
        <?php endwhile; ?>
    <?php else : ?>
        <?php // no layouts found 
        ?>
    <?php endif; ?>
</main>



<?php get_footer(); ?>