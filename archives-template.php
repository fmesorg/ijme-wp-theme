<?php
/*
Template Name: Archives Template
*/
?>	
<?php get_header(); ?>
<div class="row">
    <div class="col-md-9">
	
<div id="main">

<div id="content">

    <div>
	<?php if (have_posts()) : while (have_posts()) : the_post(); ?>
		<?php the_content(); ?>
	<?php endwhile; endif; ?>
	</div>
</div>
</div>
</div>
<div class="clearfix visible-xs visible-sm"></div>
<div class="col-md-3">
        <?php get_sidebar(); ?>
    </div>
</div>
<?php get_footer(); ?>