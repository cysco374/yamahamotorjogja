<?php
class wappPress_admin_setting extends wappPress {

	function __construct() {

			add_action( 'admin_menu', array( $this, 'maker_menu' ), 7);

			add_action( 'admin_init', array( $this, 'register_settings' ) );

			add_action( 'wp_ajax_create_app', array( $this, 'create_app' ) );

			add_action( 'wp_ajax_create_push_app', array( $this, 'create_push_app' ) );

			add_action( 'wp_ajax_get_app', array( $this, 'get_app' ) );

			add_action( 'wp_ajax_search_post_handler', array( $this, 'search_post_results' ) );

			if ( isset( $_GET['clear_app_cookie'] ) && 'true' === $_GET['clear_app_cookie'] ) {

				  self::reset_cookie();

			}

			

	}



	public function maker_menu() {

		$dirPlgUrl  = trailingslashit( plugins_url('wappPress') );

		$pageTitle = __( 'WappPress', 'WappPress' );

		$maPlgin = 'wapppressplugin';

		$maSett = 'wapppresssettings';

		$maTheme = 'wapppresstheme';

		$maPush = 'wapppresspush';

		$plgIcon  = $dirPlgUrl  . 'images/view.png';

		$dirInc1  = $dirPlgUrl  . 'includes/';

		

		// Create main menu 

		// add_menu_page( $page_title, $menu_title, $capability, $menu_slug, $function )

		$mainMenu = add_menu_page( $pageTitle, $pageTitle, 'manage_options', $maSett, array( $this, 'maker_settings_page' ),$plgIcon  );

		global $submenu;

		// Settings page sub menu

		$subSettingMenu = add_submenu_page($maSett, __( 'Settings', 'wappPress' ), __( 'Settings', 'wappPress' ),  'manage_options', $maSett, array( $this, 'maker_settings_page' ));
		
		$subPushMenu = add_submenu_page($maSett, __( 'Push Notification', 'wappPress' ), __( 'Push Notification', 'wappPress' ),  'manage_options', $maPush, array( $this, 'maker_push_page' ));

		$subThemeMenu = add_submenu_page($maSett, __( 'Themes', 'wappPress' ), __( 'Themes', 'wappPress' ),  'manage_options', $maTheme, array( $this, 'maker_theme_page' ));

				

	}

	

	// Setting Page 

