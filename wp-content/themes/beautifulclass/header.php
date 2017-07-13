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
<meta charset="<?php bloginfo( 'charset' ); ?>">
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="profile" href="http://gmpg.org/xfn/11">

<?php wp_head(); ?>
	<link rel="shortcut icon" href="<?php echo get_template_directory_uri() ; ?>/images/template/fav.ico.png">
    <link rel="apple-touch-icon image_src" href="images/template/fav.ico.png">
    <link href="https://fonts.googleapis.com/css?family=Roboto" rel="stylesheet">
</head>

<body <?php body_class(); ?>>
    <!-- Begin Header -->
    <div id="wrapper-container" class="wrapper-container">
        <div class="content-pusher">
            <header id="masthead" class="site-header bg-custom-sticky sticky-header header_overlay header_v1 affix-top">
                <div id="toolbar" class="toolbar">
                    <div class="container">
                        <div class="row">
                            <div class="col-sm-12">
                                <div class="toolbar-container">
                                    <aside id="text-2" class="widget widget_text">
                                        <div class="textwidget">
                                            <div class="thim-have-any-question"> Have any question?
                                                <div class="mobile"><i class="fa fa-phone"></i><a href="tel:00123456789" class="value">(00) 123 456 789</a></div>
                                                <div class="email"><i class="fa fa-envelope"></i><a href="mailto:hello@eduma.com">hello@eduma.com</a></div>
                                            </div>
                                        </div>
                                    </aside>
                                    <aside id="login-popup-3" class="widget widget_login-popup">
                                        <div class="thim-widget-login-popup thim-widget-login-popup-base">
                                            <div class="thim-link-login thim-login-popup"> <a class="register" href="#">Register</a> <a class="login" href="#">Login</a></div>
                                            <div id="thim-popup-login" class="has-shortcode">
                                                <div class="thim-login-container">
                                                    <a href="#" style="display:none;"></a>
                                                    <a href="#" style="display:none;"></a>
                                                    <a href="#" style="display:none;"></a>
                                                    <a href="#" style="display:none;"></a>
                                                    <div class="mo-openid-app-icons">
                                                        <p style="color:#000000"> Login with social networks</p>
                                                        <a style="width: 240px !important;padding-top:11px !important;padding-bottom:11px !important;margin-bottom: -1px !important;border-radius: 4px !important;" class="btn btn-block btn-social btn-facebook btn-custom-dec login-button" onclick="moOpenIdLogin(&quot;facebook&quot;);"> <i style="padding-top:5px !important" class="fa fa-facebook"></i> Facebook</a>
                                                        <a style="width: 240px !important;padding-top:11px !important;padding-bottom:11px !important;margin-bottom: -1px !important;border-radius: 4px !important;" class="btn btn-block btn-social btn-google btn-custom-dec login-button" onclick="moOpenIdLogin(&quot;google&quot;);"> <i style="padding-top:5px !important" class="fa fa-google-plus"></i> Google</a>
                                                        <a style="width: 240px !important;padding-top:11px !important;padding-bottom:11px !important;margin-bottom: -1px !important;border-radius: 4px !important;" class="btn btn-block btn-social btn-twitter btn-custom-dec login-button" onclick="moOpenIdLogin(&quot;twitter&quot;);"> <i style="padding-top:5px !important" class="fa fa-twitter"></i> Twitter</a>
                                                        <a style="width: 240px !important;padding-top:11px !important;padding-bottom:11px !important;margin-bottom: -1px !important;border-radius: 4px !important;" class="btn btn-block btn-social btn-linkedin btn-custom-dec login-button" onclick="moOpenIdLogin(&quot;linkedin&quot;);"> <i style="padding-top:5px !important" class="fa fa-linkedin"></i> LinkedIn</a>
                                                    </div>
                                                    <br>
                                                    <div class="thim-login">
                                                        <h2 class="title">Login with your site account</h2>
                                                        <form name="loginform" id="loginform" action="#" method="post" data-dpmaxz-eid="1">
                                                            <p class="login-username">
                                                                <input type="text" name="user_login" placeholder="Username or email" id="thim_login" class="input" value="" size="20" data-dpmaxz-eid="2">
                                                            </p>
                                                            <p class="login-password">
                                                                <input type="password" name="user_password" placeholder="Password" id="thim_pass" class="input" value="" size="20" data-dpmaxz-eid="3"><span id="show_pass"><i class="fa fa-eye"></i></span></p> <a class="lost-pass-link" href="#">Lost your password?</a>
                                                            <p class="forgetmenot login-remember">
                                                                <label for="rememberme">
                                                                    <input name="rememberme" type="checkbox" id="rememberme" value="forever" data-dpmaxz-eid="4"> Remember Me </label>
                                                            </p>
                                                            <p class="submit login-submit">
                                                                <input type="submit" name="wp-submit" id="wp-submit" class="button button-primary button-large" value="Login" data-dpmaxz-eid="5">
                                                                <input type="hidden" name="redirect_to" value="http://educationwp.thimpress.com/">
                                                                <input type="hidden" name="testcookie" value="1">
                                                            </p>
                                                        </form>
                                                        <p class="link-bottom">Not a member yet? <a class="register" href="#">Register now</a></p>
                                                    </div> <span class="close-popup"><i class="fa fa-times" aria-hidden="true"></i></span></div>
                                            </div>
                                        </div>
                                    </aside>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="container">
                    <div class="row">
                        <div class="navigation col-sm-12">
                            <div class="tm-table">
                                <div class="width-logo table-cell sm-logo">
                                    <a href="<?php  echo get_site_url(); ?>" class="no-sticky-logo"><img src="<?php echo get_template_directory_uri() ;?>/images/logo.png" alt="Education WP"></a>
                                    <a href="<?php  echo get_site_url(); ?>" class="sticky-logo"><img src="<?php echo get_template_directory_uri() ;?>/images/logo-sticky.png" alt="Education WP"></a>
                                </div>
                                <nav class="width-navigation table-cell table-right">
	                                <?php echo wp_nav_menu( array( "theme_location" => "menu-1" ) ); ?>
                                </nav>
                                <div class="menu-mobile-effect navbar-toggle" data-effect="mobile-effect"> <span class="icon-bar"></span> <span class="icon-bar"></span> <span class="icon-bar"></span></div>
                            </div>
                        </div>
                    </div>
                </div>
            </header>
            <nav class="mobile-menu-container mobile-effect">
                <ul class="nav navbar-nav">
                    <li class="menu-item menu-item-type-custom menu-item-object-custom current-menu-ancestor menu-item-has-children menu-item-3404 tc-menu-item tc-menu-depth-0 tc-menu-align-left tc-menu-layout-column tc-menu-column-hide-title"><span class="tc-menu-inner">Demos</span><span class="icon-toggle"><i class="fa fa-angle-down"></i></span>
                        <div class="tc-megamenu-wrapper tc-megamenu-holder mega-sub-menu sub-menu tc-columns-3">
                            <ul class="row">
                                <li class="menu-item menu-item-type-custom menu-item-object-custom current-menu-ancestor current-menu-parent menu-item-has-children menu-item-6222 tc-menu-item tc-menu-depth-1 tc-menu-align-left col-md-4 col-sm-12"><a href="#" class="tc-megamenu-title">Group 1</a>
                                    <ul class="sub-menu">
                                        <li class="menu-item menu-item-type-custom menu-item-object-custom current-menu-item current_page_item menu-item-home menu-item-3407 tc-menu-item tc-menu-depth-2 tc-menu-align-left"><a href="#" class="tc-menu-inner">Demo Main Demo</a></li>
                                        <li class="menu-item menu-item-type-custom menu-item-object-custom menu-item-3405 tc-menu-item tc-menu-depth-2 tc-menu-align-left"><a href="#" class="tc-menu-inner">Demo Course Era</a></li>
                                        <li class="menu-item menu-item-type-custom menu-item-object-custom menu-item-3406 tc-menu-item tc-menu-depth-2 tc-menu-align-left"><a href="#" class="tc-menu-inner">Demo Online School</a></li>
                                        <li class="menu-item menu-item-type-custom menu-item-object-custom menu-item-6125 tc-menu-item tc-menu-depth-2 tc-menu-align-left"><a href="#" class="tc-menu-inner">Demo Languages School</a></li>
                                        <li class="menu-item menu-item-type-custom menu-item-object-custom menu-item-6225 tc-menu-item tc-menu-depth-2 tc-menu-align-left"><a href="#" class="tc-menu-inner">Demo Courses Hub</a></li>
                                    </ul>
                                </li>
                                <li class="menu-item menu-item-type-custom menu-item-object-custom menu-item-has-children menu-item-6223 tc-menu-item tc-menu-depth-1 tc-menu-align-left col-md-4 col-sm-12"><a href="#" class="tc-megamenu-title">Group 2</a>
                                    <ul class="sub-menu">
                                        <li class="menu-item menu-item-type-custom menu-item-object-custom menu-item-4028 tc-menu-item tc-menu-depth-2 tc-menu-align-left"><a href="#" class="tc-menu-inner">Demo Classic University</a></li>
                                        <li class="menu-item menu-item-type-custom menu-item-object-custom menu-item-4202 tc-menu-item tc-menu-depth-2 tc-menu-align-left"><a href="#" class="tc-menu-inner">Demo Modern University</a></li>
                                        <li class="menu-item menu-item-type-custom menu-item-object-custom menu-item-3435 tc-menu-item tc-menu-depth-2 tc-menu-align-left"><a href="#" class="tc-menu-inner">Demo Ivy League</a></li>
                                        <li class="menu-item menu-item-type-custom menu-item-object-custom menu-item-7597 tc-menu-item tc-menu-depth-2 tc-menu-align-left"><a href="#" class="tc-menu-inner">Demo Stanford</a></li>
                                        <li class="menu-item menu-item-type-custom menu-item-object-custom menu-item-6607 tc-menu-item tc-menu-depth-2 tc-menu-align-left"><a href="#" class="tc-menu-inner">Demo Kindergarten</a></li>
                                    </ul>
                                </li>
                                <li class="menu-item menu-item-type-custom menu-item-object-custom menu-item-has-children menu-item-6224 tc-menu-item tc-menu-depth-1 tc-menu-align-left col-md-4 col-sm-12"><a href="#" class="tc-megamenu-title">Group 3</a>
                                    <ul class="sub-menu">
                                        <li class="menu-item menu-item-type-custom menu-item-object-custom menu-item-3899 tc-menu-item tc-menu-depth-2 tc-menu-align-left"><a href="#" class="tc-menu-inner">Demo One Instructor</a></li>
                                        <li class="menu-item menu-item-type-custom menu-item-object-custom menu-item-3898 tc-menu-item tc-menu-depth-2 tc-menu-align-left"><a href="#" class="tc-menu-inner">Demo One Course</a></li>
                                        <li class="menu-item menu-item-type-custom menu-item-object-custom menu-item-7598 tc-menu-item tc-menu-depth-2 tc-menu-align-left"><a href="#" class="tc-menu-inner">Demo Boxed</a></li>
                                        <li class="menu-item menu-item-type-custom menu-item-object-custom menu-item-3436 tc-menu-item tc-menu-depth-2 tc-menu-align-left"><a href="#" class="tc-menu-inner">Demo RTL</a></li>
                                        <li class="menu-item menu-item-type-custom menu-item-object-custom menu-item-7599 tc-menu-item tc-menu-depth-2 tc-menu-align-left"><span class="tc-menu-inner">Coming Soon</span></li>
                                    </ul>
                                </li>
                            </ul>
                        </div>
                    </li>
                    <li class="menu-item menu-item-type-post_type menu-item-object-page menu-item-7682 tc-menu-item tc-menu-depth-0 tc-menu-align-left tc-menu-layout-builder"><a href="#">Courses</a>
                        <div class="tc-megamenu-wrapper tc-megamenu-holder mega-sub-menu sub-menu">
                            <div id="pl-tc-megamenu-7682" class="panel-layout">
                                <div id="pg-tc-megamenu-7682-0" class="panel-grid panel-has-style">
                                    <div class="thim-megamenu-row panel-row-style panel-row-style-for-tc-megamenu-7682-0">
                                        <div id="pgc-tc-megamenu-7682-0-0" class="panel-grid-cell">
                                            <div id="panel-tc-megamenu-7682-0-0-0" class="so-panel widget widget_nav_menu panel-first-child panel-last-child" data-index="0">
                                                <h3 class="widget-title">About Courses</h3>
                                                <div class="menu-about-courses-container">
                                                    <ul id="menu-about-courses-1" class="menu">
                                                        <li class="menu-item menu-item-type-post_type menu-item-object-lp_course menu-item-5739 tc-menu-item tc-menu-depth-0 tc-menu-layout-default"><a href="#">Free Access Type</a></li>
                                                        <li class="menu-item menu-item-type-post_type menu-item-object-lp_course menu-item-5741 tc-menu-item tc-menu-depth-0 tc-menu-layout-default"><a href="#">Other Free Type</a></li>
                                                        <li class="menu-item menu-item-type-post_type menu-item-object-lp_course menu-item-5740 tc-menu-item tc-menu-depth-0 tc-menu-layout-default"><a href="#">Paid Type</a></li>
                                                        <li class="menu-item menu-item-type-post_type menu-item-object-lp_course menu-item-5742 tc-menu-item tc-menu-depth-0 tc-menu-layout-default"><a href="#">Other Paid Type</a></li>
                                                        <li class="menu-item menu-item-type-post_type menu-item-object-page menu-item-7635 tc-menu-item tc-menu-depth-0 tc-menu-layout-default"><a href="#">Courses Archive</a></li>
                                                        <li class="menu-item menu-item-type-post_type menu-item-object-page menu-item-4389 tc-menu-item tc-menu-depth-0 tc-menu-layout-default"><a href="#">Demo Accounts</a></li>
                                                        <li class="menu-item menu-item-type-post_type menu-item-object-page menu-item-4391 tc-menu-item tc-menu-depth-0 tc-menu-layout-default"><a href="#">Become an Instructor</a></li>
                                                        <li class="menu-item menu-item-type-custom menu-item-object-custom menu-item-4392 tc-menu-item tc-menu-depth-0 tc-menu-layout-default"><a href="#" class="tc-menu-inner">Instructor Profile</a></li>
                                                    </ul>
                                                </div>
                                            </div>
                                        </div>
                                        <div id="pgc-tc-megamenu-7682-0-1" class="panel-grid-cell">
                                            <div id="panel-tc-megamenu-7682-0-1-0" class="so-panel widget widget_courses panel-first-child panel-last-child" data-index="1">
                                                <div class="thim-widget-courses thim-widget-courses-base">
                                                    <h3 class="widget-title">New Course</h3>
                                                    <div class="thim-course-megamenu">
                                                        <div class="lpr_course course-grid-1">
                                                            <div class="course-item">
                                                                <div class="course-thumbnail">
                                                                    <a href="#"><img src="images/course-4-450x450.jpg" alt="Introduction LearnPress – LMS plugin" title="course-4" width="450" height="450"></a>
                                                                </div>
                                                                <div class="thim-course-content">
                                                                    <h2 class="course-title"> <a href="#"> Introduction LearnPress – LMS plugin</a></h2>
                                                                    <div class="course-meta">
                                                                        <div class="course-price" itemprop="offers" itemscope="" itemtype="http://schema.org/Offer">
                                                                            <div class="value free-course" itemprop="price"> Free</div>
                                                                            <meta itemprop="priceCurrency" content="$">
                                                                        </div>
                                                                    </div> <a class="course-readmore" href="#">Read More</a></div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div id="pgc-tc-megamenu-7682-0-2" class="panel-grid-cell">
                                            <div id="panel-tc-megamenu-7682-0-2-0" class="so-panel widget widget_single-images panel-first-child panel-last-child" data-index="2">
                                                <div class="thim-widget-single-images thim-widget-single-images-base">
                                                    <div class="single-image text-left">
                                                        <a href="#"><img src="https://3ek5k1tux0822q3g83e30fye-wpengine.netdna-ssl.com/wp-content/uploads/2016/02/megamenu.jpg" width="252" height="359" alt=""></a>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </li>
                    <li class="menu-item menu-item-type-custom menu-item-object-custom menu-item-has-children menu-item-95 tc-menu-item tc-menu-depth-0 tc-menu-align-left tc-menu-layout-default"><span class="tc-menu-inner">Features</span><span class="icon-toggle"><i class="fa fa-angle-down"></i></span>
                        <ul class="sub-menu">
                            <li class="menu-item menu-item-type-post_type menu-item-object-page menu-item-6550 tc-menu-item tc-menu-depth-1 tc-menu-align-left"><a href="#">Membership</a></li>
                            <li class="menu-item menu-item-type-post_type menu-item-object-page menu-item-4451 tc-menu-item tc-menu-depth-1 tc-menu-align-left"><a href="#">Portfolio</a></li>
                            <li class="menu-item menu-item-type-post_type_archive menu-item-object-forum menu-item-3437 tc-menu-item tc-menu-depth-1 tc-menu-align-left"><a href="#">Forums</a></li>
                            <li class="menu-item menu-item-type-post_type menu-item-object-page menu-item-2924 tc-menu-item tc-menu-depth-1 tc-menu-align-left"><a href="#">About Us</a></li>
                            <li class="menu-item menu-item-type-post_type menu-item-object-page menu-item-96 tc-menu-item tc-menu-depth-1 tc-menu-align-left"><a href="#">FAQs</a></li>
                            <li class="menu-item menu-item-type-custom menu-item-object-custom menu-item-6418 tc-menu-item tc-menu-depth-1 tc-menu-align-left"><a href="#" class="tc-megamenu-title">Sidebar Shop</a></li>
                            <li class="menu-item menu-item-type-custom menu-item-object-custom menu-item-3126 tc-menu-item tc-menu-depth-1 tc-menu-align-left"><a href="#" class="tc-megamenu-title">404 Page</a></li>
                        </ul>
                    </li>
                    <li class="menu-item menu-item-type-post_type_archive menu-item-object-tp_event menu-item-7679 tc-menu-item tc-menu-depth-0 tc-menu-align-left tc-menu-layout-default"><a href="#">Events</a></li>
                    <li class="menu-item menu-item-type-post_type menu-item-object-page menu-item-4528 tc-menu-item tc-menu-depth-0 tc-menu-align-left tc-menu-layout-default"><a href="#">Gallery</a></li>
                    <li class="menu-item menu-item-type-post_type menu-item-object-page menu-item-127 tc-menu-item tc-menu-depth-0 tc-menu-align-left tc-menu-layout-default"><a href="#">Blog</a></li>
                    <li class="menu-item menu-item-type-post_type menu-item-object-page menu-item-99 tc-menu-item tc-menu-depth-0 tc-menu-align-left tc-menu-layout-default"><a href="#">Contact</a></li>
                    <li class="menu-item menu-item-type-post_type menu-item-object-page menu-item-1702 tc-menu-item tc-menu-depth-0 tc-menu-align-left tc-menu-layout-default"><a href="#">Shop</a></li>
                </ul>
            </nav>




