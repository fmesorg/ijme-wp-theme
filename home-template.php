<?php
/*
 * Template Name: Home Template
 */
get_header(); ?>

    <div class="main-container">
        <div class="row justify-content-center home-about-wrapper px-2 py-2">

        </div>
        <div class="row no-gutters">
            <div class="col-md-3 col-sm-12 dp-flex left-panel-wrapper">
                <?php get_template_part('template-parts/home-page/home-left-panel'); ?>
            </div>
            <div class="col-md-6 col-sm-12 dp-flex center-panel-wrapper">
                <?php get_template_part('template-parts/home-page/home-onlinefirst-center-panel'); ?>
            </div>
            <div class="col-md-3 col-sm-12 dp-flex right-panel-wrapper">
                <?php get_template_part('template-parts/home-page/home-right-panel'); ?>
            </div>
        </div>
        <div class="row" style="width: 100%;">
            <?php get_template_part('template-parts/home-page/horizontal-advertisement'); ?>
        </div>
<!--        <div class="row mobile-margin-adjustment">-->
<!--            --><?php //get_template_part('template-parts/home-page/mostread-bytopic'); ?>
<!--        </div>-->
        <div class="row">
            <?php get_template_part('template-parts/home-page/subscribe-box'); ?>
        </div>
        <div class="row mobile-margin-adjustment">
            <?php get_template_part('template-parts/home-page/mostread-bycategory'); ?>
        </div>
        <div class="row mobile-margin-adjustment" style="width: 100%;">
            <?php get_template_part('template-parts/home-page/home-blog'); ?>
        </div>

        <div class="row mobile-margin-adjustment" style="width: 100%;">
            <?php get_template_part('template-parts/home-page/home-media'); ?>
        </div>

<!--        <div class="row">-->
<!--            --><?php //get_template_part('template-parts/home-page/mostread-flick'); ?>
<!--        </div>-->

    </div>
<?php get_footer(); ?>
