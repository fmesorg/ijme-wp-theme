<?php
/**
 * The template for displaying 404 pages (Not Found).
 *
 * @package WordPress
 */
get_header();
?>
<!--Start Content Wrapper-->


<div class="row">
    <div class="col-md-9">
        <div id="main" class="last-2">
            <div id="content">
                <h3>It seems we can’t find what you’re looking for.</h3>
                
                <div class="table-responsive">
                    <p>&nbsp;</p>
                    <p>Oops! We can't find the page you are looking for. This might be because of the following reasons:</p>
					<p>- We have recently migrated our servers </p>
					<p>- The URL you have typed might be incorrect. We regret the inconvenience caused to you. Please visit our <a href="<?php bloginfo('url'); ?>">Home Page.</a></p>
                </div>
                
            </div>
        </div>
    </div>
    <div class="clearfix visible-xs"></div>
	<div class="col-md-3">
        <?php get_sidebar(); ?>
    </div>
</div>



<!--End Content Wrapper-->
<?php get_footer(); ?>