<?php
/*
Version       : 1.0.0
Author        : Virtarich
Author URI    : http://theme-id.com
 */
if ( ! defined( 'ABSPATH' ) ) exit;
function virtarich_motor_register() {
    register_post_type('motor', array(
        'labels' => array(
            'name' => 'motor',
            'singular_name' => 'motor',
            'add_new' => 'Add New motor',
            'edit_item' => 'Edit motor',
            'new_item' => 'New  Project to my motor',
            'view_item' => 'View motor',
            'search_items' => 'Search in My motor',
            'not_found' => 'No motor Found',
            'not_found_in_trash' => 'No motor found in motor Trash'
        ),
        'public' => true,
        'has_archive' => true,
        'supports' => array(
            'title',
            'editor',
			'thumbnail'
        )
   ));
}
add_action('init', 'virtarich_motor_register');
function virtarich_feed( $qv ) {
		  if ( isset($qv['feed']) && !isset($qv['post_type']) )
			$qv['post_type'] = array('post','motor');
		  return $qv;
}
add_filter( 'request', 'virtarich_feed' );

function virtarich_index_motor() {
		global $post;
		$args=array(
		'post_type' => 'motor',
		'showposts' => '100'
		);
		$vtr_query = new WP_Query( $args );
		if ( $vtr_query->have_posts() ):  while( $vtr_query->have_posts() ) : $vtr_query->the_post();?>
         <div class="nest">
        <?php get_template_part( 'thumb' ); ?>
        </div>
        <?php
		endwhile;
		endif;
		wp_reset_postdata(); 
}

function virtarich_related_motor($jml) {
	global $post;
	$args=array(
		'post_type' => 'motor',
		'post__not_in' => array($post->ID),
		'ignore_sticky_posts'=>1,
		'showposts' => $jml,
		'orderby' => 'rand',
		);
	$vtr_query = new WP_Query( $args );
	if ( $vtr_query->have_posts() ) { while( $vtr_query->have_posts() ) {  $vtr_query->the_post(); ?>
			<?php get_template_part( 'thumb' ); ?>
			<?php }
		}
	wp_reset_query();
}

function virtarich_random_motor($jml) {
		global $post;
		$args=array(
		'post_type' => 'motor',
		'showposts' => $jml,
		'orderby' => 'rand'
		);
		$vtr_query = new WP_Query( $args );
		if ( $vtr_query->have_posts() ):  while( $vtr_query->have_posts() ) : $vtr_query->the_post(); ?>
         <div class="nest">
        <?php get_template_part( 'thumb' ); ?>
        </div>
		<?php endwhile;
		endif;
		wp_reset_postdata(); 
}