<?php

/**
 * The plugin bootstrap file
 *
 * This file is read by WordPress to generate the plugin information in the plugin
 * admin area. This file also includes all of the dependencies used by the plugin,
 * registers the activation and deactivation functions, and defines a function
 * that starts the plugin.
 *
 * @link              www.example.com
 * @since             1.0.0
 * @package           Zwivel_Related_Qa
 *
 * @wordpress-plugin
 * Plugin Name:       Zwivel Related QA
 * Plugin URI:        www.example.com
 * Description:       This is a short description of what the plugin does. It's displayed in the WordPress admin area.
 * Version:           1.0.0
 * Author:            VivifyIdeas
 * Author URI:        www.example.com
 * License:           GPL-2.0+
 * License URI:       http://www.gnu.org/licenses/gpl-2.0.txt
 * Text Domain:       zwivel-related-qa
 * Domain Path:       /languages
 */

// If this file is called directly, abort.
if ( ! defined( 'WPINC' ) ) {
	die;
}

/**
 * Currently pligin version.
 * Start at version 1.0.0 and use SemVer - https://semver.org
 * Rename this for your plugin and update it as you release new versions.
 */
define( 'PLUGIN_NAME_VERSION', '1.0.0' );

/**
 * The code that runs during plugin activation.
 * This action is documented in includes/class-zwivel-related-qa-activator.php
 */
function activate_zwivel_related_qa() {
	require_once plugin_dir_path( __FILE__ ) . 'includes/class-zwivel-related-qa-activator.php';
	Zwivel_Related_Qa_Activator::activate();
}

/**
 * The code that runs during plugin deactivation.
 * This action is documented in includes/class-zwivel-related-qa-deactivator.php
 */
function deactivate_zwivel_related_qa() {
	require_once plugin_dir_path( __FILE__ ) . 'includes/class-zwivel-related-qa-deactivator.php';
	Zwivel_Related_Qa_Deactivator::deactivate();
}

register_activation_hook( __FILE__, 'activate_zwivel_related_qa' );
register_deactivation_hook( __FILE__, 'deactivate_zwivel_related_qa' );

/**
 * The core plugin class that is used to define internationalization,
 * admin-specific hooks, and public-facing site hooks.
 */
require plugin_dir_path( __FILE__ ) . 'includes/class-zwivel-related-qa.php';

/**
 * Begins execution of the plugin.
 *
 * Since everything within the plugin is registered via hooks,
 * then kicking off the plugin from this point in the file does
 * not affect the page life cycle.
 *
 * @since    1.0.0
 */
function run_zwivel_related_qa() {

	$plugin = new Zwivel_Related_Qa();
	$plugin->run();

}
run_zwivel_related_qa();
