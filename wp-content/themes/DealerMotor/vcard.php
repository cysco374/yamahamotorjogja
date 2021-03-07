<div class="grid-12">
  <div class="nest">
	<div class="vcard">
    
	<div class="grid-3">
        <div class="vcard-photo">
        <?php if( of_get_option('foto_uploader') ){ ?>
        <img src="<?php echo of_get_option('foto_uploader'); ?>" alt="foto sales">
         <?php } ?>
        </div>
    </div>
    
    <div class="grid-9">    
	<div class="vcard-header"><?php echo of_get_option('nama_dealer'); ?></div>
	<div class="vcard-content"> 
		<div class="vcard-name"><?php echo of_get_option('nama_sales'); ?></div>
		 <p><?php echo of_get_option('jabatan'); ?></p>
			<?php if(of_get_option('contact_act') == '1') { ?>
                 <div class="grid-6 grid-m-6">
                 <div class="vcard-contact"><i class="icon-phone-squared"></i> <?php echo of_get_option('nomer_telp'); ?></div>
                 </div>
              <?php } if(of_get_option('contact_sms') == '1') { ?>
                <div class="grid-6 grid-m-6">
                <div class="vcard-contact"><i class="icon-mobile"></i> <?php echo of_get_option('nomer_hp'); ?></div>
                </div>
              <?php } if(of_get_option('contact_bbm') == '1') { ?>
                <div class="grid-6 grid-m-6">
                <div class="vcard-contact"><i class="icon-bbm"></i> <?php echo of_get_option('pin_bb'); ?></div>
                </div>
              <?php } if(of_get_option('contact_whatsapp') == '1') { ?>
                <div class="grid-6 grid-m-6">
                <div class="vcard-contact"><i class="icon-whatsapp"></i> <?php echo of_get_option('nomer_whatsapp'); ?></div>
                </div>
              <?php } ?>
	</div>
	</div>
    <div class="vcard-footer"><?php echo of_get_option('alamat'); ?> / <?php echo get_site_url(); ?></div> 
	</div>
  </div>
</div>