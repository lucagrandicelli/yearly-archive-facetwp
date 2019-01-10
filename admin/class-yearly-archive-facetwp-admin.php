<?php

/**
 * The admin-specific functionality of the plugin.
 *
 * Defines the plugin name, version, and two examples hooks for how to
 * enqueue the admin-specific stylesheet and JavaScript.
 *
 * @author            Luca Grandicelli - https://www.lucagrandicelli.it
 * @copyright         Copyright (C) 2018, Luca Grandicelli - https://www.lucagrandicelli.it
 * @license           http://www.gnu.org/licenses/gpl-3.0.html GNU General Public License, version 3 or higher
 * @link              https://github.com/lucagrandicelli/yearly-archive-facetwp
 * @package           Yearly_Archive_FacetWP
 * @since             1.0.0
 * @subpackage        Yearly_Archive_FacetWP/admin
 */
class Yearly_Archive_FacetWPWP_Admin {

	/**
	 * The ID of this plugin.
	 *
	 * @since    1.0.0
	 * @access   private
	 * @var      string    $plugin_name    The ID of this plugin.
	 */
	private $plugin_name;

	/**
	 * The version of this plugin.
	 *
	 * @since    1.0.0
	 * @access   private
	 * @var      string    $version    The current version of this plugin.
	 */
	private $version;


	/**
	 * Initialize the class and set its properties.
	 *
	 * @since    1.0.0
	 * @param      string    $plugin_name       The name of this plugin.
	 * @param      string    $version    The version of this plugin.
	 */
	public function __construct( $plugin_name, $version ) {

		$this->plugin_name = $plugin_name;
		$this->version     = $version;

	}

	/**
	 * Register the stylesheets for the admin area.
	 *
	 * @since    1.0.0
	 */
	public function enqueue_styles() {

		/**
		 * This function is provided for demonstration purposes only.
		 *
		 * An instance of this class should be passed to the run() function
		 * defined in Yearly_Archive_FacetWP_Loader as all of the hooks are defined
		 * in that particular class.
		 *
		 * The Yearly_Archive_FacetWP_Loader will then create the relationship
		 * between the defined hooks and the functions defined in this
		 * class.
		 */

		wp_enqueue_style( $this->plugin_name, plugin_dir_url( __FILE__ ) . 'css/yearly-archive-facetwp-admin.css', array(), $this->version, 'all' );

	}

	/**
	 * Register the JavaScript for the admin area.
	 *
	 * @since    1.0.0
	 */
	public function enqueue_scripts() {

		/**
		 * This function is provided for demonstration purposes only.
		 *
		 * An instance of this class should be passed to the run() function
		 * defined in Yearly_Archive_FacetWP_Loader as all of the hooks are defined
		 * in that particular class.
		 *
		 * The Yearly_Archive_FacetWP_Loader will then create the relationship
		 * between the defined hooks and the functions defined in this
		 * class.
		 */

		wp_enqueue_script( $this->plugin_name, plugin_dir_url( __FILE__ ) . 'js/yearly-archive-facetwp-admin.js', array( 'jquery' ), $this->version, false );

	}

	/**
	 * This function registers the new facet by initializing from its core class.
	 *
	 * @param [array] $facet_types
	 * @return void
	 */
	public function register_facet_type( $facet_types ) {
		$facet_types['yearly'] = new Yearly_Archive_FacetWP_Core();
		return $facet_types;
	}

	/**
	 * This function displays admin notices.
	 *
	 * @return void
	 */
	public function admin_notice() {

		/**
		 * This functions takes into account any available admin deferred notice and displays it.
		 *
		 * @return void
		 */

		if ( $notices = get_option( PLUGIN_PREFIX . '_deferred_admin_notices' ) ) {
			foreach ( $notices as $notice ) echo "$notice";
			delete_option( PLUGIN_PREFIX . '_deferred_admin_notices' );
		}
	}

	/**
	 * This function adds custom notice to the admin's deferred notice list.
	 *
	 * @param [string] $text
	 * @param [string] $type
	 * @param boolean $dismissible
	 * @return void
	 */
	public static function add_notice( $code, $text, $type, $dismissible = false ) {

		/**
		 * This function takes a notice's details as input, builds its html and adds
		 * the notice to the admin's deferred notice list managed by an internal option.
		 */

		// Getting option.
		$notices = get_option( PLUGIN_PREFIX . '_deferred_admin_notices', array() );

		// Checking if notice alreadys exists in queue.
		if ( ! array_key_exists( $code, $notices ) ) {

			// Setting up notice class.
			$notice_css_class = $dismissible ? "notice notice-$type is-dismissible" : "notice notice-$type";

			// Adding notice HTML to $notices array.
			$notices[ $code ] = "<div class=\"$notice_css_class\"><p><strong>$text</strong></p></div>";

			// Updating option.
			update_option( PLUGIN_PREFIX . '_deferred_admin_notices', $notices );
		}
	}


	/**
	 * Performs a compatibility test.
	 */
	public static function compatibility_check() {

		/**
		 * This function proviedes multiple compatibility tests
		 * in order to make the Facet WP Yearly Archive properly work.
		 *
		 * First of all, we need to check that the main FacetWP plugin
		 * exists and is installed on the WP system.
		 */

		// Checking if the main FacetWP plugin class exists.
		if ( class_exists( MAIN_FACETWP_CLASS ) ) return true;

		// If the main plugin has not been installed, warn the user by creating and adding a custom notice.
		Yearly_Archive_FacetWPWP_Admin::add_notice( 'FACETWP_MISSING', __( 'Warning! The Yearly Archive FacetWP plugin requires the official FacetWP plugin. Please install and activate this first.', 'yearly-archive-facetwp' ), 'warning' );

		return false;
	}
}
