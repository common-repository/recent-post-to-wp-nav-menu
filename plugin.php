<?php
namespace Ankit\Plugins\Rpm;

/**
 * Plugin Name: Recent Post to WP Nav Menu
 * Plugin URI: https://github.com/ankitr90/recent-post-to-wp-nav-menu
 * Description: Add Custom Post Type's recent post to Nav Menu.
 * Version: 1.0
 * Author: Ankit
 * Author URI: http://ankitr90.github.io/
 * License: GPL2
 * License URI: http://www.gnu.org/licenses/gpl-2.0.html
 */

// No direct access
if (!defined('ABSPATH')) exit;

// Define plugin version
define('RPM_PLUGIN_VER', '1.0');

// Define plugin base file
define('RPM_BASE_FILE', __FILE__);


if (is_admin()) {
    // Instantiate Admin class
    require_once('inc/class-admin.php');
    new Admin();
} else {
    // Instantiate Frontend class
    require_once('inc/class-frontend.php');
    new Frontend();
}




