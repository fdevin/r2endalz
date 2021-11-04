<?php
/**
* @package WordPress
* @subpackage R2Endalz
*/
get_header(); ?>
  <section class="miniHeader whiteBG">
    <div class="hero-inner container">
    <h1 class="search-title">
<?php echo $wp_query->found_posts; ?> <?php _e( 'Search Results Found For', 'locale' ); ?>: "<?php the_search_query(); ?>"
</h1>
    </div>
  </section>
  <!-- start section single post -->
  <section class="container-fluid pageSection">
    <div class="container content">
      <div class="row">
        
        <?php if ( have_posts() ) : while ( have_posts() ) : the_post(); ?>
        <div class="searchresult2">
          
		  <div class="searchThumb">
            <a href="<?php the_permalink(); ?>">
              <?php if ( has_post_thumbnail() ) {
				the_post_thumbnail();
				} else { ?>
				<img src="<?php bloginfo('template_directory'); ?>/images/default.png" alt="<?php the_title(); ?>" />
				<?php } ?>
            </a>
			</div>
            <div class="rightexcerpt">
              <div class="rightli">
                <h4><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h4>
                
                <?php the_excerpt(); ?>
              </div>
              
            </div>
          
        </div>
        <?php endwhile; ?>
        <?php else : ?>
        <div class="searchresult">
          <h4 class="center">No posts found. Try a different search?</h4>
          <div class="search">
            <?php get_search_form(); ?>
          </div>
        </div>
        <?php endif; ?>
		
      </div>
    </div>
  </section>
  <?php get_footer(); ?>
