<?php
ob_start();
?>

<?php get_header(); ?>

<div class="row">
    <div class="col-md-9">
	
        <?php 
        if ( have_posts() ) {
            while ( have_posts() ) {
                the_post();
                
                $issue_id = get_post_meta(get_the_ID(),'issue_post_id',true);
                $volume = get_post_meta($issue_id,'volume',true);
                ?>
                <div id="main">
				
                    <div id="breadcrumb">
                        <a href="<?php echo site_url(); ?>" target="_parent">Home</a> 
						&gt; <a href="<?php echo get_permalink($issue_id); ?>" target="_parent"> Announcements </a>&gt; <a href="<?php echo get_permalink($issue_id); ?>" target="_parent"><?php the_title(); ?></a>
                    </div>
<div style="padding-bottom:15px"></div>
                   
                    <div id="content">
                        <h3><?php the_title(); ?></h3>
                            <?php the_content();?>
                    </div><!--content-->
					
                </div><!--main-->
                
                <div class="clearfix"></div>
                <?php                
                comments_template();
                
            } // end while
        } // end if
        ?>        
    </div>
    <div class="clearfix visible-xs visible-sm"></div>
	<div class="col-md-3">
        <?php get_sidebar(); ?>
    </div>
</div>


<?php get_footer(); 
ob_end_flush();
?>
        
