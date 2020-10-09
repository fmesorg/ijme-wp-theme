<?php
/*
 * Template Name: home right panel template
 */

?>

<?php
    $announcements = get_posts(array(
      'numberposts' => -1,
      'post_type' => 'announcements',
      'posts_per_page' => 5,

    )); ?>
<div id="current-issue-right-panel-wrapper">
    <div class="dp-flex">
        <?php
            $frontpage_id = get_option('page_on_front');
            if (get_field('sidebar_advertisement', $frontpage_id)): ?>
                <a href="<?php the_field('sidebar_advertisement_link',$frontpage_id); ?>" target="_blank" style="width: inherit">
                    <img src="<?php the_field('sidebar_advertisement', $frontpage_id); ?>" width="100%"/>
                </a>
            <?php endif; ?>
    </div>
    <?php
        if ($announcements){
    ?>
    <div id="contemporarily-relevant-wrapper">
        <div class="contemporarily-relevant-section-title">Announcements</div>
        <?php
            foreach ($announcements as $post):
                setup_postdata($post);
                ?>
                <div class="contemporarily-article-wrapper">
                    <div class="contemporarily-article-name">
                        <a href="<?php if (get_field('_external_link')) {echo get_field('_external_link');}else{the_permalink();} ?>">
                        <?php echo the_title(); ?>
                        </a>
                    </div>
                    <div class="contemporarily-article-author">
                        <?php
                        echo get_the_date('F d, Y' );
                        ?>
                    </div>
                </div>
            <?php
            endforeach;
            wp_reset_postdata();
        ?>
    </div>
</div>
<?php } ?>
