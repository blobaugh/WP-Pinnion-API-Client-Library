<?php
/*
 Plugin Name: Pinnion API Client Library
 Plugin URI: https://github.com/blobaugh/WP-Pinnion-API-Client-Library
 Description: Adds the Pinnion API client for PHP to a WordPress installation to make the libraries available to plugin developers
 Version: 0.1
 Author: Ben Lobaugh
 Author URI: http://ben.lobaugh.net
 */


/**
 * TODO:
 * 
 * Prettify with WordPress styles
 * Sanitize db inputs
 * Possibly add listing of endpoints to form
 */

add_action( 'init', 'pinnion_api_client_includes', 1 );

function pinnion_api_client_includes() {
    global $blog_id;
    require_once 'Pinnion-API-client-for-PHP/Pinnion.php';
}

add_action( 'admin_menu', 'pinnion_api_client_menu', 2 );

function pinnion_api_client_register() {
  global $blog_id;
  
  $v = get_option( $blog_id . '_pinnion_api_url' );
  if($v == '') update_option( $blog_id . '_pinnion_api_url', 'http://api.pinnion.com' );
}

register_activation_hook( __FILE__, 'pinnion_api_client_register' );


function pinnion_api_client_menu() {
   // add_options_page( $page_title, $menu_title, $capability, $menu_slug, $function = '' ) 
    add_options_page( 'Pinnion API Client Settings', 'Pinnion API Client', 'activate_plugins', 'pinnion-api-client', 'pinnion_api_client_options_page' );
}

function pinnion_api_client_options_page() { 
    global $blog_id;
    
    if( isset($_POST['pinnion_api_user']) && isset($_POST['pinnion_api_pass']) ) {
        update_option( $blog_id . '_pinnion_api_user', $_POST['pinnion_api_user'] );
        update_option( $blog_id . '_pinnion_api_pass', $_POST['pinnion_api_pass'] );
        update_option( $blog_id . '_pinnion_api_url', $_POST['pinnion_api_url'] );
    }

?>

<p>Settings for Pinnion API</p>

<form action="" method="post">
    API Username: <input type="text" name="pinnion_api_user" value="<?php echo get_option($blog_id . '_pinnion_api_user'); ?>"/>
    <br/>API Password: <input type="text" name="pinnion_api_pass" value="<?php echo get_option($blog_id . '_pinnion_api_pass'); ?>"/>
    <br/>API URL: <input type="text" name="pinnion_api_url" value="<?php echo get_option($blog_id . '_pinnion_api_url'); ?>"/>
    <br/><br/><br/><input type="submit" value="Save"/>
</form>

<?php

} // end pinnion_api_client_options_page()