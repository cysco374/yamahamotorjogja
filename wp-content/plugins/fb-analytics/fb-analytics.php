<?php
/*
Plugin Name: fb-analytics
Description: Add Facebook Analaytics in Web Applications
Version:     1.0
Author:      bhvreddy
License:     GPL2
License URI: https://www.gnu.org/licenses/gpl-2.0.html
Text Domain: fba
*/


if ( ! defined( 'ABSPATH' ) ) exit;

define( 'HT_FBA_VERSION', '1.0' );

define( 'HT_FBA_WP_MIN_VERSION', '4.6' );
define( 'HT_FBA_PLUGIN_DIR', plugin_dir_path( __FILE__ ) );
define( 'HT_FBA_PLUGIN_FILE', __FILE__ );


require_once('inc/class-ht-fba.php');

$HT_Fba = HT_Fba::instance();