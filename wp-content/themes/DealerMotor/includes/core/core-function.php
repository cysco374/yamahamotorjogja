<?php
/* Virtarich Theme
Version       : 1.0.0
Author        : Virtarich
Author URI    : http://theme-id.com
 */
if ( ! defined( 'ABSPATH' ) ) exit;
define('VTR_TEMPLATE_DIR_CORE' , VTR_TEMPLATE_DIR . '/includes/core');
if( !isset( $content_width ) )
	$content_width = 600;
function virtarich_theme_setup() {
		add_theme_support('post-thumbnails');
        register_nav_menus(         
		  array(
		  'main-menu' => __('Main Menu')
		  )
		);
}
add_action( 'after_setup_theme', 'virtarich_theme_setup' );
require_once ( VTR_TEMPLATE_DIR_CORE . '/img_resizer.php' );
require_once ( VTR_TEMPLATE_DIR . '/includes/vtr-thumb.php' );
// untuk semua jQuery wordpress
function virtarich_enqueue_scripts() {
	wp_deregister_script('jquery');
	wp_register_script( 'jquery', VTR_TEMPLATE_DIR_URI. '/js/jquery.min.js','jquery','', true );
	wp_register_script( 'migrate', VTR_TEMPLATE_DIR_URI . '/js/jquery-migrate.js','jquery','', true );
	wp_register_script( 'vlibs', VTR_TEMPLATE_DIR_URI . '/js/vjQuery.libs.js','jquery','', true );
	wp_register_script( 'vscript', VTR_TEMPLATE_DIR_URI . '/js/vjQuery.script.js','jquery','', true );	  
	wp_enqueue_script('jquery');
	wp_enqueue_script('migrate');
	wp_enqueue_script('vlibs');
	wp_enqueue_script('vscript');
}    
add_action('wp_enqueue_scripts', 'virtarich_enqueue_scripts');
//  Enqueue css
function virtarich_enqueue_styles(){
	wp_enqueue_style( 'vcss', VTR_TEMPLATE_DIR_URI .'/css/v-css.css' );
	wp_enqueue_style( 'style', get_stylesheet_uri() );
}
add_action( 'wp_enqueue_scripts', 'virtarich_enqueue_styles' ); 
//  defer JS
function virtarich_defer_js ( $url ) {
		if ( FALSE === strpos( $url, '.js' ) ) return $url;
		if ( strpos( $url, 'jquery.js' ) ) return $url;
		return "$url' defer='defer";
}
add_filter( 'clean_url', 'virtarich_defer_js', 11, 1 );
function virtarich_remove_feeds() {
		remove_action( 'wp_head', 'feed_links_extra', 3 );
		remove_action( 'wp_head', 'feed_links', 2 );
}
add_action( 'after_setup_theme', 'virtarich_remove_feeds' );
remove_action('wp_head', 'wp_generator');
function virtarich_remove_version( $src ){
		$parts = explode( '?', $src );
		return $parts[0];
}
add_filter( 'script_loader_src', 'virtarich_remove_version', 15, 1 );
add_filter( 'style_loader_src', 'virtarich_remove_version', 15, 1 );

function virtarich_favicon() {
		if ( of_get_option('favicon_uploader') ) { ?>
		<link rel="Shortcut Icon" href="<?php echo of_get_option('favicon_uploader'); ?>" type="image/x-icon" />
		<?php } else {?>
		<link rel="Shortcut Icon" href="<?php echo get_template_directory_uri();?>/images/favicon.png" type="image/x-icon" />
		<?php } 
}
add_action( 'wp_head', 'virtarich_favicon',1 );

