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
        
      </section>

      <section class="mainContent container">
        <div class="row content single layout">
          <div class="col-12 entry">
            <?php the_content(); ?>
          </div>
          <!-- /entry-->
          
        </div>
        <!-- /single-->
 

        </div>
      </section>
    </main>


  <?php endwhile; ?>
<?php endif; ?>

<?php get_footer(); ?>