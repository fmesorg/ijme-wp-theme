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
                   
                    <?php
						if(get_field('external_link')) {
							$externalLink = get_field('external_link');
							header("Location:$externalLink");
						}
					else {
					?>
					
                    <div id="content">
					<!---new head start--->
						<?php if(get_the_ID() == '16667' ){ ?>
							<div class="shortheading-pdflink">
								<div class="heading">
									<h3><?php the_title(); ?></h3>
								</div>
								<div class="share-pdflink">
									<a  href="<?php echo site_url(); ?>/wp-content/uploads/2017/08/14-wcb-1-announcement.pdf" target="_blank" title = "Download PDF" > <img src="<?php echo THEME_URL; ?>/images/download-pdf.png" width="95" height="16" border="0" alt="Bookmark and Share" style="border:0;padding:0" > </a>
									<a href="http://www.addthis.com/bookmark.php" onmouseover="return addthis_open(this, '', '<?php echo $addExtraString; ?>?@ijme.in', '<?php echo get_the_title(); ?>')" onmouseout="addthis_close()" onclick="return addthis_sendto()"> <img src="https://s7.addthis.com/static/btn/lg-share-en.gif" width="125" height="16" border="0" alt="Bookmark and Share" style="border:0;padding:0"> </a>
									<script type="text/javascript" src="https://s7.addthis.com/js/200/addthis_widget.js"></script>
								</div>
							</div>
						<?php }else if(get_the_ID() == '16974' ){ ?>
							<div class="shortheading-pdflink">
								<div class="heading">
									<h3><?php the_title(); ?></h3>
								</div>
								<div class="share-pdflink">
									<a  href="<?php echo site_url(); ?>/wp-content/uploads/2018/01/14th-world-congress-of-bioethics-notice-for-change-of-venue.pdf" target="_blank" title = "Download PDF" > <img src="<?php echo THEME_URL; ?>/images/download-pdf.png" width="95" height="16" border="0" alt="Bookmark and Share" style="border:0;padding:0" > </a>
									<a href="http://www.addthis.com/bookmark.php" onmouseover="return addthis_open(this, '', '<?php echo $addExtraString; ?>?@ijme.in', '<?php echo get_the_title(); ?>')" onmouseout="addthis_close()" onclick="return addthis_sendto()"> <img src="https://s7.addthis.com/static/btn/lg-share-en.gif" width="125" height="16" border="0" alt="Bookmark and Share" style="border:0;padding:0"> </a>
									<script type="text/javascript" src="https://s7.addthis.com/js/200/addthis_widget.js"></script>
								</div>
							</div>
                        <?php }else if(get_the_ID() == '17807' ){ ?>
                            <div class="shortheading-pdflink">
                                <div class="heading">
                                    <h3><?php the_title(); ?></h3>
                                </div>
                                <div class="share-pdflink">
                                    <a  href="<?php echo site_url(); ?>/wp-content/uploads/2019/02/public-engagement-meeting-program-schedule-flyer.pdf" target="_blank" title = "Download PDF" > <img src="<?php echo THEME_URL; ?>/images/download-pdf.png" width="95" height="16" border="0" alt="Bookmark and Share" style="border:0;padding:0" > </a>
                                    <a href="http://www.addthis.com/bookmark.php" onmouseover="return addthis_open(this, '', '<?php echo $addExtraString; ?>?@ijme.in', '<?php echo get_the_title(); ?>')" onmouseout="addthis_close()" onclick="return addthis_sendto()"> <img src="https://s7.addthis.com/static/btn/lg-share-en.gif" width="125" height="16" border="0" alt="Bookmark and Share" style="border:0;padding:0"> </a>
                                    <script type="text/javascript" src="https://s7.addthis.com/js/200/addthis_widget.js"></script>
                                </div>
                            </div>
                        <?php }else if(get_the_ID() == '17284' ){ ?>
                            <div class="shortheading-pdflink">
                                <div class="heading">
                                    <h3><?php the_title(); ?></h3>
                                </div>
                                <div class="share-pdflink">
                                    <a  href="<?php echo site_url(); ?>/wp-content/uploads/2018/07/bioethics-centre-of-FMES-advertise-for-three-full-time-positions.pdf" target="_blank" title = "Download PDF" > <img src="<?php echo THEME_URL; ?>/images/download-pdf.png" width="95" height="16" border="0" alt="Bookmark and Share" style="border:0;padding:0" > </a>
                                    <a href="http://www.addthis.com/bookmark.php" onmouseover="return addthis_open(this, '', '<?php echo $addExtraString; ?>?@ijme.in', '<?php echo get_the_title(); ?>')" onmouseout="addthis_close()" onclick="return addthis_sendto()"> <img src="https://s7.addthis.com/static/btn/lg-share-en.gif" width="125" height="16" border="0" alt="Bookmark and Share" style="border:0;padding:0"> </a>
                                    <script type="text/javascript" src="https://s7.addthis.com/js/200/addthis_widget.js"></script>
                                </div>
                            </div>
                        <?php }else if(get_the_ID() == '17460' ){ ?>
                            <div class="shortheading-pdflink">
                                <div class="heading">
                                    <h3><?php the_title(); ?></h3>
                                </div>
                                <div class="share-pdflink">
                                    <a  href="<?php echo site_url(); ?>/wp-content/uploads/2018/10/two-openings-at-fmes-ijme.pdf" target="_blank" title = "Download PDF" > <img src="<?php echo THEME_URL; ?>/images/download-pdf.png" width="95" height="16" border="0" alt="Bookmark and Share" style="border:0;padding:0" > </a>
                                    <a href="http://www.addthis.com/bookmark.php" onmouseover="return addthis_open(this, '', '<?php echo $addExtraString; ?>?@ijme.in', '<?php echo get_the_title(); ?>')" onmouseout="addthis_close()" onclick="return addthis_sendto()"> <img src="https://s7.addthis.com/static/btn/lg-share-en.gif" width="125" height="16" border="0" alt="Bookmark and Share" style="border:0;padding:0"> </a>
                                    <script type="text/javascript" src="https://s7.addthis.com/js/200/addthis_widget.js"></script>
                                </div>
                            </div>
                        <?php }else if(get_the_ID() == '17708' ){ ?>
                            <div class="shortheading-pdflink">
                                <div class="heading">
                                    <h3><?php the_title(); ?></h3>
                                </div>
                                <div class="share-pdflink">
                                    <a  href="<?php echo site_url(); ?>/wp-content/uploads/2019/01/dr-richard-ash-grandround-invitation.pdf" target="_blank" title = "Download PDF" > <img src="<?php echo THEME_URL; ?>/images/download-pdf.png" width="95" height="16" border="0" alt="Bookmark and Share" style="border:0;padding:0" > </a>
                                    <a href="http://www.addthis.com/bookmark.php" onmouseover="return addthis_open(this, '', '<?php echo $addExtraString; ?>?@ijme.in', '<?php echo get_the_title(); ?>')" onmouseout="addthis_close()" onclick="return addthis_sendto()"> <img src="https://s7.addthis.com/static/btn/lg-share-en.gif" width="125" height="16" border="0" alt="Bookmark and Share" style="border:0;padding:0"> </a>
                                    <script type="text/javascript" src="https://s7.addthis.com/js/200/addthis_widget.js"></script>
                                </div>
                            </div>
                        <?php }else if(get_the_ID() == '17796' ){ ?>
                            <div class="shortheading-pdflink">
                                <div class="heading">
                                    <h3><?php the_title(); ?></h3>
                                </div>
                                <div class="share-pdflink">
                                    <a  href="<?php echo site_url(); ?>/wp-content/uploads/2019/02/fmes-essay-competition.pdf" target="_blank" title = "Download PDF" > <img src="<?php echo THEME_URL; ?>/images/download-pdf.png" width="95" height="16" border="0" alt="Bookmark and Share" style="border:0;padding:0" > </a>
                                    <a href="http://www.addthis.com/bookmark.php" onmouseover="return addthis_open(this, '', '<?php echo $addExtraString; ?>?@ijme.in', '<?php echo get_the_title(); ?>')" onmouseout="addthis_close()" onclick="return addthis_sendto()"> <img src="https://s7.addthis.com/static/btn/lg-share-en.gif" width="125" height="16" border="0" alt="Bookmark and Share" style="border:0;padding:0"> </a>
                                    <script type="text/javascript" src="https://s7.addthis.com/js/200/addthis_widget.js"></script>
                                </div>
                            </div>
                        <?php }else if( get_the_ID() == '16832'){ ?>
							<div class="shortheading-pdflink">
								<div class="heading">
									<h3><?php the_title(); ?></h3>
								</div>
								<div class="share-pdflink">
									<a  href="<?php echo site_url(); ?>/wp-content/uploads/2017/10/aadhar-statement.pdf" target="_blank" title = "Download PDF" > <img src="<?php echo THEME_URL; ?>/images/download-pdf.png" width="95" height="16" border="0" alt="Bookmark and Share" style="border:0;padding:0" > </a>
									<a href="http://www.addthis.com/bookmark.php" onmouseover="return addthis_open(this, '', '<?php echo $addExtraString; ?>?@ijme.in', '<?php echo get_the_title(); ?>')" onmouseout="addthis_close()" onclick="return addthis_sendto()"> <img src="https://s7.addthis.com/static/btn/lg-share-en.gif" width="125" height="16" border="0" alt="Bookmark and Share" style="border:0;padding:0"> </a>
									<script type="text/javascript" src="https://s7.addthis.com/js/200/addthis_widget.js"></script>
								</div>
							</div>
							
						<?php }else { ?>				
							<h3><?php the_title(); ?></h3>
						<?php } ?>
                            <?php the_content();?>
                    </div><!--content-->
					<?php } ?>
					
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
        
