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
                        <ul class="dropdown-menu" id="year-dropdown" aria-labelledby="dropdownMenu1">
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
                                <div class="issue-box" id="issue-box">
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


<script type="text/javascript">
    jQuery(function($) {

        $('#year-dropdown li').on('click', function(e) {
            e.preventDefault();
            let selected_year = $(this).text();

            let ajaxUrl = '<?php echo admin_url( 'admin-ajax.php' );?>';
            $.ajax({
                type:"POST",
                url: ajaxUrl,
                data: {
                    action: "display_year_issues",
                    selected_year: selected_year
                },
                success:function(data){
                    removeOldData();
                    console.log(data);
                    jQuery("#issue-box").html(data);
                },
                error: function(errorThrown){
                    alert(errorThrown);
                }
            });

        })

    });
    
    function removeOldData() {
        jQuery(".issue").remove();
    }
</script>