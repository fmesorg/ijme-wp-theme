<?php get_header(); ?>

<div class="row dp-flex">
    <div class="col-md-9 blocks  margin-lr-10 margin-r-5">
        <div id="search-main">
            <h4>Search</h4>
            <div id="content">
                <?php get_template_part('advance-search-form'); ?>
                <?php
                if ( have_posts() ) {
                    get_template_part('search-results');
                }
                else {
                    ?>
                    <h3>No Results found</h3>
                    <?php
                }
                ?>

            </div>
        </div>
    </div>
	<div class="clearfix visible-xs visible-sm"></div>

</div>


<?php get_footer(); ?>
