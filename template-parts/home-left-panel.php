<?php
    /*
     * Template Name: home left panel template
     */
?>

<div id="current-issue-left-panel-wrapper">
    <div class="current-issue-section-title">CURRENT ISSUE</div>
    <?php
        $articles = get_posts(array(
          'posts_per_page' => 1,
          'post_type' => 'issues'
        ));
        
        $current_issue_post = $articles[0];
        setup_postdata($current_issue_post);
        
        $current_issue_id = $id;
        $articles_id = get_post_meta($id, 'articles', true);//articles in the current issue
        
        $category_array = array();
        foreach ($articles_id as $id) {
            $t_post = get_post($id);
            $category = get_the_category($t_post->ID);
            if ($category) {
                if (!isset($category_array[$category[0]->cat_name]))
                    $category_array[$category[0]->cat_name] = array();
                
                $category_array[$category[0]->cat_name][] = $t_post;
            }
        }
        
        
        if ($articles) {
            foreach ($articles as $post) :
                setup_postdata($post);
                if (has_post_thumbnail()):
                    ?>
                    <div style="display: flex; flex-direction: column" id="current-issue-container">
                        <div>
                            <p class="current-issue-title"><a
                                        href="<?php the_permalink(); ?>"><?php echo wp_trim_words(get_the_title(), 5); ?></a>
                            </p>
                        </div>
                        <div class="dp-flex pb-3 section-bottom-border">
                            <div class="current-issue-image-cover">
                                <a href="<?php the_permalink(); ?>"><?php the_post_thumbnail('thumbnail'); ?></a>
                            </div>
                            <div id="issue-description">
                                <?php echo wp_trim_words(get_the_excerpt(), 25); ?>
                            </div>
                        </div>
                    </div>
                <?php
                endif;
            endforeach;
            wp_reset_postdata();
            
            foreach ($category_array as $category => $posts) {?>
                
                <div>
                <div class="current-issue-category"><?php echo $category; ?></div>
                <?php foreach ($posts as $post) {
                    setup_postdata($post);
                    $authors = get_post_meta(get_the_ID(), 'authors', true);
                    if(!empty($authors)) {
                        $authors_array = array();
                        foreach ($authors as $author) $authors_array[] = $author['last_name'] .' '. $author['middle_name']. ' ' . $author['first_name'];}
                    ?>
                 <div class="current-issue-article-title"><?php echo  get_the_title(); ?> </div>
                 <div class="current-issue-article-author"><?php
                        foreach ($authors_array as $author) echo $author;
                     ?></div>
                <?php } ?>
                </div>
            <?php }
        }
    ?>


</div>
