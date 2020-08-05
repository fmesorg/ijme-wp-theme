<?php
    /*
     * Template Name: advertisement widget
     */
?>

<div id="horizontal-advertisement-bar" class="col  dp-flex justify-content-center" style="flex:1; padding:40px" >
    <?php if( get_field('advertisement_bar',16406) ): ?>
        <a href="<?php the_field('advertisement_bar_link'); ?>" target="_blank" style="width: inherit">
            <img src="<?php the_field('advertisement_bar'); ?>" width="100%"/>
        </a>
    <?php endif; ?>
</div>
