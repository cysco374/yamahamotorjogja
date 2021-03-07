<?php
/* Virtarich Theme
Version       : 1.0.0
Author        : Virtarich
Author URI    : http://theme-id.com
 */
if ( ! defined( 'ABSPATH' ) ) exit;
function virtarich_custom_styles() {
          $color1 = of_get_option('virtarich_color');
		  $color2 = of_get_option('link_color');
		  $color3 = of_get_option('price_color');
		  $color4 = of_get_option('button_color');
		  $color5 = of_get_option('button_color2');
		  $color6 = of_get_option('label_color');
		  $background = of_get_option('virtarich_background_color');
?>
<style type="text/css">
body{ margin:0px auto; padding:0px;
<?php if ($background) {
if ($background['image']) {
echo 'background:url('.$background['image']. ') ;';
echo 'background-repeat:'.$background['repeat']. ' ;';
echo 'background-color:'.$background['color']. ' ;';
echo 'background-position:'.$background['position']. ' ;';
echo 'background-attachment:'.$background['attachment']. ' ;';
} else { echo 'background-color:'.$background['color'].';'; }	
}; ?>}
a, h1, h2, h3, h4  {color:<?php echo $color1; ?>;}
.vtr-menu-icon {background-color: <?php echo $color1; ?>;}
.vtr-menu  {background-color: <?php echo $color1; ?>;}
.vtr-menu  li.active > a,.vtr-menu  li.active,.vtr-menu  li:hover > a {	background-color: #000;}
.wp-pagenavi a:hover{color:#FFF;background-color:<?php echo $color1; ?>;}
.current{color:#FFFFFF;background-color:<?php echo $color1; ?>;}
#widget-form .button {background:<?php echo $color1; ?>;}
.sidebar h4{background-color: <?php echo $color1; ?>;}
.sidebar .box ul li a:hover{ color: <?php echo $color1; ?>; }
.btn{ background-color: <?php echo $color1; ?>; }
.button-widget-link{color:<?php echo $color1; ?>;}
.vtr-title{color: <?php echo $color1; ?>;border-bottom-width: 4px;border-bottom-style: solid;border-bottom-color:<?php echo $color1; ?>;}
.footer a{color:<?php echo $color1; ?>;border-top-color: <?php echo $color1; ?>;}
.vcard-name {color:<?php echo $color1; ?>;}
.vcard-footer {	background-color: <?php echo $color1; ?>;}
.keatas a{color:#999;}
.header-title{color: <?php echo $color1; ?>;} 
</style>
<?php
}
add_action('wp_head', 'virtarich_custom_styles');