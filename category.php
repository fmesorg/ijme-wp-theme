<?php
    get_header();
    echo "Category Article";
?>
<h1 class="archive-title">Category: <?php single_cat_title('', true); ?></h1>

<?php
    if (have_posts()) {
        while (have_posts()) {
            the_post();
            the_title();
        }
    } else {
        ?>
        <div class="col-sm-12">
            <p>No posts found</p>
        </div>
        <?php
    }
?>

<?php get_footer(); ?>
