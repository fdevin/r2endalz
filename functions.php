<?php
ob_start();
global $userdata;
wp_get_current_user();


$thisURL = 'http' . ((!empty($_SERVER['HTTPS'])) ? 's' : '') . '://'.$_SERVER['SERVER_NAME'].$_SERVER['REQUEST_URI'];

if ( function_exists( 'add_theme_support' ) ) { // Added in 2.9
	add_theme_support( 'post-thumbnails' );
	set_post_thumbnail_size( 360, 240, true ); // Normal post thumbnails
	add_image_size( 'fullpost', 1110, 9999, true ); //fullpost
	add_image_size( 'featured', 640, 400, true ); //fullpost
	add_image_size( 'avatar', 60, 60, true ); // avatar
	add_image_size( 'gallery', 359, 686, true ); // homepage gallery
	add_image_size( 'gallery-small', 359, 336, true ); // homepage gallery small
	add_image_size( 'gallery-top', 1296, 320, true ); // homepage gallery
	add_image_size( 'front-page', 360, 240, true ); // homepage blog posts
}

$template_path = get_bloginfo('template_directory');

add_theme_support( 'title-tag' );
add_theme_support( 'menus' );
register_nav_menu( 'primary', 'Top Nav' );
register_nav_menu( 'topfooter', 'Top Footer' );
register_nav_menu( 'bottomfooter', 'Bottom Footer' );

require_once('wp_bootstrap_navwalker.php');

add_filter( 'shortcode_atts_wpcf7', 'custom_shortcode_atts_wpcf7_filter', 10, 3 );
 
function custom_shortcode_atts_wpcf7_filter( $out, $pairs, $atts ) {
  $my_attr = 'campaign';
 
  if ( isset( $atts[$my_attr] ) ) {
    $out[$my_attr] = $atts[$my_attr];
  }
 
  return $out;
}

add_filter( 'shortcode_atts_wpcf7', 'custom_shortcode_atts_wpcf7_filter2', 10, 3 );
 
function custom_shortcode_atts_wpcf7_filter2( $out, $pairs, $atts ) {
  $my_attr = 'iprefertosupport';
 
  if ( isset( $atts[$my_attr] ) ) {
    $out[$my_attr] = $atts[$my_attr];
  }
 
  return $out;
}

// FIX VIMEO

function fixEmbed($oembvideo, $url, $attr) {
	if(strpos($url,'vimeo.com')!== false) {
	  // check if url is for Vimeo video
	  $width = 0;
	  $height = 0;
	  $newheight = 0;
	  $attrstart = strpos($oembvideo,'width="');
	  if($attrstart !== false) {
		$attrstart += 7;
		$width = substr($oembvideo, $attrstart, strpos($oembvideo,'"',$attrstart+1)-$attrstart);
		$attrstart = strpos($oembvideo,'height="');
		if(($attrstart !== false) && $width>0) {
	  $attrstart += 8;
		  $height = substr($oembvideo, $attrstart, strpos($oembvideo,'"',$attrstart+1)-$attrstart);
		  $newheight = round($height*$attr['width']/$width);
		  $oembvideo = str_replace('height="'.$height,'height="'.$newheight, str_replace('width="'.$width,'width="'.$attr['width'], $oembvideo));
		}
	  }
	}
	return $oembvideo;
  }
  add_filter('embed_oembed_html', 'fixEmbed', 10, 3);

// CF7 DISABLE AUTO P //

add_filter('wpcf7_autop_or_not', '__return_false');

// custom query to exclude the sticky in archive's pagination

function paged_num( $query ) {
    if ( ! is_admin() && $query->is_main_query() && is_paged() ) {
        // Display 50 posts for a custom post type called 'movie'
        $query->set( 'posts_per_page', 10 );
        return;
    }
}
add_action( 'pre_get_posts', 'paged_num', 1 );


// exclude categories

