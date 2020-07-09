<?php
    /*
     * Template Name: home left panel template
     */

?>

<div id="online-first-panel-wrapper">
    <div class="dp-flex justify-content-between align-items-baseline">
        <div id="online-first-section-title">Online First</div>
        <div id="online-first-view-all">VIEW ALL <span style="color: #E01F1F!important;">></span></div>
    </div>
    
    
    <?php
        global $post;
        $articles = get_posts(array(
          'posts_per_page' => 4,
          'post_type' => 'articles',
          'category' => 3
        ));
        
        if ($articles) {
            foreach ($articles as $post) :
                setup_postdata($post); ?>

                <div class="onlineFirst-article-wrapper dp-flex flex-column">
                    <div class="online-first-date">
                        <?php echo date('F d, Y', strtotime($post->post_date)); ?>
                        <?php
                            $new_post = get_post_meta($post->ID, 'show_new_button', true);
                            if ($new_post == 1) {
                                ?>
                                <img src="<?php echo get_template_directory_uri(); ?>/images/tag-new-icon.jpg"/>
                            <?php } ?>
                    </div>
                    <div class="online-first-article-title">
                        <a href="<?php the_permalink(); ?>">
                            <?php echo wp_trim_words(get_the_title(), 8); ?></a>
                    </div>
                    <div class="online-first-article-abstract">
                        <?php echo wp_trim_words(get_the_excerpt(), 40); ?>
                    </div>
                    <div class="online-first-article-author">
                        <?php
                            $authors = get_post_meta(get_the_ID(), 'authors', true);
                            $out = array();
                            foreach ($authors as $key => $author) {
                                $authStr = $author['first_name'] . ' ' . $author['middle_name'] . ' ' . $author['last_name'];
                                array_push($out, $authStr);
                            }
                            echo implode(', ', $out);
                        ?>
                    </div>
                </div>
            
            <?php endforeach;
        } ?>

</div>
