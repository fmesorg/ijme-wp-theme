<?php
    /*
     * Template Name: Media Post
     */
?>
<?php
    global $post;
    $media = get_posts(array(
      'posts_per_page' => 3,
      'post_type' => 'media-post',
    ));
?>

<div id="home-media" class="media-wrapper col">
    <div id="blog-section-title" class="dp-flex">
        Media
        <div class="view-all-wrapper"><span class="view-all-text">VIEW ALL</span> <span class="view-all-icon">></span></div>
    </div>
    <div class="media-item-wrapper">
        <?php
            if ($media) {
                foreach ($media as $post) :
                    setup_postdata($post);
                    $authors = get_post_meta(get_the_ID(), 'media_author', true);
                    $media_type = get_post_meta(get_the_ID(), 'media_type', true);
                    $media_link = get_post_meta(get_the_ID(), 'media_link', true);
                    ?>
                    <div class="media-item">
                        <div class="media-type">
                            <?php echo $media_type; ?>
                        </div>
                        <div class="media-title">
                            <a href="<?php echo $media_link; ?>">
                                <?php echo get_the_title(); ?>
                            </a>
                        </div>
                        <div class="media-authors"><?php echo $authors; ?></div>
                    </div>
                <?php endforeach;
                wp_reset_postdata();
            }
        ?>
    </div>
</div>
