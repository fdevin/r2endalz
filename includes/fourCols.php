<section class="fourCols">
    <div class="container">
        <div class="row">
            <?php
            if (have_posts()) : ?>
                <?php global $post;
                $my_query = new WP_Query(array('posts_per_page' => 2,));
                while ($my_query->have_posts()) : $my_query->the_post();

                ?>
                    <div class="col-lg-3 col-sm-6">
                        <div class="blogPost homePost">
                            <a href="<?php the_permalink(); ?>"><?php
                                                                if (has_post_thumbnail()) {

                                                                    // check if the post has a Post Thumbnail assigned to it.
                                                                    the_post_thumbnail('front-page');
                                                                } else {
                                                                    echo '<img src="';
                                                                    echo get_bloginfo('stylesheet_directory');
                                                                    echo '/images/placeholder.png"/>';
                                                                } ?></a>
                            <h3><?php the_title(); ?>
                            </h3>
                            <a class="arrowBut" href="<?php the_permalink(); ?>">Read More</a>
                        </div>
                    </div>

                <?php
                endwhile; ?>
<?php wp_reset_postdata(); ?>
            <?php endif; ?>
            <div class="col-lg-3 col-sm-6 ">
                <div class="blogPost homePost">
                <?php $the_team_image = get_sub_field( 'the_team_image' ); ?>
			<?php if ( $the_team_image ) { ?>
				<?php echo wp_get_attachment_image( $the_team_image, 'gallery-small' ); ?>
                <? } else { ?>
                    <img src="<?php bloginfo('template_directory'); ?>/images/theTeam.jpg" alt="Picture of the Team" />
			<?php } ?>
                    
                    <a class="arrowBut" href="#theTeam">The Team</a>
                </div>
            </div>
            <div class="col-lg-3 col-sm-6">
                <div class="blogPost homePost">
                <?php $the_car_image = get_sub_field( 'the_car_image' ); ?>
                <?php if ( $the_car_image ) { ?>
				<?php echo wp_get_attachment_image( $the_car_image, 'gallery-small' ); ?>
                <? } else { ?>
                    <img src="<?php bloginfo('template_directory'); ?>/images/theCar.jpg" alt="Picture of the Car" />
			<?php } ?>
                    <a class="arrowBut" href="#theCar">The Car</a>
                </div>
            </div>

        </div>
    </div>
</section>