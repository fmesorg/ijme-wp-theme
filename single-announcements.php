<?php
ob_start();
?>

<?php get_header(); ?>

<div class="row dp-flex">
    <div class="col-md-9 blocks margin-lr-10">

        <?php
        if ( have_posts() ) {
            while ( have_posts() ) {
                the_post();

                $issue_id = get_post_meta(get_the_ID(),'issue_post_id',true);
                $volume = get_post_meta($issue_id,'volume',true);
                ?>
                <div id="main">

					<div style="padding-bottom:15px"></div>

                    <?php
						if(get_field('external_link')) {
							$externalLink = get_field('external_link');
							header("Location:$externalLink");
						}
					else {
					?>

                        <div id="page-content-wrapper">
					<!---new head start--->
                            <div class="page-title-text">
                                <?php the_title(); ?>
                            </div>
                            <div class="page-content-text-style">
                            <?php the_content();?>
                            </div>
                        </div>
					<?php } ?>

                </div><!--main-->

                <div class="clearfix"></div>
                <?php
            } // end while
        } // end if
        ?>
    </div>
    <div class="clearfix visible-xs visible-sm"></div>

</div>


<?php get_footer();
ob_end_flush();
?>

