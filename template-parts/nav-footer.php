<nav id="site-navigation-footer" class="" role="navigation">
    <div class="navfooter">
        <div class="navbar-footer">
            <div class="hidden-xs hidden-sm">
                <?php
                wp_nav_menu(array(
                        //'menu'              => 'primary',
                        'theme_location' => 'footer',
                        'depth' => 2,
                        'container' => 'div',
                        'container_class' => 'footer-nav-container',
                        'container_id' => 'footer-nav-container-id',
                        'menu_class' => 'footer-nav-menu',
                        'fallback_cb' => 'wp_bootstrap_navwalker::fallback',
                        'items_wrap' => '<ul id="%2$s" class="%2$s">%3$s<li><a href="https://creativecommons.org/licenses/by-nc-nd/4.0/"><img width="150"  src="http://test.ijme.in/images/cc_and_open_access_logo.png"
                                                   alt="Page Footer IJME Logo"></a></li></ul>')
                );
//                wp_nav_menu(array('items_wrap' => '<ul id="%1$s" class="%2$s"><li><a href="http://www.google.com">go to google</a></li>%3$s</ul>'));

                ?>
            </div>

            <!--        <div class="visible-xs visible-sm">-->
            <!--            --><?php
            //            wp_nav_menu( array(
            //                    'menu'              => 'footer',
            //                    //'theme_location'    => 'header',
            //                    'depth'             => 1,
            //                    'container'         => 'div',
            //                    'container_class'   => 'footer-nav-container',
            //                    'container_id'      => 'footer-nav-container-id',
            //                    'menu_class'        => 'footer-nav-menu')
            //            );
            //            ?>
            <!--        </div>-->
            <?php
            ?>
        </div>
</nav><!-- #site-navigation -->
