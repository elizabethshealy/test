<?php
/**
 * The Header for our theme.
 *
 * Displays all of the <head> section and everything up till <div id="main">
 *
 * @package _tk
 */
?><!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
    <meta charset="<?php bloginfo('charset'); ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">

    <title><?php wp_title('|', true, 'right'); ?></title>

    <link rel="profile" href="http://gmpg.org/xfn/11">
    <link rel="pingback" href="<?php bloginfo('pingback_url'); ?>">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.0.10/css/all.css" integrity="sha384-+d0P83n9kaQMCwj8F4RJB66tzIwOKmrdb46+porD/OvrJ+37WqIM7UoBtwHO6Nlg" crossorigin="anonymous">
    <link href="https://fonts.googleapis.com/css?family=Lato" rel="stylesheet">
    <?php wp_head(); ?>
</head>

<body <?php body_class(); ?>>
<?php do_action('before'); ?>
<nav class="navbar navbar-expand-lg navbar-dark fixed-top" id="mainNav">
    <?php // substitute the class "container-fluid" below if you want a wider content area ?>
    <div class="container">
        <a class="navbar-brand js-scroll-trigger" href="<?php echo home_url(); ?>"><img src="<?php the_field('site_logo', 'option'); ?>"
                                                                        style="max-width:200px;"/>
      </a>


        <!-- .navbar-toggle is used as the toggle for collapsed navbar content -->
        <button class="navbar-toggler navbar-toggler-right" type="button" data-toggle="collapse"
                data-target="#navbarResponsive" aria-controls="navbarResponsive" aria-expanded="false"
                aria-label="Toggle navigation">
            <i class="fa fa-bars"></i>
        </button>
        <?php wp_nav_menu(
            array(
                'theme_location' => 'primary',
                'depth' => 2,
                'container' => 'div',
                'container_id' => 'navbarResponsive',
                'container_class' => 'collapse navbar-collapse',
                'menu_class' => 'navbar-nav ml-auto',
                'fallback_cb' => 'wp_bootstrap_navwalker::fallback',
                'menu_id' => 'main-menu',
                'walker' => new wp_bootstrap_navwalker()
            )
        ); ?>
    </div><!-- .container -->
</nav><!-- .site-navigation -->
<header id="masthead" class="site-header" role="banner">
   
</header>