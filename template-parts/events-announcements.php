<div class="events-announcements-body">
    <div class="media-coverage">
        <ul class="announcement-event-list">
            <?php
            global $post;
            $articles = get_posts( array(
                'posts_per_page' => 5,
                'post_type' => 'announcements'
            ) );

            if ( $articles ) {
                foreach ( $articles as $post ) :
                    setup_postdata( $post );
                    ?>
                    <li class="announcement-list-item">
                    <?php
                    if(get_field('_external_link')) {
                        $externalLink = get_field('_external_link');
                        ?>
                        <a href="<?php echo $externalLink; ?>" target="_blank">
                            <?php the_title(); ?>
                        </a>
                        <span class="announcement-tag">  <?php echo get_the_date('F d, Y' )?></span>
                        <?php
                    }
                    else {
                        ?>
                        <a href="<?php the_permalink(); ?>">
                            <?php the_title();?>
                            <span class="announcement-tag">  <?php echo get_the_date('F d, Y' )?></span>
                        </a>
                        </li>
                        <?php
                    }
                endforeach;
            }
            ?>
        </ul>
    </div>
</div>