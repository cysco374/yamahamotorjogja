<?php

/**
 * The public-facing functionality of the plugin.
 *
 * @link       http://abeltra.me/
 * @since      1.0.0
 *
 * @package    Whatsapppress
 * @subpackage Whatsapppress/public
 */

/**
 * The public-facing functionality of the plugin.
 *
 * Defines the plugin name, version, and two examples hooks for how to
 * enqueue the admin-specific stylesheet and JavaScript.
 *
 * @package    Whatsapppress
 * @subpackage Whatsapppress/public
 * @author     ABeltramo <beltramo.ale@gmail.com>
 */
class Whatsapppress_Public {

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
	 * @param      string    $plugin_name       The name of the plugin.
	 * @param      string    $version    The version of this plugin.
	 */
	public function __construct( $plugin_name, $version ) {

		$this->plugin_name = $plugin_name;
		$this->version = $version;

	}

	/**
	 * Register the stylesheets for the public-facing side of the site.
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

		wp_enqueue_style( $this->plugin_name, plugin_dir_url( __FILE__ ) . 'css/whatsapppress-public.css', array(), $this->version, 'all' );

	}

	/**
	 * Register the JavaScript for the public-facing side of the site.
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

		wp_enqueue_script( $this->plugin_name, plugin_dir_url( __FILE__ ) . 'js/whatsapppress-public.js', array( 'jquery' ), $this->version, false );

	}

	/**
	 * Add the whatsapp button to the public site
	 *
	 * @since    1.0.0
	 */
	public function add_whatsapp_button(){

		$whatsappID = get_option( $this->option_name . '_whatsappID', "" );
		$message = rawurlencode(get_option( $this->option_name . '_message', "Hi there!" ));
		$size = get_option( $this->option_name . '_size' , "50" );
		$position = get_option( $this->option_name . '_position' );
		$margin = get_option( $this->option_name . '_margin', "10px" );
		$zindex = get_option( $this->option_name . '_z_index', "10px" );

		if($position == "topleft"){
			$position = "top:".$margin."; left:".$margin;
		} else if($position == "topright"){
			$position = "top:".$margin."; right:".$margin;
		} else if($position == "bottomright"){
			$position = "bottom:".$margin."; right:".$margin;
		} else {
			$position = "bottom:".$margin."; left:".$margin;
		}

		echo "<div class='whatsappPress' style='$position; z-index:$zindex;'>
				<a target='blank' href='https://api.whatsapp.com/send?phone=" . $whatsappID . "&text=$message'>
					<img width='".$size."px' height='".$size."px' src='" . plugin_dir_url( __FILE__ ) . "resources/whatsapp.svg'></img>
				</a>
			</div>";
	}

}
