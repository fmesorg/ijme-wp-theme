<nav id="site-navigation" class="navbar navbar-expand-md" role="navigation">
    <div class="navheader navbar-right">
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1">
            <span class="navbar-toggler-custom-icon">
                <div></div>
                <div></div>
                <div></div>
            </span>
        </button>

        <!--        Full screen menu-->
        <?php
            wp_nav_menu( array(
                //'menu'              => 'primary',
                'theme_location'    => 'main',
                'depth' => 0,
                'container'         => 'div',
                'container_class' => 'collapse navbar-collapse',
                'container_id'      => 'bs-example-navbar-collapse-1',
                'menu_class'        => 'nav navbar-nav',
                'fallback_cb'       => 'wp_bootstrap_navwalker::fallback',
                'walker'            => new wp_bootstrap_navwalker())
            );
        ?>

        <!--Mobile menu-->
        <!--		<div class="visible-xs visible-sm">-->
        <!--            --><?php
            //            wp_nav_menu( array(
            //                'menu'              => 'Mobile Main Menu',
            //                //'theme_location'    => 'header',
            //                'depth'             => 4,
            //                'container'         => 'div',
            //                'container_class'   => 'collapse navbar-collapse dropnav',
            //                'container_id'      => 'bs-example-navbar-collapse-mobile',
            //                'menu_class'        => 'nav navbar-nav',
            //                'fallback_cb'       => 'wp_bootstrap_navwalker::fallback',
            //                'walker'            => new wp_bootstrap_navwalker())
            //            );
            //        ?>
        </div>
    <!--    --><?php
        //    $obj = get_queried_object();
        //        $custom_post_type = isset($obj->post_type)? $obj->post_type:"page";
        //    if($custom_post_type!='blog') { ?>
    <!--        <div>-->
    <!--            <form method="get" action="-->
    <?php //echo site_url(); ?><!--" id="searchform" class="search-form" role="search">-->
    <!--                <div class="input-group add-on">-->
    <!--                    <input class="form-control" placeholder="Search" name="s" id="srch-term" type="text">-->
    <!--                    <div class="input-group-btn">-->
    <!--                        <button class="btn search-submit" type="submit">search</button>-->
    <!--                    </div>-->
    <!--                </div>-->
    <!--            </form>-->
    <!--        </div>-->
    <!--        --><?php //}?>

</nav><!-- #site-navigation -->

