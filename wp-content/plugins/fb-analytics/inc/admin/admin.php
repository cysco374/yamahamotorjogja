<?php
/**
 * Central file for admin 
 * 
 * @package fba
 * @subpackage Admin
 * @since 1.0
 * 
 * subpackage Admin loads only on wp-admin 
 */


if ( ! defined( 'ABSPATH' ) ) exit;

require_once('class-ht-fba-admin.php');


$admin = new HT_Fba_Admin();
add_action('admin_menu',  array( $admin, 'ht_fba_options_page') );
add_action( 'admin_init', array( $admin, 'ht_fba_custom_settings' ) );