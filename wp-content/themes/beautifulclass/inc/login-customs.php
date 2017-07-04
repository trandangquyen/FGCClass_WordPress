<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/*
 * Hàm tự động chuyển đến 1 trang khác sau khi Đăng nhập
 */

function my_login_redirect($redirect_to, $request, $user) {
    /* Kiểm tra người dùng */
    global $user;
    if (isset($user->roles) && is_array($user->roles)) {
        /* Kiểm tra Admin */
        if (in_array('administrator', $user->roles)) {
            return admin_url();
        } else {
            return home_url();
        }
    } else {
        return $redirect_to;
    }
}

add_filter('login_redirect', 'my_login_redirect', 10, 3);

/* Cấu hình lại địa chỉ page redirect */

function redirect_login_page() {
    $login_page = home_url('/dang-nhap/');
    $page_viewed = basename($_SERVER['REQUEST_URI']);

    if ($page_viewed == "wp-login.php" && $_SERVER['REQUEST_METHOD'] == 'GET') {
        wp_redirect($login_page);
        exit;
    }
}

add_action('init', 'redirect_login_page');

/* Kiểm tra lỗi đăng nhập */

function login_failed() {
//    $post = get_page_by_path($slug);
    $login_page = home_url();
    wp_redirect($login_page . '?login=failed');
    exit;
}

add_action('wp_login_failed', 'login_failed');

// 
function verify_username_password($user, $username, $password) {
    $login_page = home_url();
    if ($username == "" || $password == "") {
        wp_redirect($login_page . "?login=empty");
        exit;

    }
}

add_filter('authenticate', 'verify_username_password', 1, 3);

