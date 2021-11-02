<?php

/**
 * @package WordPress
 * @subpackage R2Endalz

 */
get_header(); ?>

<main class="container-fluid archivePage ">
  <!-- ***************************** START CONTENT ZONE ********************************* -->
  <section class="blogHero">
    <div class="container">

      <?php if (have_posts()) : ?>
        <?php $post = $posts[0]; // Hack. Set $post so that the_date() works. 
        ?>
        <?php /* If this is a category archive */ if (is_category()) { ?>

          <div class="row">
            <div class="col-12 col-md-4">
              <h1><?php single_cat_title(); ?></h1>
              <p class="intro"><?php echo category_description(); ?></p>
            </div>
          </div>


        <?php /* If this is a tag archive */ } elseif (is_tag()) { ?>
          <div class="posttitle">
            <h1><?php single_cat_title(); ?></h1>
          </div>
        <?php /* If this is a daily archive */ } elseif (is_day()) { ?>
          <div class="posttitle">
            <h1>Entries stored on
              <?php the_time('F jS, Y'); ?>
            </h1>
          </div>
        <?php /* If this is a monthly archive */ } elseif (is_month()) { ?>
          <div class="posttitle">
            <h1>Entries stored on
              <?php the_time('F, Y'); ?>
            </h1>
          </div>
        <?php /* If this is a yearly archive */ } elseif (is_year()) { ?>
          <div class="posttitle">
            <h1>Entries stored on
              <?php the_time('Y'); ?>
            </h1>
          </div>
        <?php /* If this is an author archive */ } elseif (is_author()) { ?>
          <div class="posttitle">
            <h1>Articles by <?php the_author(); ?></h1>
          </div>


          <?php
          if (is_post_type_archive()) {
          ?>
            <h1>
              <?php post_type_archive_title(); ?>
            </h1>
          <?php
          }
          ?>
        <?php /* If this is a paged archive */ } elseif (isset($_GET['paged']) && !empty($_GET['paged'])) { ?>
          <div class="posttitle">
            <h1>Archive of Entries</h1>
          </div>
        <?php } ?>
    </div>

  </section>


  <section class="content">
    <div class="container">
      <div class="row layout">
        <div class="col-md-8 mainContent">

        <?php if( !is_paged() ){ ?>
    <div class="row">
    <?php

    $args = array(
      'posts_per_page' => 1,
      'post__in'  => get_option('sticky_posts'),
      'ignore_sticky_posts' => 1
    );
    $my_query = new WP_Query($args);

    $do_not_duplicate = array();
    while ($my_query->have_posts()) : $my_query->the_post();
      $do_not_duplicate[] = $post->ID; ?>
      <div class="col-12 featured">
        <p class="catName"><?php exclude_post_categories("56"); ?>
        </p>
        <h2><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h2>
        <a href="<?php the_permalink(); ?>"><?php
                                            if (has_post_thumbnail()) {

                                              // check if the post has a Post Thumbnail assigned to it.
                                              the_post_thumbnail();
                                            } else {
                                              echo '<img src="';
                                              echo get_bloginfo('stylesheet_directory');
                                              echo '/images/placeholder.png"/>';
                                            } ?></a>
        <?php the_excerpt(); ?>
        <a class="arrowBut" href="<?php the_permalink(); ?>">Read More</a>
        <!-- <ul>
                            <li>
                                <a href="#"><img src="images/tw.svg" alt="Twitter" /></a>
                            </li>
                            <li>
                                <a href="#"><img src="images/fb.svg" alt="Facebook" /></a>
                            </li>
                            <li>
                                <a href="#"><img src="images/lin.svg" alt="LinkedIn" /></a>
                            </li>

                        </ul> -->
      </div>
    <?php endwhile; ?>
  </div>
  <?php } ?>


  <?php if( !is_paged() ){ ?>
          <div class="row titleRow">
          <?php } else { ?>
          <div class="row titleRowPaged">
          <?php } ?>
            <div class="col">
              <h2>Related Posts</h2>
            </div>
          </div>
          <div class="row postsList">

            <?php if (have_posts()) : while (have_posts()) : the_post(); ?>

                <?php
                if (is_sticky()) {
                  $stickyClass = 'sticky';
                } else {
                  $stickyClass = '';
                }
                ?>

                <article class="col-12 col-md-6 <?php echo '' . $stickyClass . ''; ?>">
                  <div class="articleInner">
                    <a href="<?php the_permalink(); ?>"><?php
                                                        if (has_post_thumbnail()) {

                                                          // check if the post has a Post Thumbnail assigned to it.
                                                          the_post_thumbnail();
                                                        } else {
                                                          echo '<img src="';
                                                          echo get_bloginfo('stylesheet_directory');
                                                          echo '/images/placeholder.png"/>';
                                                        } ?></a>
                    <?php
                    $category = get_the_category();
                    ?>
                    <p class="catName"><?php exclude_post_categories('56', ''); ?>
                    </p>

                    <h4><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h4>

                    <?php the_excerpt(); ?>

                  </div>
                </article>

              <?php endwhile;
            else : ?>
          </div>
          <p>
            <?php _e('No posts by this author.'); ?>
          </p>
        <?php endif; ?>
      <?php else :
        if (is_category()) { // If this is a category archive
          printf("<h2 class='center'>Sorry, but there aren't any posts in the %s category yet.</h2>", single_cat_title('', false));
        } else if (is_date()) { // If this is a date archive
          echo ("<h2>Sorry, but there aren't any posts with this date.</h2>");
        } else if (is_author()) { // If this is a category archive
          $userdata = get_userdatabylogin(get_query_var('author_name'));
          printf("<h2 class='center'>Sorry, but there aren't any posts by %s yet.</h2>", $userdata->display_name);
        } else {
          echo ("<h2 class='center'>No posts found.</h2>");
        }

      endif;
      ?>
        </div>
        <div class="row navigationRow">
          <?php wp_pagenavi(); ?>
        </div>
      </div>
      <?php get_sidebar(); ?>
    </div>
  </section>


</main>
<?php get_footer(); ?>