<?php
/*
 * Template Name: home left panel template
 */

?>

<?php
    global $post;
    $posts = get_posts(array(
      'numberposts' => -1,
      'post_type' => 'articles',
      'meta_key' => 'is_contemporarily_relevant',
      'meta_value' => '1'
    )); ?>
<div id="current-issue-right-panel-wrapper">
    <div>Advertisement</div>
    <div id="contemporarily-relevant-wrapper">
        <div class="contemporarily-relevant-section-title">Contemporarily Relevant</div>
        <?php
            foreach ($posts as $post):
                setup_postdata($post);
                $authors_list = get_author_list(get_the_ID());
                ?>
                <div class="contemporarily-article-wrapper">
                    <div class="contemporarily-article-name"><?php echo the_title(); ?></div>
                    <div class="contemporarily-article-author">
                        <?php
                            foreach ($authors_list as $author) echo $author;
                        ?>
                    </div>
                </div>
            <?php
            endforeach;
        ?>
    </div>
</div>

