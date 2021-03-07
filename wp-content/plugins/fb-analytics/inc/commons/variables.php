<?php
/**
* Global Variables
*
* @since 1.0
*/

if ( ! defined( 'ABSPATH' ) ) exit;


$ht_fba_options = get_option('ht_fba_options');

$GLOBALS["ht_fba_app_id"] = esc_attr( $ht_fba_options['fb_app_id'] );