	public function maker_settings_page(){

	require_once(  'header.php' );

	

	$dirIncImg  = trailingslashit(plugins_url('wappPress'));

	$options = get_option('wapppress_settings');

	$args= array();	

	$all_themes = wp_get_themes( $args );

	$check = isset( $options['wapppress_theme_switch'] ) ? esc_attr( $options['wapppress_theme_switch'] ) : '';

	$authorCheck = isset( $options['wapppress_theme_author'] ) ? esc_attr( $options['wapppress_theme_author'] ) : '';

	$dateCheck = isset( $options['wapppress_theme_date'] ) ? esc_attr( $options['wapppress_theme_date'] ) : '';

	$commentCheck = isset( $options['wapppress_theme_comment'] ) ? esc_attr( $options['wapppress_theme_comment'] ) : '';

	$frontpage_id2 =  get_option('page_on_front');

	

	if($options['wapppress_theme_switch'] =='on'){ ?>

	<input type="hidden" id="wapppress_url"  value='<?php echo get_site_url() ; ?>' /> 

	<?php }else{ ?>

	<input type="hidden" id="wapppress_url"  value='<?php echo get_site_url().'/?wapppress=1' ; ?>' /> 

	<?php } ?>

	<div class="contant-section1">

		<div class="section">

		<div class="wrapper">

			<div class="contant-section">

				<div class="setting-head">

					<h3>1. SETTINGS</h3>

					<img src="<?php echo plugins_url( '../images/line.png',  __FILE__ ) ?>" title="" alt=""/>

				</div>

				

				<!--===Setting Box Start===--->

				<div class="setting-box">

					<div class="inner_left">

						<div class="inner_header2">

							<div class="tabs">

								<div class="tab-content">

								<form method="post" action="options.php">

									<div id="tab1" class="tab active">

										<ul id="toggle-view">

										<?php

											// settings_fields( $option_group )

											settings_fields( 'wapppress_group' );

											// do_settings_sections( $page )

											do_settings_sections( __FILE__ );

											?>

											<li>

											<h3 class="test">Enter Your App name</h3>

											<span><img src="<?php echo plugins_url( '../images/arrow.png',  __FILE__ ) ?>" alt=""></span>

											<div class="panel">

												<p>

													<input class="app_input"  type="text" id="wapppress_name" name="wapppress_settings[wapppress_name]" value="<?php echo $options['wapppress_name']; ?>" />

												</p>

											</div>

											</li>

											<li>

											<h3>Enable/Disable theme setting on desktop</h3>

											<span><img src="<?php echo plugins_url( '../images/arrow.png',  __FILE__ ) ?>" alt=""></span>

											<div class="panel">

												<p>

													<input type="radio" name="wapppress_settings[wapppress_theme_switch]"<?php checked( $check, 'on'.false ); ?> value='on' /> Enable &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; <input type="radio" value=''  name="wapppress_settings[wapppress_theme_switch]" <?php checked( $check, ''.false ); ?> /> Disable

												</p>

											</div>

											</li>

											<li>

											<h3>Select Theme</h3>

											<span><img src="<?php echo plugins_url( '../images/arrow.png',  __FILE__ ) ?>" alt=""></span>

											<div class="panel">

												<p>

													<select name="wapppress_settings[wapppress_theme_setting]" id="wapppress_theme_setting"  class="app_input_select">

														<?php $the = array(); 

														foreach($all_themes as $theme_val =>$theme_name){ 

														 $nonce = wp_create_nonce('switch-theme_'.$theme_val);

														 $src = admin_url().'customize.php?action=preview&theme='.$theme_val;

														 $theme_val = $theme_val == 'option-none' ? '' : esc_attr( $theme_val ); 

														 echo $the[ $theme_val ] = '<option id="'.$src.'" value="'. $theme_val .'" '. selected( $options['wapppress_theme_setting'],$theme_val, false) .'>'. esc_html( $theme_name ) .'</option>

														'."\n"; 

														} ?>

													</select>

												</p>

											</div>

											</li>

											<li>

											<h3>Use a unique homepage for your app</h3>

											<span><img src="<?php echo plugins_url( '../images/arrow.png',  __FILE__ ) ?>" alt=""></span>

											<div class="panel">

												<p>Start typing to search for a page, or enter a page ID.</p>

												<p>

													<?php $frontpage_id1 =  get_option('page_on_front'); 

													if($frontpage_id1 !=$options['wapppress_home_setting']){

													?>

													<input class="app_input"  type="text" id="wapppress_home_setting" name="wapppress_settings[wapppress_home_setting]" value="<?php echo $options['wapppress_home_setting']; ?>" />

													<?php }else{ ?>

													<input class="app_input"  type="text" id="wapppress_home_setting" name="wapppress_settings[wapppress_home_setting]" value="" />

													<?php } ?>

												</p>

										<div class='wapppress_field_markup_text' id="wapppress_field_markup_text"></div>

											</div>

											</li>

											<li>

											<h3>Customize Your Theme</h3>

											<span><img src="<?php echo plugins_url( '../images/arrow.png',  __FILE__ ) ?>" alt=""></span>

											<div class="panel">

												<p>

													<input  type="checkbox" name="wapppress_settings[wapppress_theme_date]"  class="checkbox"  <?php checked( $dateCheck, 'on'.false ); ?> /> Display Date

												</p>

												<p>

													<input  type="checkbox" name="wapppress_settings[wapppress_theme_comment]"  class="checkbox"  <?php checked($commentCheck, 'on'.false ); ?> />  Display Comments

												</p>

												

											</div>

											</li>

										</ul>

									</div>

									

									<div class="save-btn">

										<input id="submit" style='padding:0 !important'  type="image" src="<?php echo plugins_url( '../images/btn3.png',  __FILE__ ) ?>" value="Save Changes" name="submit">

									</div>

									<div style='margin-top: 15px;'>

									<a href='#bulid'><img src='<?php echo plugins_url( '../images/btn6.png',  __FILE__ ) ?>' /></a>

									</div>

								</div>

								</form>

								

							</div>

						</div>

					</div>

					<div class="wrap-right mobileFrame">

						<iframe frameborder="0" allowtransparency="no" name="mobile_frame" id="mobile_frame" src="<?php echo get_site_url() ; ?>"/>

						</iframe>

					</div>

					

					<div class="clear">

					</div>

				</div>

				<!--===Setting Box End===--->

				

				<!--===Android APP Box Start===--->

				<div id='bulid'>&nbsp;</div>

				<div class="sec-2" style="border-bottom:0px;">

					<div class="setting-sec">

						<div class="setting-head" id='head'>

							<h3>2. BUILD ANDROID APP</h3>

							<img src="<?php echo plugins_url( '../images/line.png',  __FILE__ ) ?>" title="" alt=""/>

						</div>						

						<?php 

						if (isset($_COOKIE['wapppress_proxy_old'])) {?>

						<object data="<?php echo get_app_url('complile');?>" width="100%" style="width:100%;height:1650px;">

						<embed src=<?php echo get_app_url('complile');?>" width="100%" style="width:100%;height:1650px;"> </embed>

						<p class="copile_error" style="text-transform: none;min-height: 100px;" >There was some problem while Building/Generating App at your server, either reload your page OR <a href="<?php echo get_app_url('complile');?>" target="_blank" >CLICK HERE TO COMPILE IT DIRECTLY ON OUR SERVER</a>.<br/>

						</p>

						</object>	

						

						<?php }	else {?>																

						<div id='supportId' class='msgAlert'></div>

						<div id='errorResponse' class='msgAlert'></div>

						<form role="form" action="#"  id="customer_support">

						<input type="hidden" name='dirPlgUrl1' id='dirPlgUrl1' value='<?php echo $dirIncImg; ?>'/>

						<div class="setting-form">

							<div class="supportForms_input">

								<p>

									Name:- <br /><input type="text" name='name' id='name' />

								</p>

							</div>

							<br/>

							<div class="supportForms_input">

								<p>

									Email:- <br /><input type="text" name='semail' id='semail' />

								</p>

							</div>

							<br/>

							<div class="supportForms_input">

								<p>

									 App Name (<em><span class='fon_cls'>Please enter only unique app name.</span></em>) :- <br /><input type="text" name='app_name' id='app_name' />

								</p>

							</div>

							<br/>

							<div class="supportForms_input">

								<p>

									 Choose Launcher Icon Design Type:-<br />

								</p>

								<p>

									<input style='width:0% !important' type="hidden"  name='custom_launcher_logo' id='custom_launcher_logo1' onclick='return show_launcher_logo_form(0);' checked='checked' value='0'/><!--Upload Launcher Icon&nbsp;&nbsp;&nbsp;&nbsp;

									input style='width:0% !important' onclick='return show_launcher_logo_form(1);' type="radio" name='custom_launcher_logo'  value='1'/>

									Customization Launcher Icon-->

								</p>

							</div>

							<br/>

							

							<!--==== Show Upload Div Start ====-->

							<div id="upload_logo_form">

								<div class="supportForms_input">

									<p>

										 App Launcher Icon (<em><span class='fon_cls'>Only .png Icon "Recommended Dimensions 96 x 96" </span></em>) :- <br /><input type="file" name='app_logo' id='app_logo' />

									</p>

								</div>

							</div>

							<!--==== Show Upload Div End ====-->

							

							<!--=== Show Custom Div Start====-->

								<div id='custom_logo_form' style='display:none;'>

									<div class="supportForms_input" >

										<p>

											App Launcher Icon Text :-<br />

											<input type="text" name='app_logo_text' id='app_logo_text' />

										</p>

									</div>

									<br />

									<div class="supportForms_input">

										<p>

											App Launcher Icon Text Color :-<br />

											<select class="app_input valid" name="app_logo_text_color" id="app_logo_text_color">

												<option value="1">Black</option>

												<option value="2" selected='selected'>White</option>

												<option value="3">Red</option>

												<option value="4">Lime</option>

												<option value="5">Blue</option>

												<option value="6">Yellow</option>

												<option value="7">Cyan/Aqua</option>

												<option value="8">Magenta/Fuchsia</option>

												<option value="9">Silver</option>

												<option value="10">Gray</option>

												<option value="11">Maroon</option>

												<option value="12">Olive</option>

												<option value="13">Green</option>

												<option value="14">Purple</option>

												<option value="15">Teal</option>

												<option value="16">Navy</option>

											</select>

										</p>

									</div>

									<br />

									<div class="supportForms_input">

										<p>

											App Launcher Icon Text Font-Size :-<br />

											<select class="app_input valid" name="app_logo_text_font_size" id="app_logo_text_font_size">

											<?php for($i=8;$i<=28;$i++){ ?>

												<option <?php if($i == 18){ echo "selected=''";} ?> value="<?php echo $i; ?>" ><?php echo $i.'px'; ?></option>

											<?php } ?>	

											</select>

										</p>

									</div>

									<br />

									<div class="supportForms_input">

										<p>

											App Launcher Icon Text Font-Family :-<br />

											<select class="app_input valid" name="app_logo_text_font_family" id="app_logo_text_font_family">

												<option value="1" >OpenSans Regular</option>

												<option value="2" >Rupee Foradian</option>

												<option value="3" >Cursiveelegantnormal</option>

												<option value="4" >Chalkdust</option>

												<option value="5" >Barbie</option>

											</select>

										</p>

									</div>

									<br />

									

									<div class="supportForms_input" >

										<p>

											App Launcher Icon Color :-<br /></p>

											<div style='float:left;margin-left: 5px;' class="test1">

											<?php for($l=1;$l<=7;$l++){

													if($l==1){

														 $chk= "checked='checked'";

													}else{

														 $chk=''; 

													}

											?>

											<input <?php echo $chk; ?> style='width:2.6% !important' type="radio" name='app_logo_color'  value='<?php echo $l; ?>'/>

											<img class='app_img'  width="20px" height="20px" src='<?php echo $dirIncImg; ?>images/logos/<?php echo $l; ?>.png'>

											&nbsp; 

											<?php } ?>

											</div>

										<br />

									</div>

								</div>

								<!--=== Show Custom Div End====-->

							<br /><br />		

							<div class="supportForms_input">

								<p>

									 Choose Splash Screen Design Type:-<br />

								</p>

								<p>

									<input style='width:0% !important' type="hidden" name='custom_splash_logo' id='custom_splash_logo1'  onclick='return show_splash_screen_logo_form(0);' checked='checked' value='0'/><!--Upload Splash Screen&nbsp;&nbsp;&nbsp;&nbsp;

									input style='width:0% !important' onclick='return show_splash_screen_logo_form(1);' type="radio" name='custom_splash_logo'   value='1'/>

										Customization Splash Screen-->

								</p>

							</div>

							<br/>

							

							<!--==== Show Splash Upload Div Start ====-->

								<div id='upload_splash_form'>

									<div class="supportForms_input" >

										<p>

											App Splash Screen Image (<em><span class='fon_cls'>Only .jpg image "Recommended Dimensions 480 x 800" </span></em>) :-<br />

											<input type="file" name='app_splash_image' id='app_splash_image' />

										</p>

									</div>

								</div>	

							<!--==== Show Splash Upload Div End ====-->

							

							<!--==== Show Splash Custom Div Start ====-->

							<div id='custom_splash_form' style='display:none;'>

							<div class="supportForms_input" >

								<p>

									 App Splash Screen Text :- <br /><input type="text" name='app_splash_text' id='app_splash_text' />

								</p>

							</div>

							<br/>

							<div class="supportForms_input">

								<p>

									 App Splash Screen Text Color :-<br />

									<select class="app_input valid" name="app_splash_text_color" id="app_splash_text_color">

											<option value="1">Black</option>

											<option value="2" selected='selected'>White</option>

											<option value="3">Red</option>

											<option value="4">Lime</option>

											<option value="5">Blue</option>

											<option value="6">Yellow</option>

											<option value="7">Cyan/Aqua</option>

											<option value="8">Magenta/Fuchsia</option>

											<option value="9">Silver</option>

											<option value="10">Gray</option>

											<option value="11">Maroon</option>

											<option value="12">Olive</option>

											<option value="13">Green</option>

											<option value="14">Purple</option>

											<option value="15">Teal</option>

											<option value="16">Navy</option>

									</select>

								</p>

							</div>

							<br/>

							<div class="supportForms_input">

								<p>

									 App Splash Screen Text Font-Size :-<br />

									<select class="app_input valid" name="app_splash_text_font_size" id="app_splash_text_font_size">

											<?php for($j=8;$j<=40;$j++){ ?>

												<option  <?php if($j == 28){echo "selected=''";} ?> value="<?php echo $j; ?>" ><?php echo $j.'px'; ?></option>

											<?php } ?>	

									</select>

								</p>

							</div>

							<br/>

							<div class="supportForms_input">

								<p>

									App Splash Screen Text Font-Family :-<br />

									<select class="app_input valid" name="app_splash_text_font_family" id="app_splash_text_font_family">

										<option value="1" >OpenSans Regular</option>

										<option value="2" >Rupee Foradian</option>

										<option value="3" >Cursiveelegantnormal</option>

										<option value="4" >Chalkdust</option>

										<option value="5" >Barbie</option>

									</select>

								</p>

							</div>

							<br/>

							<div class="supportForms_input">

								<p>

									 App Splash Screen Color :-<br />

								</p>

								<br />

										<?php

											for($s=1;$s<=35;$s++) {

												if($s==1){

														 $chk1= "checked='checked'";

													}else{

														 $chk1=''; 

													}

												if($s == 1 || $s == 14 || $s== 27 ){

													if($s == 14 || $s== 27 ){

														$style="style='margin-top: 10px;float:left;margin-left: 5px;'";

													}else if($s== 33){

														$style="style='margin-bottom: 10px;margin-top: 10px;float:left;margin-left: 5px;'";

													}else{

														$style="style='float:left;margin-left: 5px;'";

													}

													echo '<div '.$style.' class="test2">';

												}

											?>

											<input <?php echo $chk1; ?> style='width:2.6% !important'  type="radio" name='app_splash_color'  value='<?php echo $s; ?>'/>

											<img  width="20px" height="20px" class='app_img' src='<?php echo $dirIncImg; ?>images/splash/<?php echo $s; ?>.jpg'>&nbsp; 

											<?php

												if($s == 13 || $s == 26 || $s== 35 ){

												echo "</div>";

												echo "<br />";

												}  }  

											?>

									<br />

								<br />
								

							</div>

							</div>
							<br />
							<div class="supportForms_input">
									<p>

									<input style='width:0% !important' type="checkbox" name='adbmob_interstitial' id='adbmob_interstitial'  onclick='return show_AdMob();'  value='0'/>
									
									AdMob (<em><span class='fon_cls'>Only Interstitial Ads</span></em>):-
								 <p id="show_adbmob_interstitial" style="display:none">
									<br />
									Interstitial(Ad unit ID):- <br /><input type="text" name='interstitial_unit_id' id='interstitial_unit_id' placeholder='e.g. ca-app-pub-????????????????/??????????' />

								 </p>
									

								</p>
							</div>
							<br />

							<div class="supportForms_input">

								<p>

									Item Purchase Code:- <br /><input type="text" name='license' id='license' placeholder='CodeCanyon "Item Purchase Code"' />

								</p>

							</div>

							<br/>

						

					

							<div class="clear">

							</div>

							

							<div class="sve_change_btn sve_change_btn2">
											
								<input id="submit" class='submit-build' type="image" src="<?php echo plugins_url( '../images/btn4.png',  __FILE__ ) ?>" value="Save Changes" name="submit">
								<span id="build-btn-load" ><img src="<?php echo plugins_url( '../images/loading-img.gif',  __FILE__ ) ?>" /></span>	
								
								<span id='dwnloakId' style="display: block; margin-right: 160px;float:right;" ></span>
										
							</div>

							<span style='color:#6D6D6D;font-size:13px;'><b>Note:</b> <strong style='color: #0074a2;'>"BUILD/Generate App"</strong> feature will only  work  for the website/s hosted on live server, it would not work in localhost / local server.</span>

						</div>

						</form>

						

						

						<!---=== Launcher Upload PopUp Div  Start ===--->

							<!-- The popup for upload new photo -->

							<div id="icon_popup" class="reveal-modal">

								<div class="inner-modal" >

									<h1>UpLoad Launcher Icon</h1>

									<img  src="<?php echo plugins_url( '../images/shadow1.png',  __FILE__ ) ?>" title="" />

									<div class="inner-modal2">

										<!---Icon Image Form--->

										<form id='upload_lanuchar_icon_form' name='upload_lanuchar_icon_form' enctype="multipart/form-data">

											<div id='upId' style='color: red; font-weight: bold; text-align: center; font-size: 16px;padding: 10px;'>

											</div>

											<input type="hidden" name='dirPlgUrl1' id='dirPlgUrl1' value='<?php echo plugins_url( 'wappPress' ) ?>'/>

											<div class="image-up">

												<span><input type="file" name="app_logo" id="app_logo" value=""/></span>

											</div>

											<div class="image-up2">

												<input type="submit" value="Upload Icon">

											</div>

										</form>

										<div id="loader-icon" style="float: right; margin-right: 1px;display:none;"><img style='margin-left:6px;margin-top:-60px;' src="<?php echo plugins_url( '../images/LoaderIcon.gif',  __FILE__ ) ?>" /></div>

										<div class="clear">

										</div>										

										<!---Crop Icon Image Form--->

										<div id='crop_holder' style='display:none;'>

										<form id='upload_lanuchar_crop_icon_form' name='upload_lanuchar_crop_icon_form'>

										<div id='img_crop__holder'></div>

										<input type="hidden" name='dirPlgUrlUpload' id='dirPlgUrlUpload' value='<?php echo plugins_url( 'wappPress' ) ?>'/> 

										<input type="hidden" id="image_path" name="image_path" value="" />

										<input type="hidden" id="point_x" name="point_x" />

										<input type="hidden" id="point_y" name="point_y" />

										<input type="hidden" id="width" name="width" />

										<input type="hidden" id="height" name="height" />

										</form>

										</div>

									</div>

									<a style='cursor:pointer;'  onclick="close_popup('icon_popup')" class="close-reveal-modal"><img src="<?php echo plugins_url( '../images/cros.png',  __FILE__ ) ?>" title="" alt=""/></a>

								</div>

							</div>

							

						<!---=== Launcher Upload PopUp Div  End ===--->						

						<script type="text/javascript">

						jQuery(document).ready(function () {

							jQuery('#app_icon_img').hover(function() {

								jQuery("img#icon-preview").addClass('transition');

							}, function() {

								jQuery("img#icon-preview").removeClass('transition');

							});

							

							jQuery('input:radio[name="custom_splash_logo"]').filter('[value="0"]').attr('checked', true);

							jQuery('input:radio[name="custom_launcher_logo"]').filter('[value="0"]').attr('checked', true);

							

						});	
						//
							jQuery(window).load(function () {
									jQuery("#build-btn-load").hide();
							});	
						//
						function show_launcher_logo_form(fromId){

							if(fromId==0){

								jQuery('#upload_logo_form').show('slow');

								jQuery('#custom_logo_form').hide('fast');

							}else if(fromId==1){

								jQuery('#custom_logo_form').show('slow');

								jQuery('#upload_logo_form').hide('fast');

							}

							

						}

						

						

						

						function show_splash_screen_logo_form(fId){

							if(fId==0){

								jQuery('#upload_splash_form').show('slow');

								jQuery('#custom_splash_form').hide('fast');

							}else if(fId==1){

								jQuery('#custom_splash_form').show('slow');

								jQuery('#upload_splash_form').hide('fast');

							}

							

						}
						function show_AdMob()
						{
								
							if(jQuery('#adbmob_interstitial').val()==0)
							{
								jQuery('#show_adbmob_interstitial').show('slow');
								jQuery('#adbmob_interstitial').val('1')
								
							}else{
								jQuery('#show_adbmob_interstitial').hide('fast');
								jQuery('#adbmob_interstitial').prop('checked', false);
								jQuery('#adbmob_interstitial').val('0')
								
							}
										

						}
						

						jQuery.validator.addMethod("alphanumeric", function(value, element) {

							return this.optional(element) || /^[a-zA-Z0-9]+$/i.test(value);

						}, "Only allow alpha/numeric.");



						jQuery( "#upload_lanuchar_icon_form" ).validate({

									rules: {

										app_logo: {

											required: function() {

											var a_logo =jQuery('input:radio[name=custom_launcher_logo]:checked').val();

											 if (a_logo==0){

												 return true;

											 }else{

												 return false;

											 }

										  },

										  accept: "png"

										}

									},

									messages: {

											app_logo: {

												required: "Please Upload Your App Launcher Icon."

											}

										},

										submitHandler: function(form) {

										 ajax_launchar_icon_form();

									}

							});

							jQuery("#upload_lanuchar_crop_icon_form" ).validate({

									submitHandler: function(form) {

										 ajax_launchar_crop_icon_form();

									}

							});

						

							jQuery( "#customer_support" ).validate({

									rules: {

										name:{

											required: true

										},

										semail: {

											required: true,

											email:true

										},

										app_logo: {

											required: function() {

											var a_logo =jQuery('input:radio[name=custom_launcher_logo]:checked').val();

											 if (a_logo==0){

												 return true;

											 }else{

												 return false;

											 }

										  },

										  accept: "png"

										},

										app_logo_text: {

										  required: function() {

											var a_logo =jQuery('input:radio[name=custom_launcher_logo]:checked').val();

											 if (a_logo==1){

												 return true;

											 }else{

												 return false;

											 }

										  },

										  maxlength:5

										},

										app_splash_image: {

											required: function() {

											var splash_logo =jQuery('input:radio[name=custom_splash_logo]:checked').val();

											 if (splash_logo==0){

												 return true;

											 }else{

												 return false;

											 }

										  },

										  accept: "jpg|jpeg"

										},

										app_splash_text: {

										  required: function() {

											var splash_logo =jQuery('input:radio[name=custom_splash_logo]:checked').val();

											 if (splash_logo==1){

												 return true;

											 }else{

												 return false;

											 }

										  },

										  maxlength:10

										},

										app_name: {

											required: true,										
											alphanumeric: true,										

											maxlength:23

										},

										license: {

											required: true

										},
										interstitial_unit_id: {

										  required: function() {

											var adMob =jQuery('#adbmob_interstitial').val();

											 if (adMob==1){

												 return true;

											 }else{

												 return false;

											 }

										  },

										  minlength:30

										}

									},

									messages: {

											name: {

												required: "Please enter your name."

											},

											semail: {

												required: "Please enter your email."

											},

											app_logo: {

												required: "Please Upload Your App Launcher Icon."

											},

											app_splash_image: {

												required: "Please upload your app splash screen image."

											},

											app_name: {

												required: "Please enter only unique app name."

											},

											app_logo_text: {

												required: "Please enter your app icon text."

											},

											app_splash_text: {

												required: "Please enter your app splash screen text."

											},

											license: {

												required: 'Please enter license (CodeCanyon "Item Purchase Code").'

											},
											interstitial_unit_id: {

												required: 'Please enter Interstitial (AdMob Ad unit ID).'

											}

										},

										submitHandler: function(form) {

										 ajax_api_form();

									}

							});

							</script>

							<?php }	?>

					</div>

				</div>

				<!--===Android APP Box End===--->

				

			</div>

		</div>

	</div>

</div>

<?php require_once( 'footer.php' );

}

