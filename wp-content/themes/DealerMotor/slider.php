<?php if((is_home())&& ($paged < 1)) { ?>
<div class="slider">
	<ul id="home-slider" class="content-slider">
		<li>
			<?php if( of_get_option('banner_1') ){ ?>
            <a href="<?php echo of_get_option('banner_url_1'); ?>"><img src="<?php echo of_get_option('banner_1'); ?>" width="960" height="390" alt="<?php bloginfo('name'); ?>"></a>
            <?php } else {?>
            <img src="<?php echo get_template_directory_uri();?>/images/banner.png" width="960" height="390" alt="<?php bloginfo('name'); ?>"/>
            <?php } ?>
		</li>

		<li>
			<?php if( of_get_option('banner_2') ){ ?>
            <a href="<?php echo of_get_option('banner_url_2'); ?>"><img src="<?php echo of_get_option('banner_2'); ?>" width="960" height="390" alt="<?php bloginfo('name'); ?>"></a>
            <?php } else {?>
            <img src="<?php echo get_template_directory_uri();?>/images/banner.png" width="960" height="390" alt="<?php bloginfo('name'); ?>"/>
            <?php } ?>
		</li>
        
		<li>
			<?php if( of_get_option('banner_3') ){ ?>
            <a href="<?php echo of_get_option('banner_url_3'); ?>"><img src="<?php echo of_get_option('banner_3'); ?>" width="960" height="390" alt="<?php bloginfo('name'); ?>"></a>
            <?php } else {?>
            <img src="<?php echo get_template_directory_uri();?>/images/banner.png" width="960" height="390" alt="<?php bloginfo('name'); ?>"/>
            <?php } ?>
		</li>
        
		<li>
			<?php if( of_get_option('banner_4') ){ ?>
            <a href="<?php echo of_get_option('banner_url_4'); ?>"><img src="<?php echo of_get_option('banner_4'); ?>" width="960" height="390" alt="<?php bloginfo('name'); ?>"></a>
            <?php } else {?>
            <img src="<?php echo get_template_directory_uri();?>/images/banner.png" width="960" height="390" alt="<?php bloginfo('name'); ?>"/>
            <?php } ?>
		</li>
        
		<li>
			<?php if( of_get_option('banner_5') ){ ?>
            <a href="<?php echo of_get_option('banner_url_5'); ?>"><img src="<?php echo of_get_option('banner_5'); ?>" width="960" height="390" alt="<?php bloginfo('name'); ?>"></a>
            <?php } else {?>
            <img src="<?php echo get_template_directory_uri();?>/images/banner.png" width="960" height="390" alt="<?php bloginfo('name'); ?>"/>
            <?php } ?>
		</li>
        
	</ul>
</div>	
<?php } ?>