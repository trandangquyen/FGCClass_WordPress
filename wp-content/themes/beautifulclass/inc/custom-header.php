<?php
/**
 * Sample implementation of the Custom Header feature
 *
 * You can add an optional custom header image to header.php like so ...
 *
  <?php the_header_image_tag(); ?>
 *
 * @link https://developer.wordpress.org/themes/functionality/custom-headers/
 *
 * @package beautifulclass
 */

/**
 * Set up the WordPress core custom header feature.
 *
 * @uses beautifulclass_header_style()
 */
function beautifulclass_custom_header_setup() {
    add_theme_support('custom-header', apply_filters('beautifulclass_custom_header_args', array(
        'default-image' => '',
        'default-text-color' => '000000',
        'width' => 1000,
        'height' => 250,
        'flex-height' => true,
        'wp-head-callback' => 'beautifulclass_header_style',
    )));
}

add_action('after_setup_theme', 'beautifulclass_custom_header_setup');

if (!function_exists('beautifulclass_header_style')) :

    /**
     * Styles the header image and text displayed on the blog.
     *
     * @see beautifulclass_custom_header_setup().
     */
    function beautifulclass_header_style() {
        $header_text_color = get_header_textcolor();

        /*
         * If no custom options for text are set, let's bail.
         * get_header_textcolor() options: Any hex value, 'blank' to hide text. Default: add_theme_support( 'custom-header' ).
         */
        if (get_theme_support('custom-header', 'default-text-color') === $header_text_color) {
            return;
        }

        // If we get this far, we have custom styles. Let's do this.
        ?>
        <style type="text/css">
        <?php
// Has the text been hidden?
        if (!display_header_text()) :
            ?>
                .site-title,
                .site-description {
                    position: absolute;
                    clip: rect(1px, 1px, 1px, 1px);
                }
            <?php
// If the user has set a custom color for the text use that.
        else :
            ?>
                .site-title a,
                .site-description {
                    color: #<?php echo esc_attr($header_text_color); ?>;
                }
        <?php endif; ?>
        </style>
        <?php
    }

endif;
if (!function_exists('header_customs')) {

    function header_customs() {
        ?>
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
                                        <?php
                                        if (is_user_logged_in()) {
                                            $current_user = wp_get_current_user();
                                            ?>
                                        <b>Xin chào <span style="color: red !important; font-weight: bold !important;"><?php echo $current_user->display_name; ?></span> |</b>
                                            <?php
//                                            printf('Xin chào %s!',esc_html($current_user->display_name));
                                            ?>
                                            <a href="<?php echo wp_logout_url(home_url()); ?>">Đăng xuất</a>
                                            <?php
//                                                wp_logout();
                                        } else {
                                            ?>
                                            <div class="thim-link-login thim-login-popup"> <a class="register" href="#">Register</a> <a class="login" href="#">Login</a></div>
                                            <?php
                                        }
                                        ?>

                                        <div id="thim-popup-login" class="has-shortcode">
                                            <div class="thim-login-container">
                                                <a href="#" style="display:none;"></a>
                                                <a href="#" style="display:none;"></a>
                                                <a href="#" style="display:none;"></a>
                                                <a href="#" style="display:none;"></a>
                                                <div class="mo-openid-app-icons">
                                                    <?php dynamic_sidebar('sidebar-2'); ?>
                                                </div>
                                                <br>
                                                <div class="thim-login">
                                                    <h2 class="title">Đăng Nhập</h2>
                                                    <p style="color: red !important;">
                                                        <?php
                                                        $login = (isset($_GET['login']) ) ? $_GET['login'] : 0;
                                                        if ($login === "failed") {
                                                            echo '<p><strong>ERROR:</strong> Sai tên đăng nhập hoặc mật khẩu.</p>';
                                                        } elseif ($login === "empty") {
                                                            echo '<p><strong>ERROR:</strong> Tên đăng nhập và mật khẩu không thể bỏ trống.</p>';
                                                        } elseif ($login === "false") {
                                                            echo '<p><strong>ERROR:</strong> Bạn đã thoát ra.</p>';
                                                        }
                                                        ?>
                                                    </p>
                                                    <?php
                                                    $args = array(
                                                        'redirect' => site_url($_SERVER['REQUEST_URI']),
                                                        'form_id' => 'loginform',
                                                        'label_username' => __('Tên tài khoản'),
                                                        'label_password' => __('Mật khẩu'),
                                                        'label_remember' => __('Ghi nhớ'),
                                                        'label_log_in' => __('Đăng nhập'),
                                                    );
                                                    wp_login_form($args);
                                                    ?>

                                                    <p class="link-bottom">Chưa phải là thành viên? <a class="register" href="<?php echo wp_registration_url(); ?>">Đăng ký ngay</a></p>
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
                                <a href="http://localhost:8080/FGCClass_WordPress" class="no-sticky-logo"><img src="<?php echo get_template_directory_uri(); ?>/images/logo.png" alt="Education WP"></a>
                                <a href="http://localhost:8080/FGCClass_WordPress" class="sticky-logo"><img src="<?php echo get_template_directory_uri(); ?>/images/logo-sticky.png" alt="Education WP"></a>
                            </div>
                            <nav class="width-navigation table-cell table-right">
                                <?php echo wp_nav_menu(array("theme_location" => "menu-1")); ?>
                            </nav>
                            <div class="menu-mobile-effect navbar-toggle" data-effect="mobile-effect"> <span class="icon-bar"></span> <span class="icon-bar"></span> <span class="icon-bar"></span></div>
                        </div>
                    </div>
                </div>
            </div>
        </header>
        <?php
    }

}
