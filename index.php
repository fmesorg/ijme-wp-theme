<?php get_header(); ?>

<div class="row">
    <div class="dp-flex margin-lr-10">
        <div class="col-md-9 blocks margin-r-5">
            <?php
            if ( have_posts() ) {
                while ( have_posts() ) {
                    the_post();

                    /*
                    if(is_search()) {
                        get_template_part( 'search' );
                        break;
                    }
                    */
                    if(is_front_page()) {
                        get_template_part( 'home' );
                        break;
                    }
                    ?>
                    <?php if(!(get_post_type() == 'articles' && isset($_GET['galley']) && $_GET['galley'] == 'html')) { ?>

                            <div id="breadcrumb">
                                <!--a href="<?php //echo site_url(); ?>" class="current" target="_parent">Home</a-->
                                <?php $uri = $_SERVER['REQUEST_URI'];
                                 ?>
                            </div>

                    <?php } ?>

                    <div id="content">
                        <?php if (get_post_type() == 'articles') {

                            if(isset($_GET['galley']) && $_GET['galley'] == 'pdf') {
                                $pdf_file = get_post_meta(get_the_ID(),'pdf_file',true);
                                if( $pdf_file ) {
                                ?>
                                <div id="pdf-wrap"></div>
                                <script>PDFObject.embed('<?php echo $pdf_file; ?>', "#pdf-wrap");</script>
                                <?php
                                }
                            }
                        }
                        ?>

                        <?php if(get_post_type() == 'page') the_content(); ?>
                    </div>
                    <?php


            } // end if
            ?>
        </div>
        <div class="col-md-3 blocks">
            <?php get_sidebar(); ?>
        </div>
    </div>
</div>


<?php get_footer(); ?>
