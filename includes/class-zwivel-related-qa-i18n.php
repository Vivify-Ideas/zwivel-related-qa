<?php

/**
 * Define the internationalization functionality
 *
 * Loads and defines the internationalization files for this plugin
 * so that it is ready for translation.
 *
 * @link       www.example.com
 * @since      1.0.0
 *
 * @package    Zwivel_Related_Qa
 * @subpackage Zwivel_Related_Qa/includes
 */

/**
 * Define the internationalization functionality.
 *
 * Loads and defines the internationalization files for this plugin
 * so that it is ready for translation.
 *
 * @since      1.0.0
 * @package    Zwivel_Related_Qa
 * @subpackage Zwivel_Related_Qa/includes
 * @author     VivifyIdeas <aleksandar.s@vivifyideas.com>
 */
class Zwivel_Related_Qa_i18n {


	/**
	 * Load the plugin text domain for translation.
	 *
	 * @since    1.0.0
	 */
	public function load_plugin_textdomain() {

		load_plugin_textdomain(
			'zwivel-related-qa',
			false,
			dirname( dirname( plugin_basename( __FILE__ ) ) ) . '/languages/'
		);

	}



}
