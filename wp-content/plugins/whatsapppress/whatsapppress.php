<?php

/**
 * The plugin bootstrap file
 *
 * This file is read by WordPress to generate the plugin information in the plugin
 * admin area. This file also includes all of the dependencies used by the plugin,
 * registers the activation and deactivation functions, and defines a function
 * that starts the plugin.
 *
 * @link              http://abeltra.me/
 * @since             1.0.0
 * @package           Whatsapppress
 *
 * @wordpress-plugin
 * Plugin Name:       WhatsappPress
 * Plugin URI:        https://github.com/ABeltramo/WhatsappPress
 * Description:       Wordpress plugin wich show a Whatsapp badge to start a conversation.
 * Version:           1.0.2
 * Author:            ABeltramo
 * Author URI:        http://abeltra.me/
 * License:           GPL-2.0+
 * License URI:       http://www.gnu.org/licenses/gpl-2.0.txt
 * Text Domain:       whatsapppress
 * Domain Path:       /languages
 */

// If this file is called directly, abort.
if ( ! defined( 'WPINC' ) ) {
	die;
}

/**
 * The code that runs during plugin activation.
 * This action is documented in includes/class-whatsapppress-activator.php
 */
function activate_whatsapppress() {
	require_once plugin_dir_path( __FILE__ ) . 'includes/class-whatsapppress-activator.php';
	Whatsapppress_Activator::activate();
}

/**
 * The code that runs during plugin deactivation.
 * This action is documented in includes/class-whatsapppress-deactivator.php
 */
function deactivate_whatsapppress() {
	require_once plugin_dir_path( __FILE__ ) . 'includes/class-whatsapppress-deactivator.php';
	Whatsapppress_Deactivator::deactivate();
}

register_activation_hook( __FILE__, 'activate_whatsapppress' );
register_deactivation_hook( __FILE__, 'deactivate_whatsapppress' );

/**
 * The core plugin class that is used to define internationalization,
 * admin-specific hooks, and public-facing site hooks.
 */
require plugin_dir_path( __FILE__ ) . 'includes/class-whatsapppress.php';

/**
 * Begins execution of the plugin.
 *
 * Since everything within the plugin is registered via hooks,
 * then kicking off the plugin from this point in the file does
 * not affect the page life cycle.
 *
 * @since    1.0.0
 */
function run_whatsapppress() {

	$plugin = new Whatsapppress();
	$plugin->run();

}
run_whatsapppress();
