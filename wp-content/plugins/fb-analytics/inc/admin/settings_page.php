<?php
/**
 * template for options page
 * @uses HT_Fba_Admin::settings_page
 * @since 1.0
 */

if ( ! defined( 'ABSPATH' ) ) exit;

?>

<div class="wrap">

    <?php settings_errors(); ?>
    
    <form action="options.php" method="post" class="">
        <?php settings_fields( 'ht_fba_settings_group' ); ?>
        <?php do_settings_sections( 'ht_fba_options_settings' ) ?>
        <?php submit_button() ?>
    </form>
    
    <p class="description">
    Enable - yes to enable, no to disable <br>
    Facebook App ID - <a target="_blank" href="https://developers.facebook.com/">@Facebook developers</a>  <br>
    Where to Add - Facebook prefer to add 'After opening body tag'
    </p>
    <br>
    <p class="description">
        Will Add new Feature, Add Documentation - Working on
    </p>
    <p class="description">
    for any feature suggestion or for casual chat - please <a target="_blank" href="https://www.messenger.com/t/holithemes">Message us</a>
    </p>

</div>