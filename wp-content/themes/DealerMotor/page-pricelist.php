<?php
/*
Template Name: Pricelist
*/
?>
<?php get_header(); ?>
<div class="container">
<div class="grid-12">
      <?php virtarich_breadcrumbs(); ?>
      <?php if (have_posts()) : while (have_posts()) : the_post();  ?>
          <h1><a href="<?php the_permalink() ?>" title="<?php the_title(); ?>"><?php the_title(); ?></a>
          <button class="btn pull-right" name=print value="Print Pricelist" onClick="window.print()">Print Pricelist <i class="icon-print"></i></button></h1>
          <div id="printable">
            <?php do_action( 'virtarich_pricelist' ); ?>

             <div class="pull-right">*angsuran dalam Ribuan Rupiah</div>
            <div class="post"><?php the_content(); ?></div>
            <?php get_template_part( 'vcard' ); ?>
           
          </div>   
      <?php endwhile; ?>
      <?php else : ?>
      <div class="post"><h2>Not Found</h2>Sorry, but you are looking for something that isn't here.</div>
      <?php endif; ?>
      </div>

</div>
<?php get_footer(); ?>