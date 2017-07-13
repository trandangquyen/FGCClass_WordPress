<?php

/**
 * Plugin Name: Customize Registration Form
 * Plugin URI: http://localhost:8080/
 * Description: Thay thế trang đăng ký mặc định của WP
 * Version: 1.0
 * Author: Phạm Hiếu
 * Author URI: http://vanhieu.wdev.fgct.net
 */
function registration_form($username, $password, $email, $website, $first_name, $last_name, $nickname, $bio) {
//    global $username, $password, $email, $website, $first_name, $last_name, $nickname, $bio;
    echo '
    <style>
    .register-form-container {
        margin: auto;        
    }
    .reg-errors {
        
    }
    div {
      margin-bottom:2px;
    }
     
    input,textarea{
        margin-bottom:4px;
        width: 250px;
    }
    label {
        width : 200px;
        color: #FFF;
    }
    </style>
    ';

    echo '
    <div class="register-form-container">
        <form action="' . $_SERVER['REQUEST_URI'] . '" method="post">
            <div>
                <label for="username">Tên Đăng Nhập <strong>*</strong></label>
                <input type="text" name="username" value="' . ( isset($_POST['username']) ? $username : null ) . '">
            </div>

            <div>
                <label for="password">Mật Khẩu <strong>*</strong></label>
                <input type="password" name="password" value="' . ( isset($_POST['password']) ? $password : null ) . '">
            </div>

            <div>
                <label for="email">Email <strong>*</strong></label>
                <input type="text" name="email" value="' . ( isset($_POST['email']) ? $email : null ) . '">
            </div>

            <div>
                <label for="website">Website</label>
                <input type="text" name="website" value="' . ( isset($_POST['website']) ? $website : null ) . '">
            </div>

            <div>
                <label for="firstname">Họ</label>
                <input type="text" name="fname" value="' . ( isset($_POST['fname']) ? $first_name : null ) . '">
            </div>

            <div>
                <label for="website">Tên</label>
                <input type="text" name="lname" value="' . ( isset($_POST['lname']) ? $last_name : null ) . '">
            </div>

            <div>
                <label for="nickname">Tên hiển thị</label>
                <input type="text" name="nickname" value="' . ( isset($_POST['nickname']) ? $nickname : null ) . '">
            </div>

            <div>
                <label for="bio">Đôi chút về bản thân</label>
                <textarea name="bio">' . ( isset($_POST['bio']) ? $bio : null ) . '</textarea>
            </div>
            <input style type="submit" name="submit" value="Đăng Ký"/>
        </form>
    </div>
    ';
}

function registration_validation($username, $password, $email, $website, $first_name, $last_name, $nickname, $bio) {
    global $reg_errors;
    $reg_errors = new WP_Error;

    // Kiểm tra các trường bắt buộc có dữ liệu Username, Password và Email
    if (empty($username) || empty($password) || empty($email)) {
        $reg_errors->add('field', 'Không được bỏ trống các trường Username, Password và Email');
    }
    // Yêu cầu số ký tự để đăng ký Username phải nhiều hơn 4 ký tự
    if (4 > strlen($username)) {
        $reg_errors->add('username_length', 'Username quá ngắn. Tên đăng nhập phải có ít nhất 4 ks tự');
    }
    // Kiểm tra xem Username đã tồn tại hay chưa
    if (username_exists($username)) {
        $reg_errors->add('user_name', 'Xin lỗi! Username này đã tồn tại!');
    }
    // Sử dụng hàm validate_username trong WordPress để đảm bảo rằng username là hợp lệ.
    if (!validate_username($username)) {
        $reg_errors->add('username_invalid', 'Xin lỗi! Username bạn nhập không hợp lệ');
    }
    // Yêu cầu số ký tự của Password phải  nhiều hơn 5 ký tự
    if (5 > strlen($password)) {
        $reg_errors->add('password', 'Độ dài của mật khẩu phải nhiều hơn 5 ký tự');
    }
    // Kiểm tra tính hợp lệ của email
    if (!is_email($email)) {
        $reg_errors->add('email_invalid', 'Email của bạn không hợp lệ');
    }
    // Kiểm tra xem email đã được đăng ký hay chưa
    if (email_exists($email)) {
        $reg_errors->add('email', 'Email đã được đăng ký bởi người dùng khác');
    }
    //Nếu trường website đã được điền, kiểm tra xem nó có hợp lệ hay không
    if (!empty($website)) {
        if (!filter_var($website, FILTER_VALIDATE_URL)) {
            $reg_errors->add('website', 'Website is not a valid URL');
        }
    }
    // lặp qua các lỗi trong đối tượng WP_Error và hiển thị từng lỗi.
    if (is_wp_error($reg_errors)) {

        foreach ($reg_errors->get_error_messages() as $error) {

            echo '<div class="reg-errors">';
            echo '<strong style="color: red !important; font-weight: bold !important;">OOP..!</strong>:';
            echo '<span style="color: red !important;">' . $error . '</span> <br/>';
            echo '</div>';
        }
    }
}

