<?php
    /*
     * Template Name: advertisement widget
     */
?>

<div id="horizontal-advertisement-bar" class="col  dp-flex justify-content-center" >
    <?php
        $frontpage_id = get_option('page_on_front');
        if (get_field('advertisement_bar', $frontpage_id)):
            ?>
        <a href="<?php the_field('advertisement_bar_link',$frontpage_id); ?>" target="_blank" style="width: inherit">
            <img src="<?php the_field('advertisement_bar',$frontpage_id); ?>" width="100%"/>
        </a>
    <?php endif; ?>
</div>
