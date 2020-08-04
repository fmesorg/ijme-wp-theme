<?php
/*
 * Template Name: home left panel template
 */

?>

<?php
    $posts = get_posts(array(
      'numberposts' => -1,
      'post_type' => 'articles',
      'meta_key' => 'is_contemporarily_relevant',
      'meta_value' => '1'
    )); ?>
<div id="current-issue-right-panel-wrapper">
    <div class="dp-flex">
        <?php
            $frontpage_id = get_option('page_on_front');
            if (get_field('sidebar_advertisement', $frontpage_id)): ?>
                <img src="<?php the_field('sidebar_advertisement', $frontpage_id); ?>" width="100%"/>
            <?php endif; ?>
    </div>
    <div id="contemporarily-relevant-wrapper">
        <div class="contemporarily-relevant-section-title">Contemporarily Relevant</div>
        <?php
            foreach ($posts as $post):
                setup_postdata($post);
                $authors_list = get_author_list(get_the_ID());
                ?>
                <div class="contemporarily-article-wrapper">
                    <div class="contemporarily-article-name">
                        <a href="<?php the_permalink(); ?>">
                        <?php echo the_title(); ?>
                        </a>
                    </div>
                    <div class="contemporarily-article-author">
                        <?php
                            foreach ($authors_list as $author) echo $author;
                        ?>
                    </div>
                </div>
            <?php
            endforeach;
            wp_reset_postdata();
        ?>
    </div>
</div>

