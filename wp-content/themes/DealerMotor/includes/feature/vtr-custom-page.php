<?php
/*
Version       : 1.0.0
Author        : Virtarich
Author URI    : http://theme-id.com
 */
if ( ! defined( 'ABSPATH' ) ) exit;
function virtarich_create_pricelist() {
	$post_id = -1;
	$slug = 'pricelist';
	$title = 'pricelist';
	if( null == get_page_by_title( $title ) ) {
		$post_id = wp_insert_post(
			array(
				'comment_status'	=>	'closed',
				'ping_status'		=>	'closed',
				'post_author'		=>	'1',
				'post_name'			=>	$slug,
				'post_title'		=>	$title,
				'post_status'		=>	'publish',
				'post_type'			=>	'page',
				'page_template'		=>  'page-pricelist.php'
			)
		);
	} else {
    		$post_id = -2;

	}
}
add_filter( 'after_setup_theme', 'virtarich_create_pricelist' );

function virtarich_pricelist_function() {
	  global $post;
	  	$args=array(
		'post_type' => 'motor',
		'showposts' => '1000',
		);
	  $vtr_query = new WP_Query($args);
	   while ($vtr_query->have_posts()) : $vtr_query->the_post(); ?>
       
       
       <div class="list">
       <div class="nest"><div class="grid-12"></div>
      <div class="grid-3 grid-m-4"><div class="thumbnail"> <a href="<?php the_permalink(); ?>" title="<?php the_title(); ?>"><?php virtarich_thumb_normal() ?></a></div></div>
        <div class="grid-9 grid-m-8"><h1><?php the_title(); ?> Harga  <?php echo get_post_meta($post->ID, "harga", $single = true);?></h1>
        <table class="vtr-table">
      <tr>
            <th rowspan="2">Uang Muka</th>
            <td colspan="5" class="sapi">Angsuran</td>
  </tr>
  <tr><td>11</td><td>17</td><td>23</td><td>29</td><td>35</td></tr>
        <tr>
          <?php virtarich_list_harga() ?>
        </tr>
      </table></div>
     </div>
     </div>
	  <?php endwhile;
	  wp_reset_postdata(); 
}
add_action('virtarich_pricelist', 'virtarich_pricelist_function');