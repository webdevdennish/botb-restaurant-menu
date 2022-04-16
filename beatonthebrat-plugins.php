<?php
/**
 * Plugin Name: The Sensible Restaurant Menu
 * Description: Custom Elementor addon.
 * Plugin URI:  https://elementor.com/
 * Version:     1.0.0
 * Author:      Beat on the Brat
 * Author URI:  https://developers.elementor.com/
 * Text Domain: beatonthebrat-plugins
 * 
 * Elementor tested up to:     3.5.0 maybe
 * Elementor Pro tested up to: 3.5.0 maybe
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}

function beatonthebrat_plugins() {
	define( 'BEATONTHEBRAT_PLUGIN_PATH', plugin_dir_path(  __FILE__  ) );
	define( 'BEATONTHEBRAT_PLUGIN_URL', plugin_dir_url(  __FILE__  ) );

	require_once( __DIR__ . '/includes/plugin.php' );

	// Run the plugin
	\Beat_on_the_Brat_Plugins\Plugin::instance();

}
// load the actual plugin file with the class
// this is where all the setup is done and where 
// the widget(s) are loaded
add_action( 'plugins_loaded', 'beatonthebrat_plugins' );