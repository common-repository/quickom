<?php

/**
 * The plugin bootstrap file
 *
 * This file is read by WordPress to generate the plugin information in the plugin
 * admin area. This file also includes all of the dependencies used by the plugin,
 * registers the activation and deactivation functions, and defines a function
 * that starts the plugin.
 *
 * @link              http://quickom.com
 * @since             1.0.0
 * @package           Quickom
 *
 * @wordpress-plugin
 * Plugin Name:       QUICKOM Call Center
 * Plugin URI:        http://quickom.com
 * Description:       This plugin offer QUICKOM Call Center service which is the perfect fit for remote teams or virtual offices, providing support agents with the ability to receive messages or calls on any device.
 * Version:           1.0.0
 * Author:            Quickom
 * License:           GPL-2.0+
 * License URI:       http://www.gnu.org/licenses/gpl-2.0.txt
 * Text Domain:       quickom
 * Domain Path:       /languages
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
define( 'QUICKOM_VERSION', '1.0.0' );

/**
 * The code that runs during plugin activation.
 * This action is documented in includes/class-quickom-activator.php
 */
function activate_quickom() {
	require_once plugin_dir_path( __FILE__ ) . 'includes/class-quickom-activator.php';
	Quickom_Activator::activate();
}

/**
 * The code that runs during plugin deactivation.
 * This action is documented in includes/class-quickom-deactivator.php
 */
function deactivate_quickom() {
	require_once plugin_dir_path( __FILE__ ) . 'includes/class-quickom-deactivator.php';
	Quickom_Deactivator::deactivate();
}

register_activation_hook( __FILE__, 'activate_quickom' );
register_deactivation_hook( __FILE__, 'deactivate_quickom' );

/**
 * The core plugin class that is used to define internationalization,
 * admin-specific hooks, and public-facing site hooks.
 */
require plugin_dir_path( __FILE__ ) . 'includes/class-quickom.php';

/**
 * Begins execution of the plugin.
 *
 * Since everything within the plugin is registered via hooks,
 * then kicking off the plugin from this point in the file does
 * not affect the page life cycle.
 *
 * @since    1.0.0
 */
function run_quickom() {

	$plugin = new Quickom();
	$plugin->run();

}
run_quickom();
