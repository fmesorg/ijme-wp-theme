<?php get_header(); ?>
<div class="row dp-flex">
    <div class="col-md-9 margin-adjust-5">
        <div class="blocks">
            <h4 class="tocSectionTitle">News</h4>
            <ul class="dp-flex announcement-archive-list">
                <?php
                global $post;
                $articles = get_posts( array(
                    'posts_per_page' => 10,
                    'post_type' => 'articles',
                    'category_name' => 'news'
                ) );

                if ( $articles ) {
                    foreach ( $articles as $post ) :
                        setup_postdata( $post );
                        ?>
                        <li class="announcement-archive-list-item">
                        <?php
                        if(get_field('_external_link')) {
                            $externalLink = get_field('_external_link');
                            ?>
                            <div class="col-md-9 announcement-archive-list-item-title">
                                <a href="<?php echo $externalLink; ?>" target="_blank">
                                    <!--                                    --><?php //the_title(); ?>
                                </a>
                            </div>

                            <div class="col-md-3 announcement-archive-list-item-date">

                                <?php echo get_the_date('d-m-Y' )?>
                            </div>

                            <?php
                        }
                        else {
                            ?>
                            <div class="col-md-9 announcement-archive-list-item-title">
                                <a href="<?php the_permalink(); ?>">
                                    <?php the_title();?>
                                </a>
                            </div>

                            <div class="col-md-3 announcement-archive-list-item-date">
                                <?php echo get_the_date('d-m-Y' )?>
                            </div>
                            </li>
                            <?php
                        }
                    endforeach;
                }
                ?>
            </ul>
        </div>
    </div>
    <div class="col-md-3 blocks margin-r-10">
        <?php get_sidebar(); ?>
    </div>
</div>