<?php
/*
 * Template Name: Trang Đăng Nhập
 */

get_header();
?>
</br>
</br>
</br>
</br>
</br>
<style type="text/css">
    body {
        /*background: #2E8D41;*/
        font-family: Arial, sans-serif;
        font-size: 14px;
        line-height: 1.5em;

    }
    .login-box {
        background: #FFF;
        margin: 100px auto;
        width: 960px;
        padding: 1em;
        overflow: hidden;
        border: solid #ffb606 2px;
        border-radius: 4px;
    }
    .note {
        float: left;
        margin-right: 20px;
    }
    .form {
        float: right;
        width: 250px;
        text-align: center;
        border: solid #ccc 1px;
        box-shadow: 5px 5px 5px #888888;
    }
    label {
        display: block;
    }
    input[type=email], input[type=number], input[type=password], input[type=search], input[type=tel], input[type=text], input[type=url], select, textarea {
        border: 1px solid #DDD;
        -webkit-box-shadow: inset 0 1px 2px rgba(0, 0, 0, 0.07);
        box-shadow: inset 0 1px 2px rgba(0, 0, 0, 0.07);
        background-color: #FFF;
        color: #333;
        -webkit-transition: .05s border-color ease-in-out;
        transition: .05s border-color ease-in-out;
        padding: 5px 10px;
    }
    input[type=submit] {
        background: #51a818;
        background-image: -webkit-linear-gradient(top, #51a818, #3d8010);
        background-image: -moz-linear-gradient(top, #51a818, #3d8010);
        background-image: -ms-linear-gradient(top, #51a818, #3d8010);
        background-image: -o-linear-gradient(top, #51a818, #3d8010);
        background-image: linear-gradient(to bottom, #51a818, #3d8010);
        -webkit-border-radius: 10px;
        -moz-border-radius: 10px;
        border-radius: 10px;
        font-family: Arial;
        color: #ffffff;
        padding: 10px 20px 10px 20px;
        border: solid #32a840 2px;
        text-decoration: none;
    }
</style>
<div class="login-box" >
    <div class="note">

    </div>
    <div class="form">
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
            'form_id' => 'dangnhap',
            'label_username' => __('Tên tài khoản'),
            'label_password' => __('Mật khẩu'),
            'label_remember' => __('Ghi nhớ'),
            'label_log_in' => __('Đăng nhập'),
        );
        if (!is_user_logged_in()) {

            wp_login_form($args);
        } else {
            $current_user = wp_get_current_user();
            ?>
                <b>Welcome:  <span style="color: red !important; font-weight: bold !important;"><?php echo $current_user->display_name; ?></span></b>
                <b>ID:  <span style="color: red !important; font-weight: bold !important;"><?php echo $current_user->ID; ?></span></b>
                <b>Email:  <span style="color: red !important; font-weight: bold !important;"><?php echo $current_user->user_mail; ?></span></b>

                <p><a href="http://localhost:8080/FGCClass_WordPress">Quay về trang chủ</a></p>
            <?php
        }
        ?>
    </div>
</div>
<?php
//wp_login_form();

get_footer();
