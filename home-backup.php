<?php
global $current_issue_id;
global $current_issue_main_article_id;
global $current_issue_sec_article_id;
global $online_only_main_post_ids;

global $cat_reviews_id;
global $cat_reports_id;
global $cat_comments_id;
global $cat_articles_id;
global $cat_editorial_id;
?>

<div id="main">
<!-- <div class="row">
	<div class="col-sm-12">
		<div class="ticker-container">
			<div class="ticker-sibling">
				Announcements
			</div>
			<div class="ticker-text">
				<span><a href="/nbc-20140321/index.php/NBC-6/index/pages/view/registration" target="_blank">Registration</a> for Sixth National Bioethics Conference Open</span><span>Announcements of <a href="/nbc-20140321/index.php/NBC-6/index/pages/view/announcement-of-nsf" target="_blank">pre-conference workshop</a> on transition of care in patients with advanced and life limiting conditions. Please sign up</span><span>Announcement of a <a href="/nbc-20140321/index.php/NBC-6/index/pages/view/visit-to-cipla-palliative-care-and-training-centre" target="_blank">Study Tour</a> to the Cipla Palliative Care and Training Centre, Pune on Jan 12, 2017 and Jan 15, 2017.</span>
			</div>
		</div>
	</div>
</div>-->
<div id="content">



    <div>
        <div class="row home-current-online">
            <div class="col-md-8 current-issue-panel">
                <div class="blocks current-issue">
                    <div class="title-bar">
                        <!--<h3><a href="/index.php/ijme/issue/view/138"> Current Issue </a></h3>-->
                        <h3><a href="<?php echo get_permalink($current_issue_id); ?>"> Current Issue </a></h3>
                    </div>
                    <div class="row home-currentissue">
                        <div class="col-md-12">
                            <div class="row">
                                <div class="col-md-12">
                                    <?php
                                    $current_issue_main_article = get_post($current_issue_main_article_id);
                                    ?>
                                    <!--<h3 class="home-title-1"><a href="/index.php/ijme/article/view/2378">The functioning of the Medical Council of India analysed by the Parliamentary Standing Committee of Health and Family Welfare </a></h3>-->
                                    <h3 class="home-title-1"><a href="<?php echo get_permalink($current_issue_main_article_id); ?>"><?php echo get_the_title($current_issue_main_article_id); ?></a></h3>
                                    <p><?php echo substr($current_issue_main_article->post_excerpt,0 , 250); ?>...</p>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-4">
                                    <a class="item" href="<?php echo get_permalink($current_issue_id); ?>">
                                        <!--<img src="/public/journals/1/cover_issue_242_en_US.jpg" alt="IJME 2016 Issue-2">-->
                                        <?php
                                        echo get_the_post_thumbnail($current_issue_id,'full',array('class'=>'home-current-featured'));
                                        ?>
                                    </a>
                                </div>
                                <div class="col-md-8">
                                    <?php
                                    $current_issue_sec_article = get_post($current_issue_sec_article_id);
                                    ?>
                                    <!--<h4 class="home-article-title"><a href="/index.php/ijme/article/view/2381">The Chennai floods of 2015: urgent need for ethical disaster management guidelines</a></h4>-->
                                    <h4 class="home-article-title"><a href="<?php echo get_permalink($current_issue_sec_article_id); ?>"><?php echo get_the_title($current_issue_sec_article_id); ?></a></h4>
                                    <p><?php echo substr($current_issue_sec_article->post_excerpt,0 , 300); ?>...</p>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-12">
                                    <?php get_template_part('home','carousal'); ?>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
			
		<!--	<div class="col-md-4" style="padding-bottom: 25px;">
				<div id="online_first" class="blocks online-first">
					<div class="title-bar">
						<h3><a href="/index.php/ijme/issue/view/141">FMES</a></h3>
					</div>
					<div class="article-list-item">
						<p>
							<a href="/index.php/ijme/issue/view/141" target="_blank">Annual Report 2015-16</a>
						</p>
						<p>
							<a href="/index.php/ijme/issue/view/141" target="_blank">FMES Brochure</a>
						</p>
						<p>
							<a href="/index.php/ijme/issue/view/141" target="_blank">6th NBC Brochure</a>
						</p>
						<p>
							<a href="/index.php/ijme/issue/view/141" target="_blank">Public Debate EoLC @ TISS on July 16, 2016 | How to get there</a>
						</p>
						<p>
							<a href="/nbc-20140321/index.php/NBC-6/index/pages/view/public-engagement" target="_blank">Public Debate EoLC@ Ferguson College, Pune 2 September, 2016</a>
						</p>
					</div>
				</div>
			</div> -->
			
            <div class="col-md-4">
                <div id="online_first" class="blocks online-first">
                    <?php global $online_issue_id; ?>
                    <div class="title-bar">
                        <h3><a href="<?php echo get_permalink($online_issue_id); ?>"> Online First </a></h3>
                    </div>
                    <?php
                    /*
                    $args = array(
                        'meta_key' => 'issue_post_id',
                        'meta_value' => $online_issue_id,
                        'post_type' => 'articles',
                        'post_status' => 'publish',
                        'posts_per_page' => 2
                    );
                    $posts_array = get_posts($args);
                    */
                    $posts_array = get_posts( array('post__in'=>$online_only_main_post_ids,'post_type'=>'articles') );
                    
                    foreach($posts_array as $post_obj) {
                        ?>
                        <div class="article-list-item">
                            <h4 class="home-article-title"><a href="<?php echo get_permalink($post_obj->ID); ?>"><?php echo $post_obj->post_title; ?></a></h4>
                            <?php 
								$words = explode(" ", $post_obj->post_excerpt);
								$first = join(" ", array_slice($words, 0, 50));
							echo $first;
							//echo $post_obj->post_excerpt; ?>
                        </div>
                        <?php
                    }
                    ?>
                    <div style="text-align: right; padding-bottom: 13px;"><a href="<?php echo get_permalink(735); ?>"> <strong>More articles...</strong> </a></div>
                </div>
                <p class="home-text"><em>The Indian Journal of Medical Ethics is peer reviewed and indexed in Medline and other databases.</em></p>
            </div>
        </div>
        <div class="row">
            <div class="col-md-6">
                <div class="blocks home-featured-articles">
                    <div class="title-bar">
                        <h3>EDITORIALS</h3>
                    </div>
                    <?php
                    $posts_array = get_posts( array('category'=>$cat_editorial_id,'post_type'=>'articles','posts_per_page'=>4) );
                    foreach($posts_array as $post_obj) {
                        ?>
                        <div class="single-article-block">
                            <h5><a href="<?php echo get_permalink($post_obj->ID); ?>"><?php echo $post_obj->post_title; ?></a></h5>
                            <p class="author">
                                <?php
                                $authors = get_post_meta($post_obj->ID, 'authors', true);
                                $authors_array = array();
                                foreach($authors as $author) $authors_array[] = $author['first_name'].' '.$author['middle_name'].' '.$author['last_name'];
                                echo implode(', ',$authors_array);
                                ?>
                            </p>
                        </div>
                        <?php
                    }
                    ?>
                </div>
            </div>
            <div class="col-md-6">
                <div class="blocks home-featured-articles">
                    <div class="title-bar">
                        <h3>ARTICLES</h3>
                    </div>
                    <?php
                    $posts_array = get_posts( array('category'=>$cat_articles_id,'post_type'=>'articles','posts_per_page'=>4) );
                    foreach($posts_array as $post_obj) {
                        ?>
                        <div class="single-article-block">
                            <h5><a href="<?php echo get_permalink($post_obj->ID); ?>"><?php echo $post_obj->post_title; ?></a></h5>
                            <p class="author">
                                <?php
                                $authors = get_post_meta($post_obj->ID, 'authors', true);
                                $authors_array = array();
                                foreach($authors as $author) $authors_array[] = $author['first_name'].' '.$author['middle_name'].' '.$author['last_name'];
                                echo implode(', ',$authors_array);
                                ?>
                            </p>
                        </div>
                        <?php
                    }
                    ?>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-6">
                <div class="blocks home-featured-articles">
                    <div class="title-bar">
                        <h3>COMMENTS</h3>
                    </div>
                    <?php
                    $posts_array = get_posts( array('category'=>$cat_comments_id,'post_type'=>'articles','posts_per_page'=>4) );
                    foreach($posts_array as $post_obj) {
                        ?>
                        <div class="single-article-block">
                            <h5><a href="<?php echo get_permalink($post_obj->ID); ?>"><?php echo $post_obj->post_title; ?></a></h5>
                            <p class="author">
                                <?php
                                $authors = get_post_meta($post_obj->ID, 'authors', true);
                                $authors_array = array();
                                foreach($authors as $author) $authors_array[] = $author['first_name'].' '.$author['middle_name'].' '.$author['last_name'];
                                echo implode(', ',$authors_array);
                                ?>
                            </p>
                        </div>
                        <?php
                    }
                    ?>
                </div>
            </div>
            <div class="col-md-6">
                <div class="blocks home-featured-articles">
                    <div class="title-bar">
                        <h3>REPORTS</h3>
                    </div>
                    <?php
                    $posts_array = get_posts( array('category'=>$cat_reports_id,'post_type'=>'articles','posts_per_page'=>4) );
                    foreach($posts_array as $post_obj) {
                        ?>
                        <div class="single-article-block">
                            <h5><a href="<?php echo get_permalink($post_obj->ID); ?>"><?php echo $post_obj->post_title; ?></a></h5>
                            <p class="author">
                                <?php
                                $authors = get_post_meta($post_obj->ID, 'authors', true);
                                $authors_array = array();
                                foreach($authors as $author) $authors_array[] = $author['first_name'].' '.$author['middle_name'].' '.$author['last_name'];
                                echo implode(', ',$authors_array);
                                ?>
                            </p>
                        </div>
                        <?php
                    }
                    ?>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-6">
                <div class="blocks home-featured-articles">
                    <div class="title-bar">
                        <h3>REVIEWS</h3>
                    </div>
                    <?php
                    $posts_array = get_posts( array('category'=>$cat_reviews_id,'post_type'=>'articles','posts_per_page'=>4) );
                    foreach($posts_array as $post_obj) {
                        ?>
                        <div class="single-article-block">
                            <h5><a href="<?php echo get_permalink($post_obj->ID); ?>"><?php echo $post_obj->post_title; ?></a></h5>
                            <p class="author">
                                <?php
                                $authors = get_post_meta($post_obj->ID, 'authors', true);
                                $authors_array = array();
                                foreach($authors as $author) $authors_array[] = $author['first_name'].' '.$author['middle_name'].' '.$author['last_name'];
                                echo implode(', ',$authors_array);
                                ?>
                            </p>
                        </div>
                        <?php
                    }
                    ?>
                </div>
            </div>
            <div class="col-md-6">
                <div class="blocks home-featured-articles">
                    <div class="title-bar">
                        <h3>Online Only</h3>
                    </div>
                    <?php
                    global $online_only_section_post_ids;
                    $posts_array = get_posts( array('post__in'=>$online_only_section_post_ids,'post_type'=>'articles') );
                    foreach($posts_array as $post_obj) {
                        ?>
                        <div class="single-article-block">
                            <h5><a href="<?php echo get_permalink($post_obj->ID); ?>"><?php echo $post_obj->post_title; ?></a></h5>
                            <p class="author">
                                <?php
                                $authors = get_post_meta($post_obj->ID, 'authors', true);
                                $authors_array = array();
                                foreach($authors as $author) $authors_array[] = $author['first_name'].' '.$author['middle_name'].' '.$author['last_name'];
                                echo implode(', ',$authors_array);
                                ?>
                            </p>
                        </div>
                        <?php
                    }
                    ?>
                </div>
            </div>
        </div>
    </div>
</div>
</div>