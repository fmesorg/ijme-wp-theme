<?php 
if ( have_posts() ) {
    while ( have_posts() ) {
        the_post();
        ?>
        <h2>
            <?php echo get_bloginfo ('name'); ?>
            <?php
            $volume = get_post_meta(get_the_ID(),'volume', true);
            $number = get_post_meta(get_the_ID(),'number', true);
            $year = get_post_meta(get_the_ID(),'year', true);
            ?>
            <?php if($volume || $number || $year) { ?> ,&nbsp; <?php } ?>
            <?php if($volume) { ?>Vol <?php echo $volume; ?>,<?php } ?>
            <?php if($number) { ?>No <?php echo $number; ?> <?php } ?>
            <?php if($year) { ?>(<?php echo $year; ?>) <?php } ?>
        </h2>
        <?php
        the_content();
        ?>
        <script type="text/javascript">
            window.print();
        </script>
        <?php
    }
}
else {
    ?>
    Unknown article
    <?php
}