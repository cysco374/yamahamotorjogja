<div class="list">
   <div class="nest">
      <div class="grid-3 grid-m-4">
          <div class="list-thumb"><a href="<?php the_permalink(); ?>" title="<?php the_title(); ?>"><?php virtarich_thumb_list();?></a></div>
      </div>
      <div class="grid-9 grid-m-8">
      <div class="list-title"><h2><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h2></div>
      <div class="tags"><?php the_time('l j F Y'); ?> | <?php the_category(', ') ?></div>
	  <p><?php echo virtarich_excerpt(25); ?></p>
      </div>
   </div>
</div>