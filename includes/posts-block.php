<section class="mainContent container">
        <?php
        if (have_posts()) : ?>
            <?php global $post;
            $my_query = new WP_Query(array('posts_per_page' => 1, 'categories_per_page' => 1,));
            while ($my_query->have_posts()) : $my_query->the_post();

            ?>
                <div class="row featuredBox">
                    <div class="col-12 col-lg-7 leftFeat">
                        <a href="<?php the_permalink(); ?>"><?php
                                                            if (has_post_thumbnail()) {

                                                                // check if the post has a Post Thumbnail assigned to it.
                                                                the_post_thumbnail('featured');
                                                            } else {
                                                                echo '<img src="';
                                                                echo get_bloginfo('stylesheet_directory');
                                                                echo '/images/placeholder.png"/>';
                                                            } ?></a>
                    </div>
                    <div class="col-12 col-md-7 col-lg-5 rightFeat">

                        <?php
                        $category = get_the_category();
                        ?>
                        <p class="stripline"><a href="<?php echo esc_url(get_category_link($category[0]->term_id)); ?>"><?php echo $category[0]->cat_name; ?></a></p>
                        <h2><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h2>
                        <p class="featCopy"><?php echo content(30); ?></p>
                        <p class="date">
                            <php the_time();?>
                        </p>
                    </div>
                </div>
            <?php

            endwhile; ?>

        <?php endif; ?>

        <div class="articles row">
            <?php
            $i = 0;
            if (have_posts()) : ?>
            <?php get_sub_field( 'articles_per_page' ); ?>
			
                <?php global $post;
                $my_query = new WP_Query(array('posts_per_page' => 12, 'offset' => 1, 'categories_per_page' => 1,));
                while ($my_query->have_posts()) : $my_query->the_post();
                    if ($i == 6) {
                        $i = 0;
                ?>
                
                        <section class="subscribeBar">
                            <div class="container">
                                <div class="row">
                                    <div class="col-12 col-md-6">
                                        <p>Never miss a beat. Sign up to get notified.</p>
                                    </div>
                                    <div class="col-12 col-md-6">
                                        <div class="d-flex">
                                        <?php $form = get_sub_field( 'subscribe_form' ); ?>
                                        <?php echo do_shortcode('[contact-form-7 id="'.$form.'" title="Subscribe Form"]'); ?>
                                        
                    </div>
                                    </div>
                                </div>
                            </div>
                        </section>
                    <?php
                    }
                    ?>


                    <div class="col-12 col-md-4">
                        <article class="rounded">
                            <a href="<?php the_permalink(); ?>"><?php
                                                                if (has_post_thumbnail()) {

                                                                    // check if the post has a Post Thumbnail assigned to it.
                                                                    the_post_thumbnail();
                                                                } else {
                                                                    echo '<img src="';
                                                                    echo get_bloginfo('stylesheet_directory');
                                                                    echo '/images/placeholder.png"/>';
                                                                } ?></a>
                            <div class="articleInner">
                                <?php
                                $category = get_the_category();
                                ?>
                                <p class="catName"><a href="<?php echo esc_url(get_category_link($category[0]->term_id)); ?>"><?php echo $category[0]->cat_name; ?></a></p>

                                <h3><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h3>
                                <p class="date"><?php the_time(); ?></p>
                            </div>
                        </article>
                    </div>
                <?php
                    $i++;
                endwhile; ?>
<?php wp_reset_postdata(); ?>
            <?php endif; ?>



        </div>
        <div class="row buttonHolder">
            <a href="<?php bloginfo('url');?>/category/blog/" class="ghost">Load More</a>
        </div>
    </section>
