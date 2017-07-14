<?php get_header(); ?>
<div id="main-contents" class="row main-contents">
    <div class="col-xs-8 ">
        <?php
        $login_page = home_url('/dang-nhap/');

        if (is_user_logged_in()) {
            wp_redirect($login_page);
        } else {
            ?>
            <div class="register">
                <form action="" id="registerform">
                    <label >Tên đăng nhập</label>
                    <input type="text" name="username" placeholder="Tên đăng nhập">
                    <label >Mật khẩu</label>
                    <input type="password" name="password" placeholder="Mật khẩu">
                    <label >Nhập lại mật khẩu</label>
                    <input type="password" name="repassword" placeholder="Nhập lại mật khẩu">
                    <label >Họ và tên</label>
                    <input type="text" name="fullname" placeholder="Họ tên">
                    <label >Địa chỉ</label>
                    <input type="text" name="address" placeholder="Địa chỉ">
                    <label >Số điện thoại</label>
                    <input type="tel" name="phoneno" placeholder="Số điện thoại">
                    <label >Email</label>
                    <input type="email" name="email" placeholder="E-mail">

                    <input type="submit" value="Gửi" />

                </form>
            </div>
            <?php
        }
        ?>

    </div>

    <div class="col-xs-3"><?php get_sidebar(); ?></div>
</div>
<?php
get_footer();
