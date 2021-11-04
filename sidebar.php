<?php

/**
 * @package WordPress
 * @subpackage R2Endalz
 */
?>

<!-- ASIDE -->
<aside class="col-md-3 blogSidebar">
    <div class="funding">
        <h2>Funding the cure</h2>
        <p>Cutting-edge research aimed at delaying the progression of the disease or stopping its course.</p>
        <a class="btn CTA" href="https://www.houstonmethodist.org/neurology-neurosurgery/texas-medical-center/clinical-programs/nantz-national-alzheimer-center/">Read More</a>
    </div>


    <?php if (have_rows('social_links', 'option')) : ?>
        <div class="social">
            <h3>Connect &amp; Follow Us</h3>
            <div class="socialBox">
                <?php include(get_template_directory() . '/includes/socialBlock.php'); ?>
            </div>
        </div>
    <?php endif; ?>
    <div class="miniBanner">
        <img src="<?php bloginfo('template_directory'); ?>/images/new-car.png" />
        <h2>Let's stay in touch!</h2>
        <p>Subscribe to our newsletter for exclusive content and all the behind-the-scenes details.
        </p>
        <form>
            <input type="email" placeholder="Enter your Email">
            <input type="submit" class="btn yellowBut" value="Subscribe" />
        </form>
    </div>
    <div class="widget latest">
        <h3>Latest Posts</h3>
        <?php $the_query = new WP_Query('posts_per_page=5'); ?>
        <?php while ($the_query->have_posts()) : $the_query->the_post(); ?>
            <article>
                <a href="<?php the_permalink(); ?>"><?php
                                                    if (has_post_thumbnail()) {

                                                        // check if the post has a Post Thumbnail assigned to it.
                                                        the_post_thumbnail();
                                                    } else {
                                                        echo '<img src="';
                                                        echo get_bloginfo('stylesheet_directory');
                                                        echo '/images/placeholder.png"/>';
                                                    } ?></a>
                <p class="catName"><?php exclude_post_categories("56"); ?></p>
                <h4><a href="<?php the_permalink() ?>"><?php the_title(); ?></a></h4>
            </article>
        <?php endwhile;
        wp_reset_postdata();
        ?>
    </div>
    <div class="widget">
        <h3>Categories</h3>
        <ul class="categoriesList">

            <?php wp_list_categories(array(
                'orderby'    => 'name',
                'title_li'   => __(''),
                'exclude'    => array(1),

            )); ?>

        </ul>
        </ul>
    </div>
    <?php if (is_active_sidebar('sidebar_blog')) : ?>
        <?php dynamic_sidebar('sidebar_blog'); ?>
    <?php else : ?>
        <!-- Time to add some widgets! -->
    <?php endif; ?>
</aside>