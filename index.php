<?php get_header(); ?>

<div class="row">
            <?php
            if ( have_posts() ) {
                while ( have_posts() ) {
                    the_post();
                    /*
                    if(is_search()) {
                        get_template_part( 'search' );
                        break;
                    }
                    */
                    if(is_front_page()) {
                        get_template_part( 'home' );
                        break;
                    }
    
                    ?>
                    <div id="page-content-wrapper">
                        <?php if (get_post_type() == 'page') the_content(); ?>
        
                        <?php if (get_post_type() == 'post') { ?>
                            <div class="post-title"><?php the_title(); ?> </div>
                            <div class="post-date">Date of Publication: <?php echo get_the_date('Y-m-d'); ?> </div>
                            <div class="post-content"><?php the_content(); ?> </div>
                            <?php
                        } ?>
                    </div>
                    <?php
                }
            } // end if
            ?>
        </div>

<?php get_footer(); ?>
