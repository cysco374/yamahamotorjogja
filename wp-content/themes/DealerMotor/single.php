<?php get_header(); ?>
<div class="container">
<div class="grid-9 pull-right">
		<?php virtarich_breadcrumbs(); ?>
        <?php if (have_posts()) : while (have_posts()) : the_post();  ?>
            <div class="post">
                <h1><a href="<?php the_permalink() ?>" title="<?php the_title(); ?>"><?php the_title(); ?></a></h1>
                <div class="tags"><?php the_time('l, F jS Y.') ?> <?php edit_post_link('Edit', '', ''); ?></div>
                <?php virtarich_top_ads(); ?>  
                <?php the_content(); ?>
                <?php virtarich_bottom_ads(); ?> 
                <?php virtarich_share_buttons();?>
            </div>	
        <?php endwhile; ?>
        <?php else : ?>
            <div class="post"><h2>Not Found</h2>Sorry, but you are looking for something that isn't here.</div>
        <?php endif; ?>
            <div class="vtr-title"><h2>motor Terbaru</h2></div>
            <?php virtarich_random_motor(6); ?>
             <div class="vtr-title"><h2>Related Article <?php the_title(); ?></h2></div>
            <?php virtarich_related_post(3); ?>
    </div>
	<?php get_sidebar(); ?>
</div>
<?php get_footer(); ?>