<!-- step 1 -->
<?php
global $current_user;
?>
<?php wp_nonce_field( 'tab_welcome', 'ml_nonce' ); ?>
<div class="ml-init-page">

	<!-- Start initial details block -->
	<div id='ml-initial-details' class="ml-col-onesecond-f card">
		<div class="ml-card-wrap">
			<form action="https://www.mobiloud.com/demo-success/" method="post" target="_blank" class="contact-form">
				<?php wp_nonce_field( 'ml-form-welcome' ); ?>
				<input type="hidden" name="step" value="1">
				<span></span>
				<label for="pname">Your Name&nbsp;<span class="red">*</span></label>
				<input type="text" class="form-control" id="pname" value="<?php echo esc_attr( Mobiloud::get_option( 'ml_user_name', '' ) ); ?>"
					name="name" placeholder="Your name" minlength="2" required="" aria-required="true" maxlength="100">
				<br>
				<label for="pemail">Your email&nbsp;<span class="red">*</span></label>
				<input type="email" class="form-control" id="pemail" value="<?php echo esc_attr( Mobiloud::get_option( 'ml_user_email', $current_user->user_email ) ); ?>"
					name="email" placeholder="Your email address" required="" aria-required="true" maxlength="254">
				<br>
				<label for="psite">Your website's address&nbsp;<span class="red">*</span></label>
				<input type="url" class="form-control" id="psite" value="<?php echo esc_attr( Mobiloud::get_option( 'ml_user_site', get_site_url() ) ); ?>"
					name="site" placeholder="http://www.yoursite.com" required="" aria-required="true" maxlength="100">
				<br>
				<label for="pcompany_name">Company or Site name&nbsp;<span class="red">*</span></label>
				<input type="text" class="form-control" id="pcompany_name" value="<?php echo esc_attr( Mobiloud::get_option( 'ml_user_company', get_option( 'blogname' ) ) ); ?>"
					name="company_name" placeholder="Company or Site name" required="" aria-required="true" maxlength="100">
				<br>
				<label for="pphone">Phone number (incl. country code)&nbsp;<span class="red">*</span></label>
				<input type="text" class="form-control" id="pphone" value="<?php echo esc_attr( Mobiloud::get_option( 'ml_user_phone', '' ) ); ?>"
					name="phone" required="" aria-required="true" maxlength="100">
				<br>
				<label for="pmessage">Tell us about your app&nbsp;<span class="red">*</span><br>
					<span class="ml-subtitle">Tell us what you'd like to achieve with the app so we can recommend the best solution for your specific needs.</span>
				</label>
				<textarea class="form-control" id="pmessage" name="message" required="" aria-required="true" rows="2"
					maxlength="100"><?php echo esc_textarea( htmlspecialchars( Mobiloud::get_option( 'ml_user_message', '' ), ENT_NOQUOTES ) ); ?></textarea>
				<br>

				<!--
				<label class="checkbox_lbl checkbox_welcome">
					<input type="checkbox" name="pricing" id="pricing" value="1" required="">
					<span class="checkbox_content">I'm aware MobiLoud is a complete service starting at $249/month ($199/m paid annually), for more details see the <a href="https://www.mobiloud.com/pricing/?utm_source=news-plugin&utm_medium=welcome-screen" target="_blank">pricing page</a><span class="red">*</span></span>
				</label>
				<br>
				-->
				<label class="checkbox_lbl checkbox_welcome">
					<input type="checkbox" name="accept" id="accept" value="1" required="" aria-required="true">
					<span class="checkbox_content">I accept MobiLoud's <a href="https://www.mobiloud.com/terms/?utm_source=news-plugin&utm_medium=welcome-screen" target="_blank">Terms of Service</a>
						and <a href="https://www.mobiloud.com/privacy/?utm_source=news-plugin&utm_medium=welcome-screen" target="_blank">Privacy Policy</a><span class="red">*</span></span>
				</label>
				<br>
				<label class="checkbox_lbl checkbox_welcome">
					<input type="checkbox" name="newsletter" id="newsletter" value="1" <?php checked( 1, Mobiloud::get_option( 'ml_user_newsletter', '' ), true ); ?>>
					<span class="checkbox_content">I would like to receive content from MobiLoud such as articles and free guides on how to build,
						launch and promote mobile apps.</span>
				</label>
				<br>
				<br>
				<div class='ml-col-row ml-init-button'>
					<button type="submit" name="submit" id="submit" class="button button-hero button-primary ladda-button" data-style="zoom-out">Get Started</button>
				</div>
			</form>
		</div>
	</div>
	<!-- Learn more block -->
	<div class="ml-col-onesecond-f card">
		<div class="ml-card-wrap">
			<h3>Launch mobile apps for your WordPress site</h3>
			<p>MobiLoud is a complete service to have a native mobile app built for your WordPress website. We take care of everything for you,
				from configuring to publishing your app and maintaining it over time. Offering an unmatched level of service is our obsession.
				Any questions? <a href="mailto:support@mobiloud.com">Send us an email</a> or <a href="https://www.mobiloud.com?utm_source=news-plugin&utm_medium=welcome-screen">read more on our website</a>.</p>
			<div class="ml-image-block">
				<img src="<?php echo esc_attr( MOBILOUD_PLUGIN_URL . 'assets/img/welcome.png' ); ?>" width="500">
			</div>
			<h3>Connect directly with your users</h3>
			<ul class="ml-welcome">
				<li>Find your users on App Store and Google Play</li>
				<li>Grow traffic and retention with push notifications</li>
				<li>Offer a better user experience on mobile</li>
				<li>Monetize with native mobile advertising</li>
			</ul>
			<!--
			<br/>
			<h3>Fully integrated with WordPress</h3>
			<ul class="ml-welcome">
				<li>Compatible with your theme and all your plugins</li>
				<li>App configured, built and published for you</li>
				<li>Send manual and automatic notifications from WordPress</li>
				<li>Tight integration with all WordPress features</li>
			</ul>
			-->
		</div>
	</div>
</div>
