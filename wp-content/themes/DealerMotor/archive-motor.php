<?php get_header(); ?>
<div class="container">
<div class="grid-9 pull-right">
	<?php virtarich_breadcrumbs(); ?>
    <h1><?php bloginfo('name'); ?> <?php  if ( get_query_var('paged') ) { echo ' ('; echo __('page') . ' ' . get_query_var('paged');   echo ')';  } ?></h1>
    <div class="nest">
        <?php if (have_posts()) : while (have_posts()) : the_post(); 
			  get_template_part( 'thumb' );
			  endwhile;
			  virtarich_pagenavi();
			  else : ?>
        <h2>Not Found</h2>Sorry, but you are looking for something that isn't here.
        <?php endif; ?>
    </div>	
    </div>
    <?php get_sidebar(); ?>
</div>
<?php get_footer(); ?>