<?php
/**
 * Plugin Name: Custom WordPress Welcome Admin Dashboard
 * Plugin URI: https://gist.github.com/wpfresher/8d3680d4d9d6d86f22f7f6cb1662ab1a
 * Description: This plugin will replaces the default WordPress admin dashboard with a new custom menu page. It works when the user has 'Read' capability & do not has no 'Manage_Options' capability
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
 * And add the capability property if you want to remove this custom dashboard and back to the default wordpress dashboard
 *
 * Remember: To ensure the uninterrupted functionality of this plugin, simply place this file into the "mu-plugins" folder within the "wp-content" directory.
 * If the "mu-plugins" folder is not present, you can easily create one yourself.
 */

/**
 * Exit if accessed directly
 */
defined( 'ABSPATH' ) || exit;

/**
 * Custom Wordpress Welcome Admin Dashboard
 * Class executes when the user has 'Read' capability
 * Not execute when the user has no 'Manage_Options' capability
 * 
 * @since version 1.0.0
 */
class Custom_WP_Dashboard {
    
    protected $menu_page_name = 'Dashboard';
    protected $menu_page_slug = 'dashboard';
    protected $capability = 'read';
    protected $no_capability = 'manage_options';
    protected $title;

    /**
     * Here "final" prefix used, It's because we do not want to override this methods by other sub classes or sub methods
     */
    final public function __construct() {

        if( is_admin() ) {
            add_action( 'init', array( $this, 'init_callback_fn' ) );
        }

    }
    
    final public function init_callback_fn() {

        if( current_user_can( $this->capability) && !current_user_can( $this->no_capability ) ) {

            $this->set_the_title();

            add_action( 'admin_menu', array( $this, 'admin_menu_callback_fn' ) );
            add_filter( 'admin_title', array( $this, 'admin_title_callback_fn' ), 10, 2 );
            add_action( 'current_screen', array( $this, 'current_screen_callback_fn' ) );
        }

    }

    /**
     * Set the page title for your custom dashboard
     * 
     * @since version 1.0.0
     */
    function set_the_title() {

        if( ! isset( $this->title ) ) {
            $this->title = __( 'Dashboard' );
        }

    }

    /**
     * Output the content for your custom dashboard
     * 
     * @since version 1.0.0
     */
    function page_content_callback_fn() {

        $content = __( 'Hi! Welcome to your new dashboard!' );
        echo <<<HTML
        <div class="wrap">
            <h2>{$this->title}</h2>
            <p>{$content}</p>
        </div>
        HTML;
    }

    /**
     * Adding custom menu page
     * Removing the wordpress default Dashboard menu page
     * 
     * @since version 1.0.0
     */
    final public function admin_menu_callback_fn() {

        /**
         * Adds a custom page to WordPress
         * 
         * @since version 1.0.0
         * @reference https://developer.wordpress.org/reference/functions/add_menu_page/
         */
        add_menu_page( $this->title, $this->menu_page_name, $this->capability, $this->menu_page_slug, array( $this, 'page_content_callback_fn' ), 'dashicons-dashboard', 0);

        /**
         * Remove the Wordpress default Dashboard menu page
         * 
         * @since version 1.0.0
         * @reference https://developer.wordpress.org/reference/functions/remove_menu_page/
         */
        remove_menu_page( 'index.php' );

    }

    /**
     * Fixing the page title.
     *
     * @param string $admin_title
     * @param string $title
     * @return string $admin_title
     * 
     * @since version 1.0.0
     */
    public function admin_title_callback_fn( $admin_title, $title ) {

        global $pagenow;

        if( 'admin.php' == $pagenow && isset( $_GET['page'] ) && $this->menu_page_slug == $_GET['page'] ) {

            $admin_title = $this->title . ' &rarr; ' . $admin_title;

        }

        return $admin_title;
    }

    /**
     * Redirect users from the Wordpress default welcome dashboard to your custom dashboard
     * 
     * @since version 1.0.0
     */
    function current_screen_callback_fn( $screen ) {

        if( $screen->id == 'dashboard' ) {

            wp_safe_redirect( admin_url( 'admin.php?page='. $this->menu_page_slug ) );
            exit;
        }

    }

}

/**
 * Custom Wordpress Welcome Admin Dashboard
 * Class executes when the user has 'Read' capability
 * Not execute when the user has no 'Manage_Options' capability
 * 
 * @since version 1.0.0
 */
new Custom_WP_Dashboard();
