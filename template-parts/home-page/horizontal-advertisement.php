<?php
    /*
     * Template Name: advertisement widget
     */
?>

<div id="horizontal-advertisement-bar" class="col  dp-flex justify-content-center" style="flex:1; padding:40px" >
    <?php if( get_field('advertisement_bar',16406) ): ?>
    <img src="<?php the_field('advertisement_bar'); ?>" width="100%" />
    <?php endif; ?>
</div>
