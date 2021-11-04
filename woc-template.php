<?php

/**
 * @package WordPress
 * @subpackage R2Endalz
 * Template Name: Woc
 */
get_header(); ?>


<!-- ***************************** START CONTENT ZONE ********************************* -->
<?php if (have_posts()) : while (have_posts()) : the_post(); ?>
        <main class="woc">
            <section class="container galleryPage">

                <div class="row">
                    <div class="col-12 titleBox">

                        <h1><?php the_title(); ?></h1>
                        <div class="wocContent">
                            <?php the_content(); ?>
                        </div>


                    </div>

                </div>

                <?php
                $param = '';

                if (isset($_GET['param'])) {
                    $param = $_GET['param'];
                }
                ?>
                <div class="row">
                    <div class="col-lg-12">
                        <div class="form-search">
                            <div class="ajaxSearch">
                                <input type="text" name="keyword" id="keyword" placeholder="Search..." />
                                <input type="hidden" value="<?php echo admin_url('admin-ajax.php'); ?>" id="ajax_url_input"> <button id="resetSearch" class="btn btn-primary">Reset Search</button>
                            </div>
                            <div class="form-search-tabs">
                                <p>Sort by:</p>

                                <a href="?param=byname " class="link-left <?= $param == 'byname'  ? 'active' : ''; ?>"><?php the_field('button_name_1', 'options-en') ?>
                                </a>
                                <a href="?param=newest" class="link-right <?= $param == 'newest'  ? 'active' : ''; ?>"><?php the_field('button_name_2', 'options-en') ?>
                                </a>
                            </div>
                            <!-- <div id="datafetch">Search results will appear here</div> -->

                        </div>
                        <div id="datafetch"></div>

                    </div>
                </div>



                <?php
                switch ($param) {
                    case 'byname':
                        $args = array(

                            'post_type' => 'gallerys',
                            'post_status' => 'publish',
                            'posts_per_page' => '24',
                            'orderby' => 'title',
                            'order'   => 'ASC',
                            'paged' => 1,
                        );
                        break;
                    case 'newest':
                        $args = array(
                            'post_type' => 'gallerys',
                            'post_status' => 'publish',
                            'posts_per_page' => '24',
                            'orderby' => 'date',
                            'order'   => 'DESC',
                            'paged' => 1,
                        );
                        break;
                    default:
                        $args = array(
                            'post_type' => 'gallerys',
                            'post_status' => 'publish',
                            'posts_per_page' => '24',
                            'orderby' => 'date',
                            'order'   => 'DESC',
                            'paged' => 1,

                        );
                }
                ?>

                <?php


                $i = 0;
                $blog_posts = new WP_Query($args);
                ?>
                <?php $count = $blog_posts->found_posts; ?>


                <?php if ($blog_posts->have_posts()) : ?>
                    <div class="blog-posts row">
                        <?php while ($blog_posts->have_posts()) : $blog_posts->the_post(); ?>
                            <div class="col-6 col-sm-6 col-lg-2 col-xl-2">
                                <?php
                                $i = $i + 1;
                                $featured_img_url = get_the_post_thumbnail_url(get_the_ID(), 'thumbnail');
                                if ($featured_img_url == "") {
                                    $featured_img_url = get_template_directory_uri() . '/images/placeholder.jpg';
                                }


                                ?>


                                <a class="item-gallery" class="" data-bs-toggle="modal" data-bs-target="#gallerry-<?php echo get_the_ID(); ?>">
                                    <img class="img-fluid img-content" src="<?= $featured_img_url; ?>" alt="">
                                    <div class="overlay">

                                        <span><?= the_title(); ?></span>


                                    </div>
                                </a>

                            </div>
                        <?php endwhile; ?>
                    </div>



                    <?php if ($count > 24) : ?>
                        <div class="loadmore white-btn-hover">Load More</div>
                        <div id="alert-post" class="alert-post" style='display:none;'>
                            <p>No more posts were found.</p>
                        </div>
                    <?php endif; ?>
                <?php endif; ?>


                <?php
                $args = array(
                    'post_type' => 'gallerys',
                    'post_status' => 'publish',
                    'posts_per_page' => '24',
                    'paged' => 1,
                );
                $i = 0;
                $blog_posts = new WP_Query($args);
                ?>

                <?php if ($blog_posts->have_posts()) : ?>
                    <div class="modal-div">
                        <?php while ($blog_posts->have_posts()) : $blog_posts->the_post(); ?>

                            <?php
                            $i = $i + 1;
                            $featured_img_url = get_the_post_thumbnail_url(get_the_ID(), 'full');
                            if ($featured_img_url == "") {
                                $featured_img_url = get_template_directory_uri() . '/images/placeholder.jpg';
                            }
                            ?>
                            <div class="modal fade  " id="gallerry-<?php echo get_the_ID(); ?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                <div class="modal-dialog modal-xl modal-dialog-centered " role="document">
                                    <div class="modal-content">
                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                        <div class="modal-body">
                                            <img class="btn-prev arrow-prev-modal" src="<?= get_template_directory_uri() ?>/images/arrow-prev.png" alt="">
                                            <img class="btn-next arrow-next-modal" src="<?= get_template_directory_uri() ?>/images/arrow-next.png" alt="">
                                            <div class="row">
                                                <div class="col-lg-6">
                                                    <img class="img-fluid img-modal" src="<?= $featured_img_url; ?>" alt="">
                                                </div>
                                                <div class="col-lg-6">
                                                    <div class="col-lg-1">

                                                    </div>
                                                    <div class="col-lg-10 d-flex justify-content-center align-items-center" style="height:100%;">
                                                        <div class="box">
                                                            <h4><?php the_title(); ?></h4>

                                                            <p class="city"> <?php the_field('city'); ?></p>

                                                            <?php the_content(); ?>
                                                        </div>


                                                    </div>
                                                    <div class="col-lg-1">

                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                    </div>
                                </div>
                            </div>

                        <?php endwhile; ?>
                    <?php endif; ?>

                    </div>
            </section>


            <?php include(get_template_directory() . '/includes/modal.php'); ?>

        </main>


    <?php endwhile; ?>
