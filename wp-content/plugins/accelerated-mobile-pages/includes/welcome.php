<?php
// Exit if accessed directly
if ( ! defined( 'ABSPATH' ) ) {
    exit;
}
 
add_action( 'admin_init', 'ampforwp_welcome_screen_do_activation_redirect' );
function ampforwp_welcome_screen_do_activation_redirect() {
  // Bail if no activation redirect
    if ( ! get_transient( 'ampforwp_welcome_screen_activation_redirect' ) ) {
    return;
  }

  // Delete the redirect transient
  delete_transient( 'ampforwp_welcome_screen_activation_redirect' );

  // Bail if activating from network, or bulk
  if ( is_network_admin() || isset( $_GET['activate-multi'] ) ) {
    return;
  }

  // Redirect to welcome page
  wp_safe_redirect( esc_url( add_query_arg( array( 'page' => 'ampforwp-welcome-page' ), admin_url( 'admin.php' ) ) ) );
  exit();
}			

add_filter('ampforwp_add_admin_subpages', 'ampforwp_add_welcome_pages');
function ampforwp_add_welcome_pages($sections){
	$sections[] = array(
		'page_title'=> esc_html__('Welcome To AMPforWP plugin','accelerated-mobile-pages'),
		'menu_title'=>esc_html__('Welcome to AMP','accelerated-mobile-pages'),
		'page_permissions'=>'manage_options',
		'menu_slug' => 'ampforwp-welcome-page',
		'callback' => 'ampforwp_welcome_screen_content',
		'custom_amp_menu'   => true
	);
	return $sections;
}

function ampforwp_welcome_screen_content() {
  ?>
  	<div class="wrap">
	    <div class="clear"></div>

	    <div class="ampforwp-post-installtion-instructions">

		    <h1 class="amp_installed_heading"><?php echo esc_html__('AMP is now Installed!','accelerated-mobile-pages') ?></h1>
			<div class="amp_installed_text"><p><?php echo esc_html__('Thank you so much for installing the AMPforWP plugin!','accelerated-mobile-pages') ?></p>
			<p><?php echo esc_html__('Our team works really hard to deliver good user experience to you.','accelerated-mobile-pages') ?></p></div>
			<div class="getstarted_wrapper">
            <div class="amp_user_onboarding">
            <div class="amp_new_user amp_user_onboarding_choose">
                <div class="amp_user_avatar"></div>
                <h3><?php echo esc_html__("I'm a New User!","accelerated-mobile-pages") ?></h3>
                <p><?php echo esc_html__("We have recommend you to go through AMP installation wizard which helps setup the Basic AMP and get started immediatly.","accelerated-mobile-pages") ?></p>
                <a href="<?php echo esc_url(wp_nonce_url(admin_url('plugins.php?page=ampforwptourinstaller&ampforwp_install=1'), '_wpnonce'));?>"><?php echo esc_html__("Run Installation Wizard","accelerated-mobile-pages") ?></a>
            </div>
            <div class="amp_expert_user amp_user_onboarding_choose">
                <div class="amp_user_avatar"></div>
                <h3><?php echo esc_html__("I'm an Experienced User!","accelerated-mobile-pages") ?></h3>
                <p><?php echo esc_html__("We have many settings in Options Panel to help you setup the AMP perfectly to according to your taste & needs.","accelerated-mobile-pages") ?></p>
                <a href="<?php echo esc_url(admin_url('admin.php?tabid=opt-text-subsection&page=amp_options'));?>"><?php echo esc_html__("AMP Options Panel","accelerated-mobile-pages") ?></a>                    
            </div>
			
            <div class="clear"></div>
            </div>
 			</div>
 			<div style="float:right; height: 640px;overflow:auto;">
 				<div class="amp_expert_user amp_user_onboarding_choose">
	                <!--<div class="amp_user_avatar"></div>-->
	                <!--<h3>Change log</h3>-->
	                <?php require AMPFORWP_PLUGIN_DIR.'/includes/change-log.php';?>
            	</div>
 			</div>

		    
		    
            <div class="getstarted_wrapper nh-b">
            <h1 style="color: #008606;font-weight: 300;margin-top: 35px;">
		    	<i class="dashicons dashicons-editor-help" style="font-size: 34px;margin-right: 18px;margin-top: -1px;"></i><?php echo esc_html__('Need Help?','accelerated-mobile-pages') ?>
		    </h1>
			<div class="amp_installed_text"><p><?php echo esc_html__('We\'re bunch of passionate people that are dedicated towards helping our users. We will be happy to help you!','accelerated-mobile-pages') ?></p></div>
            <div class="getstarted_options">
            <p><b><?php echo esc_html__("Getting Started","accelerated-mobile-pages") ?></b></p>
				<ul class="getstarted_ul">
					<li><a href="https://ampforwp.com/tutorials/article-categories/installation-updating/" target="_blank"><?php echo esc_html__("Installation &amp; Setup","accelerated-mobile-pages") ?></a></li>
					<li><a href="https://ampforwp.com/tutorials/article-categories/settings-options/" target="_blank"><?php echo esc_html__("Settings &amp; Options","accelerated-mobile-pages") ?></a></li>
					<li><a href="https://ampforwp.com/tutorials/article-categories/setup-amp/" target="_blank"><?php echo esc_html__("Setup AMP","accelerated-mobile-pages") ?></a></li>
					<li><a href="https://ampforwp.com/tutorials/article-categories/page-builder/" target="_blank"><?php echo esc_html__("Page Builder","accelerated-mobile-pages") ?></a></li>
				</ul>  
            </div>
            <div class="getstarted_options">
            <p><b><?php echo esc_html__("Useful Links","accelerated-mobile-pages") ?></b></p>
				<ul class="getstarted_ul">
					<li><a href="https://ampforwp.com/tutorials/article-categories/extension/" target="_blank"><?php echo esc_html__("Extensions &amp; Themes Docs","accelerated-mobile-pages") ?></a></li>
					<li><a href="https://ampforwp.com/tutorials/article-categories/extending/" target="_blank"><?php echo esc_html__("Developers Docs","accelerated-mobile-pages") ?></a></li>
					<li><a href="https://ampforwp.com/amp-theme-framework/" target="_blank"><?php echo esc_html__("Create a Custom Theme for AMP","accelerated-mobile-pages") ?></a></li>
					<li><a href="https://ampforwp.com/tutorials/article-categories/how-to/" target="_blank"><?php echo esc_html__("General How To's","accelerated-mobile-pages") ?></a></li>
				</ul>  
            </div>
            <div class="clear"></div>
            </div>

		</div>

	</div> <?php
}

