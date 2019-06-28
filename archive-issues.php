<?php get_header(); ?>

    <div class="container-block">
        <div class="content blocks  ">

            <div class="col-md-9">
                <div class="row">
                    <div class="dropdown">
                        <button class="btn btn-default dropdown-toggle dropdown-width" type="button" id="dropdownMenu1"
                                data-toggle="dropdown" aria-haspopup="true" aria-expanded="true">
                            Select Year
                            <span class="caret"></span>
                        </button>
                        <ul class="dropdown-menu" aria-labelledby="dropdownMenu1">
                            <li><a href="#">Current Year</a></li>
                            <li><a href="#">Last Year</a></li>
                            <li role="separator" class="divider"></li>
                            <li><a href="#">2019</a></li>
                            <li><a href="#">2018</a></li>
                            <li><a href="#">2017</a></li>
                            <li><a href="#">2016</a></li>
                        </ul>
                    </div>
                </div>
                <!--    <div class="clearfix"></div>-->
                <div class="row">
                    <div class="issues-wrapper">
                        <div class="">
                            <div class="row">
                                <div class="issue-box">
                                            <?php
                                            global $post;
                                            $articles = get_posts(array(
                                                'posts_per_page' => 4,
                                                'post_type' => 'issues'
                                            ));

                                            if ($articles) {
                                                foreach ($articles as $post) :
                                                    setup_postdata($post);
                                                    if (has_post_thumbnail()):
                                                        ?>
                                                    <div class="issue">
                                                        <div class="issue-image">
                                                            <a href="<?php the_permalink(); ?>"><?php the_post_thumbnail('medium'); ?></a>
                                                        </div>
                                                        <div class="issue-content">
                                                            <div class="issue-title"><h3 class="home-title-1"><a
                                                                            href="<?php the_permalink(); ?>"><?php echo get_the_title(); ?></a>
                                                                </h3>
                                                            </div>
                                                            <div class="issue-detail"><?php echo wp_trim_words(get_the_excerpt(), 500); ?></div>
                                                        </div>
                                                    </div>
                                                    <?php
                                                    endif;
                                                endforeach;
                                                wp_reset_postdata();

                                            }
                                            ?>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-3">
                <?php get_sidebar(); ?>
            </div>
        </div>
    </div>
<?php get_footer(); ?>

<script>
    jQuery(document).ready( function($) {

        $.ajax({
            type:'POST',
            url: <?php echo admin_url('admin-ajax.php');?>,
            data:{
                selected_year:'2018'
            },
            success: function( data ) {
                alert( 'ajax response success');
            }
        })

    })
</script>
