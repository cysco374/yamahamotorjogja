<?php

class Mobiloud_Intercom {

	private static $initiated = false;

	public static function init() {
		add_action( 'admin_head', [ __CLASS__, 'init_intercom' ] );
	}


	/**
	 * Init Intercom
	 *
	 * @return bool
	 */
	public static function init_intercom() {
		if ( self::$initiated ) {
			return true;
		}
		if ( self::is_on() && self::is_mobiloud_page() && is_admin() && current_user_can( 'administrator' ) && Mobiloud::get_option( 'ml_initial_details_saved' ) ) {
			$user_email    = Mobiloud::get_option( 'ml_user_email' );
			$user_name     = Mobiloud::get_option( 'ml_user_name', '' );
			$user_site     = Mobiloud::get_option( 'ml_user_site', '' );
			$user_sitetype = Mobiloud::get_option( 'ml_user_sitetype', '' );
			$user_company  = Mobiloud::get_option( 'ml_user_company', '' );
			$user_phone    = Mobiloud::get_option( 'ml_user_phone', '' );
			$theme         = wp_get_theme();
			$theme_name    = $theme->Name;
			$theme_path    = get_stylesheet_directory_uri();
			$settings      = [
				'email'          => $user_email,
				'name'           => $user_name,
				'site'           => $user_site,
				'installurl'     => get_site_url(),
				'sitename'       => get_bloginfo( 'name' ),
				'pb_key'         => Mobiloud::get_option( 'ml_pb_app_id' ),
				'os_key'         => Mobiloud::get_option( 'ml_onesignal_app_id' ),
				'version'        => MOBILOUD_PLUGIN_VERSION,
				'post_count'     => wp_count_posts()->publish,
				'language'       => get_locale(),
				'site_type'      => $user_sitetype,
				'company'        => $user_company,
				'phone'          => $user_phone,
				'homepage_type'  => get_option( 'show_on_front' ),
				'app_id'         => 'h89uu5zu',
				'user_id'        => $user_email,
				'user_hash'      => hash_hmac( 'sha256', $user_email, '2d8ReoNHhovD4NhWCb72DgrghadvKVwGJsR0t6YR' ),
				'haswoocommerce' => is_plugin_active( 'woocommerce/woocommerce.php' ) || class_exists( 'Woocommerce' ) ? '"yes"' : '"no"',
				'hasbuddypress'  => is_plugin_active( 'buddypress/bp-loader.php' ) || class_exists( 'BuddyPress' ) ? '"yes"' : '"no"',
				'theme_name'     => $theme_name,
				'theme_path'     => $theme_path,
				'news'           => 'yes',
			];
			?>
			<script id="IntercomSettingsScriptTag">
				window.intercomSettings = <?php echo wp_json_encode( $settings ); ?>;
			</script>
			<script>(function () {
				var w = window;
				var ic = w.Intercom;
				if (typeof ic === "function") {
					ic('reattach_activator');
					ic('update', intercomSettings);
				} else {
					var d = document;
					var i = function () {
						i.c(arguments)
					};
					i.q = [];
					i.c = function (args) {
						i.q.push(args)
					};
					w.Intercom = i;
					function l() {
						var s = d.createElement('script');
						s.type = 'text/javascript';
						s.async = true;
						s.src = 'https://widget.intercom.io/widget/h89uu5zu';
						var x = d.getElementsByTagName('script')[0];
						x.parentNode.insertBefore(s, x);
					}

					if (w.attachEvent) {
						w.attachEvent('onload', l);
					} else {
						w.addEventListener('load', l, false);
					}
				}
			})()</script>
			<?php
			self::$initiated = true;
			return true;
		}
		return false;
	}

	/**
	 * Track an event using Intercom
	 *
	 * @param string $action
	 */
	public static function track( $action ) {
		if ( self::is_on() && is_admin() && current_user_can( 'administrator' ) ) {
			if ( ! self::$initiated ) {
				if ( ! self::init_intercom() ) {
					return false;
				}
			}
			?>
			<script type="text/javascript">
				Intercom("trackUserEvent", "<?php echo esc_js( $action ); ?>");
			</script>
			<?php
			return true;
		}
		return false;
	}

	/**
	 * Is tracking allowed
	 *
	 * @return bool
	 */
	private static function is_on() {
		return ! empty( Mobiloud::get_option( 'ml_user_email' ) );
	}

	/**
	 * Check if currently on mobiloud plugin page
	 *
	 * @return bool
	 */
	private static function is_mobiloud_page() {
		return isset( $_GET['page'] ) && strpos( sanitize_text_field( wp_unslash( $_GET['page'] ) ), 'mobiloud' ) !== false;
	}
}
