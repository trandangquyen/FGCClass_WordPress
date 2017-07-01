<?php
/**
 * The header for our theme
 *
 * This is the template that displays all of the <head> section and everything up until <div id="content">
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package beautifulclass
 */
?><!DOCTYPE html>
<html <?php language_attributes(); ?>>
    <head>
        <meta charset="<?php bloginfo('charset'); ?>">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="profile" href="http://gmpg.org/xfn/11">

        <?php wp_head(); ?>
        <link rel="shortcut icon" href="<?php echo get_template_directory_uri(); ?>/images/template/fav.ico.png">
        <link rel="apple-touch-icon image_src" href="images/template/fav.ico.png">
        <link href="https://fonts.googleapis.com/css?family=Roboto" rel="stylesheet">
    </head>

    <body <?php body_class(); ?>>
        <!-- Begin Header -->
        <div id="wrapper-container" class="wrapper-container">
            <div class="content-pusher">
                <?php
                header_customs();
                mobile_menu();
                ?>
                <!-- ================================================================================================== -->
                <?php ob_start(); ?>
                <div id="page" class="site">
                    <a class="skip-link screen-reader-text" href="#content"><?php esc_html_e('Skip to content', 'beautifulclass'); ?></a>

                    <header id="masthead" class="site-header" role="banner">
                        <div class="site-branding">
                            <?php if (is_front_page() && is_home()) : ?>
                                <style type="text/css">
                                    .site-header.bg-custom-sticky.affix, .site-header.header_v2.bg-custom-sticky.affix .width-navigation {

                                        background-color: rgba(255, 255, 255, 0);

                                    }
                                </style>
                                <h1 class="site-title"><a href="<?php echo esc_url(home_url('/')); ?>" rel="home"><?php bloginfo('name'); ?></a></h1>
                            <?php else : ?>
                                <style type="text/css">
                                    .site-header.bg-custom-sticky.affix, .site-header.header_v2.bg-custom-sticky.affix .width-navigation {

                                        background-color: #FFF;

                                    }
                                </style>
                                <p class="site-title"><a href="<?php echo esc_url(home_url('/')); ?>" rel="home"><?php bloginfo('name'); ?></a></p>
                            <?php
                            endif;

                            $description = get_bloginfo('description', 'display');
                            if ($description || is_customize_preview()) :
                                ?>
                                <p class="site-description"><?php echo $description; ?></p>
                            <?php endif;
                            ?>
                        </div><!--site-branding-->

                        <nav id="site-navigation" class="main-navigation" role="navigation">
                            <button class="menu-toggle" aria-controls="primary-menu" aria-expanded="false"><?php esc_html_e('Primary Menu', 'beautifulclass'); ?></button>
                            <?php wp_nav_menu(array('theme_location' => 'menu-1', 'menu_id' => 'primary-menu')); ?>
                        </nav><!-- #site-navigation-->
                    </header><!-- #masthead -->

                    <div id="content" class="site-content">
                        <?php
                        $html = ob_get_clean();
                        ?>

