<?php

/**
 * Plugin Name:       Israel Front-End Authentication
 * Plugin URI:        https://israelakinola.info/
 * Description:       Provides Front Page Authentication
 * Version:           1.0.0
 * Author:            Israel A
 * Author URI:        https://author.example.com/
 * License:           GPL v2 or later
 * License URI:       https://www.gnu.org/licenses/gpl-2.0.html
 * Text Domain:       israel-front-page-auth
 * Domain Path:       /languages
 */


// If this file is called directly, abort.
if (!defined('WPINC')) {
    die;
}

/**
 * Add Stylesheet and Sripts
 */

function israel_front_page_auth_scripts()
{

    wp_enqueue_style('israel-front-end-auth-style', plugins_url('assets/css/style.css', __FILE__));
    wp_enqueue_script('israel-front-end-auth-script', plugins_url('assets/js/app.js', __FILE__), array('jquery'), false, false);

}

add_action('wp_enqueue_scripts', 'israel_front_page_auth_scripts');



/**
 * This function Display the Login Modal on the Front End
 * ..for UN-Autheticated Users.
 */

function israel_front_page_auth_display_login_modal()
{

    if (!is_user_logged_in()) {
        // Generate a custom nonce value.
        $israel_front_page_auth_nonce = wp_create_nonce('israel_front_page_form_auth_nonce');
        require_once(plugin_dir_path(__FILE__) . 'inc/views/form-view.php');

    }
}
add_action('wp_footer', 'israel_front_page_auth_display_login_modal');




/**
 * This Functions handle the Login Form Submission and Authenticate the User
 */

function israel_front_page_auth_display_login_modal_form_request()
{
    //Check If Nounce is valid
    if (isset($_POST['israel_front_page_login_form_nounce']) && wp_verify_nonce($_POST['israel_front_page_login_form_nounce'], 'israel_front_page_form_auth_nonce')) {
        $creds = array(
            'user_login' => sanitize_text_field($_POST['israel_front_page_login_form_username']),
            'user_password' => sanitize_text_field($_POST['israel_front_page_login_form_password']),
            'remember' => true
        );
        //Authenticate User
        $user = wp_signon($creds, false);

        if (is_wp_error($user)) {
            echo $user->get_error_message();
        } else {
            echo 'Login Successful';
        }
        wp_die();
    } else {
        wp_die(
            'Invalid nonce specified',
            'Error',
            array(
                'response' => 403,
                'back_link' => home_url(),
            )
        );
    }

}


add_action('wp_ajax_nopriv_front-end-auth', 'israel_front_page_auth_display_login_modal_form_request');