<?php get_header(); ?>
<div class="container">
<div class="grid-9 pull-right">
	<?php virtarich_breadcrumbs(); ?>
    <div class="post">
		<?php if (have_posts()) : while (have_posts()) : the_post(); ?>
        <h1><a href="<?php the_permalink() ?>" title="<?php the_title(); ?>"><?php the_title(); ?></a></h1>
        <?php the_content(); ?>
        <?php endwhile; ?><?php else : ?>
        <h2>Not Found</h2>Sorry, but you are looking for something that isn't here.
        <?php endif; ?>
    </div>
</div>
  
  <?php get_sidebar(); ?>

</div>
<?php get_footer(); ?>