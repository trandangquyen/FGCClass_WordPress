<?php

/**
 * Plugin Name: Customize Admin Login Screen
 * Plugin URI: http://localhost:8080/
 * Description: Tùy biến giao diện trang Admin Login 
 * Version: 1.0
 * Author: Phạm Hiếu
 * Author URI: http://vanhieu.wdev.fgct.net
 */
function custom_logo() {
    ?>
    <style type="text/css">
        #login h1 a {
            background-image: url(<?php echo plugins_url('images/logo.png',__FILE__); ?>);
            width: 300px;
            height: 100px;
            background-size: 300px 100px;            
        }
        body {
            background-image: url(<?php echo plugins_url('images/Dazzle.jpg',__FILE__); ?>) !important;
            background-repeat: no-repeat !important;
            background-size: cover !important;
            /*max-width: 100%;*/
            /*background-position: center !important;*/
            
        }
        #loginform {
            border-radius: 5px;
        }
        .login #backtoblog a, .login #nav a {
            color: #1674d2 !important;
        }
            
    </style>
    <?php

}
add_action('login_enqueue_scripts', 'custom_logo');


