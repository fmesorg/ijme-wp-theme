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
                <link rel="canonical" href="http://ijme.in<?php echo $_SERVER['REQUEST_URI'] ?>"/>
		<?php } ?>
		<?php } ?>


        <?php wp_head(); ?>

        <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
        <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
        <!--[if lt IE 9]>
            <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
            <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
        <![endif]-->


        <?php $site_url = 'http://' . $_SERVER['HTTP_HOST'] . '/';
            if (($site_url == "http://ijme.in/") || ($site_url == "http://www.ijme.in/")) {
                if (is_singular('articles')) {
                    $this_post = get_queried_object();
                    $catList = get_the_category($this_post->ID);
                    $tags = wp_get_post_tags($this_post->ID);
                    $categoryDimension = "";
                    foreach ($catList as $single) {
                        $categoryDimension = $categoryDimension . " " . $single->cat_name . " ";
                    }
                    $term_obj_list = get_the_terms($this_post->ID, 'topic');
                    $terms_string = " ";
                    if ($term_obj_list) {
                        $terms_string = join(' , ', wp_list_pluck($term_obj_list, 'name')) . " ";
                    }
                }
                ?>
				<script>
					 (function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){
					 (i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),
					 m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
					 })(window,document,'script','https://www.google-analytics.com/analytics.js','ga');
					 ga('create', 'UA-42369332-1', 'auto');
                     <?php
                     if(is_singular('articles'))
                     {?>
                     ga('set', 'dimension1', '<?php echo $categoryDimension; ?>');
                     <?php
                     if ($terms_string != " ") {?>
                     ga('set', 'dimension2', '<?php echo $terms_string; ?>');
                     <?php  } ?>
                     <?php } ?>
                     ga('send', 'pageview');

                     function hover(element,fileName) {
                       let link = '<?php echo THEME_URL; ?>/images/header-social-media/hover/'+fileName;
                       element.setAttribute('src', link);
                     }

                     function unhover(element,fileName) {
                       let link = '<?php echo THEME_URL; ?>/images/header-social-media/'+fileName;
                       element.setAttribute('src', link);
                     }

                </script>
            <?php } ?>


    </head>
    <body>

    <div class="">
        <div class="row background-white padding-left-24 header-shadow custom-navigation-header">
            <div class="i-header-logo dp-flex align-items-center">
                <a href="<?php echo site_url(); ?>"><img src="<?php echo THEME_URL; ?>/images/logo.png"
                                                         alt="Page Header"></a>
            </div>
            <div class="nav-menu-wrapper">
                <div style="display: flex;width: 100%">
                    <?php require 'nav.php'; ?>
                    <div class="header-social-media-wrapper">
                        <img width="18" src="<?php echo THEME_URL; ?>/images/header-social-media/facebook-f.svg"
                             onmouseover="hover(this,'facebook-f.svg');"
                             onmouseout="unhover(this,'facebook-f.svg')"
                             alt="Page Header">
                        <img width="18" src="<?php echo THEME_URL; ?>/images/header-social-media/twitter.svg"
                             onmouseover="hover(this,'twitter.svg');"
                             onmouseout="unhover(this,'twitter.svg')"
                             alt="Page Header">
                        <img width="18" src="<?php echo THEME_URL; ?>/images/header-social-media/linkedin-in.svg"
                             onmouseover="hover(this,'linkedin-in.svg');"
                             onmouseout="unhover(this,'linkedin-in.svg')"
                             alt="Page Header">
                    </div>
                </div>
                <div class="nav-logo-text">
                    <span>ISSN: 0975-5091 (Online);</span>
                    <span>0974-8466 (Print)</span>
                    <span>RNI Reg No. MAHENG/2016/67188</span>
                </div>
                <div class="nav-about-wrapper" >
                    <p class="nav-about-journal-text">
                        A Journal of Healthcare Ethics & Humanities. Published since 1993 by Forum for Medical Ethics
                        Society. Peer-reviewed. Indexed in Medline, PubMed, The Philosopher’s Index, Scopus.
                    </p>
                </div>
            </div>
            </div>


