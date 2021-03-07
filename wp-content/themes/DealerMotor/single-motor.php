<?php get_header(); ?>
<div class="container">
<div class="grid-9 pull-right">
	<div class="nest">
	<?php if (have_posts()) : ?><?php while (have_posts()) : the_post(); ?>
     <div class="grid-12 "><?php virtarich_breadcrumbs(); ?>
     
     
     <div class="nest">
     <div class="grid-6">
        <div class="photo">
		<?php virtarich_label() ?><?php virtarich_big_thumb() ?>
                 <div class="photo-slider"><?php virtarich_slider_thumb() ?></div> 
                </div>
           </div> 
           <div class="grid-6">
                   <div class="judul">   <h1><a href="<?php the_permalink() ?>" title="<?php the_title(); ?>"><?php the_title(); ?></a></h1></div>
 <div class="harga"> Harga <?php echo get_post_meta($post->ID, "harga", $single = true);?></div>
          <table class="vtr-table" >
            <tr>
            <th rowspan="2">Uang Muka</th>
            <td colspan="5" class="sapi">Angsuran</td>
  </tr>
  <tr>
  <td><?php echo of_get_option('angsuran_1') ?></td>
  <td><?php echo of_get_option('angsuran_2') ?></td>
  <td><?php echo of_get_option('angsuran_3') ?></td>
  <td><?php echo of_get_option('angsuran_4') ?></td>
  <td><?php echo of_get_option('angsuran_5') ?></td>
  </tr>
      
          <?php virtarich_list_harga() ?>
          </table>
          <div class="pull-right">*angsuran dalam Ribuan Rupiah</div>
           </div>
            
            
                
                </div>
                
       </div>


                
<?php if(get_post_meta($post->ID, "youtube",true)){ ?>
    <div class="grid-12">
        <div class="vtr-title"><h3>Video <?php the_title(); ?></h3></div>
        <div class="videowrapper">
        <iframe width="560" height="315" src="https://www.youtube.com/embed/<?php echo get_post_meta($post->ID, "youtube", $single = true);?>" frameborder="0" allowfullscreen></iframe>
        </div>
    </div>
<?php } ?>

   

      <div class="grid-12">
          <div class="vtr-title"><h2>Deskripsi Motor <?php the_title(); ?></h2></div>
          <div class="post"><?php the_content(); ?></div>
      </div>

	  <?php if(of_get_option('vcard_act') == '1') { ?>
      <div class="grid-12">           
          <div class="vtr-title"><h4>Hubungi Kami</h4></div>
          <?php get_template_part( 'vcard' ); ?>
          <?php virtarich_share_buttons();?>
      </div>
      <?php } ?>
 
    
 <?php if(of_get_option('maps_act') == '1') { ?>
          <div class="grid-12">   
          <div class="vtr-title"><h4>Peta Lokasi</h4></div>   
            <div id="google_maps"></div>
          </div>
<?php } ?>

<?php endwhile; ?>

<div class="grid-12">   
    <div class="vtr-title"><h3>Motor Tipe Lain <?php the_category(', ') ?></h3></div>
    <div class="nest"><?php virtarich_related_motor(9); ?></div>
</div>

<?php endif; ?>
</div>
</div>
	<?php get_sidebar(); ?>
</div>
<?php get_footer(); ?>