<?php endif; ?>
<script>
    jQuery(document).ready(function() {
        setTimeout(function() {
            jQuery('.box-popup').fadeIn();
        }, 3000);
    });

    function close_modalito() {
        document.getElementById("pop-up").style.display = "none";
    }
    jQuery(document).scroll(function() {});


    jQuery("#keyword").keyup(function() {
        var search_posts = jQuery(this).val();
        var ajax_url = jQuery('#ajax_url_input').val();
        jQuery.ajax({
            type: 'POST',
            url: ajax_url,
            data: {
                action: 'search_data',
                query: search_posts,
            },
            beforeSend: function() {},
            success: function(data) {
                if (search_posts) {
                    jQuery('.loadmore').css('display', 'none');
                } else {
                    jQuery('.loadmore').css('display', 'block');
                }

                jQuery(".blog-posts").html(data);
            }
        });
    });

    jQuery("#resetSearch").click(function() {
        jQuery("#keyword").val('');
        location.reload();
    
    })

    var page = 2;
    jQuery(function($) {
        jQuery('body').on('click', '.loadmore', function() {
            var button = $(this),
                data = {
                    'action': 'loadmore',
                    'query': misha_loadmore_params.posts, // that's how we get params from wp_localize_script() function
                    'page': misha_loadmore_params.current_page
                };

            jQuery.ajax({ // you can also use $.post here
                url: misha_loadmore_params.ajaxurl, // AJAX handler
                data: data,
                type: 'POST',
                beforeSend: function(xhr) {
                    button.text('Loading...'); // change the button text, you can also add a preloader image
                },
                success: function(data) {

                    if (data.trim()) {
                        $(".blog-posts").append(data);
                        button.text('Load More')
                        //button.text( 'More posts' ).prev().before(data); // insert new posts
                        misha_loadmore_params.current_page++;

                        if (misha_loadmore_params.current_page == misha_loadmore_params.max_page)
                            button.remove(); // if last page, remove the button

                        // you can also fire the "post-load" event here if you use a plugin that requires it
                        // $( document.body ).trigger( 'post-load' );
                    } else {
                        button.remove(); // if no data, remove the button as well
                    }
                }
            });

        });
        jQuery(document).ready(function() {
            load_modal();
        });

        function load_modal() {
            $("div[id^='gallerry-']").each(function() {

                var currentModal = $(this);
                //click next
                currentModal.find('.btn-next').click(function() {


                    currentModal.modal('hide');
                    currentModal.closest("div[id^='gallerry-']").nextAll("div[id^='gallerry-']").first().modal('show');
                    var body = document.body;
                    body.classList.add("modal-class");

                });

                //click prev
                currentModal.find('.btn-prev').click(function() {

                    currentModal.modal('hide');
                    currentModal.closest("div[id^='gallerry-']").prevAll("div[id^='gallerry-']").first().modal('show');


                    var body = document.body;
                    body.classList.add("modal-class");
                });

            });


            jQuery('.modal').on('hide.bs.modal', function(e) {
                console.log('hide');
                $("body").removeClass("modal-class");
                $("body").removeClass("modal-open");
                $('.modal-backdrop').remove();
                // var anim = $('#exit').val();
                // testAnim(anim);
                // $('.modal .modal-dialog').attr('class', 'modal-dialog modal-xl modal-dialog-centered  fadeOutRight  animated');
            })
        }




        jQuery('.modal').on('hide.bs.modal', function(e) {
            console.log('hide');
            $("body").removeClass("modal-class");
            $("body").removeClass("modal-open");
            $('.modal-backdrop').remove();
            // var anim = $('#exit').val();
            // testAnim(anim);
            // $('.modal .modal-dialog').attr('class', 'modal-dialog modal-xl modal-dialog-centered  fadeOutRight  animated');
        })
    });



    var page = 2;
    var modal_page = page;

    jQuery(function($) {
        jQuery('body').on('click', '.loadmore', function() {

            const queryString = window.location.search;
            console.log(queryString);
            const urlParams = new URLSearchParams(queryString);

            const param = urlParams.get('param')
            console.log(param);

            var data = {
                'action': 'load_posts_by_ajax',
                'page': page,
                'param': param,
                // 'security': blog.security
            };

            jQuery.post(blog.ajaxurl, data, function(response) {

                if ($.trim(response) != '') {
                    $('.blog-posts').append(response);
                    page++;
                } else {
                    $('.loadmore').hide();
                    $('.alert-post').show();

                }
            });
        });
    });
</script>

<?php get_footer(); ?>