function exclude_post_categories($excl='', $spacer=' ') {
	$categories = get_the_category(get_the_ID());
	if (!empty($categories)) {
	  $exclude = $excl;
	  $exclude = explode(",", $exclude);
	  $thecount = count(get_the_category()) - count($exclude);
	  foreach ($categories as $cat) {
		$html = '';
		if (!in_array($cat->cat_ID, $exclude)) {
		  $html .= '<a href="' . get_category_link($cat->cat_ID) . '" ';
		  $html .= 'title="' . $cat->cat_name . '">' . $cat->cat_name . '</a>';
		  if ($thecount > 0) {
			$html .= $spacer;
		  }
		  $thecount--;
		  echo $html;
		}
	  }
	}
  }
  

  // get rid of stickies when needed

  add_action( 'pre_get_posts', function ( $q ) {
    if ( !is_admin()
         && $q->is_main_query()
         && !$q->is_home()
         && !$q->is_tag()
         && !$q->is_search()
         && !$q->is_page()
         && !$q->is_single()
    ) {

      function is_existing_cat($q_catName) {
           $existingCats = get_categories();
           $isExistingCat = false;

           foreach ($existingCats as $cat) {
                if ($cat->name == $q_catName) {
                     $isExistingCat = true;
                }
           }

           return $isExistingCat;
      }

        if ($q->is_category() && !$q->is_paged() && is_existing_cat($q->query['category_name'])) {

            $q->set( 'post__not_in', get_option( 'sticky_posts' ) );

            add_filter( 'the_posts', function ( $posts ) {
                $catName = get_category(get_query_var('cat'))->name;
                $catID = get_cat_ID($catName);

                if ( !empty(get_option( 'sticky_posts' )) ) {
                    $stickies = get_posts( [
                        'category' => $catID,
                        'post__in' => get_option( 'sticky_posts' )
                    ] );

                    $posts = array_merge( $stickies, $posts );
                }

                return $posts;

            }, 10, 2);
        }
    }
});


if ( function_exists('register_sidebar') )

register_sidebar(array(
'id' => 'footer_widget1',
'name'        => __( 'Footer Col 1' ),
'description' => __( 'This is the widget we use for the footer area if needed'),
'before_widget' => '<div id="%1$s" class="widget %2$s">',
'after_widget' => '</div>',
'before_title' => '<h4>',
'after_title' => '</h4>',
));
register_sidebar(array(
'id' => 'footer_widget2',
'name'        => __( 'Footer Col 2' ),
'description' => __( 'This is the widget we use for the footer area if needed'),
'before_widget' => '<div id="%1$s" class="widget %2$s">',
'after_widget' => '</div>',
'before_title' => '<h4>',
'after_title' => '</h4>',
));
register_sidebar(array(
'id' => 'footer_widget3',
'name'        => __( 'Footer Col 3' ),
'description' => __( 'This is the widget we use for the footer area if needed'),
'before_widget' => '<div id="%1$s" class="widget %2$s">',
'after_widget' => '</div>',
'before_title' => '<h4>',
'after_title' => '</h4>',
));
register_sidebar(array(
'id' => 'footer_widget4',
'name'        => __( 'Footer Col 4' ),
'description' => __( 'This is the widget we use for the footer area if needed'),
'before_widget' => '<div id="%1$s" class="widget %2$s">',
'after_widget' => '</div>',
'before_title' => '<h4>',
'after_title' => '</h4>',
));

register_sidebar(array(
'id' => 'sidebar_widget',
'name'        => __( 'Sidebar Widgets' ),
'description' => __( 'This is the widget we use for the sidebar area if needed'),
'before_widget' => '<div id="%1$s" class="widget %2$s">',
'after_widget' => '</div>',
'before_title' => '<h4>',
'after_title' => '</h4>',
));
register_sidebar(array(
'id' => 'sidebar_blog',
'name'        => __( 'Sidebar Blog' ),
'description' => __( 'This is the widget used for the blog sidebar '),
'before_widget' => '<div id="%1$s" class="widget %2$s">',
'after_widget' => '</div>',
'before_title' => '<h4>',
'after_title' => '</h4>',
));

