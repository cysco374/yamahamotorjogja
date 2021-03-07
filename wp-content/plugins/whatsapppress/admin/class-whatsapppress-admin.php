<?php

/**
 * The admin-specific functionality of the plugin.
 *
 * @link       http://abeltra.me/
 * @since      1.0.0
 *
 * @package    Whatsapppress
 * @subpackage Whatsapppress/admin
 */

/**
 * The admin-specific functionality of the plugin.
 *
 * Defines the plugin name, version, and two examples hooks for how to
 * enqueue the admin-specific stylesheet and JavaScript.
 *
 * @package    Whatsapppress
 * @subpackage Whatsapppress/admin
 * @author     ABeltramo <beltramo.ale@gmail.com>
 */
class Whatsapppress_Admin {

	/**
	 * The ID of this plugin.
	 *
	 * @since    1.0.0
	 * @access   private
	 * @var      string    $plugin_name    The ID of this plugin.
	 */
	private $plugin_name;

	/**
	 * The version of this plugin.
	 *
	 * @since    1.0.0
	 * @access   private
	 * @var      string    $version    The current version of this plugin.
	 */
	private $version;

	/**
	 * The options name to be used in this plugin
	 *
	 * @since  	1.0.0
	 * @access 	private
	 * @var  	string 		$option_name 	Option name of this plugin
	 */
	private $option_name = 'whatsapppress';

	/**
	 * Initialize the class and set its properties.
	 *
	 * @since    1.0.0
	 * @param      string    $plugin_name       The name of this plugin.
	 * @param      string    $version    The version of this plugin.
	 */
	public function __construct( $plugin_name, $version ) {

		$this->plugin_name = $plugin_name;
		$this->version = $version;

	}

	/**
	 * Add an options page under the Settings submenu
	 *
	 * @since  1.0.0
	 */
	public function add_options_page() {

		$this->plugin_screen_hook_suffix = add_options_page(
			__( 'WhatsappPress Settings', 'whatsapppress' ),
			__( 'WhatsappPress', 'whatsapppress' ),
			'manage_options',
			$this->plugin_name,
			array( $this, 'display_options_page' )
		);

	}

	/**
	 * Render the options page for plugin
	 *
	 * @since  1.0.0
	 */
	public function display_options_page() {
		include_once 'partials/whatsapppress-admin-display.php';
	}

	/**
	 * Save the settings in admin page
	 *
	 * @since  1.0.0
	 */
	public function register_setting() {

		// Add a General section
		add_settings_section(
			$this->option_name . '_wp',
			__( 'Whatsapp API', 'whatsapppress' ),
			array( $this, $this->option_name . '_general_cb' ),
			$this->plugin_name
		);

		// Phone number
		add_settings_field(
			$this->option_name . '_whatsappID',
			__( 'Phone number', 'whatsapppress' ),
			array( $this, $this->option_name . '_whatsappID_cb' ),
			$this->plugin_name,
			$this->option_name . '_wp',
			array( 'label_for' => $this->option_name . '_whatsappID', 'intval' )
		);

		// Default message
		add_settings_field(
			$this->option_name . '_message',
			__( 'Default message', 'whatsapppress' ),
			array( $this, $this->option_name . '_message_cb' ),
			$this->plugin_name,
			$this->option_name . '_wp',
			array( 'label_for' => $this->option_name . '_message')
		);

		// Add a General section
		add_settings_section(
			$this->option_name . '_general',
			__( 'Button style', 'whatsapppress' ),
			array( $this, $this->option_name . '_button_style_cb' ),
			$this->plugin_name
		);

		// Size of control
		add_settings_field(
			$this->option_name . '_size',
			__( 'Control size', 'whatsapppress' ),
			array( $this, $this->option_name . '_size_cb' ),
			$this->plugin_name,
			$this->option_name . '_general',
			array( 'label_for' => $this->option_name . '_size', 'intval' )
		);

		// Position of button
		add_settings_field(
			$this->option_name . '_position',
			__( 'Position of button', 'whatsapppress' ),
			array( $this, $this->option_name . '_position_cb' ),
			$this->plugin_name,
			$this->option_name . '_general',
			array( 'label_for' => $this->option_name . '_position')
		);

		// Position of button
		add_settings_field(
			$this->option_name . '_z_index',
			__( 'z-index', 'whatsapppress' ),
			array( $this, $this->option_name . '_z_index_cb' ),
			$this->plugin_name,
			$this->option_name . '_general',
			array( 'label_for' => $this->option_name . '_z_index', 'intval')
		);

		register_setting( $this->plugin_name, $this->option_name . '_whatsappID');
		register_setting( $this->plugin_name, $this->option_name . '_size');
		register_setting( $this->plugin_name, $this->option_name . '_message');
		register_setting( $this->plugin_name, $this->option_name . '_position');
		register_setting( $this->plugin_name, $this->option_name . '_z_index');
	}

