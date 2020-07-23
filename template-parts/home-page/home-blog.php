<?php
    /*
     * Template Name: Blogs
     */
?>

<?php
    global $post;
    $blogs = get_posts(array(
      'posts_per_page' => 3,
      'post_type' => 'blog',
    ));
?>

<div id="blog" class="blog-wrapper col">
    <div id="blog-section-title" class="dp-flex">
        Blog
        <div class="view-all-wrapper"><span class="view-all-text">VIEW ALL</span> <span class="view-all-icon">></span></div>
    </div>
    <div class="blog-item-wrapper">
        <?php
            if ($blogs) {
                foreach ($blogs as $post) :
                    setup_postdata($post); ?>
                    <div class="blog-item">
                        <div class="blog-description">
                            <?php echo get_the_title(); ?>
                        </div>
                        <div class="blog-item-details">
<!--       Author hidden as not required by FMES Team  <span class="blog-item-author">The Hindu</span>-->
                            <span class="blog-item-date"><?php echo date("F j, Y", strtotime($post->post_date)); ?></span>
                        </div>
                    </div>
                <?php endforeach;
                wp_reset_postdata();
    
            }
        ?>
    </div>

</div>
