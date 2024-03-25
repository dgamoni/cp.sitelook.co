<?php
/**
 * The header for our theme
 *
 * This is the template that displays all of the <head> section and everything up until <div id="content">
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package WP_Bootstrap_Starter
 */

?><!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
    <meta charset="<?php bloginfo( 'charset' ); ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <link rel="profile" href="http://gmpg.org/xfn/11">
    <link rel="pingback" href="<?php bloginfo( 'pingback_url' ); ?>">
<?php wp_head(); ?>
</head>

<body <?php body_class(); ?>>
<div id="page" class="site">
	<a class="skip-link screen-reader-text" href="#content"><?php esc_html_e( 'Skip to content', 'wp-bootstrap-starter' ); ?></a>
    <?php if(!is_page_template( 'blank-page.php' ) && !is_page_template( 'blank-page-with-container.php' )): ?>
	<header id="masthead" class="site-header navbar-static-top navbar-dark bg-primary p-0" role="banner">

        <?php
        if ( is_active_sidebar( 'top-left-menu' ) || is_active_sidebar( 'top-right-social' ) || is_active_sidebar( 'top-right-search' ) ) {?>
                <div id="top-header-widgets" class="row m-0">
                    <div class="container">
                        <div class="row">
                            <?php if ( is_active_sidebar( 'top-left-menu' )) : ?>
                                <div id="top-header-menu" class="col-12 col-md-6 pt-1 pb-1"><?php dynamic_sidebar( 'top-left-menu' ); ?></div>
                            <?php endif; ?>
                            <?php if ( is_active_sidebar( 'top-right-social' )) : ?>
                                <div id="social-container" class="col-6 col-md-3 pt-1 pb-1"><?php dynamic_sidebar( 'top-right-social' ); ?></div>
                            <?php endif; ?>
                            <?php if ( is_active_sidebar( 'top-right-search' )) : ?>
                                <div id="search-container" class="col-6 col-md-3 pt-1 pb-1"><?php dynamic_sidebar( 'top-right-search' ); ?></div>
                            <?php endif; ?>
                        </div>
                    </div>
                </div>

        <?php }
        ?>

        <div class="container">
            <nav class="navbar navbar-expand-xl m-0 pt-3 pb-3">
                <div class="row col-12">
                    <div class="col-6 col-md-3">
                        <div class="navbar-brand">
                            <?php if ( get_theme_mod( 'wp_bootstrap_starter_logo' ) ): ?>
                                <a href="<?php echo esc_url( home_url( '/' )); ?>">
                                    <img src="<?php echo esc_attr(get_theme_mod( 'wp_bootstrap_starter_logo' )); ?>" alt="<?php echo esc_attr( get_bloginfo( 'name' ) ); ?>">
                                </a>
                            <?php else : ?>
                                <a class="site-title" href="<?php echo esc_url( home_url( '/' )); ?>"><?php esc_url(bloginfo('name')); ?></a>
                            <?php endif; ?>
                        </div>
                    </div>
                    <div class="col-6 col-md-3">
                        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#main-nav" aria-controls="" aria-expanded="false" aria-label="Toggle navigation">
                            <span class="navbar-toggler-icon"></span>
                        </button>

                        <?php
                        wp_nav_menu(array(
                        'theme_location'    => 'primary',
                        'container'       => 'div',
                        'container_id'    => 'main-nav',
                        'container_class' => 'collapse navbar-collapse justify-content-end',
                        'menu_id'         => false,
                        'menu_class'      => 'navbar-nav',
                        'depth'           => 3,
                        'fallback_cb'     => 'wp_bootstrap_navwalker::fallback',
                        'walker'          => new wp_bootstrap_navwalker()
                        ));
                        ?>
                    </div>
                    <div id="user-menu-container" class="col-12 col-md-6">
                         <?php if ( is_active_sidebar( 'user-menu' )) dynamic_sidebar( 'user-menu' ); ?>
                    </div>
                </div>
            </nav>
        </div>
	</header><!-- #masthead -->

    <?php if(is_front_page() && !get_theme_mod( 'header_banner_visibility' )): ?>
        <div id="page-sub-header" <?php if(has_header_image()) { ?>style="background-image: url('<?php header_image(); ?>');" <?php } ?>>
            <div class="container">
                <h1>
                    <?php
                    if(get_theme_mod( 'header_banner_title_setting' )){
                        echo get_theme_mod( 'header_banner_title_setting' );
                    }else{
                        echo 'Wordpress + Bootstrap';
                    }
                    ?>
                </h1>
                <p>
                    <?php
                    if(get_theme_mod( 'header_banner_tagline_setting' )){
                        echo get_theme_mod( 'header_banner_tagline_setting' );
                }else{
                        echo esc_html__('To customize the contents of this header banner and other elements of your site, go to Dashboard > Appearance > Customize','wp-bootstrap-starter');
                    }
                    ?>
                </p>
            </div>

            <a href='/therapy' class='btn yellow'>Therapy Options <i class="fa fa-arrow-right"></i></a>
            <a href='/resources' class='btn transparent'>Resources <i class="fa fa-arrow-right"></i></a>

            <div id="promote-container" class="container">
                <div class="row">
                    <div class="col-6 col-md-3 promote promote-1">
<h3>FOR CATHOLICS</h3>
The best of the psychological sciences is now integrated with thousands of years of Catholic philosophy and theology.
                    </div>
                    <div class="col-6 col-md-3 promote promote-2">
<h3>GROWING NETWORK OF THERAPISTS</h3>
We have a growing number of locations throughout the eastern United States.
                    </div>
                    <div class="col-6 col-md-3 promote promote-3">
<h3>ONLINE THERAPY</h3>
Not near one of our occife locations? That’s ok - we offer online, virtual theraphy,
                    </div>
                    <div class="col-6 col-md-3 promote promote-4">
<h3>SELF-HELP RESOURCES</h3>
In-depth topical articles, book recommendations and self-paced online video courses.
                    </div>
                </div>
                <!--
                    <a href="#content" class="page-scroller"><i class="fa fa-fw fa-angle-down"></i></a>
                -->
            </div>
        </div>
    <?php endif; ?>

    <?php wp_bootstrap_starter_sitelook_featured_image();?>
 
	<div id="content" class="site-content <?php if(is_front_page()) echo ' frontpage';?>">
        <?php if(!is_front_page()):?>
		  <div class="container">
		  	<div class="row">
            <?php endif; ?>
                <?php endif; ?>