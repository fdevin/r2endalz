<?php

/**
 * @package WordPress
 * @subpackage R2Endalz

 */
get_header(); ?>


<!-- ***************************** START CONTENT ZONE ********************************* -->
<?php if (have_posts()) : while (have_posts()) : the_post(); ?>
<main class="page">
    <section class="container titleRow">
        <div class="row">
            <div class="col-12">
                <h1><?php the_title(); ?></h1>
            </div>

        </div>
        <div class="row metaInfo">
            <!-- <div class="author">
                <p><?php the_author(); ?></p>
            </div> -->
            <div class="dateMeta">
                <p class="meta">Posted on: <span class="date"><?php the_time('F j, Y'); ?></span>
                </p>
            </div>
            <p class="catName"><span>In Categories: </span><?php exclude_post_categories("56"); ?>
            </p>

        </div>
    </section>

    <section class="mainContent container">

        <div class="row content single layout">

            <div class="col-12 col-md-8 entry ">
                <div class="entryInner">
                    <div class="featImg"><?php
                                    if (has_post_thumbnail()) {
                                      the_post_thumbnail('full');
                                    } else {
                                    } ?>
                    </div>
                    <?php the_content(); ?>

                    <?php the_tags('<ul class="tags"><li class="titleUlTag">', '</li><li>', '</li></ul>'); ?>
                </div>
            </div>
            <!-- /entry-->
            <?php endwhile; ?>
            <?php endif; ?>
            <?php get_sidebar(); ?>
            <div class="relatedPosts col-12">
                <?php $orig_post = $post;
          global $post;
          $categories = get_the_category($post->ID);
          if ($categories) {
            $category_ids = array();
            foreach ($categories as $individual_category) $category_ids[] = $individual_category->term_id;

            $args = array(
              'category__in' => $category_ids,
              'post__not_in' => array($post->ID),
              'posts_per_page' => 4, // Number of related posts that will be shown.
              'ignore_sticky_posts' => 1
            );

            $my_query = new wp_query($args);
            if ($my_query->have_posts()) {
              echo '<div id="related_posts"><h3>Related Posts</h3><ul>';
              while ($my_query->have_posts()) {
                $my_query->the_post(); ?>

                <li>
                    <a href="<?php the_permalink(); ?>"><?php
                                                      if (has_post_thumbnail()) {

                                                        // check if the post has a Post Thumbnail assigned to it.
                                                        the_post_thumbnail();
                                                      } else {
                                                        echo '<img src="';
                                                        echo get_bloginfo('stylesheet_directory');
                                                        echo '/images/placeholder.png"/>';
                                                      } ?></a>
                    <div class="relatedcontent">
                        <h4><a href="<?php the_permalink() ?>" rel="bookmark"
                                title="<?php the_title(); ?>"><?php the_title(); ?></a></h4>
                        <?php the_time('M j, Y') ?>
                    </div>
                </li>
                <?
              }
              echo '</ul></div>';
            }
          }
          $post = $orig_post;
          wp_reset_query(); ?>
            </div>
        </div>
        <!-- /single-->


    </section>
</main>




<?php get_footer(); ?>