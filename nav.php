<nav id="site-navigation" class="navbar col-lg-10 col-md-10" role="navigation">
    <div class="navheader navbar-right">
        <div class="navbar-header">
            <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#bs-example-navbar-collapse-mobile">
                <span class="sr-only">Toggle navigation</span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button>
            <a class="navbar-brand" href="#"><?php bloginfo( 'name' ); ?></a>
        </div>
		<div class="hidden-xs hidden-sm">
        <?php
            wp_nav_menu( array(
                //'menu'              => 'primary',
                'theme_location'    => 'main',
                'depth'             => 4,
                'container'         => 'div',
                'container_class'   => 'collapse navbar-collapse dropnav',
                'container_id'      => 'bs-example-navbar-collapse-1',
                'menu_class'        => 'nav navbar-nav',
                'fallback_cb'       => 'wp_bootstrap_navwalker::fallback',
                'walker'            => new wp_bootstrap_navwalker())
            );
        ?>
		</div>
		
		<div class="visible-xs visible-sm">
		<?php
            wp_nav_menu( array(
                'menu'              => 'Mobile Main Menu',
                //'theme_location'    => 'header',
                'depth'             => 4,
                'container'         => 'div',
                'container_class'   => 'collapse navbar-collapse dropnav',
                'container_id'      => 'bs-example-navbar-collapse-mobile',
                'menu_class'        => 'nav navbar-nav',
                'fallback_cb'       => 'wp_bootstrap_navwalker::fallback',
                'walker'            => new wp_bootstrap_navwalker())
            );
        ?>
		</div>
        <?php
        ?>
    </div>
	
</nav><!-- #site-navigation -->
