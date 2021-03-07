<?php get_header(); ?>
<div class="container">
<div class="grid-9 pull-right">
<div class="vtr-row">
<?php virtarich_breadcrumbs(); ?>
<h1><?php the_search_query();?> </h1>
<?php get_template_part( 'loop' ); ?>	
</div>
</div>
<?php get_sidebar(); ?>
</div>
<?php get_footer(); ?>