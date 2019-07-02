<?php
if(isset($_GET['galley']) && $_GET['galley'] == 'print') {
    get_template_part( 'article', 'print' );
    return;
}
elseif(isset($_GET['galley']) && $_GET['galley'] == 'index') {
    get_template_part( 'article', 'index' );
    return;
}
elseif(isset($_GET['galley']) && $_GET['galley'] == 'citations') {
    get_template_part( 'article', 'citations' );
    return;
}
elseif(isset($_GET['galley']) && $_GET['galley'] == 'references') {
    get_template_part( 'article', 'find-references' );
    return;
}
elseif(isset($_GET['galley']) && $_GET['galley'] == 'mail') {
    get_template_part( 'article', 'mail' );
    return;
}
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
				<?php if( get_the_ID() =='2177'){ ?>
				
					<div id="breadcrumb">
					 <a href="<?php echo site_url(); ?>" >Home</a> &gt; 
					 <a href="javascript:void(0)">About us</a> &gt; 
					 <a href="javascript:void(0)">FMES</a> &gt; 
					 <a href="javascript:void(0)">FMES Brochure</a>
					</div>
					
				<?php }elseif( get_the_ID() =='2176' || get_the_ID() =='16745' || get_the_ID()== '17727'){ ?>
					<div id="breadcrumb">
					 <a href="<?php echo site_url(); ?>" >Home</a> &gt; 
					 <a href="javascript:void(0)">About us</a> &gt; 
					 <a href="javascript:void(0)">FMES</a> &gt; 
					 <a href="javascript:void(0)">Annual Report</a>
					</div>
				<?php }else{ ?>
				
					<div id="breadcrumb">
                        <a href="<?php echo site_url(); ?>" target="_parent">Home</a> 
                        <?php if($volume) { ?>
                        &gt;<a href="<?php echo get_permalink($issue_id); ?>" target="_parent"> Vol <?php echo get_post_meta($issue_id,'volume',true); ?>, No <?php echo get_post_meta($issue_id,'number',true); ?>  (<?php echo get_post_meta($issue_id,'year',true); ?>)</a> 
                        <?php } elseif(get_post_type() == 'articles'){ 
						$categories = get_the_category();
						if ( ! empty( $categories ) ) {
							$cat= esc_html( $categories[0]->name );  
							if($cat=="Opportunities" ){ ?>
							&gt; <a href="<?php echo site_url(); ?>/issues/opportunities/">Opportunities</a>
								
							<?php }					
						} else{
						?> 
						&gt; <a href="<?php echo site_url(); ?>/issues/online-first/">Online First</a>
						<?php 
							}
						}	?>
						
						<?php $authors = get_post_meta(get_the_ID(), 'authors', true); ?>
							&gt; <a href="<?php echo get_permalink(); ?>"><?php echo $authors[0]['last_name'] ?></a>
						<?php  ?>
                        
                    </div>

				<?php } ?>

                    <div id="content">
                        <div class="addthis_container">

                            <!-- Go to www.addthis.com/dashboard to customize your tools -->
                            <div class="addthis_inline_share_toolbox"></div>

                        </div>
                        <?php
                        if(isset($_GET['galley']) && $_GET['galley'] == 'pdf') {
                            $pdf_file = get_post_meta(get_the_ID(),'pdf_file',true);
                            if( $pdf_file ) {
                            ?>
							
                            <div id="pdfDownloadLinkContainer">
                                <a class="action pdf" id="pdfDownloadLink" target="_parent" onclick="ga('send', 'event','pdf', 'downloads', 'pdf downloads', 0,{'nonInteraction': 1})" href="<?php echo $pdf_file; ?>">Download this PDF file</a>
                            </div>
							<div>
								<p><?php if(get_field('doi')){ ?> 
										DOI: <a href="<?php the_field('doi_link'); ?>" class="doi"><?php the_field('doi'); ?></a>
									<?php } else { ?>
									<?php } ?>
								</p>
							</div>
							<div class="hidden-xs hidden-sm">
								<div id="pdf-wrap"></div>
								<script>PDFObject.embed('<?php echo $pdf_file; ?>', "#pdf-wrap");</script>
							</div>
							<?php
                                    $authors = get_post_meta(get_the_ID(), 'authors', true);
									?>
									
							<div class="separator"><br></div>
							<div class="visible-xs visible-sm">
							<iframe id="pdfviewer" src="https://docs.google.com/gview?embedded=true&url=<?php echo $pdf_file; ?>&amp;embedded=true"
							frameborder="0" width="100%" height="400px"></iframe>
							</div>
							<?php if( get_the_ID() == '2176' || get_the_ID() == '16745' || get_the_ID() == '17727' ){
							
							}else{ ?>
                                    <div class="author-section-bottom">
                                        <div class="blockTitle"> About the Authors </div>

                                        <?php
                                        $authors = get_post_meta(get_the_ID(), 'authors', true);
                                        $out = array();
                                        foreach($authors as $key=>$author) {	?>
                                            <div id="authorBio">
                                                <div>
                                                    <p><em><?php echo $author['first_name'].' '.$author['middle_name'].' '.$author['last_name'] ?></em>
                                                        <?php  if(array_key_exists("email",$author)){?>
                                                        <a href="mailto:<?php echo $author['email']; ?>">
                                                            (<?php echo $author['email']; ?>)</a></p>
                                                    <?php }else echo ""; ?>
                                                    <p><?php echo $author['biography']; ?></p>
                                                    <p><?php echo $author['affiliation']; ?></p>
                                                </div>
                                            </div>
                                            <div class="separator"></div>

                                        <?php } ?>


                                        <?php if(get_field('manuscript_editor')){ ?>
                                            <p style="color:#595959"><b>Manuscript Editor: </b> <?php the_field('manuscript_editor'); ?> </p>

                                        <?php } ?>
                                        <?php
//                                        Peer section for pdf
                                        $peers = get_post_meta(get_the_ID(), 'peers', true);
                                        ?>
                                                                        <?php   if(!empty($peers[0]['name'])) { ?>
                                                                            <p style="color:#595959"><b>Peer Reviewers: </b> <em>
                                                                            <?php foreach ($peers as $key => $peer) { ?>
                                                                               <?php echo $peer['name'] . ', '; ?>
                                                                            <?php }?>
                                                                            </em></p>

                                                                       <?php }?>


                                    </div>



							<?php } ?>
                            <?php
                            }
                        }
                        elseif(isset($_GET['galley']) && $_GET['galley'] == 'html') {

                            if(get_the_ID()>=17690){
                            ?>
                            <div id="articleTitle"><h3><?php echo get_the_title(); ?></h3></div>
                            <div id="authorString">
                                <em>
                                    <?php
                                    $authors = get_post_meta(get_the_ID(), 'authors', true);
                                    $out = array();
                                    if(!empty($authors)){
                                        foreach($authors as $key=>$author) {
                                            $authStr=$author['first_name'].' '.$author['middle_name'].' '.$author['last_name'];
                                            //if($author['primary_contact']) {
                                            array_push($out, $authStr);
                                        }
                                        echo implode(', ', $out);
                                    }
                                    ?>
                                </em>
                                <p>
                                    <span class="article_publish_date pull-left">Published On : <?php echo get_the_date('d-m-Y') ?></span>

                                    <?php if (get_field('doi')) { ?>
                                        <span class="pull-right"> DOI: <a href="<?php the_field('doi_link'); ?>"
                                                                          class="doi"><?php the_field('doi'); ?></a></span>
                                    <?php } else { ?>
                                    <?php } ?>

                                </p>
                            </div>
                            <div class="clearfix"></div>
                            <div class="article_count_container">
                                <div class="article-count-wrapper">
                                    Article Views:&nbsp;
                                    <div class="lds-ellipsis" id="place-holder"><p id="article_count"></p>
                                        <div></div>
                                    </div>

                                    &nbsp;&nbsp;,PDF Downloads:&nbsp;
                                    <div class="lds-ellipsis" id="pdf-place-holder"><p id="pdfDownloadCount"></p>
                                        <div></div>
                                    </div>
                                </div>
                            </div>
                          <?php  }
                            else{
                            }?>
							
                            <script>
                                jQuery(document).ready(function($){$(".section").first().prepend($(".about-author-content").html());});
                            </script>
                            <div class="about-author-content" style="display: none;">
                                <div class="block" id="articleToolsInContent" style="float: right; border-bottom: 0; border: 1px solid #ddd;">
                                    <h4 class="blockTitle">Article Tools</h4>
                                    <?php if( get_post_meta(get_the_ID(),'pdf_file',true) ) { ?>
                                    <div class="articleToolItem">
                                        <img src="<?php echo THEME_URL; ?>/images/abstract.png" class="articleToolIcon">
                                        <a href="<?php echo add_query_arg( 'galley', 'pdf', get_permalink(get_the_ID()) ); ?>" class="file" target="_parent">PDF</a><br>
                                    </div>
                                    <?php } ?>
                                    
                                    <script>
                                        jQuery(document).ready(function($) {
                                            $('a.new-window').click(function() {
                                                window.open($(this).attr('href'),'title', 'width=700, height=400');
                                                return false;
                                            });

                                            $.get("ijmewp/ArticleCountAPI/article_count_api.php", function (data) {
                                                $(".result").html(data);
                                            })
                                        });
                                    </script>
                                    <div class="articleToolItem">
                                        <img src="<?php echo THEME_URL; ?>/images/printArticle.png" class="articleToolIcon"> <a href="<?php echo add_query_arg( 'galley', 'print', get_permalink(get_the_ID()) ); ?>">Print this article</a>
                                    </div>
                                    <div class="articleToolItem">
                                        <img src="<?php echo THEME_URL; ?>/images/metadata.png" class="articleToolIcon"> <a href="#" onclick="window.open('<?php echo add_query_arg( 'galley', 'index', get_permalink(get_the_ID()) ); ?>','_blank')">Indexing metadata</a><br>
                                    </div>
                                    <div class="articleToolItem">
                                        <img src="<?php echo THEME_URL; ?>/images/citeArticle.png" class="articleToolIcon"> <a href="<?php echo add_query_arg( 'galley', 'citations', get_permalink(get_the_ID()) ); ?>" target="_blank" >How to cite item</a><br>
                                    </div>
                                    <div class="articleToolItem">
                                        <img src="<?php echo THEME_URL; ?>/images/findingReferences.png" class="articleToolIcon"> <a href="<?php echo add_query_arg( 'galley', 'references', get_permalink(get_the_ID()) ); ?>" target="_blank" >Finding References</a>
                                    </div>
                                    <div class="articleToolItem">
                                        <img src="<?php echo THEME_URL; ?>/images/emailArticle.png" class="articleToolIcon"> <a href="<?php echo add_query_arg( 'galley', 'mail', get_permalink(get_the_ID()) ).'&to=author'; ?>" target="_blank">Email the author</a>
                                    </div>
                                    <div class="articleToolItem">
                                        <img src="<?php echo THEME_URL; ?>/images/postComment.png" class="articleToolIcon">
                                        <a href="#comments">Post a Comment</a> 
                                    </div>
                                </div>
                            </div>
                            <div class="singleContentArticle"><?php the_content(); ?></div>
							
							<?php
                                    $authors = get_post_meta(get_the_ID(), 'authors', true);
                            if(empty($authors)){
                               echo '<div class="author-section-bottom">';
                               echo	'<div class="blockTitle"> </div>';
                            }else{
                                ?>
							    <div class="author-section-bottom">
								<div class="blockTitle"> About the Authors </div>
								
								<?php }
									$authors = get_post_meta(get_the_ID(), 'authors', true);
									$out = array();
									if(!empty($authors)){
									foreach($authors as $key=>$author) {	?>
									<div id="authorBio">
										<div>
											<p><em><?php echo $author['first_name'].' '.$author['middle_name'].' '.$author['last_name'] ?></em>
                                                <?php  if(array_key_exists("email",$author)){?>
                                                <a href="mailto:<?php echo $author['email']; ?>">
											(<?php echo $author['email']; ?>)</a></p>
                                               <?php }else echo ""; ?>
											<p><?php echo $author['biography']; ?></p>
											<p><?php echo $author['affiliation']; ?></p>
										</div>
									</div>
									<div class="separator"></div>

									<?php }} ?>


									<?php if(get_field('manuscript_editor')){ ?> 
										<p style="color:#595959"><b>Manuscript Editor: </b> <?php the_field('manuscript_editor'); ?> </p>
										
									<?php } ?>
                               <?php
                                $peers = get_post_meta(get_the_ID(), 'peers', true);
                                ?>
                                <?php   if(!empty($peers[0]['name'])) { ?>
                                    <p style="color:#595959"><b>Peer Reviewers: </b> <em>
                                    <?php foreach ($peers as $key => $peer) { ?>
                                       <?php echo $peer['name'] . ', '; ?>
                                    <?php }?>
                                    </em></p>

                               <?php }?>

                                </div>
                            <!-- Peer section ----2 ------>

                        <?php }
                        else {
                            ?>
							<div id="articleTitle"><h3><?php echo get_the_title(); ?></h3></div>
                            <div id="authorString">
                                <em>
                                    <?php
                                    $authors = get_post_meta(get_the_ID(), 'authors', true);
									$out = array();
									if(!empty($authors)){
                                        foreach($authors as $key=>$author) {
                                            $authStr=$author['first_name'].' '.$author['middle_name'].' '.$author['last_name'];
                                            //if($author['primary_contact']) {
                                            array_push($out, $authStr);
                                        }
                                        echo implode(', ', $out);
                                    }
                                    ?>
                                </em>
								<p>
                                    <span class="article_publish_date pull-left">Published On : <?php echo get_the_date('d-m-Y') ?></span>

                                    <?php if (get_field('doi')) { ?>
                                        <span class="pull-right"> DOI: <a href="<?php the_field('doi_link'); ?>"
                                                                          class="doi"><?php the_field('doi'); ?></a></span>
                                    <?php } else { ?>
                                    <?php } ?>

                                </p>
                            </div>
                        <div class="clearfix"></div>
                        <div class="article_count_container">
                            <div class="article-count-wrapper">
                            Article Views:&nbsp;
                            <div class="lds-ellipsis" id="place-holder"><p id="article_count"></p>
                                <div></div>
                            </div>

                                &nbsp;&nbsp;,PDF Downloads:&nbsp;
                            <div class="lds-ellipsis" id="pdf-place-holder"><p id="pdfDownloadCount"></p>
                                <div></div>
                            </div>
                            </div>
                        </div>

                            <br/>
							<?php if( get_the_ID() == '16706' && !is_front_page() ){  ?>
                            <div id="articleAbstract1" style = "padding: 30px 0 0px !important;">
                                
							<?php }else{ ?> 
							<div id="articleAbstract">
                                <h4>Abstract</h4>	
							<?php } ?> 
                                <div><?php the_excerpt(); ?></div>
                            </div>
							<?php if( get_the_ID() != '16706' && !is_front_page()){  ?>
                            <div id="articleFullText">
                                <h4>Full Text</h4>
                                <a class="file" href="<?php echo add_query_arg( 'galley', 'html', get_permalink(get_the_ID()) ); ?>">HTML</a>
                                <a class="file" href="<?php echo add_query_arg( 'galley', 'pdf', get_permalink(get_the_ID()) ); ?>">PDF</a>
                            </div>
                           <?php
                            if(get_ojs_article_ID(get_the_ID()) > 0 ){; ?>
                            <div id="articleHistory">
                                <h4>Article History</h4>
                                <p class="articleHistory-item">Date Submitted:<?php echo get_submission_date(get_ojs_article_ID(get_the_ID()));?></p>
                                <p class="articleHistory-item">Date Published: <?php echo get_published_date(get_ojs_article_ID(get_the_ID()));?></p>
                            </div>
							<?php } }?>

                                <?php

                        }
                        
                        ?>
                        
                        <?php if(get_post_type() == 'page') the_content(); ?>
                    </div><!--content-->
                </div><!--main-->
                
                <div class="clearfix"></div>
                <?php                
                comments_template();
                
            } // end while
        } // end if
        ?>        
    </div>
        <div class="col-md-3 article-count-container">
            <script>
                jQuery(document).ready(function($) {
                    let post_slug = "<?php echo $slug = get_post_field( 'post_name', get_post() ); ?>";
                    url = "/ArticleCountAPI/article_count_api.php?article_name="+post_slug;
                    $.get(url,function (data) {
                        $(".result").html(data);
                        document.getElementById('place-holder').classList.remove('lds-ellipsis') ;
                        document.getElementById('article_count').innerText = JSON.parse(data).pageView;
                        document.getElementById('pdf-place-holder').classList.remove('lds-ellipsis') ;
                        document.getElementById('pdfDownloadCount').innerText = JSON.parse(data).pdfView;
                    })
                });
            </script>
            <!-- Go to www.addthis.com/dashboard to customize your tools -->
            <script type="text/javascript" src="//s7.addthis.com/js/300/addthis_widget.js#pubid=ra-5d1b0148a07aaf99"></script>
        </div>
	<div class="clearfix visible-xs visible-sm"></div>
    <div class="col-md-3">
        <?php get_sidebar(); ?>
    </div>
</div>


<?php get_footer(); ?>



