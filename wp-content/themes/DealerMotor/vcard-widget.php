<div class="grid-12">
	<div class="vcard-widget-photo">
		<?php if( of_get_option('foto_uploader') ){ ?>
   		<img src="<?php echo of_get_option('foto_uploader'); ?>" alt="foto sales" >
   		<?php } ?>
	</div>
    <div class="vcard-content"> 
		<div class="vcard-name-widget"><?php echo of_get_option('nama_sales'); ?></div>
		<div class="vcard-title-widget"><?php echo of_get_option('jabatan'); ?></div>
    
		
	  <?php if(of_get_option('contact_act') == '1') { ?>
          <div class="vcard-widget-contact"><i class="icon-phone-squared"></i> <?php echo of_get_option('nomer_telp'); ?></div>
      <?php } if(of_get_option('contact_sms') == '1') { ?>
          <div class="vcard-widget-contact"><i class="icon-mobile"></i> <?php echo of_get_option('nomer_hp'); ?></div>
      <?php } if(of_get_option('contact_bbm') == '1') { ?>
          <div class="vcard-widget-contact"><i class="icon-bbm"></i> <?php echo of_get_option('pin_bb'); ?></div>
      <?php } if(of_get_option('contact_whatsapp') == '1') { ?>
          <div class="vcard-widget-contact"><i class="icon-whatsapp"></i> <?php echo of_get_option('nomer_whatsapp'); ?></div>
      <?php } ?>
	</div>
</div>