// Hàm để xử lý đăng ký người dùng
function complete_registration() {
    global $reg_errors, $username, $password, $email, $website, $first_name, $last_name, $nickname, $bio;
    if (1 > count($reg_errors->get_error_messages())) {
        $userdata = array(
            'user_login' => $username,
            'user_email' => $email,
            'user_pass' => $password,
            'user_url' => $website,
            'first_name' => $first_name,
            'last_name' => $last_name,
            'nickname' => $nickname,
            'description' => $bio,
        );
        $user = wp_insert_user($userdata);
        echo 'Đăng ký thành công. Đi đến <a href="' . get_site_url() . '/wp-login.php">trang đăng nhập</a>.';
    }
}

function custom_registration_function() {
    // Xác định xem form đã được submit hay chưa bằng cách kiểm tra $_POST['submit'] có được thiết lập hay chưa
    if (isset($_POST['submit'])) {
        // Nếu form đã được submit, chúng ta gọi hàm registration_validation để xác nhận form.
        registration_validation(
                $_POST['username'], $_POST['password'], $_POST['email'], $_POST['website'], $_POST['fname'], $_POST['lname'], $_POST['nickname'], $_POST['bio']
        );

        // Sàng lọc thông tin user nhập vào
        global $username, $password, $email, $website, $first_name, $last_name, $nickname, $bio;
        $username = sanitize_user($_POST['username']);
        $password = esc_attr($_POST['password']);
        $email = sanitize_email($_POST['email']);
        $website = esc_url($_POST['website']);
        $first_name = sanitize_text_field($_POST['fname']);
        $last_name = sanitize_text_field($_POST['lname']);
        $nickname = sanitize_text_field($_POST['nickname']);
        $bio = esc_textarea($_POST['bio']);

        // Gọi hàm complete_registration để tạo user chỉ khi không có lỗi WP_error được tìm thấy
        complete_registration(
                $username, $password, $email, $website, $first_name, $last_name, $nickname, $bio
        );
    }

    registration_form(
            $username = "", $password = "", $email = "", $website = "", $first_name = "", $last_name = "", $nickname = "", $bio = ""
    );
}

function user_infomation_details() {
    $current_user = wp_get_current_user();
    ?>
    <h1> Thông tin tài khoản</h1>
    <p>Welcome:  <span style="color: red !important; font-weight: bold !important;"><?php echo $current_user->display_name; ?></span></p> 
    <p>ID:  <span style="color: red !important; font-weight: bold !important;"><?php echo $current_user->ID; ?></span></p>
    <p>Email:  <span style="color: red !important; font-weight: bold !important;"><?php echo $current_user->user_email; ?></span></p>
    <p><a href="<?php home_url('/FGCClass_WordPress/') ?>">Quay về trang chủ</a></p>
    <?php
}

// Tạo mới 1 shortcode [fgc_custom_registration]
add_shortcode('fgc_custom_registration', 'custom_registration_shortcode');

// Hàm gọi
function custom_registration_shortcode() {
    ob_start();
    if (!is_user_logged_in()) {
        custom_registration_function();
    } else {
        user_infomation_details();
//        remove_action(custom_registration_function());
    }
    return ob_get_clean();
}