function virtarich_logo() { 
if( of_get_option('logo_uploader') ){ ?>
<div class="header-logo"><a href="<?php echo home_url() ; ?>" title="<?php bloginfo('name'); ?>">
<img src="<?php echo of_get_option('logo_uploader'); ?>" alt="<?php bloginfo('name'); ?>" ></a></div>
<?php } else { ?>
<div class="header-title"><a href="<?php echo home_url() ; ?>" title="<?php bloginfo('name'); ?>"><?php bloginfo('name'); ?></a><p><?php bloginfo('description'); ?></p></div>
<?php } 
} 
add_filter( 'the_category', 'virtarich_remove_rel' ); 
function virtarich_remove_rel( $text ) {
$text = str_replace('rel="category tag"', "", $text); return $text;
}
function virtarich_breadcrumbs() {
	$args = array(
		'home_title' 		=> 'Home',
		'front_page' 		=> false,
		'show_blog' 		=> false,
		'singular_post_taxonomy'=> 'category',
		'echo' 			=> true
	);
	$items = virtarich_get_items( $args );
	$breadcrumbs = '';
	$breadcrumbs .= '<div class="breadcrumbs"><div xmlns:v="http://rdf.data-vocabulary.org/#">';
	$breadcrumbs .= join( '<i class="icon-angle-right"></i>', $items );
	$breadcrumbs .= '</div></div>';
	$breadcrumbs = apply_filters( 'virtarich', $breadcrumbs );
		echo $breadcrumbs;
}
function virtarich_get_items( $args ) {
	global $wp_query;

	$item = array();
	if ( !is_front_page() )
		$item[] = '<span typeof="v:Breadcrumb"><a rel="v:url" property="v:title" href="'. home_url( '/' ) .'">' . $args['home_title'] . '</a></span>';

	if ( is_home() ) {
		$home_page = get_page( $wp_query->get_queried_object_id() );
		$item = array_merge( $item, virtarich_get_parents( $home_page->post_parent ) );
		$item['last'] = get_the_title( $home_page->ID );
	}

	elseif ( is_singular() ) {

		$post = $wp_query->get_queried_object();
		$post_id = (int) $wp_query->get_queried_object_id();
		$post_type = $post->post_type;

		$post_type_object = get_post_type_object( $post_type );

		if ( 'post' === $wp_query->post->post_type && $args['show_blog'] ) {
			$item[] = '<span typeof="v:Breadcrumb"><a rel="v:url" property="v:title" href="' . get_permalink( get_option( 'page_for_posts' ) ) . '">' . get_the_title( get_option( 'page_for_posts' ) ) . '</a></span>';
		}

		if ( 'page' !== $wp_query->post->post_type ) {

			if ( function_exists( 'get_post_type_archive_link' ) && !empty( $post_type_object->has_archive ) )
				$item[] = '<span typeof="v:Breadcrumb"><a rel="v:url" property="v:title" href="' . get_post_type_archive_link( $post_type ) . '" title="' . esc_attr( $post_type_object->labels->name ) . '">' . $post_type_object->labels->name . '</a></span>';

			if ( isset( $args["singular_{$wp_query->post->post_type}_taxonomy"] ) && is_taxonomy_hierarchical( $args["singular_{$wp_query->post->post_type}_taxonomy"] ) ) {
				$terms = wp_get_object_terms( $post_id, $args["singular_{$wp_query->post->post_type}_taxonomy"] );
				$item = array_merge( $item, virtarich_get_term_parents( $terms[0], $args["singular_{$wp_query->post->post_type}_taxonomy"] ) );
			}
			elseif ( isset( $args["singular_{$wp_query->post->post_type}_taxonomy"] ) )
				$item[] = get_the_term_list( $post_id, $args["singular_{$wp_query->post->post_type}_taxonomy"], '', ', ', '' );
		}

		if ( ( is_post_type_hierarchical( $wp_query->post->post_type ) || 'attachment' === $wp_query->post->post_type ) && $parents = virtarich_get_parents( $wp_query->post->post_parent ) ) {
			$item = array_merge( $item, $parents );
		}

		$item['last'] = get_the_title();
	}
	else if ( is_archive() ) {

		if ( is_category() || is_tag() || is_tax() ) {

			$term = $wp_query->get_queried_object();
			$taxonomy = get_taxonomy( $term->taxonomy );

			if ( ( is_taxonomy_hierarchical( $term->taxonomy ) && $term->parent ) && $parents = virtarich_get_term_parents( $term->parent, $term->taxonomy ) )
				$item = array_merge( $item, $parents );

			$item['last'] = $term->name;
		}

		else if ( function_exists( 'is_post_type_archive' ) && is_post_type_archive() ) {
			$post_type_object = get_post_type_object( get_query_var( 'post_type' ) );
			$item['last'] = $post_type_object->labels->name;
		}

		else if ( is_date() ) {

			if ( is_day() )
				$item['last'] = 'Archives for '. get_the_time( 'F j, Y' );

			elseif ( is_month() )
				$item['last'] = 'Archives for '. single_month_title( ' ', false );

			elseif ( is_year() )
				$item['last'] = 'Archives for '. get_the_time( 'Y' );
		}

		else if ( is_author() )
			$item['last'] = 'Archives by: '. get_the_author_meta( 'display_name', $wp_query->post->post_author );
	}
	else if ( is_search() )
		$item['last'] = 'Search results for "'. stripslashes( strip_tags( get_search_query() ) ) . '"';

	return apply_filters( 'virtarich_items', $item );
}
function virtarich_get_parents( $post_id = '', $separator = '/' ) {
	$parents = array();
	if ( $post_id == 0 )
		return $parents;
	while ( $post_id ) {
		$page = get_page( $post_id );
		$parents[]  = '<span typeof="v:Breadcrumb"><a rel="v:url" property="v:title" href="' . get_permalink( $post_id ) . '" title="' . esc_attr( get_the_title( $post_id ) ) . '">' . get_the_title( $post_id ) . '</a></span>';
		$post_id = $page->post_parent;
	}
	if ( $parents )
		$parents = array_reverse( $parents );
	return $parents;
}
function virtarich_get_term_parents( $parent_id = '', $taxonomy = '', $separator = '/' ) {
	$html = array();
	$parents = array();
	if ( empty( $parent_id ) || empty( $taxonomy ) )
		return $parents;
	while ( $parent_id ) {
		$parent = get_term( $parent_id, $taxonomy );
		$parents[] = '<span typeof="v:Breadcrumb"><a rel="v:url" property="v:title" href="' . get_term_link( $parent, $taxonomy ) . '" title="' . esc_attr( $parent->name ) . '">' . $parent->name . '</a></span>';
		$parent_id = $parent->parent;
	}
	if ( $parents )
		$parents = array_reverse( $parents );
	return $parents;
}
function virtarich_pagenavi($before = '', $after = '', $prelabel = '', $nxtlabel = '', $pages_to_show = 6, $always_show = false) {
	global $request, $posts_per_page, $wpdb, $paged;
	if(empty($prelabel)) {
		$prelabel  = '<i class="icon-left-open"></i>';
	}
	if(empty($nxtlabel)) {
		$nxtlabel = '<i class="icon-right-open"></i>';
	}
	$half_pages_to_show = round($pages_to_show/2);
	if (!is_single()) {
		if(!is_category()) {
			preg_match('#FROM\s(.*)\sORDER BY#siU', $request, $matches);
		} else {
			preg_match('#FROM\s(.*)\sGROUP BY#siU', $request, $matches);
		}
		$fromwhere = $matches[1];
		$numposts = $wpdb->get_var("SELECT COUNT(DISTINCT ID) FROM $fromwhere");
		$max_page = ceil($numposts /$posts_per_page);
		if(empty($paged)) {
			$paged = 1;
		}
		if($max_page > 1 || $always_show) {
			echo "$before <div class=\"wp-pagenavi\"><span class=\"pages\">Page $paged of $max_page:</span>";
			if ($paged >= ($pages_to_show-1)) {
				echo '<a href="'.get_pagenum_link().'"><i class="icon-left-open"></i> First</a>&nbsp;';
			}
			previous_posts_link($prelabel);
			for($i = $paged - $half_pages_to_show; $i  <= $paged + $half_pages_to_show; $i++) {
				if ($i >= 1 && $i <= $max_page) {
					if($i == $paged) {
						echo "<strong class='current'>$i</strong>";
					} else {
						echo ' <a href="'.get_pagenum_link($i).'">'.$i.'</a> ';
					}
				}
			}
			next_posts_link($nxtlabel, $max_page);
			if (($paged+$half_pages_to_show) < ($max_page)) {
				echo '&nbsp;<a href="'.get_pagenum_link($max_page).'">Last <i class="icon-right-open"></i></a>';
			}
			echo "</div> $after";
		}
	}
}

