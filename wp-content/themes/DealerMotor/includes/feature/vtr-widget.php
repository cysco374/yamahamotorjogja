<?php
/*
Version       : 1.0.0
Author        : Virtarich
Author URI    : http://theme-id.com
*/
if ( ! defined( 'ABSPATH' ) ) exit;
wp_register_sidebar_widget(
    'virtarich_widget_kontak', 
    'Virtarich kontak', 
    'virtarich_widget_kontak',
    array( 'description' => 'kontak widget' )
);
wp_register_sidebar_widget(
    'virtarich_hitung_kredit', 
    'Virtarich Hitung Kredit', 
    'virtarich_hitung_kredit',
    array( 
        'description' => 'Widget Hitung Kredit'
    )
);
wp_register_sidebar_widget(
    'virtarich_widget_download', 
    'Virtarich Download', 
    'virtarich_widget_download',
    array( 'description' => 'Tampilkan print katalog di sidebar' )
);
wp_register_sidebar_widget(
    'virtarich_widget_motor',
    'Virtarich Motor',
    'virtarich_widget_motor', 
    array( 
        'description' => 'Tampilkan Slider Motor'
    )
);


function virtarich_widget_kontak() { ?>
      <div class="box">
<?php get_template_part( 'vcard-widget' ); ?>
      </div> 
<?php }

function virtarich_hitung_kredit() { ?>
<div class="box">
<h4>Simulasi Kredit</h4>
    <form id="widget-form" >
      <div><label><span>Harga Motor (Rp)</span></label><input placeholder="(tanpa koma / titik)" type="text" id="kreditHarga"/></div>
        <div><label><span>Uang Muka (Rp)</span></label><input placeholder="(tanpa koma / titik)" type="text" id="kreditDp"/></div>
        <div><label><span>Bunga/tahun(ex: 6.5)</span></label><input placeholder="tulis angka" type="text" id="kreditRate" /></div>
        <div><label><span>jangka waktu(tahun)</span></label><input placeholder="tulis angka" type="text" id="kreditJangka" /></div>
       <div> <button name="submit" class="button"  id="hitung" onclick="return false">Hitung angsuran</button></div>
        <div><label><span>Hutang Pokok (Rp)</span></label><input type="text" id="kreditHutang" /></div>
        <div><label><span>Angsuran/Bln (Rp)</span></label><input type="text" id="kreditAngsuran" /></div>
       <div><label><span>Pembayaran Pertama (Rp)</span></label><input type="text" id="kreditTotal" /></div>
    </form>
</div>
<?php
}


function virtarich_widget_motor() { ?>
    <div class="box">
        <h4>Motor Baru</h4>
        <div class="widget-slider">
            <ul id="widget-slider" class="content-produk">
                <?php global $post; 
                query_posts('post_type=motor');
                if (have_posts()) :  while (have_posts()) : the_post();  ?>
                   <li> 
                  <div class="slider-gambar-center">
                  <div class="slider-gambar">
                  <a href="<?php the_permalink(); ?>" title="<?php the_title(); ?>"><?php virtarich_thumb_normal() ?></a>
                  </div>
                  </div>
                  		
                  </li>
                      
           		 <?php  
                  endwhile;
                  endif;
                 wp_reset_query(); ?>
            </ul>
        </div>
    </div>
<?php } 
add_action('virtarich_pricelist', 'virtarich_pricelist_function');
function virtarich_widget_download() { ?>
    <div class="box">
      <h4>Download Pricelist</h4>
          <a href="<?php echo home_url() ; ?>/pricelist" class="button-widget" title="download" target="_blank" rel="nofollow">
              <span class="button-widget-icon"><i class="icon-download"></i></span>
              <span class="button-widget-text">Download</span>
              <span class="button-widget-link">Pricelist</span>
          </a>
    </div>
<?php
}