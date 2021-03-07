<?php 
/**
 * Creates top level menu
 * and options page 
 * 
 * @package ht_fba
 * @subpackage admin
 * @since 1.0
 * 
 */

if ( ! defined( 'ABSPATH' ) ) exit;

if ( ! class_exists( 'HT_Fba_Admin' ) ) :

class HT_Fba_Admin {


    /**
     * Adds top level menu -> FBA
     *
     * @uses action hook - admin_menu
     * 
     * @since 1.0.0
     * @return void
     */
    public function ht_fba_options_page() {
        add_menu_page(
            'fba - Facebook Analytics',
            'FB-Analytics',
            'manage_options',
            'fba-options-page',
            array( $this, 'settings_page' ),
            'dashicons-chart-bar'
        );
    }


    /**
     * Options page Content - 
     *   get settings form from a template settings_page.php
     * 
     * Call back from - $this->ht_fba_options_page, add_menu_page
     *
     * @since 1.0.0
     * @return void
     */
    public function settings_page() {
        
        if ( ! current_user_can('manage_options') ) {
            return;
        }

        // get options page form
        require_once('settings_page.php'); 
    }



    /**
     * Options page - Regsiter, add section and add setting fields
     *
     * @uses action hook - admin_init
     * 
     * @since 1.0.0
     * @return void
     */
    public function ht_fba_custom_settings() {

        register_setting( 'ht_fba_settings_group', 'ht_fba_options' , array( $this, 'ht_fba_options_sanitize' ) );
        
        add_settings_section( 'ht_fba_settings', '', array( $this, 'ht_fba_settings_section_cb' ), 'ht_fba_options_settings' );
        
        add_settings_field( 'enable', __( 'Enable' , 'fba' ), array( $this, 'ht_fba_enable_cb' ), 'ht_fba_options_settings', 'ht_fba_settings' );
        add_settings_field( 'ht_fba_fb_app_id', __( 'Facebook App ID' , 'fba' ), array( $this, 'ht_fba_fb_app_id_cb' ), 'ht_fba_options_settings', 'ht_fba_settings' );
        
        add_settings_field( 'ht_fba_fb_where', __( 'Where to Add' , 'fba' ), array( $this, 'ht_fba_fb_where_cb' ), 'ht_fba_options_settings', 'ht_fba_settings' );
        
    }

    // section heading
    function ht_fba_settings_section_cb() {
        echo '<h1>FBA - Settings page</h1>';
    }

    // enable
    public function ht_fba_enable_cb() {
        $enable = get_option('ht_fba_options');
        ?>
        <div>
            <select name="ht_fba_options[enable]" class="select-1">
            <option value="no"><?php _e( 'No' , 'fba' ) ?></option>
            <option value="1" <?php echo esc_attr( $enable['enable'] ) == '1' ? 'SELECTED' : ''; ?>  ><?php _e( 'Yes' , 'fba' ) ?></option>
            </select>
        </div>
        <?php
    }

    // App id
    public function ht_fba_fb_app_id_cb() {

        $ht_fba_fb_app_id = get_option('ht_fba_options');
        ?>
        <input type="text" name="ht_fba_options[fb_app_id]" id="" value="<?php echo esc_attr( $ht_fba_fb_app_id['fb_app_id'] ) ?>">

        <!-- <p class="description"><?php _e( 'Facebook App ID - ' , 'fba' ) ?> <a target="_blank" href="https://holithemes.com/plugins/fba/facebook-app-id/"><?php _e( 'more info' , 'fba' ) ?></a> </p> -->
        <?php
    }



    // fb where - sdk
    public function ht_fba_fb_where_cb() {

        $fb_where = get_option('ht_fba_options');
        $where_val = esc_attr( $fb_where['fb_where'] );

        ?>

        <select name="ht_fba_options[fb_where]">
        <option value="1" <?php echo $where_val == "1" ? 'SELECTED' : ''; ?> >After opening body tag</option>
        <option value="2" <?php echo $where_val == "2" ? 'SELECTED' : ''; ?> >Header</option>
        <option value="3" <?php echo $where_val == "3" ? 'SELECTED' : ''; ?> >Footer</option>
        </select>

        <!-- <p class="description"><?php _e( 'Where to add Analytics snippet - ' , 'fba' ) ?><a target="_blank" href="https://holithemes.com/plugins/fba/messenger-ref/"><?php _e( 'more info' , 'fba' ) ?></a> </p> -->
        <?php
    }

   



    /**
     * Sanitize each setting field as needed
     *
     * @since 1.0
     * @param array $input Contains all settings fields as array keys
     */
    public function ht_fba_options_sanitize( $input ) {

        if ( ! current_user_can( 'manage_options' ) ) {
            wp_die( 'not allowed to modify - please contact admin ' );
        }

        $new_input = array();

        if( isset( $input['enable'] ) )
        $new_input['enable'] = sanitize_text_field( $input['enable'] );

        if( isset( $input['fb_app_id'] ) )
        $new_input['fb_app_id'] = sanitize_text_field( $input['fb_app_id'] );

       
        if( isset( $input['fb_where'] ) )
        $new_input['fb_where'] = sanitize_text_field( $input['fb_where'] );

        return $new_input;
    }






}

endif; // END class_exists check