add_action('admin_footer','ampforwp_add_welcome_styling');
function ampforwp_add_welcome_styling(){
	$current = "";
	$current = get_current_screen();

	if(!is_object($current)){
		return ;
	}
	if ( 'amp_page_ampforwp-welcome-page' == $current->base || 'toplevel_page_amp_options' == $current->base ) {
	?>
    <style>
    .getstarted_wrapper{ display: inline-block; margin: 0px 0px 5px 0px; }
    .nh-b{display:block;}
    .getstarted_options{float: left; margin-right: 15px;
    background: #fff; border: 1px solid #ddd; padding: 5px 25px 10px 23px; border-radius: 2px;}
    .getstarted_links{float: right; background: #fff; border: 1px solid #ddd; padding: 10px 30px 10px 30px; border-radius: 2px; }
    .ampforwp-post-installtion-instructions, .ampforwp-pre-installtion-instructions{     margin-left: 15px;margin-top: 15px;}
        .getstarted_ul li{        list-style-type: decimal;
		    list-style-position: inside;
		    line-height: 23px;
		    font-size: 15px; }
		.getstarted_options p {
		font-size: 16px;
		    margin-top: 13px;
		    margin-bottom: 10px;
		    color: #333;
		}
		.getstarted_ul a {
		    text-decoration: none;
		    color: #ed1c26;
		}
		.getstarted_ul a:hover {
		    text-decoration: underline;
		    color: #222
		}
		.getstarted_ul {
		    margin-top: 6px;
		}
        a.getstarted_btn{
        	background: #666;
		    color: #fff;
		    padding: 9px 35px 9px 35px;
		    font-size: 13px;
		    line-height: 1;
		    text-decoration: none;
		    margin-top: 8px;
		    display: inline-block;}
        .dashicons-warning, .dashicons-yes{
            font-family: dashicons;
            font-style: normal;
            position: relative;
            top: 1px;
            font-size: 32px;
            margin-right: 18px;
        }
        .dashicons-yes{
            margin-right: 25px;
        }
        .dashicons-yes:before {
            content: "\f147";
            background: #388e3c;
   