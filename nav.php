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
        <!--        </div>-->
    </div>

</nav>