// FIX widgets headers
add_action( 'after_setup_theme', function() { 
	add_action( 'register_sidebar', function( $sidebar )
	{
    	global $wp_registered_sidebars;
	
	    $id = $sidebar[ 'id' ];
	    $sidebar[ 'before_title' ] = '<h3 class="widget-title subheading heading-size-3">';
	    $sidebar[ 'after_title' ] = '</h3>';

	    $wp_registered_sidebars[ $id ] = $sidebar;
	});
});

// ACF Stuff

if( function_exists('acf_add_options_page') ) {
	
	acf_add_options_page();
	
}
function acf_change_icon_on_files ( $icon, $mime, $attachment_id ){ // Display thumbnail instead of document.png
		
		if ( strpos( $_SERVER[ 'REQUEST_URI' ], '/wp-admin/upload.php' ) === false && $mime === 'application/pdf' ){
			$get_image = wp_get_attachment_image_src ( $attachment_id, 'thumbnail' );
			if ( $get_image ) {
				$icon = $get_image[0];
			} 
		}
		return $icon;
	}
	
	add_filter( 'wp_mime_type_icon', 'acf_change_icon_on_files', 10, 3 );

//

add_action('init', 'my_custom_init');
function my_custom_init() {
	add_post_type_support( 'page', 'excerpt' );
}




function new_excerpt_length($length) {
	return 50;
}
add_filter('excerpt_length', 'new_excerpt_length');

function the_titlesmall($before = '', $after = '', $echo = true, $length = false) { $title = get_the_title();

	if ( $length && is_numeric($length) ) {
		$title = substr( $title, 0, $length );
	}

	if ( strlen($title)> 0 ) {
		$title = apply_filters('the_titlesmall', $before . $title . $after, $before, $after);
		if ( $echo )
			echo $title;
		else
			return $title;
	}
}

function content($limit) {
  $content = explode(' ', get_the_content(), $limit);
  if (count($content)>=$limit) {
    array_pop($content);
    $content = implode(" ",$content).' ... ';
  } else {
    $content = implode(" ",$content);
  }	
  $content = preg_replace('/\[.+\]/','', $content);
  $content = apply_filters('the_content', $content); 
  $content = str_replace(']]>', ']]&gt;', $content);
  return $content;
}

function setName(){
	global $current_user;
	wp_get_current_user();
	if($current_user->user_firstname != '' || $current_user->user_lastname != ''){
		$value = "$current_user->user_firstname $current_user->user_lastname";
	} else {
		$value = "$current_user->user_login";
	}
	if(is_page('feedback')){
		echo "<script type='text/javascript'>";
		echo "jQuery(document).ready(function(){";
		echo "jQuery('#cf_field_1').val('$value')";
		echo "})";
		echo "</script>";
	}
}
add_action('wp_head', 'setName');

// function to display number of posts.
function getPostViews($postID){
    $count_key = 'post_views_count';
    $count = get_post_meta($postID, $count_key, true);
    if($count==''){
        delete_post_meta($postID, $count_key);
        add_post_meta($postID, $count_key, '0');
        return "0 View";
    }
    return $count.' Views';
}

// function to count views.
function setPostViews($postID) {
    $count_key = 'post_views_count';
    $count = get_post_meta($postID, $count_key, true);
    if($count==''){
        $count = 0;
        delete_post_meta($postID, $count_key);
        add_post_meta($postID, $count_key, '0');
    }else{
        $count++;
        update_post_meta($postID, $count_key, $count);
    }
}

function get_parent_category()
{
  foreach ((get_the_category()) as $cat)
  {
    if ($cat->category_parent)
      return $cat->category_parent;
    else
      return $cat->cat_ID;
  }
}

