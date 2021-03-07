<?php

/**
 * Provide a admin area view for the plugin
 *
 * This file is used to markup the admin-facing aspects of the plugin.
 *
 * @link       http://abeltra.me/
 * @since      1.0.0
 *
 * @package    Whatsapppress
 * @subpackage Whatsapppress/admin/partials
 */
?>

<div class="wrap">
	<h2><?php echo esc_html( get_admin_page_title() ); ?></h2>
	<form action="options.php" method="post">
		<?php
			settings_fields( $this->plugin_name );
			do_settings_sections( $this->plugin_name );
			submit_button();
		?>
	</form>
	<div>
		<h2 style="text-align:center;">Credits</h2>
		<h5 style="text-align:center;">
			<a target="blank" href="https://www.paypal.me/abeltramo/">
				<img src="https://www.paypalobjects.com/webstatic/en_US/i/btn/png/btn_donate_92x26.png" alt="paypal" style="max-width:100%;">
			</a>
			<br>Made with love by <a href="http://abeltra.me/">ABeltramo</a>, you can <a href="https://github.com/ABeltramo/WhatsappPress">fork it</a> on Github
		</h5>
	</div>
</div>