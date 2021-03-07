<?php
/* VIRTACART
Version       : 1.0.0
Author        : Virtarich
Author URI    : http://theme-id.com
*/
if ( ! defined( 'ABSPATH' ) ) exit;

function virtarich_label(){
	  global $post;
	  if(get_post_meta($post->ID, "label", true) == 'sold'){ ?><div class="ribbon sold"><span>Sold Out</span></div>
	  <?php } else if(get_post_meta($post->ID, "label", true) == 'promo') { ?><div class="ribbon promo"><span>Promo</span></div>
	  <?php } else if(get_post_meta($post->ID, "label", true) == 'best') { ?><div class="ribbon best"><span>Best Seller</span></div>
	  <?php } else if(get_post_meta($post->ID, "label", true) == 'inden') { ?><div class="ribbon inden"><span>Inden</span></div>
	  <?php } else if(get_post_meta($post->ID, "label", true) == 'limited') { ?><div class="ribbon limited"><span>Limited</span></div>
	  <?php } 
}

function virtarich_share_buttons() {
		$shortURL = wp_get_shortlink();
		$shortTitle = get_the_title();
		$twitterURL = 'https://twitter.com/intent/tweet?text='.$shortTitle.'&amp;url='.$shortURL.'&amp;';
		$facebookURL = 'https://www.facebook.com/sharer/sharer.php?u='.$shortURL;
		$googleURL = 'https://plus.google.com/share?url='.$shortURL;
?>
<div class="share-buttons">
<a class="twitter" title="Share on Twitter" href="<?php echo $twitterURL ?>" target="_blank" rel="nofollow"><i class="icon-twitter-squared"></i> Twitter</a>
<a class="facebook" title="Share on Facebook" href="<?php echo $facebookURL ?>" target="_blank" rel="nofollow"><i class="icon-facebook-squared"></i> Facebook</a>
<a class="googleplus" title="Share on Google+" href="<?php echo $googleURL ?>" target="_blank" rel="nofollow"><i class="icon-gplus-squared"></i> Google+</a>
</div>
<?php }

function virtacart_enqueue_googlemaps() {
  wp_register_script( 'gmaps', 'http://maps.googleapis.com/maps/api/js?sensor=false','jquery','', true );
  if(of_get_option('maps_act') == '1' && is_singular('motor')){wp_enqueue_script('gmaps');}
}    
add_action('wp_enqueue_scripts', 'virtacart_enqueue_googlemaps');

function isMobile() {
    return preg_match("/(android|avantgo|blackberry|bolt|boost|cricket|docomo|fone|hiptop|mini|mobi|palm|phone|pie|tablet|up\.browser|up\.link|webos|wos)/i", $_SERVER["HTTP_USER_AGENT"]);
}

function virtarich_map_data() {
if(of_get_option('maps_act') == '1' && is_singular('motor')){ ?>
<script type="text/javascript">
var latlngPos = new google.maps.LatLng(<?php print of_get_option('maps');?>);
var virtarichMaps = {zoom: 15,center: latlngPos,mapTypeId: google.maps.MapTypeId.ROADMAP,scrollwheel: false, <?php echo(isMobile()) ? 'draggable: false' : ''; ?>};
map = new google.maps.Map(document.getElementById("google_maps"), virtarichMaps);
var marker = new google.maps.Marker({position: latlngPos,map: map,title: "Lokasi"});
</script>
<?php }
}
add_action( 'wp_footer', 'virtarich_map_data',21 );


function virtarich_top_ads() {
	if(of_get_option('top_act') == '1') { ?>
		<div class="ads"><?php echo of_get_option('top_ads'); ?></div>
	<?php }
}
function virtarich_bottom_ads() {
	if(of_get_option('bottom_act') == '1') { ?>
		<div class="ads"><?php echo of_get_option('bottom_ads'); ?></div>
	<?php }
}
function virtarich_related_post($jumlah) {
	global $post;
	$cats = get_the_category($post->ID);
	if ( $cats == true ) {
		$cat_id = array();
		foreach ( $cats as $cat ) {$cat_id[] = $cat->term_id;}
	$args=array('category__in' => $cat_id,'post__not_in' => array($post->ID),'ignore_sticky_posts'=>1,'posts_per_page'=> $jumlah,
		'orderby' => 'rand',);
	$vtr_query = new WP_Query( $args );
	if ( $vtr_query->have_posts() ) { 
		while( $vtr_query->have_posts() ) { 
			 $vtr_query->the_post(); 
			 get_template_part( 'list' );
			 }
		}
	}
	wp_reset_postdata();
}