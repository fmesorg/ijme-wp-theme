<?php
    get_header();
?>

<div class="row dp-flex">
    <div class="col-md-9 blocks  margin-lr-10 margin-r-5">
        <div id="search-main">
            <div id="online-first-section-title">Category: <?php single_cat_title('', true); ?></div>


            <?php
            $categoryName = single_cat_title('', false);
            global $post;
            $articles = get_posts(array(
                'posts_per_page' => 20,
                'post_type' => 'articles',
                'category_name' => $categoryName
            ));

            if ($articles) {
                foreach ($articles as $post) :
                    setup_postdata($post);
        ?>
                    <div class="onlineFirst-article-wrapper dp-flex flex-column">
                        <div class="issue-article-date">
                            <?php echo date('F d, Y', strtotime($post->post_date)); ?>
                        </div>
                        <div class="online-first-article-title">
                            <a href="<?php the_permalink(); ?>">
                                <?php echo wp_trim_words(get_the_title(), 8); ?></a>
                        </div>
                        <div class="online-first-article-abstract">
                            <!--                        --><?php //echo wp_trim_words(get_the_excerpt(), 40);
                            ?>
                            <?php echo mb_strimwidth(get_the_excerpt(), 0, 300, '...'); ?>
                        </div>
                        <div class="online-first-article-author">
                            <?php
                            $authors_list = get_author_list(get_the_ID());
                            echo implode(', ', $authors_list);
                            ?>
                        </div>
                    </div>
                <?php
                endforeach;
                wpbeginner_numeric_posts_nav();

            } else {
                ?>
                <div class="col-sm-12">
                    <p>No posts founds</p>
                </div>
                <?php
            }
            ?>

        </div>
    </div>
</div>

<?php get_footer(); ?>
