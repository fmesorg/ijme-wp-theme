<?php
    /*
     * Template Name: home left panel template
     */

?>

<div id="online-first-panel-wrapper">
    <div class="online-first-section-wrapper">
        <div id="online-first-section-title">Online First</div>
        <div id="online-first-view-all">
            <a href="/issues/online-first">
            VIEW ALL <span style="color: #E01F1F!important;">></span>
            </a>
        </div>
    </div>


    <?php
        global $post;
        $articles = get_posts(array(
          'posts_per_page' => 7,
          'post_type' => 'articles',
          'category' => 3
        ));


        if ($articles) {
            foreach ($articles as $post) :
                setup_postdata($post); ?>
                <div class="onlineFirst-article-wrapper dp-flex flex-column">
                    <div class="issue-article-date">
                        <?php
                        $postId = get_post_meta(get_the_ID(), 'articles', true);
                        $article_category = get_the_category($postId);
                        if(count($article_category)>1 && $article_category[0]->name =='Research Articles'){
                            $catname=$article_category[1]->name;
                        }else{
                            $catname = $article_category[0]->name;
                        }
                        echo $catname.": ".date('F d, Y', strtotime($post->post_date)); ?>
                        <?php
                            $new_post = get_post_meta($post->ID, 'show_new_button', true);
                            if ($new_post == 1) {
                                ?>
                                <img src="<?php echo get_template_directory_uri(); ?>/images/tag-new-icon.jpg"/>
                            <?php } ?>
                    </div>
                    <div class="online-first-article-title">
                        <a href="<?php the_permalink(); ?>">
                            <?php echo get_the_title(); ?></a>
                    </div>
                    <div class="online-first-article-abstract">
<!--                        --><?php //echo wp_trim_words(get_the_excerpt(), 40); ?>
                        <em> <?php echo mb_strimwidth(get_the_excerpt(),0,300,'...'); ?></em>
                    </div>
                    <div class="online-first-article-author">
                        <?php
                            $authors_list = get_author_list(get_the_ID());
                            echo implode(', ', $authors_list);
                        ?>
                    </div>
                </div>

            <?php endforeach;
        } ?>

</div>
