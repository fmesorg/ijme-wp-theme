<?php
/*
 * Template Name: Home Template
 */
 get_header(); ?>
 
 <div class="container main-container">
	<div class="row">
	<div class="col-md-3 pd-xs-0 current-issue-panel">
		<div class="blocks current-issue">
		<?php
			global $post;
			$articles = get_posts( array(
				'posts_per_page' => 1,
				'post_type' => 'issues'
			) );
			 
			if ( $articles ) {
				foreach ( $articles as $post ) :
					setup_postdata( $post ); 
					if ( has_post_thumbnail() ):
		?>
		
		<div class="title-bar"><h3><a href="<?php the_permalink(); ?>"> Current Issue </a></h3></div>
		<?php
			endif; 
			endforeach;
		}
		?>
			<div class="row home-currentissue">
				<div class="col-md-12">
					<div class="row">
						<div class="col-md-12">
							<?php
							global $post;
							$articles = get_posts( array(
								'posts_per_page' => 1,
								'post_type' => 'issues'
							) );
							 
							if ( $articles ) {
								foreach ( $articles as $post ) :
									setup_postdata( $post ); 
									if ( has_post_thumbnail() ):
							?>
									
							<a href="<?php the_permalink(); ?>" class="currentIssueImage"><?php the_post_thumbnail('medium'); ?></a>
							<?php
									endif; 
								endforeach;
							}
							?>
						</div>
					</div>
				<div class="row">
					<div class="col-md-12">
					
						<?php
					if ( $articles ) {
						foreach ( $articles as $post ) :
							setup_postdata( $post ); 
					?>
						<div class="article-list-item">
							<h3 class="home-title-1"><a href="<?php the_permalink(); ?>"><?php echo wp_trim_words(get_the_title(), 5); ?></a></h3>
							<?php echo wp_trim_words(get_the_excerpt(), 30); ?>
						</div> <hr/>
						<?php
						endforeach; 
						wp_reset_postdata();
					}
				
					?>
					
					</div>
					
					
					
				</div>
				
				<div class="row">
					<div class="col-md-12">
						<div class="row issue-slider" style="margin-top: 15px; margin-bottom: 15px;">
							<div id="carousel" class="owl-carousel owl-theme">
							<?php 
							global $post;
								$articles = get_posts( array(
									'posts_per_page' => 12,
									'post_type' => 'issues',
									'offset'=> 1,
									'order'     => 'DESC'
								) ); 
							if ( $articles ) {
									foreach ( $articles as $post ) : 
										setup_postdata( $post ); 
										if ( has_post_thumbnail() ):
							?>
								 <div>
									<div class="item">		
										<a href="<?php the_permalink(); ?>"><?php the_post_thumbnail('thumbnail'); ?></a>
									</div>
								</div>
							<?php
										endif; 
									endforeach;
								}
							?>
						   
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
    </div>
	
	
    <div class="col-md-9">
    <div id="main">
     
    <div id="content">
    <div>

    <div class="row home-current-online">
    
	<div class="col-md-12">
		<p class="home-text"><em>The Indian Journal of Medical Ethics is peer reviewed and indexed in Medline, The Philosopher's Index, Scopus and other databases.</em></p>
	</div>
    <div class="col-md-8 pd-xs-0">
    <div id="online_first" class="blocks online-first">
		<div class="title-bar"><h3><a href="/issues/online-first/"> Online First </a></h3></div>

		<?php
		global $post;
		$articles = get_posts( array(
			'posts_per_page' => 4,
			'post_type' => 'articles',
			'category' => 3
		));
		 
		if ( $articles ) {
			foreach ( $articles as $post ) :
				setup_postdata( $post ); 
		?>
			<div class="article-list-item">
				<p class="online-first-date">
					<?php echo date('F d, Y', strtotime($post->post_date)); ?>
				</p>
				
				<h4 class="home-article-title"><a href="<?php the_permalink(); ?>">
				
				<?php
					$new_post = get_post_meta($post->ID, 'show_new_button', true);
					if($new_post == 1) {
				?>
				<img src="<?php echo get_template_directory_uri(); ?>/images/tag-new-icon.jpg"/>
				<?php } ?>
				
				<?php echo wp_trim_words(get_the_title(), 8); ?></a></h4>
				
				<div class="authorsName onlineFirst">
					<em>
						<?php
						$authors = get_post_meta(get_the_ID(), 'authors', true);
						$out = array();
						foreach($authors as $key=>$author) {										
							$authStr=$author['first_name'].' '.$author['middle_name'].' '.$author['last_name'];
								array_push($out, $authStr);
						}
						echo implode(', ', $out);

						?>
					</em>
				</div>
				
				
				<!--div class="" style="margin: 6px 0 5px 0;"><i><?php //echo get_the_author();?></i></div-->
				
				
				<?php echo wp_trim_words(get_the_excerpt(), 20); ?>
				<?php if( get_the_ID() != '16706' ){  ?>
				<div class="extraLinks">
					<?php $uri = $_SERVER['REQUEST_URI'];
					if (strpos($uri, 'opportunities') !== false || strpos($uri, 'issues/fmes') !== false) {
						
					}else  { ?>
					
					<a class="" href="<?php echo get_permalink($post->ID); ?>">ABSTRACT</a>
					<?php }
					$pdfUrl = add_query_arg( 'galley', 'pdf', get_permalink($post->ID) );
					$htmlUrl = add_query_arg( 'galley', 'html', get_permalink($post->ID) );
                    ?>
					<a class="tocGalleyFile" onclick="showSupportModal('<?php echo $htmlUrl ?>')" href="#">HTML</a>
					<?php if(get_post_meta($post->ID,'pdf_file',true)) { ?>
					<a class="tocGalleyFile" onclick="showSupportModal('<?php echo $pdfUrl?>')" href="#">PDF</a>
					<?php } ?>
				</div>
				<?php } ?>
			</div>
			<?php
			endforeach; 
			wp_reset_postdata();
		}
	
		?>
		
		<div style="text-align: right;">
			<a href="<?php echo site_url();?>/issues/online-first/"> <strong>More articles&#8230;</strong></a>
		</div>
	</div>
  </div>
  <div class="col-md-4 pd-xs-0"><div id="sidebar"><?php get_sidebar();?></div></div>
  
