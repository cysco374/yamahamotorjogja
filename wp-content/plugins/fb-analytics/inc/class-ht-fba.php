<?php
/**
 * Starter..
 * 
 * singleton instance for this class.
 * 
 * added variable to declare other instance if needed 
 * ( in some cases in this plugin, using static methods and calling with out creating instance )
 * 
 * Includes other files - admin - front end 
 * 
 * add hooks
 * 
 * @package FBA
 * @since 1.0
 */

if ( ! defined( 'ABSPATH' ) ) exit;

if ( ! class_exists( 'HT_Fba' ) ) :

class HT_Fba {

    /**
     * singleton instance
     *
     * @var HT_Fba 
     * @since 1.0
     */
    private static $instance;



    /**
     * main instance - HT_Fba
     *
     * @return Ht_Fba instance
     * @since 1.0
     */
    public static function instance() {
        if ( ! isset( self::$instance ) && ! ( self::$instance instanceof HT_Fba ) ) {
            self::$instance = new self();
        }
        return self::$instance;
    }


    public function __clone() {
		wc_doing_it_wrong( __FUNCTION__, __( 'Cheatin&#8217; huh?', 'fba' ), '1.0' );
    }
    
    public function __wakeup() {
		wc_doing_it_wrong( __FUNCTION__, __( 'Cheatin&#8217; huh?', 'fba' ), '1.0' );
    }

    /**
     * constructor 
     * calling to - includes - which include files
     * calling to - hooks  - which run hooks 
     */
    public function __construct() {
        $this->includes();
        $this->hooks();
    }


    private function includes() {
        
        // include in admin and front pages
        require_once HT_FBA_PLUGIN_DIR . 'inc/class-ht-fba-db.php';
        require_once HT_FBA_PLUGIN_DIR . 'inc/commons/variables.php';
        require_once HT_FBA_PLUGIN_DIR . 'inc/class-ht-fba-register.php';

        //  is_admin ? include file to admin area : include files to non-admin area 
        if ( is_admin() ) {
            require_once HT_FBA_PLUGIN_DIR . 'inc/admin/admin.php';
        } else {
            require_once HT_FBA_PLUGIN_DIR . 'inc/class-ht-fba-add-sdk.php';
        }
    }



    /**
     * Register hooks - when plugin activate, deactivate, uninstall
     * commented deactivation, uninstall hook - its not needed as now
     * 
     * plugins_loaded  - Check Diff - uses when plugin updates.
     *
     * @since 1.0
     */
    private function hooks() {

        register_activation_hook( __FILE__, array( 'HT_FBA_Register', 'activate' )  );
        // register_deactivation_hook( __FILE__, array( 'HT_FBA_Register', 'deactivate' )  );
        // register_uninstall_hook(__FILE__, array( 'HT_FBA_Register', 'uninstall' ) );

        // when plugin updated - check version diff
        add_action('plugins_loaded', array( 'HT_FBA_Register', 'plugin_update' ) );

    }


}

endif; // END class_exists check