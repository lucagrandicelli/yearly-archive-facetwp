<?php
/**
 * Yearly Archive FacetWP
 *
 * @author            Luca Grandicelli - https://www.lucagrandicelli.it
 * @copyright         Copyright (C) 2018, Luca Grandicelli - https://www.lucagrandicelli.it
 * @license           http://www.gnu.org/licenses/gpl-3.0.html GNU General Public License, version 3 or higher
 * @link              https://github.com/lucagrandicelli/yearly-archive-facetwp
 * @package           Yearly_Archive_FacetWP
 * @since             1.0.0
 *
 * @wordpress-plugin
 * Plugin Name:       Yearly Archive FacetWP
 * Plugin URI:        https://github.com/lucagrandicelli/yearly-archive-facetwp
 * Description:       This is a free add-on for the FacetWP plugin (https://facetwp.com/). It adds a new facet type called "Yearly Archive" which can display a list of years with an associated counter of published posts.
 * Version:           1.0.2
 * Author:            Luca Grandicelli
 * Author URI:        https://www.lucagrandicelli.it
 * License:           GPL-3.0+
 * License URI:       http://www.gnu.org/licenses/gpl-2.0.txt
 * Text Domain:       yearly-archive-facetwp
 * Domain Path:       /languages
 *
 * Yearly Archive FacetWP is free software: you can redistribute it and/or modify
 * it under the terms of the GNU General Public License as published by
 * the Free Software Foundation, either version 2 of the License, or
 * any later version.
 *
 * Yearly Archive FacetWP is distributed in the hope that it will be useful,
 * but WITHOUT ANY WARRANTY; without even the implied warranty of
 * MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE. See the
 * GNU General Public License for more details.

 * You should have received a copy of the GNU General Public License
 * along with Yearly Archive FacetWP. If not, see http://www.gnu.org/licenses/gpl-3.0.html
 */

// If this file is called directly, abort.
if ( ! defined( 'WPINC' ) ) {
	die;
}

/**
 * Currently plugin version.
 * Start at version 1.0.0 and use SemVer - https://semver.org
 * Rename this for your plugin and update it as you release new versions.
 */
define( 'ARP_VERSION', '1.0.2' );

/**
 * Plugin's prefix.
 */
define( 'PLUGIN_PREFIX', 'YAF' );

/**
 * Custom constants.
 */
define( 'MAIN_FACETWP_CLASS', 'FacetWP' );

/**
 * The code that runs during plugin activation.
 * This action is documented in includes/class-yearly-archive-facetwp-activator.php
 */
function activate_yearly_archive_facet() {
	require_once plugin_dir_path( __FILE__ ) . 'includes/class-yearly-archive-facetwp-activator.php';
	Yearly_Archive_FacetWP_Activator::activate();
}

/**
 * The code that runs during plugin deactivation.
 * This action is documented in includes/class-yearly-archive-facetwp-deactivator.php
 */
function deactivate_yearly_archive_facet() {
	require_once plugin_dir_path( __FILE__ ) . 'includes/class-yearly-archive-facetwp-deactivator.php';
	Yearly_Archive_FacetWP_Deactivator::deactivate();
}

register_activation_hook( __FILE__, 'activate_yearly_archive_facet' );
register_deactivation_hook( __FILE__, 'deactivate_yearly_archive_facet' );

/**
 * The core plugin class that is used to define internationalization,
 * admin-specific hooks, and public-facing site hooks.
 */
require plugin_dir_path( __FILE__ ) . 'includes/class-yearly-archive-facetwp.php';

/**
 * Begins execution of the plugin.
 *
 * Since everything within the plugin is registered via hooks,
 * then kicking off the plugin from this point in the file does
 * not affect the page life cycle.
 *
 * @since    1.0.0
 */
function run_yearly_archive_facet() {

	$plugin = new Yearly_Archive_FacetWP();
	$plugin->run();

}

run_yearly_archive_facet();
