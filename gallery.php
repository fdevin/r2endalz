<?php /* Template Name: Gallery */ ?>
<?php get_header('new'); ?>

<section class="content-new">
    <?php get_template_part('template_parts/layout/header-gallery'); ?>
    <div class="content-body-all" id="content-body-all">
        <style>
        .bg-gallery {

            background: url('<?= get_template_directory_uri() ?>/images/bg-gallery.png');
            background-color: #7632AB;
            background-repeat: no-repeat;
            background-size: 100%;
            background-position: top;
        }
        </style>
        <section class="content-gallery bg-gallery">
            <div class="container">
                <?php
                $param = '';

                if (isset($_GET['param'])) {
                    $param = $_GET['param'];
                } 
            ?>
                <div class="row">
                    <div class="col-lg-12">
                        <div class="form-search">
                            <input type="text" name="keyword" id="keyword" onkeyup="fetch()"
                                placeholder="Search..."></input>
                            <div class="form-search-tabs">
                                <a href="?param=byname "
                                    class="link-left <?= $param == 'byname'  ? 'active' : ''; ?>"><?php the_field('button_name_1','options-en') ?>
                                </a>
                                <a href="?param=newest"
                                    class="link-left <?= $param == 'newest'  ? 'active' : ''; ?>"><?php the_field('button_name_2','options-en') ?>
                                </a>
                            </div>
                            <!-- <div id="datafetch">Search results will appear here</div> -->
                            <div id="datafetch"></div>
                        </div>


                    </div>
                </div>
                <div class="row">
                    <div class="col-lg-12">
                        <div class="box-title " data-sal="zoom-in" data-sal-duration="650">
                            <h1>
                                <?= the_title(); ?>

                            </h1>
                            <?php the_content(); ?>
                        </div>
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
                            'paged' => 1,
                        );
                        break;
                    default:
                    $args = array(
                        'post_type' => 'gallerys',
                        'post_status' => 'publish',
                        'posts_per_page' => '24',
                        'paged' => 1,
                    );
                }
            ?>

                <?php

                

            
                
                $i=0;
                $blog_posts = new WP_Query( $args );
                ?>
                <?php $count = $blog_posts->found_posts;?>


                <?php if ( $blog_posts->have_posts() ) : ?>
                <div class="blog-posts row">
                    <?php while ( $blog_posts->have_posts() ) : $blog_posts->the_post(); ?>
                    <div class="col-6 col-sm-6 col-lg-2 col-xl-2">
                        <?php 
                        $i = $i+1;
                            $featured_img_url = get_the_post_thumbnail_url(get_the_ID(),'thumbnail'); 
                            if ($featured_img_url == "") {
                            $featured_img_url = get_template_directory_uri().'/images/default-image.png';
                            }

                            
                        ?>


                        <a class="item-gallery" class="" data-toggle="modal"
                            data-target="#gallerry-<?php echo get_the_ID(); ?>">
                            <img class="img-fluid img-content" src="<?= $featured_img_url; ?>" alt="">
                            <div class="overlay">
                                <div>
                                    <span><?= the_title(); ?></span>
                                    <br>
                                    <img src="<?= get_template_directory_uri() ?>/images/see-more-ico.png" alt="">
                                    <br>
                                </div>
                            </div>
                        </a>

                    </div>
                    <?php endwhile; ?>
                </div>
                <?php if ( $count > 24 ) :?>
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
                $i=0;
                $blog_posts = new WP_Query( $args );
                ?>

                <?php if ( $blog_posts->have_posts() ) : ?>
                <div class="modal-div">
                    <?php while ( $blog_posts->have_posts() ) : $blog_posts->the_post(); ?>

                    <?php 
                        $i = $i+1;
                            $featured_img_url = get_the_post_thumbnail_url(get_the_ID(),'full'); 
                            if ($featured_img_url == "") {
                            $featured_img_url = get_template_directory_uri().'/images/default-image.png';
                            }
                        ?>
                    <div class="modal fade  " id="gallerry-<?php echo get_the_ID(); ?>" tabindex="-1" role="dialog"
                        aria-labelledby="exampleModalLabel" aria-hidden="true">
                        <div class="modal-dialog modal-xl modal-dialog-centered " role="document">
                            <div class="modal-content">
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                                <div class="modal-body">
                                    <img class="btn-prev arrow-prev-modal"
                                        src="<?= get_template_directory_uri() ?>/images/arrow-prev.png" alt="">
                                    <img class="btn-next arrow-next-modal"
                                        src="<?= get_template_directory_uri() ?>/images/arrow-next.png" alt="">
                                    <div class="row">
                                        <div class="col-lg-6">
                                            <img class="img-fluid img-modal" src="<?= $featured_img_url; ?>" alt="">
                                        </div>
                                        <div class="col-lg-6">
                                            <div class="col-lg-1">

                                            </div>
                                            <div class="col-lg-10 d-flex justify-content-center align-items-center"
                                                style="height:100%;">
                                                <div class="box">
                                                    <h2><?php the_title(); ?></h2>
                                                    <br>
                                                    <h3 class="city"> <?php the_field('city'); ?></h3>
                                                    <br>
                                                    <?php the_content(); ?>
                                                    <!-- <button type="button" class="next-modal btn-next">Next</button> -->
                                                </div>

                                                <!-- <button class="btn btn-primary" onclick="javascript::player.api('pause')" data-dismiss="modal" 
                                                    data-bs-target="#video-<?php echo get_the_ID(); ?>"
                                                    data-bs-toggle="modal" data-bs-dismiss="modal">View Video</button> -->

                                            </div>
                                            <div class="col-lg-1">

                                            </div>
                                        </div>
                                    </div>
                                </div><!-- end first modal -->
                                <!-- start condictional video modal 
                                <div class="modal fade" id="video-<?php echo get_the_ID(); ?>" aria-hidden="true"
                                    aria-labelledby="exampleModalToggleLabel2" tabindex="-1">
                                    <div class="modal-dialog modal-lg modal-dialog-centered ">
                                        <div class="modal-content">
                                            
                                            <div class="modal-body">
                                            <iframe width="560" height="315" src="https://www.youtube.com/embed/twG4mr6Jov0" title="YouTube video player" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>    
                                            </div>
                                            <div class="modal-footer">
                                                <button class="btn btn-primary" onclick="javascript::player.api('pause')" data-dismiss="modal" aria-label="Close"
                                                    data-bs-target="#gallerry-<?php echo get_the_ID(); ?>"
                                                    data-bs-toggle="modal" data-bs-dismiss="modal">Back to
                                                    content</button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                end conditional video modal -->

                            </div>
                        </div>
                    </div>

                    <?php endwhile; ?>
                    <?php endif; ?>

                </div>
        </section>
        <?php get_template_part('template_parts/sections/pop-up'); ?>
    </div>
    <?php get_template_part('template_parts/layout/footer'); ?>

</section>
<?php
    /*-----------------------------------------------------------------------------------*/
    /* This template will be called by all other template files to finish
    /* rendering the page and display the footer area/content
    /*-----------------------------------------------------------------------------------*/
?>

<script src="<?php echo get_template_directory_uri(); ?>/assets/js/bootstrap.min.js" type="text/javascript"></script>
<?php wp_footer();
// This fxn allows plugins to insert themselves/scripts/css/files (right here) into the footer of your website.
// Removing this fxn call will disable all kinds of plugins.
// Move it if you like, but keep it around.
?>

</body>

</html>