class BS3_Walker_Nav_Menu extends Walker_Nav_Menu {
	/**
	 * Traverse elements to create list from elements.
	 *
	 * Display one element if the element doesn't have any children otherwise,
	 * display the element and its children. Will only traverse up to the max
	 * depth and no ignore elements under that depth. It is possible to set the
	 * max depth to include all depths, see walk() method.
	 *
	 * This method shouldn't be called directly, use the walk() method instead.
	 *
	 * @since 2.5.0
	 *
	 * @param object $element Data object
	 * @param array $children_elements List of elements to continue traversing.
	 * @param int $max_depth Max depth to traverse.
	 * @param int $depth Depth of current element.
	 * @param array $args
	 * @param string $output Passed by reference. Used to append additional content.
	 * @return null Null on failure with no changes to parameters.
	 */
	function display_element( $element, &$children_elements, $max_depth, $depth, $args, &$output ) {
		$id_field = $this->db_fields['id'];
 
		if ( isset( $args[0] ) && is_object( $args[0] ) )
		{
			$args[0]->has_children = ! empty( $children_elements[$element->$id_field] );
 
		}
 
		return parent::display_element( $element, $children_elements, $max_depth, $depth, $args, $output );
	}
 
	/**
	 * @see Walker::start_el()
	 * @since 3.0.0
	 *
	 * @param string $output Passed by reference. Used to append additional content.
	 * @param object $item Menu item data object.
	 * @param int $depth Depth of menu item. Used for padding.
	 * @param int $current_page Menu item ID.
	 * @param object $args
	 */
	function start_el( &$output, $item, $depth = 0, $args = array(), $id = 0 ) {
		if ( is_object($args) && !empty($args->has_children) )
		{
			$link_after = $args->link_after;
			$args->link_after = ' <b class="caret"></b>';
		}
 
		parent::start_el($output, $item, $depth, $args, $id);
 
		if ( is_object($args) && !empty($args->has_children) )
			$args->link_after = $link_after;
	}
 
	/**
	 * @see Walker::start_lvl()
	 * @since 3.0.0
	 *
	 * @param string $output Passed by reference. Used to append additional content.
	 * @param int $depth Depth of page. Used for padding.
	 */
	function start_lvl( &$output, $depth = 0, $args = array() ) {
		$indent = str_repeat("t", $depth);
		$output .= $indent . '<ul class="dropdown-menu list-unstyled"></ul>';
	}
}



    /**
     *----------------- Add Featured Images to Page List Views in Admin Area -------------------
    **/
     
    // Add the posts and pages columns filter. They can both use the same function.
    add_filter('manage_posts_columns', 'tcb_add_post_thumbnail_column', 5);
    add_filter('manage_pages_columns', 'tcb_add_post_thumbnail_column', 5);
     
    // Add the column
    function tcb_add_post_thumbnail_column($cols){
    $cols['tcb_post_thumb'] = __('Featured');
    return $cols;
    }
     
    // Hook into the posts an pages column managing. Sharing function callback again.
    add_action('manage_posts_custom_column', 'tcb_display_post_thumbnail_column', 5, 2);
    add_action('manage_pages_custom_column', 'tcb_display_post_thumbnail_column', 5, 2);
     
    // Grab featured-thumbnail size post thumbnail and display it.
    function tcb_display_post_thumbnail_column($col, $id){
    switch($col){
    case 'tcb_post_thumb':
    if( function_exists('the_post_thumbnail') )
    echo the_post_thumbnail( );
    else
    echo 'Not supported in theme';
    break;
    }
    }
	
	/** HIDE PASSWORD PROTECTED POSTS  **/
	function wpb_password_post_filter( $where = '' ) {
    if (!is_single() && !is_admin()) {
        $where .= " AND post_password = ''";
    }
    return $where;
}

function title_filter( $where, &$wp_query ){
    global $wpdb;
    if ( $search_term = $wp_query->get( 'search_prod_title' ) ) {
        $where .= ' AND ' . $wpdb->posts . '.post_title LIKE \'%' . esc_sql( like_escape( $search_term ) ) . '%\'';
    }
    return $where;
}

