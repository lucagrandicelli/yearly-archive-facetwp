<?php

/**
 * Define the internationalization functionality.
 *
 * Loads and defines the internationalization files for this plugin
 * so that it is ready for translation.
 *
 * @author            Luca Grandicelli - https://www.lucagrandicelli.it
 * @copyright         Copyright (C) 2018, Luca Grandicelli - https://www.lucagrandicelli.it
 * @license           http://www.gnu.org/licenses/gpl-3.0.html GNU General Public License, version 3 or higher
 * @link              https://github.com/lucagrandicelli/yearly-archive-facetwp
 * @package           Yearly_Archive_FacetWP
 * @since             1.0.0
 * @subpackage        Yearly_Archive_FacetWP/includes
 */
class Yearly_Archive_FacetWP_i18n {


	/**
	 * Load the plugin text domain for translation.
	 *
	 * @since    1.0.0
	 */
	public function load_plugin_textdomain() {

		load_plugin_textdomain(
			'yearly-archive-facetwp',
			false,
			dirname( dirname( plugin_basename( __FILE__ ) ) ) . '/languages/'
		);

	}



}