	//App Core Setting function	

	function register_settings() {

		// register_setting( $option_group, $option_name, $sanitize_callback )

		register_setting( 'wapppress_group', 'wapppress_settings', array($this, 'settings_validate') );

		if ( defined( 'DOING_AJAX' ) && DOING_AJAX )

			{

				//

			}

	}

	

	function settings_validate($arr_input) {

		$frontpage_id =  get_option('page_on_front');

		$options = get_option('wapppress_settings');

		$options['wapppress_name'] = trim( $arr_input['wapppress_name'] );

		$options['wapppress_theme_switch'] = trim( $arr_input['wapppress_theme_switch'] );

		$options['wapppress_theme_setting'] = trim( $arr_input['wapppress_theme_setting'] );

		if(!empty($arr_input['wapppress_home_setting'])){

			$options['wapppress_home_setting'] =	trim( $arr_input['wapppress_home_setting']);

		}else{

			$options['wapppress_home_setting'] =	trim( $frontpage_id );

		}

		$options['wapppress_theme_author'] = trim( @$arr_input['wapppress_theme_author'] );

		$options['wapppress_theme_date'] = trim( @$arr_input['wapppress_theme_date'] );

		$options['wapppress_theme_comment'] = trim( @$arr_input['wapppress_theme_comment'] );

		return $options;

	}

	