function search_data() {
	$query = $_POST['query'];
	/*global $wpdb;
	$result = $wpdb->get_results("SELECT * FROM alz_posts where post_type='gallerys' and post_status = 'publish' and post_title like '".$query."%' ORDER BY id DESC");
	print_r($result);*/
	$args = array(
            
		'post_type' => 'gallerys',
		'post_status' => 'publish',
		'orderby' => 'title',
		'order'   => 'ASC',
		'search_prod_title' => $query
	);
	//$blog_posts = new WP_Query( $args );
	add_filter( 'posts_where', 'title_filter', 10, 2 );
	$blog_posts = new WP_Query($args);
	remove_filter( 'posts_where', 'title_filter', 10, 2 );
	?>

 
 <?php if ( $blog_posts->have_posts() ) : ?>
	 
		 <?php while ( $blog_posts->have_posts() ) : $blog_posts->the_post(); ?>
		 <div class="col-6 col-sm-6 col-lg-2 col-xl-2" >
		 <?php 
		 $i = $i+1;
			 $featured_img_url = get_the_post_thumbnail_url(get_the_ID(),'full'); 
			 if ($featured_img_url == "") {
			 $featured_img_url = get_template_directory_uri().'/images/default-image.png';
			 }
		 ?>
			 <a class="item-gallery" class="" bs-data-toggle="modal" bs-data-target="#gallerry-<?php echo get_the_ID(); ?>">
				 <img class="img-fluid img-content" src="<?= $featured_img_url; ?>" alt="">
				 <div class="overlay">
					 <div>
					 <span><?= the_title(); ?></span>
					
					 
					 </div>
				 </div>
			 </a>
			 <div class="modal fade  " id="gallerry-<?php echo get_the_ID(); ?><?= $paged ?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
				 <div class="modal-dialog modal-xl modal-dialog-centered " role="document">
					 <div class="modal-content">
						 <button type="button" class="close" data-dismiss="modal" aria-label="Close">
						 <span aria-hidden="true">&times;</span>
						 </button>
						 <div class="modal-body">
							 
							 <div class="row">
								 <div class="col-lg-6">
								 <img class="img-fluid img-modal" src="<?= $featured_img_url; ?>" alt="">
								 </div>
								 <div class="col-lg-6">
									 <div class="col-lg-1">

									 </div>
									 <div class="col-lg-10">
										 <div class="box">
											 <h2><?php the_title(); ?></h2>
											 <br>
											 <br>
											 <?php the_content(); ?>
											 <!-- <button type="button" class="next-modal btn-next">Next</button> -->
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
			 </div>
		 <?php endwhile; ?>
 
 <?php endif;

 wp_die();
}
add_action('wp_ajax_search_data', 'search_data');
add_action('wp_ajax_nopriv_search_data', 'search_data');


function misha_my_load_more_scripts() {
 
	global $wp_query; 
 
	// In most cases it is already included on the page and this line can be removed
	// wp_enqueue_script('jquery');
 
	// register our main script but do not enqueue it yet
	wp_register_script( 'my_loadmore', get_stylesheet_directory_uri() . '/myloadmore.js', array('jquery') );
 
	// now the most interesting part
	// we have to pass parameters to myloadmore.js script but we can get the parameters values only in PHP
	// you can define variables directly in your HTML but I decided that the most proper way is wp_localize_script()
	wp_localize_script( 'my_loadmore', 'misha_loadmore_params', array(
		'ajaxurl' => site_url() . '/wp-admin/admin-ajax.php', // WordPress AJAX
		'posts' => json_encode( $wp_query->query_vars ), // everything about your loop is here
		'current_page' => get_query_var( 'paged' ) ? get_query_var('paged') : 2,
		'max_page' => $wp_query->max_num_pages
	) );
 
 	wp_enqueue_script( 'my_loadmore' );
}
add_action( 'wp_enqueue_scripts', 'misha_my_load_more_scripts' );

