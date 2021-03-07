	<?php if (have_posts()) : while (have_posts()) : the_post();  ?>
    	<?php get_template_part( 'list' ); ?>
    <?php endwhile; ?>
    <?php virtarich_pagenavi(); ?>
    <?php else : ?>
    <h2>Not Found</h2>Sorry, but you are looking for something that isn't here.
    <?php endif; ?>