	// Theme Page 

	public function maker_theme_page(){

	require_once( 'header.php' );

	$args = array();

	$themes = wp_get_themes( $args );

	$dirIncImg  = trailingslashit( plugins_url('wappPress') );

?>



<!--===Theme Listing Box Start===--->

<div class="contant-section1">	

	<div class="section">

		<div class="wrapper">

			<div class="contant-section">

				<h5>

				<img src="<?php echo plugins_url( '../images/img1.png',  __FILE__ ) ?>" title="" alt=""/> &nbsp; <i>All Themes Listing</i>

				</h5>

				<div class="wrapper">

					<div class="container_main">

						<?php $the = array(); foreach($themes as $theme_val => $theme_name){

						$options = get_option('wapppress_settings');

						$currentTheme= $options['wapppress_theme_setting'];

						if($currentTheme==$theme_val){

						$theme_img = get_theme_root_uri().'/'.$theme_val.'/'.'screenshot.png';

						$url = esc_url(add_query_arg( array('wapppress' => true,'theme' =>$currentTheme,), admin_url( 'customize.php' ) ));

						 ?>

						<div class="theme-box-main">

							<div class="theme_box">

								<span><img src="<?php echo $theme_img?>" alt="<?php echo $theme_name?>" width='244' height="225" /></span>

								<a class="customize" href="<?php  echo $url; ?>">Customize</a>

							</div>

							<p>

								<img src="<?php echo plugins_url( '../images/shadow.png',  __FILE__ ) ?>" title=""/>

							</p>

						</div>

						<?php } } ?>

						<?php

						$the = array(); foreach($themes as $theme_val => $theme_name){

						$options = get_option('wapppress_settings');

						$currentTheme= $options['wapppress_theme_setting'];

						if($currentTheme!=$theme_val){

						$theme_img = get_theme_root_uri().'/'.$theme_val.'/'.'screenshot.png';

						$nonce = wp_create_nonce('switch-theme_'.$theme_val);

						?>

						<div class="theme-box-main">

							<div class="theme_box">

								<span><img src="<?php echo $theme_img; ?>" alt="<?php echo $theme_name; ?>" width='244' height="225" /></span>

								<a class="customize" style="opacity:0.5;pointer-events: none;" href="<?php  echo $url; ?>">Customize</a>

							</div>

							<p>

								<img src="<?php echo plugins_url( '../images/shadow.png',  __FILE__ ) ?>" title=""/>

							</p>

						</div>

						<?php } } ?>

					</div>

					<div class="clear"></div>

				</div>

			</div>

		</div>

	</div>

</div>

<!--===Theme Listing Box End===--->



<?php require_once( 'footer.php' );

}	



// Push Notification Page 

public function maker_push_page(){

require_once( 'header.php' );

$args =array();

$themes = wp_get_themes( $args );

$dirIncImg  = trailingslashit( plugins_url('wappPress') );

$dirPath1  = trailingslashit( plugin_dir_path( __FILE__ ) );

?>

<!--===Push Notification Box Start===--->

<div class="contant-section1">	

	<div class="section">

	<div class="wrapper">

		<div class="contant-section">

			<div class="setting-head">

				<h3>Push Notifications</h3>

				<img src="<?php echo plugins_url( '../images/line.png',  __FILE__ ) ?>" title="" alt=""/>

			</div>

			<div class="sec-2" style="border:none;">

				<div class="setting-sec">

					<?php 

						if (isset($_COOKIE['wapppress_proxy_old'])) {?>

						

					

							<object data="<?php echo get_app_url('push');?>" width="100%" style="width:100%;height:700px;">

						<embed src=<?php echo get_app_url('push');?>" width="100%" style="width:100%;height:700px;"> </embed>

						<p class="copile_error" style="text-transform: none;min-height: 100px;" >There was some problem while sending Push Notification from your server, either reload your page OR <a href="<?php echo get_app_url('push');?>" target="_blank" >CLICK HERE TO SEND NOTIFICATION DIRECTLY FROM OUR SERVER</a><br/>

						</p>

					

						</object>

						<?php }	else {?>

					<div class="setting-form">

						<div class="headingIn">

							You can send messages/alerts or push notifications to all the app installations as and when you want to

							send. This message/alert would be delivered instantly to all the users who have installed your Mobile App. This would help in reaching out to your users for advertisement, new product notifications , offers or any message/alert that you want to sent to your users.

						</div>

						<form id='push_from' name='push_from'>

						<div id='msgId' class='msgAlert'></div>

							<div class="supportForms_input">

								<p>Message:- <br /><textarea name="push_msg" id='push_msg'></textarea></p>

							</div>

							<br/>

							

							

							<input type="hidden" name='dirPath1' id='dirPath1' value='<?php echo $dirPath1; ?>'/>

							<input type="hidden" name='dirPlgUrl1' id='dirPlgUrl1' value='<?php echo $dirIncImg; ?>'/>

							

							<div class="sendAlert">

								<input id="push_btn"  type="image" src="<?php echo plugins_url( '../images/send-alert.png',  __FILE__ ) ?>" value="Send Alert" name="push_btn">&nbsp;

							</div>

						</form>

						

						

						<script type="text/javascript">

							

							

						

							jQuery( "#push_from" ).validate({

									rules: {

										push_msg:{

											required: true

										}

									},

									messages: {

											push_msg: {

												required: "Please enter your message."

											}

										},

										submitHandler: function(form) {

										 ajax_push_form();

									}

							});

							

							

							</script>

					</div>

					<?php }	?>

				</div>

			</div>

		</div>

	</div>

  </div>

</div>

<!--===Push Notification Box End===--->



<?php require_once( 'footer.php' );

}



//Create App 

public function  create_app(){

$p  = trailingslashit( plugin_dir_path( __FILE__ ) );	

$plugin_path = str_replace('includes/', '', $p);

ini_set('memory_limit', '2048M');

set_time_limit(300);

//Upload Launcher Icon Start

if(!empty($_FILES['app_logo']) && $_FILES['app_logo']['name'] !=''){

$app_logo_name='';

$new_app_logo_name='';

$new_app_logo_name1='ic_launcher.png';

$push_icon_name='';

$push_icon_name1='ic_stat_gcm.png';



	if ( $_FILES['app_logo']['error'] === UPLOAD_ERR_OK ) {

		$app_logo_name = $_FILES['app_logo']['name'];

		if ( !file_exists($plugin_path."/images/app_logo") ) {

					mkdir($plugin_path."/images/app_logo", 0777);

				}

		@chmod($plugin_path."/images/app_logo", 0777);

		

		if ( !file_exists($plugin_path."/images/app_logo/push_icon") ) {

						mkdir($plugin_path."/images/app_logo/push_icon", 0777);

				}

		@chmod($plugin_path."/images/app_logo/push_icon", 0777);



		require_once(  'resize_class.php' );

		$image_path = $plugin_path."/images/app_logo/".$app_logo_name;

		

		move_uploaded_file($_FILES['app_logo']["tmp_name"], $image_path );

		$image = $image_path;

		/*$resizeObj = new resize($image);

		

		//Save Launcher Icon

		$resizeObj -> resizeImage(96, 96, 0);

		$resizeObj -> saveImage($image_path, 100);*/

		$new_app_logo_name = $plugin_path."/images/app_logo/".$new_app_logo_name1;

		if (file_exists($new_app_logo_name)) {

			@unlink($new_app_logo_name);

			rename($image_path, $new_app_logo_name);

		}else{

			rename($image_path, $new_app_logo_name);

		}

		

		//Save Push Notification Icon
		$resizeObj = new resize($image);
		$resizeObj -> resizeImage(22, 22, 0);

		$resizeObj -> saveImage($image_path, 100);

		$push_icon_name = $plugin_path."/images/app_logo/push_icon/".$push_icon_name1;

		if (file_exists($push_icon_name)) {

			@unlink($push_icon_name);

			rename($image_path, $push_icon_name);

		}else{

			rename($image_path, $push_icon_name);

		}

	}

}

//Upload Launcher Icon End





//Upload Splash Image Start

if(!empty($_FILES['app_logo']) && $_FILES['app_logo']['name'] !=''){

	$app_splash_image='';

	$new_app_splash_image='';

	$new_app_splash_image1='';

	if(!empty($_FILES['app_splash_image']) && $_FILES['app_splash_image']['name'] !=''){

		$new_app_splash_image1='splash_screen.jpg';

		if ( $_FILES['app_splash_image']['error'] === UPLOAD_ERR_OK ) {

			$app_splash_image = time()."_".$_FILES['app_splash_image']['name'];

			if ( !file_exists($plugin_path."/images/app_splash_screen") ) {

						mkdir($plugin_path."/images/app_splash_screen", 0777);

					}

			@chmod($plugin_path."/images/app_splash_screen", 0777);

			require_once(  'resize_class.php' );

			$image_path1 = $plugin_path."/images/app_splash_screen/".$app_splash_image;

			move_uploaded_file($_FILES['app_splash_image']["tmp_name"], $image_path1 );

			$image1 = $image_path1;

			/*$resizeObj1 = new resize($image1);

			$resizeObj1 -> resizeImage(480, 800, 0);

			$resizeObj1 -> saveImage($image_path1, 100);*/

			 $new_app_splash_image = $plugin_path."/images/app_splash_screen/".$new_app_splash_image1;

			if (file_exists($new_app_splash_image)) {

				@unlink($new_app_splash_image);

				rename($image_path1, $new_app_splash_image);

			}else{

				rename($image_path1, $new_app_splash_image);

			}

		}

	}

}

//Upload Splash Image End





//Android API Form Start

if( isset($_POST['type']) && $_POST['type'] =='api_create_form') {



	//Get Current Website URL

	function curl_site_url() {

		 $pageURL = 'http';

		 if (isset($_SERVER['HTTPS']) && $_SERVER["HTTPS"] == "on") {$pageURL .= "s";}

		 $pageURL .= "://";

		 if ($_SERVER["SERVER_PORT"] != "80") {

		  $pageURL .= $_SERVER["SERVER_NAME"].":".$_SERVER["SERVER_PORT"];

		 } else {

		  $pageURL .= $_SERVER["SERVER_NAME"];

		 }

		 $subDirURL='';

		 if(!empty($_SERVER['SCRIPT_NAME'])){

			 $subDirURL .= str_replace("/wp-admin/admin-ajax.php","",$_SERVER['SCRIPT_NAME']);

		 }

		 return $pageURL.$subDirURL;

	}

	

	$name = $_POST['name'];	

	$email = $_POST['semail'];	

	$website = curl_site_url();					

		

				

	$dirPlgUrl1 = $_POST['dirPlgUrl1'];

	$ap = $_POST['ap'];	

	$ip = $_POST['ip'];	

	$file = $_POST['file'];	

	function wcurlrequest($ac,$d_name,$an,$data) {

		set_time_limit(300);

		$fields = '';

		foreach ($data as $key => $value) {

			$fields .= $key . '=' . $value . '&';

		}

		rtrim($fields, '&');

	

		$post = curl_init();

			curl_setopt($post, CURLOPT_URL,$ac);

			curl_setopt($post, CURLOPT_VERBOSE, 0);  

			curl_setopt($post, CURLOPT_RETURNTRANSFER, true);

			curl_setopt($post, CURLOPT_SSL_VERIFYHOST, false);

			curl_setopt($post, CURLOPT_SSL_VERIFYPEER, false);

			curl_setopt($post, CURLOPT_CONNECTTIMEOUT, 10);

			//curl_setopt($post, CURLOPT_TIMEOUT, 900);

			curl_setopt($post, CURLOPT_TIMEOUT, 300);

			$agent = 'Mozilla/5.0 (X11; U; Linux x86_64; pl-PL; rv:1.9.2.22) Gecko/20110905 Ubuntu/10.04 (lucid) Firefox/3.6.22';

			if(!empty($_SERVER['HTTP_USER_AGENT'])){

				$agent = $_SERVER['HTTP_USER_AGENT'];

			}

			curl_setopt($post, CURLOPT_USERAGENT, $agent);

			curl_setopt($post, CURLOPT_FAILONERROR, 1);

			curl_setopt($post, CURLOPT_POST, count($data));

			curl_setopt($post, CURLOPT_POSTFIELDS, $fields);

			

		$result = curl_exec($post);

	    $code = curl_getinfo($post, CURLINFO_HTTP_CODE);

        $success = ($code == 200);

        curl_close($post);

        if (!$success) {

			 setcookie( 'wapppress_proxy', 'true', time() + ( DAY_IN_SECONDS * 100 ) );

			 $str = "0~test";			

			 wp_send_json_success( $str );

			 exit();

        } else {

		

			if($result!=0)

			 {
					if($result==5)
					{
						$str = "5~test";	

						wp_send_json_success( $str );

						exit();
					}else{
						//Save comment Response
						global $wpdb;
						$tablename = $wpdb->prefix.'wappcomment';
						$all_data = $wpdb->get_row( 'SELECT * FROM '.$tablename.'');
						
						if(!empty($all_data)){
							$data = array(
								'wapp_response'=>$result,
								'wapp_date'=>date('Y-m-d')
							);
							$where_arr = array(
								'wapp_id'=>$all_data->wapp_id
							);
							$wpdb->update( $tablename, $data, $where_arr );
						}else{
							$data = array(
								'wapp_response'=>$result,
								'wapp_date'=>date('Y-m-d')
							);	
							$wpdb->insert( $tablename, $data);
						}
						

						$d_name = str_replace("-","_",$d_name);

						$str = '1'.'~'.$d_name;

						wp_send_json_success( $str );

						  exit();				
					 }
				}else{

					setcookie( 'wapppress_proxy', 'true', time() + ( DAY_IN_SECONDS * 100 ) );

					$str = "0~test";					

					wp_send_json_success( $str );

					exit();

					

				}

		}	

	

	}



	function get_domain($url){

	  $pieces = parse_url($url);

	  $domain = isset($pieces['host']) ? $pieces['host'] : '';

	  if(preg_match('/(?P<domain>[a-z0-9][a-z0-9\-]{1,63}\.[a-z\.]{2,10})$/i', $domain, $regs)) {

		//
		function isLetter($domain_name) {
		  return preg_match('/^\s*[a-z,A-Z]/', $domain_name) > 0;
		}
		if(isLetter($regs['domain']))
		{
			 return $regs['domain'];
		}else{
			 return "com_".$regs['domain'];			
		}
		//

	  }

	  return false;

	}

	

	$domain_name = get_domain($website); 

	$domain_arr= explode('.',$domain_name);

	$domain_fname = $domain_arr[0];

	$app_name = $_POST['app_name'];

	

	$data = array(

			"name" => $_POST['name'],

			"app_name" => $_POST['app_name'],

			"email" => $_POST['semail'],

			"license" => $_POST['license'],
			
			"interstitial_unit_id" => $_POST['interstitial_unit_id'],

			"website" => $website,

			"domain_name"=>$domain_name,

			"domain_fname"=>$domain_fname,

			'app_site_url'=>$dirPlgUrl1

		);

	

	$custom_launcher_logo = $_POST['custom_launcher_logo'];

	$custom_splash_logo = $_POST['custom_splash_logo'];

	

	if(isset($custom_launcher_logo) && $custom_launcher_logo =='0'){

		$data['app_launcher_logo_name'] = 'ic_launcher.png';

		$data['app_push_icon'] = 'ic_stat_gcm.png';

	}elseif(isset($custom_launcher_logo) && $custom_launcher_logo =='1'){

		$data['app_logo_color'] = $_POST['app_logo_color'];

		$data['app_logo_text_color'] = $_POST['app_logo_text_color'];

		$data['app_logo_text'] = $_POST['app_logo_text'];

		$data['app_logo_text_font_family'] = $_POST['app_logo_text_font_family'];

		$data['app_logo_text_font_size'] = $_POST['app_logo_text_font_size'];

	}

	

	

	if(isset($custom_splash_logo) && $custom_splash_logo =='0'){

		$data['app_splash_screen_name'] = 'splash_screen.jpg';

	}elseif(isset($custom_splash_logo) && $custom_splash_logo =='1'){

		$data['app_splash_color'] = $_POST['app_splash_color'];

		$data['app_splash_text'] = $_POST['app_splash_text'];

		$data['app_splash_text_color'] = $_POST['app_splash_text_color'];

		$data['app_splash_text_font_family'] = $_POST['app_splash_text_font_family'];

		$data['app_splash_text_font_size'] = $_POST['app_splash_text_font_size'];

	}

	





	// cURL Enable/Disable Function

	function _is_curl_installed() {

		if  (in_array  ('curl', get_loaded_extensions())) {

			return true;

		} else {

			return false;

		}

	}

	

	$whitelist = array('127.0.0.1', "::1",'localhost');



	// Check cURL Enable/Disable 

	if (_is_curl_installed()) {

		if(in_array($_SERVER['SERVER_NAME'], $whitelist)){

			$str = "3~test";

			wp_send_json_success( $str );

			exit();

		}else{	

			wcurlrequest($ip.$ap.$file,$domain_name,$app_name,$data);

		}

	} else {

		if(in_array($_SERVER['SERVER_NAME'], $whitelist)){

			$str = "3~test";

			wp_send_json_success( $str );

			exit();

		}else{

			$str = "2~test";

			wp_send_json_success( $str );

			exit();

		}

	}

}

//Android API Form End		



}

public function  get_app()

{

if( isset($_POST['type']) && $_POST['type'] =='api_get_form') {

	

	//Get Current Website URL

	function curl_site_url() {

		 $pageURL = 'http';

		 if (isset($_SERVER['HTTPS']) && $_SERVER["HTTPS"] == "on") {$pageURL .= "s";}

		 $pageURL .= "://";

		 if ($_SERVER["SERVER_PORT"] != "80") {

		  $pageURL .= $_SERVER["SERVER_NAME"].":".$_SERVER["SERVER_PORT"];

		 } else {

		  $pageURL .= $_SERVER["SERVER_NAME"];

		 }

		 $subDirURL='';

		 if(!empty($_SERVER['SCRIPT_NAME'])){

			 $subDirURL .= str_replace("/wp-admin/admin-ajax.php","",$_SERVER['SCRIPT_NAME']);

		 }

		 return $pageURL.$subDirURL;

	}

	$ap = $_POST['ap'];	

	$ip = $_POST['ip'];	

	$file = $_POST['file'];	

	$app_name = $_POST['app_name'];

	function get_domain($url){

	  $pieces = parse_url($url);

	  $domain = isset($pieces['host']) ? $pieces['host'] : '';

	  if(preg_match('/(?P<domain>[a-z0-9][a-z0-9\-]{1,63}\.[a-z\.]{2,10})$/i', $domain, $regs)) {

		
		//
		function isLetter($domain_name) {
		  return preg_match('/^\s*[a-z,A-Z]/', $domain_name) > 0;
		}
		if(isLetter($regs['domain']))
		{
			 return $regs['domain'];
		}else{
			 return "com_".$regs['domain'];			
		}
		//
		

	  }

	  return false;

	}

	// cURL Enable/Disable Function

	function _is_curl_installed() {

		if  (in_array  ('curl', get_loaded_extensions())) {

			return true;

		} else {

			return false;

		}

	}

	$website = curl_site_url();	

	$domain_name = get_domain($website); 

	$domain_arr= explode('.',$domain_name);

	$domain_fname = $domain_arr[0];

	$app_name = $_POST['app_name'];

	$data = array(

			"name" => $_POST['name'],

			"app_name" => $_POST['app_name'],

			"email" => $_POST['semail'],

			"license" => $_POST['license'],
			
			"interstitial_unit_id" => $_POST['interstitial_unit_id'],

			"website" => $website,

			"domain_name"=>$domain_name,

			"domain_fname"=>$domain_fname

		);

	function wcurlRErequest($ac,$d_name,$an,$data) 

	{

		set_time_limit(300);

		$fields = '';

		foreach ($data as $key => $value) {

			$fields .= $key . '=' . $value . '&';

		}

		rtrim($fields, '&');

	

		$post = curl_init();

			curl_setopt($post, CURLOPT_URL,$ac);

			curl_setopt($post, CURLOPT_VERBOSE, 0);  

			curl_setopt($post, CURLOPT_RETURNTRANSFER, true);

			curl_setopt($post, CURLOPT_SSL_VERIFYHOST, false);

			curl_setopt($post, CURLOPT_SSL_VERIFYPEER, false);

			curl_setopt($post, CURLOPT_CONNECTTIMEOUT, 10);

			//curl_setopt($post, CURLOPT_TIMEOUT, 900);

			curl_setopt($post, CURLOPT_TIMEOUT, 300);

			$agent = 'Mozilla/5.0 (X11; U; Linux x86_64; pl-PL; rv:1.9.2.22) Gecko/20110905 Ubuntu/10.04 (lucid) Firefox/3.6.22';

			if(!empty($_SERVER['HTTP_USER_AGENT'])){

				$agent = $_SERVER['HTTP_USER_AGENT'];

			}

			curl_setopt($post, CURLOPT_USERAGENT, $agent);

			curl_setopt($post, CURLOPT_FAILONERROR, 1);

			curl_setopt($post, CURLOPT_POST, count($data));

			curl_setopt($post, CURLOPT_POSTFIELDS, $fields);

			

		$result = curl_exec($post);

	    $code = curl_getinfo($post, CURLINFO_HTTP_CODE);

        $success = ($code == 200);

        curl_close($post);

        if (!$success) {

			 setcookie( 'wapppress_proxy', 'true', time() + ( DAY_IN_SECONDS * 100 ) );

			 $str = "0~test";			

			 wp_send_json_success( $str );

			 exit();

        } else {

		

			if($result!=0)

			 {

					//Save comment response
					global $wpdb;
					$tablename = $wpdb->prefix.'wappcomment';
					$all_data = $wpdb->get_row( 'SELECT * FROM '.$tablename.'');
					
					if(!empty($all_data)){
						$data = array(
							'wapp_response'=>$result,
							'wapp_date'=>date('Y-m-d')
						);
						$where_arr = array(
							'wapp_id'=>$all_data->wapp_id
						);
						$wpdb->update( $tablename, $data, $where_arr );
					}else{
						$data = array(
							'wapp_response'=>$result,
							'wapp_date'=>date('Y-m-d')
						);	
						$wpdb->insert( $tablename, $data);
					}

					$d_name = str_replace("-","_",$d_name);

					$str = '1'.'~'.$d_name;
					setcookie( 'wapppress_proxy', 'true', time() - 1000 );
					wp_send_json_success( $str );								
					exit();		
					
				}else{

					setcookie( 'wapppress_proxy', 'true', time() + ( DAY_IN_SECONDS * 100 ) );

					$str = "0~test";					

					wp_send_json_success( $str );

					exit();

					

				}

		}	

	

	}

	$whitelist = array('127.0.0.1', "::1",'localhost');

	// Check cURL Enable/Disable 

	if (_is_curl_installed()) {

		if(in_array($_SERVER['SERVER_NAME'], $whitelist)){

			$str = "3~test";

			wp_send_json_success( $str );

			exit();

		}else{	

			wcurlRErequest($ip.$ap.$file,$domain_name,$app_name,$data);

		}

	} else {

		if(in_array($_SERVER['SERVER_NAME'], $whitelist)){

			$str = "3~test";

			wp_send_json_success( $str );

			exit();

		}else{

			$str = "2~test";

			wp_send_json_success( $str );

			exit();

		}

	}

}

}





//Create App 

public function  create_push_app(){

ini_set('memory_limit', '2048M');

set_time_limit(300);

//Push Notification Form Start

if(isset($_POST['type']) && $_POST['type'] =='push_form') {

	$dirPath = dirname(__FILE__);

	//Get response data
	global $wpdb;
	$tablename = $wpdb->prefix.'wappcomment';
	$all_data = $wpdb->get_row( 'SELECT * FROM '.$tablename.'');
	
	if(!empty($all_data)){
		$get_contant = $all_data->wapp_response;
	}else{
		$get_contant='';
	}

	

	if($get_contant !=''){

		//Get Current Website URL

		

		

		function wcurlpushrequest($ac,$data) {

			set_time_limit(100);

			$fields = '';

			foreach ($data as $key => $value) {

				$fields .= $key . '=' . $value . '&';

			}

			rtrim($fields, '&');	

			$post = curl_init();

			curl_setopt($post, CURLOPT_URL,$ac);

			curl_setopt($post, CURLOPT_VERBOSE, 0);  

			curl_setopt($post, CURLOPT_RETURNTRANSFER, true);

			curl_setopt($post, CURLOPT_SSL_VERIFYHOST, false);

			curl_setopt($post, CURLOPT_SSL_VERIFYPEER, false);

			curl_setopt($post, CURLOPT_CONNECTTIMEOUT, 10);

			curl_setopt($post, CURLOPT_TIMEOUT, 300);

			$agent = 'Mozilla/5.0 (X11; U; Linux x86_64; pl-PL; rv:1.9.2.22) Gecko/20110905 Ubuntu/10.04 (lucid) Firefox/3.6.22';

			if(!empty($_SERVER['HTTP_USER_AGENT'])){

				$agent = $_SERVER['HTTP_USER_AGENT'];

			}

			curl_setopt($post, CURLOPT_USERAGENT, $agent);

			curl_setopt($post, CURLOPT_FAILONERROR, 1);

			curl_setopt($post, CURLOPT_POST, count($data));

			curl_setopt($post, CURLOPT_POSTFIELDS, $fields);

			$result = curl_exec($post);

			curl_close($post);

			if($result==1){

				$str = '1';

				wp_send_json_success( $str );

				exit();

			}else if($result==4){

				$str = '4';

				wp_send_json_success( $str );

				exit();

			}else{

				$str = '0';

				wp_send_json_success( $str );

				exit();

			}	

		}

		

				

		$ap = $_POST['ap'];	

		$ip = $_POST['ip'];	

		$file = $_POST['file'];	

		

		$data = array(

			'push_msg'=> $_POST['push_msg'],

			'app_auth_key'=>$get_contant

		); 

		// Return cURL Enable/Disable Function

		function check_push_is_curl_installed() {

			if(in_array  ('curl', get_loaded_extensions())) {

				return true;

			} else {

				return false;

			}

		}

		

		

		

		$whitelist = array('127.0.0.1', "::1",'localhost');

		// Check cURL Enable/Disable 

		if (check_push_is_curl_installed()) {

			if(in_array($_SERVER['SERVER_NAME'], $whitelist)){

				$str = '3';

				wp_send_json_success( $str );

				exit();

			}else{

				wcurlpushrequest($ip.$ap.$file,$data);

			}

		} else {

			if(in_array($_SERVER['SERVER_NAME'], $whitelist)){

				$str = '3';

				wp_send_json_success( $str );

				exit();

			}else{

				$str = '2';

				wp_send_json_success( $str );

				exit();

			}

		}

	}else{

		$str = '5';

		wp_send_json_success( $str );

		exit();

	}

	

}

//Push Notification From End

	

}





//Search Home Page  

public function search_post_results() {

	   $searchVal = sanitize_text_field($_POST['search_val']);

	   $nonceVal = sanitize_text_field($_POST['nonce']);

		if( !(isset($searchVal,$nonceVal) && wp_verify_nonce($nonceVal, 'wapppress_group-options' ) ) ){

			wp_send_json_error( '<p>'. __( 'Security check failed', 'wapppress' ) .'</p>' );

		}	

		

		if ( empty( $searchVal ) ){

			wp_send_json_error( '<p>'. __( 'Please Try Again', 'wapppress' ) .'</p>' );

		}

		global $wpdb;

		$allResults = $wpdb->get_col( $wpdb->prepare( "SELECT ID FROM $wpdb->posts WHERE post_title LIKE '%%%s%%' AND post_status = 'publish' AND post_type = 'page' LIMIT 10", $searchVal ) );

		if ( empty( $allResults ) ){

			wp_send_json_error( '<p>'. __('No Results Found', 'wapppress' ) .'</p>' );

		}

		if ( !empty( $allResults ) ){

			$str = '<p>'. __('Please choose a page', 'wapppress' ) .'</p>';

			$str .= '<ol>';

			foreach ( $allResults as $postID ) {

				$str .= '<li><a href="'. get_permalink( $postID ) .'"  data-postID="'. $postID .'">'. get_the_title( $postID ) .'</a></li>';

			}

			$str .= '</ol>';

			wp_reset_postdata();

			wp_send_json_success( $str );

		}

	}

	

	public function reset_cookie() {

		setcookie( 'wapppress_app', 'true', time() - DAY_IN_SECONDS );

	}

}

new wappPress_admin_setting();

