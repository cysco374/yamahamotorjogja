<?php
/* Virtarich Theme
Version       : 1.0.0
Author        : Virtarich
Author URI    : http://theme-id.com
 */
if ( ! defined( 'ABSPATH' ) ) exit;
function virtarich_thumb_normal(){
		if(has_post_thumbnail()) { 
			  $image_id = get_post_thumbnail_id();
			  $image_url = wp_get_attachment_url($image_id,'full' );
			  $image = aq_resize( $image_url, 200, 200, true , false , true  );?>
			  <img src="<?php echo $image[0] ?>" alt="<?php the_title(); ?>" width="<?php echo $image[1] ?>" height="<?php echo $image[2] ?>"/>
		<?php } else {
				global $post, 
				$posts;
				$first_img = '';
				ob_start();
				ob_end_clean();
				$output = preg_match_all('/<img.+src=[\'"]([^\'"]+)[\'"].*>/i', $post->post_content, $matches);
				if(isset($matches [1] [0])){
					$first_img = $matches [1] [0];
					$img_url = $first_img; 
					$image = aq_resize( $img_url, 200, 200, true , false , true );?>
					<img class="group list-group-image" src="<?php echo $image[0] ?>" alt="<?php the_title(); ?>" width="<?php echo $image[1] ?>" height="<?php echo $image[2] ?>" />
				<?php } else {?>
				<i class="icon-picture icon-5x"></i>
				<?php }  
		}  
}

function virtarich_thumb_list(){
			if(has_post_thumbnail()) { 
				  $image_id = get_post_thumbnail_id();
				  $image_url = wp_get_attachment_url($image_id,'full' );
				  $image = aq_resize( $image_url, 146, 97, true , false , true  );?>
			<img class="lazy" src="<?php echo get_template_directory_uri(); ?>/images/asli.gif" data-original="<?php echo $image[0] ?>" alt="<?php the_title(); ?>" width="<?php echo $image[1] ?>" height="<?php echo $image[2] ?>"/>
			<?php } else {
				global $post, $posts;
				$first_img = '';
				ob_start();
				ob_end_clean();
				$output = preg_match_all('/<img.+src=[\'"]([^\'"]+)[\'"].*>/i', $post->post_content, $matches);
				if(isset($matches [1] [0])){
					$first_img = $matches [1] [0];
					$img_url = $first_img; 
					$image = aq_resize( $img_url, 146, 97, true , false , true );?>
					<img class="lazy" src="<?php echo get_template_directory_uri(); ?>/images/asli.gif" data-original="<?php echo $image[0] ?>" alt="<?php the_title(); ?>" width="<?php echo $image[1] ?>" height="<?php echo $image[2] ?>" />
				<?php } else {?>
				<i class="icon-picture icon-5x"></i>
			<?php }  
			}  
}

function virtarich_thumb(){
			if(has_post_thumbnail()) { 
				  $image_id = get_post_thumbnail_id();
				  $image_url = wp_get_attachment_url($image_id,'full' );
				  $image = aq_resize( $image_url, 213, 213, true , false , true  );?>
			<img class="lazy" src="<?php echo get_template_directory_uri(); ?>/images/asli.gif" data-original="<?php echo $image[0] ?>" alt="<?php the_title(); ?>" width="<?php echo $image[1] ?>" height="<?php echo $image[2] ?>"/>
			<?php } else {
				global $post, $posts;
				$first_img = '';
				ob_start();
				ob_end_clean();
				$output = preg_match_all('/<img.+src=[\'"]([^\'"]+)[\'"].*>/i', $post->post_content, $matches);
				if(isset($matches [1] [0])){
					$first_img = $matches [1] [0];
					$img_url = $first_img; 
					$image = aq_resize( $img_url, 213, 213, true , false , true );?>
					<img class="lazy" src="<?php echo get_template_directory_uri(); ?>/images/asli.gif" data-original="<?php echo $image[0] ?>" alt="<?php the_title(); ?>" width="<?php echo $image[1] ?>" height="<?php echo $image[2] ?>" />
				<?php } else {?>
				<i class="icon-picture icon-5x"></i>
			<?php }  
			}  
}

 
function virtarich_big_thumb(){
			if(has_post_thumbnail()) { 
				  $image_id = get_post_thumbnail_id();
				  $image_url = wp_get_attachment_url($image_id,'full' );
				  $image = aq_resize( $image_url, 350, 350, true , false , true  );?>
            <a href="<?php echo $image[0] ?>" data-title="<?php the_title(); ?>">
					<img src="<?php echo $image[0] ?>" alt="<?php the_title(); ?>" width="<?php echo $image[1] ?>" height="<?php echo $image[2] ?>" /></a>                 
                    
                    
                    
                    
			<?php } else {
				global $post, 
				$posts;
				$first_img = '';
				ob_start();
				ob_end_clean();
				$output = preg_match_all('/<img.+src=[\'"]([^\'"]+)[\'"].*>/i', $post->post_content, $matches);
				if(isset($matches [1] [0])){
					$first_img = $matches [1] [0];
					$img_url = $first_img; 
					$image = aq_resize( $img_url, 350, 350, false , true , true );?>
					<a href="<?php echo $img_url; ?>">
					<img src="<?php echo $image[0] ?>" alt="<?php the_title(); ?>" width="<?php echo $image[1] ?>" height="<?php echo $image[2] ?>" /></a>
				<?php } else { ?>
					<i class="icon-picture icon-5x"></i>
				<?php }  
			}  
}


function virtarich_slider_thumb(){ ?>
<ul id="small-slider">
	<?php global $post;
		  $args = array(
            'post_type' => 'attachment',
            'numberposts' => -1,
            'post_status' => null,
            'post_parent' => $post->ID
            ); 
         $attachments = get_posts($args);
		 if(count($attachments) > 1) {
         foreach (array_reverse($attachments) as $attachment ) { ?>
         <li>
              <a href="<?php echo wp_get_attachment_url($attachment->ID); ?>" >
              <img src="<?php echo wp_get_attachment_thumb_url( $attachment->ID); ?>" alt="<?php the_title(); ?>"/></a>
         </li>
        <?php } 
		} ?>
</ul>
<?php }