<nav id="site-navigation-footer" class="" role="navigation">
    <div class="navfooter">
        <div class="navbar-footer">
        <div class="hidden-xs hidden-sm">
            <?php
            wp_nav_menu( array(
                    //'menu'              => 'primary',
                    'theme_location'    => 'footer',
                    'depth'             => 2,
                    'container'         => 'div',
                    'container_class'   => 'footer-nav-container',
                    'container_id'      => 'footer-nav-container-id',
                    'menu_class'        => 'footer-nav-menu',
                    'fallback_cb'       => 'wp_bootstrap_navwalker::fallback')
            );
            ?>
        </div>

        <div class="visible-xs visible-sm">
            <?php
            wp_nav_menu( array(
                    'menu'              => 'footer',
                    //'theme_location'    => 'header',
                    'depth'             => 1,
                    'container'         => 'div',
                    'container_class'   => 'footer-nav-container',
                    'container_id'      => 'footer-nav-container-id',
                    'menu_class'        => 'footer-nav-menu')
            );
            ?>
        </div>
        <?php
        ?>
    </div>

</nav><!-- #site-navigation -->
