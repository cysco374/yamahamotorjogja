<?php
/**
 * Database - add values to Database - wp_options table
 * plugin settings - options page
 * plugin details
 */

if ( ! defined( 'ABSPATH' ) ) exit;

if ( ! class_exists( 'HT_FBA_db' ) ) :

class HT_FBA_db {


    /**
     * Add plugin Details to db - wp_options table
     * Add plugin version to db - useful while updating plugin
     * 
     * @uses class-ht-fba-register -> activate()
     * @return void
     */
    public static function db_plugin_details() {

        // plugin details 
        $plugin_details = array(
            'version' => HT_FBA_VERSION,
        );

        // Always use update_option - override new values .. don't preseve already existing values
        update_option( 'ht_fba_plugin_details', $plugin_details );
    }




    /**
     * options page - default values.
     * 
     * @uses class-ht-fba-register -> activate()
     * @return void
     */
    public static function db_default_values() {

        /**
         * plugin details 
         * @todo changedd fb_app_id - default value
         * @key enable - 1, means true. add sdk.
         * @key fb_where - 1 - after open body, 2 - header, 3 - footer
         */
        $values = array(
            'enable' => '1',
            'fb_app_id' => '',
            'fb_where' => '1',
        );

        
        // update_option( 'ht_fba_options', $values );
        // add_option( 'ht_fba_options', $values );

        $db_values = get_option( 'ht_fba_options', array() );
        $update_values = array_merge($values, $db_values);
        update_option('ht_fba_options', $update_values);
    }



}

endif; // END class_exists check