	/**
	 * Render the text for the general section
	 *
	 * @since  1.0.0
	 */
	public function whatsapppress_general_cb() {

		echo '<p>' . __( 'For more information see <a href="https://www.whatsapp.com/faq/en/general/26000030">Whatsapp FAQ</a>', 'whatsapppress' ) . '</p>';
	
	}

	/**
	 * Render the input box for whatsappID
	 *
	 * @since  1.0.0
	 */
	public function whatsapppress_whatsappID_cb() {

		$whatsappID = get_option( $this->option_name . '_whatsappID' );
		echo '<input type="text" name="' . $this->option_name . '_whatsappID' . '" id="' . $this->option_name . '_whatsappID' . '" value="' . $whatsappID . '"> ';
	
	}

	/**
	 * Render the input box for control size
	 *
	 * @since  1.0.0
	 */
	public function whatsapppress_size_cb() {

		$size = get_option( $this->option_name . '_size', "50" );
		echo '<input type="number" name="' . $this->option_name . '_size' . '" id="' . $this->option_name . '_size' . '" value="' . $size . '"> '.__( 'Pixel', 'whatsapppress' );
		
	}

	/**
	 * Render the text for the general section
	 *
	 * @since  1.0.0
	 */
	public function whatsapppress_button_style_cb() {

		echo '<p>' . __( 'This options modify the style of the button in the page', 'whatsapppress' ) . '</p>';
	
	}

	/**
	 * Render the input box for control size
	 *
	 * @since  1.0.0
	 */
	public function whatsapppress_message_cb() {

		$msg = get_option( $this->option_name . '_message', "Hi there!" );
		echo '<textarea name="' . $this->option_name . '_message" id="' . $this->option_name . '_message" cols="30" rows="4">'.$msg.'</textarea>';
		
	}


	/**
	 * Render the position radio boxes
	 *
	 * @since  1.0.0
	 */
	public function whatsapppress_position_cb() {
		$position = get_option( $this->option_name . '_position', "bottomright" );

		?>
			<fieldset>
				<label>
					<input type="radio" name="<?php echo $this->option_name . '_position' ?>" id="<?php echo $this->option_name . '_position' ?>" value="topleft" <?php checked( $position, 'topleft' ); ?>>
					<?php _e( 'Top Left', 'outdated-notice' ); ?>
				</label>
				<br>
				<label>
					<input type="radio" name="<?php echo $this->option_name . '_position' ?>" value="topright" <?php checked( $position, 'topright' ); ?>>
					<?php _e( 'Top Right', 'outdated-notice' ); ?>
				</label>
				<br>
				<label>
					<input type="radio" name="<?php echo $this->option_name . '_position' ?>" value="bottomright" <?php checked( $position, 'bottomright' ); ?>>
					<?php _e( 'Bottom Right', 'outdated-notice' ); ?>
				</label>
				<br>
				<label>
					<input type="radio" name="<?php echo $this->option_name . '_position' ?>" value="bottomleft" <?php checked( $position, 'bottomleft' ); ?>>
					<?php _e( 'Bottom Left', 'outdated-notice' ); ?>
				</label>
			</fieldset>
		<?php

	}

	/**
	 * Render the position radio boxes
	 *
	 * @since  1.0.2
	 */
	 public function whatsapppress_z_index_cb() {

		$zindex = get_option( $this->option_name . '_z_index', "99" );
		echo '<input type="number" name="' . $this->option_name . '_z_index' . '" id="' . $this->option_name . '_z_index' . '" value="' . $zindex . '"> <a href="https://www.w3schools.com/cssref/pr_pos_z-index.asp" target="blank">?</a>';
		
	}

	/**
	 * Register the stylesheets for the admin area.
	 *
	 * @since    1.0.0
	 */
	public function enqueue_styles() {

		/**
		 * This function is provided for demonstration purposes only.
		 *
		 * An instance of this class should be passed to the run() function
		 * defined in Whatsapppress_Loader as all of the hooks are defined
		 * in that particular class.
		 *
		 * The Whatsapppress_Loader will then create the relationship
		 * between the defined hooks and the functions defined in this
		 * class.
		 */

		wp_enqueue_style( $this->plugin_name, plugin_dir_url( __FILE__ ) . 'css/whatsapppress-admin.css', array(), $this->version, 'all' );

	}

	/**
	 * Register the JavaScript for the admin area.
	 *
	 * @since    1.0.0
	 */
	public function enqueue_scripts() {

		/**
		 * This function is provided for demonstration purposes only.
		 *
		 * An instance of this class should be passed to the run() function
		 * defined in Whatsapppress_Loader as all of the hooks are defined
		 * in that particular class.
		 *
		 * The Whatsapppress_Loader will then create the relationship
		 * between the defined hooks and the functions defined in this
		 * class.
		 */

		wp_enqueue_script( $this->plugin_name, plugin_dir_url( __FILE__ ) . 'js/whatsapppress-admin.js', array( 'jquery' ), $this->version, false );

	}

}