</div>
</div>
</div>
</div>
</div>
    
	<div class="clearfix visible-xs visible-sm"></div>
    
    
	<div class="clearfix"></div>
    <div class="row current-issue-bottom-panel">
		<div class="col-md-12">
			<div class="blocks">
				<div id="exTab2" class="container">	
					<ul class="nav nav-tabs">
						<li class="active">
							<a  href="#1" data-toggle="tab">EDITORIALS</a>
						</li>
						<li>
							<a href="#2" data-toggle="tab">ARTICLES</a>
						</li>
						<li>
							<a href="#3" data-toggle="tab">COMMENTS</a>
						</li>
						<li>
							<a href="#4" data-toggle="tab">REPORTS</a>
						</li>
						<li>
							<a href="#5" data-toggle="tab">REVIEWS</a>
						</li>
						<li>
							<a href="#6" data-toggle="tab">ONLINE ONLY</a>
						</li>
					</ul>

					<div class="tab-content ">
						<div class="tab-pane active" id="1">
							<?php
							global $post;
							$articles = get_posts( array(
								'posts_per_page' => 4,
								'post_type' => 'articles',
								'category' => 2
							) );
							 
							if ( $articles ) {
								foreach ( $articles as $post ) :
									setup_postdata( $post ); 
							?>
							<div class="single-article-block">
								<h5><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h5>
								<p class=""><em>
										<?php
										$authors = get_post_meta(get_the_ID(), 'authors', true);
										$out = array();
										foreach($authors as $key=>$author) {										
											$authStr=$author['first_name'].' '.$author['middle_name'].' '.$author['last_name'];
												array_push($out, $authStr);
										}
										echo implode(', ', $out);

										?>
								</em></p>
							</div>
							<?php
								endforeach;
							}
						?>
						</div>
						
						<div class="tab-pane" id="2">
						<?php
							global $post;
							$articles = get_posts( array(
								'posts_per_page' => 4,
								'post_type' => 'articles',
								'category' => 3
							) );
							 
							if ( $articles ) {
								foreach ( $articles as $post ) :
									setup_postdata( $post ); 
							?>
							<div class="single-article-block">
								<h5><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h5>
								<p class=""><em>
										<?php
										$authors = get_post_meta(get_the_ID(), 'authors', true);
										$out = array();
										foreach($authors as $key=>$author) {										
											$authStr=$author['first_name'].' '.$author['middle_name'].' '.$author['last_name'];
												array_push($out, $authStr);
										}
										echo implode(', ', $out);

										?>
								</em></p>
							</div>
							<?php
								endforeach;
							}
						?>
						</div>
						<div class="tab-pane" id="3">
							<?php
							global $post;
							$articles = get_posts( array(
								'posts_per_page' => 4,
								'post_type' => 'articles',
								'category' => 20
							) );
							 
							if ( $articles ) {
								foreach ( $articles as $post ) :
									setup_postdata( $post ); 
							?>
							<div class="single-article-block">
								<h5><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h5>
								<p class=""><em>
										<?php
										$authors = get_post_meta(get_the_ID(), 'authors', true);
										$out = array();
										foreach($authors as $key=>$author) {										
											$authStr=$author['first_name'].' '.$author['middle_name'].' '.$author['last_name'];
												array_push($out, $authStr);
										}
										echo implode(', ', $out);

										?>
								</em></p>
							</div>
							<?php
								endforeach;
							}
						?>
						</div>
						<div class="tab-pane" id="4">
						<?php
							global $post;
							$articles = get_posts( array(
								'posts_per_page' => 4,
								'post_type' => 'articles',
								'category' => 23
							) );
							 
							if ( $articles ) {
								foreach ( $articles as $post ) :
									setup_postdata( $post ); 
							?>
							<div class="single-article-block">
								<h5><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h5>
								<p class=""><em>
										<?php
										$authors = get_post_meta(get_the_ID(), 'authors', true);
										$out = array();
										foreach($authors as $key=>$author) {										
											$authStr=$author['first_name'].' '.$author['middle_name'].' '.$author['last_name'];
												array_push($out, $authStr);
										}
										echo implode(', ', $out);

										?>
								</em></p>
							</div>
							<?php
								endforeach;
							}
						?>
						</div>
						<div class="tab-pane" id="5">
							<?php
							global $post;
							$articles = get_posts( array(
								'posts_per_page' => 4,
								'post_type' => 'articles',
								'category' => 16
							) );
							 
							if ( $articles ) {
								foreach ( $articles as $post ) :
									setup_postdata( $post ); 
							?>
							<div class="single-article-block">
								<h5><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h5>
								<p class=""><em>
										<?php
										$authors = get_post_meta(get_the_ID(), 'authors', true);
										$out = array();
										foreach($authors as $key=>$author) {										
											$authStr=$author['first_name'].' '.$author['middle_name'].' '.$author['last_name'];
												array_push($out, $authStr);
										}
										echo implode(', ', $out);

										?>
								</em></p>
							</div>
							<?php
								endforeach;
							}
						?>
						</div>
						<div class="tab-pane" id="6">
							<div class="single-article-block">
								<?php 
									$posts = $wpdb->get_results("SELECT post_id FROM $wpdb->postmeta WHERE meta_key = '_is_ns_featured_post' AND  meta_value = 'yes'", ARRAY_A);
									
									foreach($posts as $post) {
										//echo $post['post_id']; 
										$onlineOnly = get_post($post['post_id']);
										//var_dump($onlineOnly);
									?>
									<h5><a href="<?php echo $onlineOnly->guid; ?>"><?php echo $onlineOnly->post_title; ?></a></h5>
									<p class=""><em>
											<?php
												
													$authors = get_post_meta($onlineOnly->ID, 'authors', true);
													$authors_array = array();
													//print_r($authors);
													if (is_array($authors)) {
														foreach($authors as $author) $authors_array[] = $author['first_name'].' '.$author['middle_name'].' '.$author['last_name'];
														echo implode(', ',$authors_array);
													}
											?>
										<em></p>
									<?php } ?>
								
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
    
    </div>
 </div>
 <?php get_footer(); ?>