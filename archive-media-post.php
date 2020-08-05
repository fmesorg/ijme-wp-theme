<?php
    /*
    Template Name: Media Post Archives
    */
    get_header(); ?>
<?php
    global $post;
    $media_post = get_posts(array(
      'posts_per_page' => 10,
      'post_type' => 'media-post'
    ));
?>

<div id="container" class="media-archive-container">
    <div id="content" class="media-archive-card-wrapper">
        <?php
            if ($media_post) {
                foreach ($media_post as $post) :
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
                
                <?php
                endforeach;
                wp_reset_postdata();
            }else{
                ?>
                    <div class="dp-flex">No Post Available for Media..</div>
        <?php    }
        ?>
    </div><!-- #content -->
</div><!-- #container -->

<?php get_footer(); ?>
