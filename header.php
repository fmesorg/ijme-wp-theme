<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->

		<?php if(is_front_page()) { ?>
		<title><?php echo get_bloginfo('name'); ?> | <?php the_title(); ?></title>
		<meta name="description" content="IJME is a comprehensive, open access, platform for discussions on bioethics, medical ethics, and healthcare justice in India and the developing world." />
		<?php }else{ ?>
		<title><?php the_title(); ?> | <?php echo get_bloginfo('name'); ?> </title>
		<meta name="description" content="<?php the_title(); ?>" />
		<?php } ?>

        <!-- Bootstrap -->
        <!--<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" integrity="sha384-1q8mTJOASx8j1Au+a5WDVnPi2lkFfwwEAa8hDDdjZlpLegxhjVME1fgjWPGmkzs7" crossorigin="anonymous">-->
		<?php $url='http://'.$uri = $_SERVER['HTTP_HOST'];
		if($url=="http://ijme.in"){  }else{ ?>
		<meta name="robots" content="noindex, nofollow">
		<?php if(is_front_page()){ ?>
		<link rel="canonical" href="http://ijme.in/"/>
		<?php }else{ ?>
		<link rel="canonical" href="http://ijme.in<?php echo $_SERVER['REQUEST_URI'] ?>" />
		<?php } ?>
		<?php } ?>


        <?php wp_head(); ?>

        <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
        <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
        <!--[if lt IE 9]>
            <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
            <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
        <![endif]-->


		<?php $site_url= 'http://'.$_SERVER['HTTP_HOST'].'/';
			if(($site_url== "http://ijme.in/") || ($site_url== "http://www.ijme.in/")){ ?>
				<script>
					 (function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){
					 (i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),
					 m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
					 })(window,document,'script','https://www.google-analytics.com/analytics.js','ga');

					 ga('create', 'UA-42369332-1', 'auto');
					 ga('send', 'pageview');
				</script>
		<?php }elseif(($site_url== "http://medicalethicsindia.org/") || ($site_url== "http://www.medicalethicsindia.org/")) { ?>
				<script>
					 (function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){
					 (i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),
					 m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
					 })(window,document,'script','https://www.google-analytics.com/analytics.js','ga');

					 ga('create', 'UA-90349823-1', 'auto');
					 ga('send', 'pageview');
				</script>
		<?php }elseif(($site_url== "http://issuesinmedicalethics.com/") || ($site_url== "http://www.issuesinmedicalethics.org/")){?>
				<script>
					 (function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){
					 (i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),
					 m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
					 })(window,document,'script','https://www.google-analytics.com/analytics.js','ga');

					 ga('create', 'UA-90344917-1', 'auto');
					 ga('send', 'pageview');
				</script>
		<?php }
		?>




    </head>
    <body>

        <div class="container">

            <div class="row header">
		      <div class="col-md-12 i-header-banner">
                </div>

            </div>
            <div class="row">
			  <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12 i-header-logo">
                    <a href="<?php echo site_url(); ?>"><img src="<?php echo THEME_URL; ?>/images/logo.jpg" alt="Page Header"></a>
                </div>
                <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12 nav-top-btn-container">
                    <!--<div class="top-nav-btnI"><a href="<?php //echo get_permalink(4199); ?>"><img src="<?php //echo THEME_URL; ?>/images/Disclaimer.jpg" alt="Disclaimer"></a></div>
                    <div class="top-nav-btnI"><a href="<?php //echo get_permalink(4223); ?>"><img src="<?php //echo THEME_URL; ?>/images/subscribe_btn.jpg" alt="Subscribe"></a></div>-->
                    <!--<div class="top-nav-btnI"><a href="<?php //echo get_permalink(4201); ?>"><img src="<?php //echo THEME_URL; ?>/images/donate_btn.jpg" alt="Donate"></a></div>
                    <div class="top-nav-btnI"><a href="<?php //echo get_permalink(4195); ?>"><img src="<?php //echo THEME_URL; ?>/images/banneFr_ad_btn.jpg" alt="Advertise with us"></a></div>-->

					<div class="top-nav-btnI top-nbc-logo">
						<img src="<?php echo THEME_URL; ?>/images/nbc.jpg" alt="">
					</div>
					<div class="top-nav-btnI border"><a href="#"><img src="<?php echo THEME_URL; ?>/images/14-world-congress-of-bioethics-logo.jpg" alt="14th-wcb"></a></div>
                    <div class="top-nav-btnI border"><a href="<?php echo site_url(); ?>/about-us/fmes/overview/"><img src="<?php echo THEME_URL; ?>/images/search.jpg" alt="fmes"></a></div>

                </div>
				<div class="btnContainer">
					<a href="<?php echo site_url(); ?>/contact/" title="Contact Us">
						<img src="<?php echo THEME_URL; ?>/images/contact_icon.jpg" alt="Contact Us"></a>
					<a href="<?php echo site_url(); ?>/advertise/" title="Advertise">
						<img src="<?php echo THEME_URL; ?>/images/advertise_icon.jpg" alt="Advertise"></a>
					<!--a href="<?php //echo site_url(); ?>/donate/" title="Donate"-->
					<a href="https://www.payumoney.com/paybypayumoney/#/322913" target="_blank" title="Donate">
						<img src="<?php echo THEME_URL; ?>/images/donate-icon.jpg" alt="Donate"></a>
				</div>
            </div>

            <?php require 'nav.php'; ?>
