<!DOCTYPE html>
<!--[if IE]>
<script src="http://html5shiv.googlecode.com/svn/trunk/html5.js"></script>
<![endif]-->
<head>
<meta charset="utf-8">
<meta name="propeller" content="81aa0d011692970ab0491dc025caee45" />
<title><?php if ( is_home() ) { ?><?php bloginfo('name'); ?> - <?php bloginfo('description'); ?>
<?php } else { ?><?php wp_title(''); ?> - <?php bloginfo('name'); ?><?php } ?></title>
<link rel="profile" href="http://gmpg.org/xfn/11" />
<link rel="pingback" href="<?php bloginfo('pingback_url'); ?>" />
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<link rel="stylesheet" type="text/css" href="http://fonts.googleapis.com/css?family=Open+Sans">
<?php wp_head(); ?>
</head>
<body>
<script>
  window.fbAsyncInit = function() {
    FB.init({
      appId      : '198305810922374',
      xfbml      : true,
      version    : 'v2.12'
    });
  
    FB.AppEvents.logPageView();
  
  };

  (function(d, s, id){
     var js, fjs = d.getElementsByTagName(s)[0];
     if (d.getElementById(id)) {return;}
     js = d.createElement(s); js.id = id;
     js.src = "https://connect.facebook.net/en_US/sdk.js";
     fjs.parentNode.insertBefore(js, fjs);
   }(document, 'script', 'facebook-jssdk'));
</script>


<div id="wrap">
<div class="header">
<div class="grid-4"><?php virtarich_logo() ; ?></div>
<div class="grid-8">
<div class="header-title"><?php echo of_get_option('nama_dealer'); ?><p><?php echo of_get_option('alamat'); ?></p></div>
    </div>
</div>
<div class="vtr-menu-wrap">
    <div class="vtr-menu-icon">Menu <i class="icon-th-list pull-right"></i></div>
    <?php wp_nav_menu( array( 'theme_location' => 'main-menu','menu_class' => 'mobile-menu' ) ); ?>
</div>
<?php wp_nav_menu( array( 'theme_location' => 'main-menu','menu_class' => 'vtr-menu' ) ); ?>