<!-- ================================================================================================== -->
<?php
ob_start(); ?>
 <div id="page" class="site">
	<a class="skip-link screen-reader-text" href="#content"><?php esc_html_e( 'Skip to content', 'beautifulclass' ); ?></a>

	<header id="masthead" class="site-header" role="banner">
		<div class="site-branding">
			<?php
			if ( is_front_page() && is_home() ) : ?>
				<h1 class="site-title"><a href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home"><?php bloginfo( 'name' ); ?></a></h1>
			<?php else : ?>
				<p class="site-title"><a href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home"><?php bloginfo( 'name' ); ?></a></p>
			<?php
			endif;

			$description = get_bloginfo( 'description', 'display' );
			if ( $description || is_customize_preview() ) : ?>
				<p class="site-description"><?php echo $description;  ?></p>
			<?php
			endif; ?>
		</div>.site-branding

		<nav id="site-navigation" class="main-navigation" role="navigation">
			<button class="menu-toggle" aria-controls="primary-menu" aria-expanded="false"><?php esc_html_e( 'Primary Menu', 'beautifulclass' ); ?></button>
			<?php wp_nav_menu( array( 'theme_location' => 'menu-1', 'menu_id' => 'primary-menu' ) ); ?>
		</nav>#site-navigation
	</header>#masthead

	<div id="content" class="site-content">
	<?php 
	$html = ob_get_clean();



?>

