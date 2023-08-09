/**
 * Plugin Name: Custom WordPress Welcome Admin Dashboard
 * Plugin URI: https://gist.github.com/wpfresher/8d3680d4d9d6d86f22f7f6cb1662ab1a
 * Description: This plugin will replace the default WordPress admin dashboard with a new custom menu page. It works when the user has a 'Read' capability & does not have a 'Manage_Options' capability
 * Version: 1.0.0
 * Author: Kawsar Ahmed
 * Author URI: http://urldev.com/
 * Developer: Kawsar Ahmed
 * Developer URI: http://urldev.com/
 * Contributors: Kawsar Ahmed
 * License: GPLv2 or later
 * License URI: http://www.gnu.org/licenses/gpl-2.0.html
 * Requires at least: 5.2
 * Tested up to: 6.3
 * Requires PHP: 7.0
 */

/**
 * 
 * This plugin provides an initial foundation for replacing the default WordPress admin dashboard. If you have a background in object-oriented programming,
 * you can create a subclass to customize and override the set_the_title() and page_content_callback_fn() methods.
 * Alternatively, if you're not familiar with object-oriented programming, you can modify the set_the_title() and page_content_callback_fn() functions according to your requirements.
 *
 * Modify the user redirection to the custom dashboard by adjusting the capability property for specific users.
 * And add the capability property if you want to remove this custom dashboard and back to the default WordPress dashboard
 *
 * Remember: To ensure the uninterrupted functionality of this plugin, simply place this file into the "mu-plugins" folder within the "wp-content" directory.
 * If the "mu-plugins" folder is not present, you can easily create one yourself.
 */

# custom-wp-dashboard
The Custom WordPress Welcome Admin Dashboard plugin will replace the default WordPress admin dashboard with a new custom menu page. It works when the user has a 'Read' capability &amp; does not has a 'Manage_Options' capability
