<?php

/**
 * @package WordPress
 * @subpackage R2Endalz
 */
?>
<!DOCTYPE html>
<html lang="en">


<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="revisit-after" content="1 day" />
    <meta name="rating" content="General" />


    <link rel="apple-touch-icon" sizes="180x180" href="<?php bloginfo('template_directory'); ?>/favicon/apple-touch-icon.png">
    <link rel="icon" type="image/png" sizes="32x32" href="<?php bloginfo('template_directory'); ?>/favicon/favicon-32x32.png">
    <link rel="icon" type="image/png" sizes="16x16" href="<?php bloginfo('template_directory'); ?>/favicon/favicon-16x16.png">
    <link rel="manifest" href="<?php bloginfo('template_directory'); ?>/favicon/site.webmanifest">
    <link rel="mask-icon" href="<?php bloginfo('template_directory'); ?>/favicon/safari-pinned-tab.svg" color="#7632ab">
    <link rel="shortcut icon" href="<?php bloginfo('template_directory'); ?>/favicon/favicon.ico">
    <meta name="msapplication-TileColor" content="#ffc40d">
    <meta name="msapplication-config" content="<?php bloginfo('template_directory'); ?>/favicon/browserconfig.xml">
    <meta name="theme-color" content="#ffffff">
    
    <script src="<?php bloginfo('template_directory'); ?>/js/modernizr-custom.js"></script>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-+0n0xVW2eSR5OomGNYDnhzAbDsOXxcvSN1TPprVMTNDbiYZCxYbOOl7+AMvyTG2x" crossorigin="anonymous">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@300;400;700&display=swap" rel="stylesheet">
    <link href="<?php bloginfo('template_directory'); ?>/style.css" rel="stylesheet">
    <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
      <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->

<!-- Google Tag Manager -->
<script>(function(w,d,s,l,i){w[l]=w[l]||[];w[l].push({'gtm.start':
new Date().getTime(),event:'gtm.js'});var f=d.getElementsByTagName(s)[0],
j=d.createElement(s),dl=l!='dataLayer'?'&l='+l:'';j.async=true;j.src=
'https://www.googletagmanager.com/gtm.js?id='+i+dl;f.parentNode.insertBefore(j,f);
})(window,document,'script','dataLayer','GTM-PSSBHGW');</script>
<!-- End Google Tag Manager -->
    <?php wp_head(); ?>

</head>

<body <?php body_class('class-name'); ?>>
<!-- Google Tag Manager (noscript) -->
<noscript><iframe src="https://www.googletagmanager.com/ns.html?id=GTM-PSSBHGW"
height="0" width="0" style="display:none;visibility:hidden"></iframe></noscript>
<!-- End Google Tag Manager (noscript) -->
<?php if (!is_page( 'donate' )) { ?>
    <?php if (have_rows('top_bar', 'option')) : ?>
        <div class="topBar">
            <?php while (have_rows('top_bar', 'option')) : the_row(); ?>
                <div class="topBarBox">
                    <p><?php the_sub_field('bar_text'); ?> </p>

                    <?php $button_link = get_sub_field('button_link'); ?>
                    <?php if ($button_link) { ?>
                        <a class="btn CTA" href="<?php echo $button_link; ?>"><?php the_sub_field('button_label'); ?></a>
                    <?php } ?>

                </div>
            <?php endwhile; ?>
        </div>
    <?php endif; ?>
    <!-- / TOP BAR -->
    <?php } ?>

    <header>

        <nav class="navbar navbar-expand-lg navbar-light bg-light">
            <div class="container">
              
                <a href="<?php bloginfo('url'); ?>" class="navbar-brand mr-auto"><img src="<?php bloginfo('template_directory'); ?>/images/logo.png" class="logo" alt="Racing to End Alzheimer's Logo "></a>

                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarScroll" aria-controls="navbarScroll" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>

                <?php
                wp_nav_menu(array(
                    'theme_location'  => 'primary',
                    'depth'           => 1, // 1 = no dropdowns, 2 = with dropdowns.
                    'container'       => 'div',
                    'container_class' => 'collapse navbar-collapse',
                    'container_id'    => 'navbarScroll',
                    'menu_class'      => 'navbar-nav ml-auto',
                    'fallback_cb'     => 'WP_Bootstrap_Navwalker::fallback',
                    'walker'          => new WP_Bootstrap_Navwalker(),
                ));
                ?>


            </div>
        </nav>
    </header>