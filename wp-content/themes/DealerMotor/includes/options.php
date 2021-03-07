<?php
function optionsframework_option_name() {

	$themename = get_option( 'stylesheet' );
	$themename = preg_replace("/\W/", "_", strtolower($themename) );

	$optionsframework_settings = get_option( 'optionsframework' );
	$optionsframework_settings['id'] = $themename;
	update_option( 'optionsframework', $optionsframework_settings );
}
function optionsframework_options() {
	$background_defaults = array(
		'color' => '#002468',
		'image' => '',
		'repeat' => 'repeat',
		'position' => 'top center',
		'attachment'=>'scroll' );
	
	$wp_editor_settings = array(
		'wpautop' => true, 
		'textarea_rows' => 20,
		'tinymce' => true,
		'quicktags'=> true
	);
	$wp_settings = array(
		'wpautop' => true, 
		'textarea_rows' => 5,
		'tinymce' => false,
		'quicktags'=> false
	);
	$options = array();

$options[] = array( "name" => "Styling","type" => "heading");
	$options[] = array( "name" => "Header",
						"desc" => "upload gambar header anda ukuran  290 x 75 px.",
						"id" => "logo_uploader",
						"type" => "upload");
						
	$options[] = array( "name" => "Favicon",
						"desc" => "Upload favicon anda.",
						"id" => "favicon_uploader",
						"type" => "upload");
	
	$options[] = array( "name" => "Background Color",
						"desc" => "Change the background CSS.",
						"id" => "virtarich_background_color",
						"std" => $background_defaults, 
						"type" => "background");			
						
	$options[] = array( "name" => "Theme Color",
						"desc" => "Warna untuk Link , Navigasi , Header sidebar",
						"id" => "virtarich_color",
						"std" => "#0A2D82",
						"type" => "color");
																													
																										
	$options[] = array( 'name' => 'Footer',
						'desc' => 'footer text or statistic code',
						'id' => 'footer_text',
						'std' => '',
						'type' => 'editor',
						'settings' => $wp_settings );
											
$options[] = array( "name" => "Slider","type" => "heading");
	  
	  $options[] = array( "name" => "Tampilkan slider?",
						"desc" => "Pilih YES jika ingin menampilkan banner dan slider di Home",
						"id" => "slider_act",
						"std" => "No",
						"type" => "select",
						"class" => "mini", 
						"options" => array("No", "Yes"));	
						
	  $options[] = array('name' => __('Banner Slider', 'options_framework_theme'),
						  'desc' => __('Banner di bawah ini akan tampil berupa slider di home', 'options_framework_theme'),
						  'type' => 'info');						
							  
	  $options[] = array( "name" => "Banner 1",
						  "desc" => "Upload banner anda ukuran lebar 960px × 390px",
						  "id" => "banner_1",
						  "type" => "upload");
						  
	  $options[] = array( "name" => "URL Link banner 1 ",
						  "desc" => "isi url halaman tujuan contoh : http://theme-id.com",
						  "id" => "banner_url_1",
						  "std" => "",
						  "type" => "text");	
						  
	  $options[] = array( "name" => "Banner 2",
						  "desc" => "Upload banner anda ukuran lebar 960px × 390px",
						  "id" => "banner_2",
						  "type" => "upload");
						  
	  $options[] = array( "name" => "URL Link banner 2 ",
						  "desc" => "isi url halaman tujuan contoh : http://theme-id.com",
						  "id" => "banner_url_2",
						  "std" => "",
						  "type" => "text");							
	  
	  $options[] = array( "name" => "Banner 3",
						  "desc" => "Upload banner anda ukuran lebar 960px × 390px",
						  "id" => "banner_3",
						  "type" => "upload");
						  
	  $options[] = array( "name" => "URL Link banner 3 ",
						  "desc" => "isi url halaman tujuan contoh : http://theme-id.com",
						  "id" => "banner_url_3",
						  "std" => "",
						  "type" => "text");	
						  
	  $options[] = array( "name" => "Banner 4",
						  "desc" => "Upload banner anda ukuran lebar 960px × 390px",
						  "id" => "banner_4",
						  "type" => "upload");
						  
	  $options[] = array( "name" => "URL Link banner 4 ",
						  "desc" => "isi url halaman tujuan contoh : http://theme-id.com",
						  "id" => "banner_url_4",
						  "std" => "",
						  "type" => "text");	
						  
	  $options[] = array( "name" => "Banner 5",
						  "desc" => "Upload banner anda ukuran lebar 960px × 390px",
						  "id" => "banner_5",
						  "type" => "upload");
						  
	  $options[] = array( "name" => "URL Link banner 5 ",
						  "desc" => "isi url halaman tujuan contoh : http://theme-id.com",
						  "id" => "banner_url_5",
						  "std" => "",
						  "type" => "text");	
						  
$options[] = array( "name" => "Home","type" => "heading");
		
	  $options[] = array( 'name' => 'Paragraph Selamat Datang',
						  "desc" => "text di bawah ini akan tampil pada halaman home web anda",
						  'id' => 'welcome_text',
						  'type' => 'editor',
						  'settings' => $wp_editor_settings );	
																					
$options[] = array( "name" => "Data","type" => "heading");

	  $options[] = array( "name" => "Nama Sales",
						"desc" => "Tulis nama sales .",
						"id" => "nama_sales",
						"std" => "",
						"type" => "text");
						
	  $options[] = array( "name" => "Jabatan",
						"desc" => "Tulis jabatan .",
						"id" => "jabatan",
						"std" => "",
						"type" => "text");
						
	  $options[] = array( "name" => "Foto",
						  "desc" => "upload foto anda ukuran  175px × 250px.",
						  "id" => "foto_uploader",
						  "type" => "upload");	
						
	  $options[] = array( "name" => "Nama Dealer",
						"desc" => "Tulis Nama Dealer / PT .",
						"id" => "nama_dealer",
						"std" => "",
						"type" => "text");
						
	  $options[] = array( "name" => "Alamat Dealer",
						"desc" => "Tulis alamat .",
						"id" => "alamat",
						"std" => "",
						"type" => "text");					  												

	  $options[] = array( "name" => "Tampilkan VCARD disingle?",
						"desc" => "Pilih YES jika ingin menampilkan",
						"id" => "vcard_act",
						"std" => "No",
						"type" => "select",
						"class" => "mini", 
						"options" => array("No", "Yes"));	
							  
	  $options[] = array( "name" => "Tampilkan Google Maps?",
						"desc" => "Pilih YES jika ingin menampilkan google maps",
						"id" => "maps_act",
						"std" => "No",
						"type" => "select",
						"class" => "mini", 
						"options" => array("No", "Yes"));	
																												
	  $options[] = array( "name" => "longitude dan latitude Google Maps",
						"desc" => "baca di panduan",
						"id" => "maps",
						"std" => "",
						"class" => "mini",
						"type" => "text");

$options[] = array( "name" => "Kontak","type" => "heading");
					  												
	  $options[] = array( "name" => "Tampilkan No Telp?",
						"desc" => "Pilih YES jika ingin menampilkan nomer telp",
						"id" => "contact_act",
						"std" => "No",
						"type" => "select",
						"class" => "mini", 
						"options" => array("No", "Yes"));	
																												
	  $options[] = array( "name" => "Nomor Telp",
						"desc" => "Tulis Nomor telp",
						"id" => "nomer_telp",
						"std" => "",
						"class" => "mini",
						"type" => "text");
						
	  $options[] = array( "name" => "Tampilkan No SMS?",
						"desc" => "Pilih YES jika ingin menampilkan nomer SMS",
						"id" => "contact_sms",
						"std" => "No",
						"type" => "select",
						"class" => "mini", 
						"options" => array("No", "Yes"));	
						
	  $options[] = array( "name" => "Nomor SMS / HP",
						"desc" => "Tulis Nomor untuk sms",
						"id" => "nomer_hp",
						"std" => "",
						"class" => "mini",
						"type" => "text");	
						
	  $options[] = array( "name" => "Tampilkan PIN BB?",
						"desc" => "Pilih YES jika ingin menampilkan Pin BB",
						"id" => "contact_bbm",
						"std" => "No",
						"type" => "select",
						"class" => "mini", 
						"options" => array("No", "Yes"));	
						
						
	  $options[] = array( "name" => "PIN BB",
						"desc" => "Tulis PIN BB",
						"id" => "pin_bb",
						"std" => "",
						"class" => "mini",
						"type" => "text");	
						
	  $options[] = array( "name" => "Tampilkan whatsapp?",
						"desc" => "Pilih YES jika ingin menampilkan whatsapp",
						"id" => "contact_whatsapp",
						"std" => "No",
						"type" => "select",
						"class" => "mini", 
						"options" => array("No", "Yes"));	
						
	  $options[] = array( "name" => "Whatsapp",
						"desc" => "Tulis No Whatsapp",
						"id" => "nomer_whatsapp",
						"std" => "",
						"class" => "mini",
						"type" => "text");	
						
$options[] = array( "name" => "Angsuran","type" => "heading");
					  																																								
	  $options[] = array( "name" => "Angsuran 1",
						"desc" => "Tulis angka saja ",
						"id" => "angsuran_1",
						"std" => "",
						"class" => "mini",
						"type" => "text");		
	  $options[] = array( "name" => "Angsuran 2",
						"desc" => "Tulis angka saja ",
						"id" => "angsuran_2",
						"std" => "",
						"class" => "mini",
						"type" => "text");	
	  $options[] = array( "name" => "Angsuran 3",
						"desc" => "Tulis angka saja ",
						"id" => "angsuran_3",
						"std" => "",
						"class" => "mini",
						"type" => "text");		
	  $options[] = array( "name" => "Angsuran 4",
						"desc" => "Tulis angka saja ",
						"id" => "angsuran_4",
						"std" => "",
						"class" => "mini",
						"type" => "text");
	  $options[] = array( "name" => "Angsuran 5",
						"desc" => "Tulis angka saja ",
						"id" => "angsuran_5",
						"std" => "",
						"class" => "mini",
						"type" => "text");																									
// ads setting	
		
$options[] = array( 'name' => 'Ads',
				'type' => 'heading');
	$options[] = array(
		'name' => 'iklan untuk halaman single post',
		'type' => 'info'
	);		
									
	$options[] = array( 'name' => 'display ads at top?',
					'desc' => 'Please select',
					'id' => 'top_act',
					'std' => 'No',
					'type' => 'select',
					'class' => 'mini', 
					'options' => array('No', 'Yes'));
					
											
	$options[] = array( 'name' => 'Ads Top Code',
					'id' => 'top_ads',
					'type' => 'editor',
					'settings' => $wp_settings );
					
	$options[] = array( 'name' => 'display ads at bottom?',
					'desc' => 'Please select',
					'id' => 'bottom_act',
					'std' => 'No',
					'type' => 'select',
					'class' => 'mini', 
					'options' => array('No', 'Yes'));
					
	$options[] = array( 'name' => 'Ads Bottom Code',
					'id' => 'bottom_ads',
					'type' => 'editor',
					'settings' => $wp_settings ); 
																							
	return $options;
}