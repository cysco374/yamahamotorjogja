<?php 
/**
 * Add fb sdk 
 */

if ( ! defined( 'ABSPATH' ) ) exit;

if ( ! class_exists( 'HT_FBA_Add_SDK' ) ) :

class HT_FBA_Add_SDK {


    /**
     * Add sdk - Analytics snippet
     * 
     * @uses self::fba_footer
     * @uses self::fba_head
     * @uses self::fba_after_body
     * 
     * @return string Analytics snippet
     */
    public static function ht_fba_get_sdk() {

        $ht_fba_options = get_option('ht_fba_options');
        
        $ht_fba_fb_app_id = esc_attr( $ht_fba_options['fb_app_id'] );

        $current_version = HT_FBA_VERSION;

        $ht_fb_sdk_adf = "";
        $ht_fb_sdk_adf.= "
        <!-- Facebook Analytics - fba plugin- v$current_version - HoliThemes - https://holithemes.com/ -->
        <script>
            window.fbAsyncInit = function() {
                FB.init({
                appId      : '$ht_fba_fb_app_id',
                cookie     : true,
                xfbml      : true,
                version    : 'v2.11'
                });
                
                FB.AppEvents.logPageView();   
                
            };

            (function(d, s, id){
                var js, fjs = d.getElementsByTagName(s)[0];
                if (d.getElementById(id)) {return;}
                js = d.createElement(s); js.id = id;
                js.src = 'https://connect.facebook.net/en_US/sdk.js';
                fjs.parentNode.insertBefore(js, fjs);
            }(document, 'script', 'facebook-jssdk'));
        </script>
        <!-- / Facebook Analytics - fba plugin - HoliThemes -->
        ";


        return $ht_fb_sdk_adf;
    }

    /**
     * check with place to add - and call related method
     * head, after body, footer
     */
    public static function ht_fba_init_sdk() {

        $ht_fba_options = get_option('ht_fba_options');
            
        $ht_fba_fb_where = esc_attr( $ht_fba_options['fb_where'] );

        $enable = esc_attr( $ht_fba_options['enable'] );

        /**
         * enable not equal to 1, not to add sdk.
         * so retun out of the page.
         */
        if ( '1' !== $enable ) {
            return;
        }

        /**
         *  1 - after open body tag
         *  2 - header
         *  3 - footer
         */
        if ( '1' == $ht_fba_fb_where ) {
            add_filter('body_class', array( __CLASS__, 'fba_after_body' ), PHP_INT_MAX);
        } elseif ( '2' == $ht_fba_fb_where ) {
            add_action( 'wp_head', array( __CLASS__, 'fba_head' ) );
        } elseif ( '3' == $ht_fba_fb_where ) {
            add_action( 'wp_footer', array( __CLASS__, 'fba_footer' ) );
        }

    }

    
    /**
     * Add at footer
     * where is - 3
     */
    public static function fba_footer() {
        echo self::ht_fba_get_sdk();
    }


    /**
     * Add at header
     * where is - 2
     */
    public static function fba_head() {
        echo self::ht_fba_get_sdk();
    }


    /**
     * Add After open body tag
     * using body_class filter
     * where is - 1
     */
    public static function fba_after_body( $classes ) {
        $classes[] = '">' . self::ht_fba_get_sdk() . '<noscript></noscript novar="';
        return $classes;
    }

    

}

// @todo move to right place
$fbb = new HT_FBA_Add_SDK();
$fbb->ht_fba_init_sdk();

endif; // END class_exists check