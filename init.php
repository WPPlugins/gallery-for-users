<?php
/*
Plugin Name: Gallery for Users
Plugin URI: 
Description: Allows the users of the site to upload and display their own images and link to their Youtube videos in a gallery
Version: 1.0.1
Author: TOGI Data ApS
Author URI: http://togidata.dk
Requires at least: 4.0
Tested up to: 4.6
Text Domain: wp-users-gallery

Copyright: 2016
License: GNU General Public License v3.0
License URI: http://www.gnu.org/licenses/gpl-3.0.html
*/

/**
 * Check for premium version installation
 */
add_action('plugins_loaded', 'wpug_plugin_free_install', 11);
function wpug_plugin_free_install() {
	if (!function_exists('is_plugin_active')) {
        require_once( ABSPATH . 'wp-admin/includes/plugin.php' );
    }

    if (defined('WPUG_PLUGIN_PREMIUM')) {
        add_action('admin_notices', 'wpugf_plugin_install_free_admin_notice');
        deactivate_plugins('users-gallery/init.php');
    }
}

function wpugf_plugin_install_free_admin_notice(){
 	?>
 		<div class="error">
            <p><?php _e('You can\'t use the free version of Users gallery while you are using the premium one.', 'wp-users-gallery'); ?></p>
        </div>
 	<?php
}

//Initiate function
if (!class_exists('Wpug_users_gallery')) {
    include 'users-gallery.php';
}