function virtarich_excerpt($jml) {
		$content = get_the_content();
		$content = preg_replace("/\[caption.*\[\/caption\]/", '', $content);
		$content = apply_filters('the_content', $content);
		echo wp_trim_words( $content, $jml );
}


function virtarich_register_sidebar() {
		register_sidebar(array('name'=>'Sidebar',
		'id' => 'sidebar',
		'before_widget' => '<div class="box">', 
		'after_widget' => '</div>', 
		'before_title' => '<h4>', 
		'after_title' => '</h4>', 
		));
}
add_action( 'widgets_init', 'virtarich_register_sidebar' );

function virtarich_notice(){
	    global $pagenow;
   		if ( $pagenow == 'themes.php' ) {
   		echo '<div class="updated">
       <p><h3>Virtarich</h3>Terima kasih anda menggunakan theme dari theme-id.com : info terbaru >> <a href="http://theme-id.com/info-terbaru" target="_blank">Visit site</a></p></div>';
	}
}
add_action('admin_notices', 'virtarich_notice');

function virtarich_totop() { ?>
	<div class="keatas">
    	<a href="#"><i class="icon-up-circled"></i></a>
       </div>
<?php } 
add_action( 'wp_footer', 'virtarich_totop' );
show_admin_bar(false);

function rss_post_thumbnail($content) {
global $post;
if(has_post_thumbnail($post->ID)) {
$content = '<p>' . get_the_post_thumbnail($post->ID) . '</p>' . get_the_content();
}
return $content;
}
add_filter('the_excerpt_rss', 'rss_post_thumbnail');
add_filter('the_content_feed', 'rss_post_thumbnail');