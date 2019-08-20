<?php get_header(); ?>

<div class="blog-page-container background-white">
    <div class="jumbotron overlay-dark">
        <div class="blog-title">
            <h2><?php the_title(); ?></h2>
            <p class="minor-heading">Blog Description will be displayed here</p>
            <p class="published-date"><?php
                echo date("F j, Y",strtotime($post->post_date)); ?></p>
        </div>
    </div>
    <div class="container blog-main-container">
        <div class="blog-container">
            <div class="blog-content">
                <?php echo $post->post_content;?>
<!--                --><?php // var_dump($post);?>
            </div>

        </div>
    </div>
</div>

<?php get_footer();?>