<?php
/**
 * The template for Menus
 *
 * @package Catch Themes
 * @subpackage Clean Education
 * @since Clean Education 0.1
 */


if ( ! function_exists( 'clean_education_primary_menu' ) ) :
    /**
     * Shows Primary Menu
     *
     * @since Clean Education 0.1
     */
    function clean_education_primary_menu() {
        ?>
        <button id="menu-toggle-primary" class="menu-toggle"><?php esc_html_e( 'Menu', 'clean-education' ); ?></button>

        <div id="site-header-menu-primary" class="site-header-menu">
                <nav id="site-navigation-primary" class="main-navigation" role="navigation" aria-label="<?php esc_attr_e( 'Primary Menu', 'clean-education' ); ?>">
                <h3 class="screen-reader-text"><?php _e( 'Primary menu', 'clean-education' ); ?></h3>
                    <?php
                        if ( has_nav_menu( 'primary' ) ) {
                            $args = array(
                                'theme_location'    => 'primary',
                                'menu_class'        => 'menu primary-menu',
                                'container'         => false
                            );
                            wp_nav_menu( $args );
                        }
                        else {
                            wp_page_menu( array( 'menu_class'  => 'default-page-menu' ) );
                        }
                    ?>
                </nav><!-- .main-navigation -->
        </div><!-- .site-header-menu -->
    <?php
    }
endif;
add_action( 'clean_education_header', 'clean_education_primary_menu', 60 );



/**
 * Add ID and CLASS attributes to the first <ul> occurence in wp_page_menu
 *
 * @since Clean Education 0.1
 */
function clean_education_add_menuclass( $ulclass ) {
  return preg_replace( '/<ul>/', '<ul id="wp-page-menu" class="menu primary-menu">', $ulclass, 1 );
}
add_filter( 'wp_page_menu', 'clean_education_add_menuclass', 90 );


/**
 * Get our wp_nav_menu() fallback, wp_page_menu(), to show a home link.
 *
 * @since Clean Education 0.1
 */
function clean_education_page_menu_args( $args ) {
    $args['show_home'] = true;
    return $args;
}
add_filter( 'wp_page_menu_args', 'clean_education_page_menu_args' );