function misha_loadmore_ajax_handler(){
 
	// prepare our arguments for the query
	$args = json_decode( stripslashes( $_POST['query'] ), true );
	$args['paged'] = $_POST['page'] + 1; // we need next page to be loaded
	$args['post_status'] = 'publish';
 
	// it is always better to use WP_Query but not here
	query_posts( $args );
 
	if( have_posts() ) :
 
		// run the loop
		while( have_posts() ): the_post();
 
			// look into your theme code how the posts are inserted, but you can use your own HTML of course
			// do you remember? - my example is adapted for Twenty Seventeen theme
			get_template_part( 'template-parts/post/content', get_post_format() );
			// for the test purposes comment the line above and uncomment the below one
			// the_title();
 
 
		endwhile;
 
	endif;
	die; // here we exit the script and even no wp_reset_query() required!
}
 
 
 
//add_action('wp_ajax_loadmore', 'misha_loadmore_ajax_handler'); // wp_ajax_{action}
//add_action('wp_ajax_nopriv_loadmore', 'misha_loadmore_ajax_handler'); // wp_ajax_nopriv_{action}

add_action('wp_ajax_loadmore', 'load_posts_by_ajax_callback'); // wp_ajax_{action}
add_action('wp_ajax_nopriv_loadmore', 'load_posts_by_ajax_callback'); // wp_ajax_nopriv_{action}


add_filter( 'posts_where', 'wpb_password_post_filter' );
function load_posts_by_ajax_callback() {
    //check_ajax_referer('load_more_posts', 'security');
    $paged = $_POST['page'];
    $param = $_POST['param'];
    switch ($param) {
        case 'byname':
            $args = array(
            
                'post_type' => 'gallerys',
                'post_status' => 'publish',
                'posts_per_page' => '24',
                'orderby' => 'title',
                'order'   => 'ASC',
                'paged' => $paged,
            );
            break;
        case 'newest':
            $args = array(
                'post_type' => 'gallerys',
                'post_status' => 'publish',
                'posts_per_page' => '24',
                'paged' => $paged,
            );
            break;
        default:
        $args = array(
            'post_type' => 'gallerys',
            'post_status' => 'publish',
            'posts_per_page' => '24',
            'paged' => $paged,
        );
    }
 
	$i=0;
    $blog_posts = new WP_Query( $args );
	//echo "Last SQL-Query: {$blog_posts->request}";
	//print_r($blog_posts);
	//echo $blog_posts->last_query; exit;
    ?>
 
	<?php if ( $blog_posts->have_posts() ) : ?>
		
			<?php while ( $blog_posts->have_posts() ) : $blog_posts->the_post(); ?>
			<div class="col-6 col-sm-6 col-lg-2 col-xl-2" >
			<?php 
			$i = $i+1;
				$featured_img_url = get_the_post_thumbnail_url(get_the_ID(),'full'); 
				if ($featured_img_url == "") {
				$featured_img_url = get_template_directory_uri().'/images/default-image.png';
				}
			?>
				<a class="item-gallery" class="" bs-data-toggle="modal" bs-data-target="#gallerry-<?php echo get_the_ID(); ?>">
					<img class="img-fluid img-content" src="<?= $featured_img_url; ?>" alt="">
					<div class="overlay">
						<div>
                        <span><?= the_title(); ?></span>
                       
                        
						</div>
					</div>
				</a>
				<div class="modal fade  " id="gallerry-<?php echo get_the_ID(); ?><?= $paged ?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
					<div class="modal-dialog modal-xl modal-dialog-centered " role="document">
						<div class="modal-content">
							<button type="button" class="close" data-dismiss="modal" aria-label="Close">
							<span aria-hidden="true">&times;</span>
							</button>
							<div class="modal-body">
								
								<div class="row">
									<div class="col-lg-6">
									<img class="img-fluid img-modal" src="<?= $featured_img_url; ?>" alt="">
									</div>
									<div class="col-lg-6">
										<div class="col-lg-1">

										</div>
										<div class="col-lg-10">
											<div class="box">
												<h2><?php the_title(); ?></h2>
												<br>
												<br>
												<?php the_content(); ?>
												<!-- <button type="button" class="next-modal btn-next">Next</button> -->
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
				</div>
			<?php endwhile; ?>
	
	<?php endif;
 
    wp_die();
}
