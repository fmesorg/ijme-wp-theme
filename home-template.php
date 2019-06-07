<?php
/*
 * Template Name: Home Template
 */
 get_header(); ?>
 
 <div class="container main-container">
	<div class="row main-container-background">
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

 </div>
 <?php get_footer(); ?>