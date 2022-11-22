<div id="israel-front-end-auth-modal-form-login-container">
    <div id="israel-front-end-auth-modal">

        <div class="logo-container">
            <?php
            if (get_custom_logo()) {
                echo get_custom_logo();
            } else {
                echo get_bloginfo('name');
            }

            ?>
        </div>
        <div id="israel-front-end-auth-modal-form-login_error"> </div>
        <form class="alert alert-danger" id="israel-front-end-auth-modal-form-login">
            <input type="hidden" name="ajax_url" value="<?php echo esc_url(admin_url('admin-ajax.php')) ?>">
            <input type="hidden" name="action" value="front-end-auth">
            <input type="hidden" name="israel_front_page_login_form_nounce"
                value="<?php echo $israel_front_page_auth_nonce ?>" />
            Username/Email: <input type="text" name="israel_front_page_login_form_username"><br>
            Password: <input type="password" name="israel_front_page_login_form_password"><br>
            <input class="btn btn-primary" type="submit" value="Login">
        </form>
    </div>
</div>