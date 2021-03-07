<?php
/**
 * this class have methods to run when plugin
 *  - activate, 
 *  - deactivate, 
 *  - uninstall, 
 *  - update
 */

if ( ! defined( 'ABSPATH' ) ) exit;

if ( ! class_exists( 'HT_FBA_Register' ) ) :
        
class HT_FBA_Register {

    /**
     * When plugin activate, updates this function will call
     * 
     * Check min wp version 
     * calls self::db_plugin_details - add plugin details to db
     * 
     * @since 1.0.0
     * @uses register_activation_hook, self::plugin_update
     * 
     */
    public static function activate() {

        // check minimum version required to run this plugin
        if( version_compare( get_bloginfo('version'), HT_FBA_WP_MIN_VERSION, '<') )  {
            wp_die( 'please update WordPress' );
        }

        // update plugin details to wp_options table
        HT_FBA_db::db_plugin_details();

        // default values
        HT_FBA_db::db_default_values();

    }

    /**
     * When plugin deactivate
     * @uses register_deactivation_hook
     * @return void
     */
    public static function deactivate() {

    }

    /**
     * When plugin uninstall ( delete )
     * @uses register_uninstall_hook
     * @return void
     */
    public static function uninstall() {

    }
    

    /**
     * @uses action hook - plugins_loaded  
     * 
     * compare this content version with saved version in db
     * If version is different then run activate function
     * 
     * @since 1.0.0
     * 
     * @return void
     */
    public static function plugin_update() {
        // @todo change this - on how to get value..
        $ht_fba_plugin_details = get_option('ht_fba_plugin_details');
    
        if ( HT_FBA_VERSION !== $ht_fba_plugin_details['version'] ) {
            //  to update the plugin - just like activate plugin
            self::activate();

        }
    }

    
}

endif; // END class_exists check