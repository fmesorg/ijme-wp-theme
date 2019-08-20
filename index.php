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
                        //require THEME_PATH.'/home.php';
                        get_template_part( 'home' );
                        break;
                    }
                    ?>
                    <?php if(!(get_post_type() == 'articles' && isset($_GET['galley']) && $_GET['galley'] == 'html')) { ?>

                            <div id="breadcrumb">
                                <!--a href="<?php //echo site_url(); ?>" class="current" target="_parent">Home</a-->
                                <?php $uri = $_SERVER['REQUEST_URI'];
                                 ?>
                                </a>
                            </div>

                    <?php } ?>

                    <div id="content">

                        <?php if(has_post_thumbnail()) { ?>
                            <div class="cover-img">
                                <?php the_post_thumbnail('full'); ?>
                            </div>
                        <?php } ?>

                        <?php if(!(get_post_type() == 'articles' && isset($_GET['galley']) && $_GET['galley'] == 'html')) { ?>

                            <?php if (strpos($uri, 'issues/fmes') !== false) {
    echo "<div><br></div>"	;
                            }else{ ?>
                                <h3><?php the_title(); ?></h3>
                            <?php } ?>
                        <?php } ?>

                        <div class="issueContents"><?php if(get_post_type() == 'issues') the_content(); ?></div>

                        <?php
                        if(get_post_type() == 'issues' && !is_archive() && get_the_ID() == 4) {


                            $postArray = array();

                            $postId = get_post_meta(get_the_ID(), 'articles', true);
                            foreach($postId as $id) {
                                $t_post = get_post($id);
                                $postArray[] = $t_post;
                            }
                           ?>
                                <?php
                                foreach($postArray as $t_post) { //echo "<pre>"; var_dump($t_post);
                                    if($t_post->post_status != "trash" and $t_post->post_status !="inherit") {
                                    ?>
                                    <div class="row" id="online-<?php echo $t_post->ID;?>">
                                        <div class="col-md-8 col-sm-8 article-section-title-author">
                                            <div class="row">
                                                <div class="col-md-12">
                                                    <a class="section-article-title" href="<?php echo get_permalink($t_post->ID); ?>">
                                                    <?php $new_post=get_post_meta($t_post->ID, 'show_new_button', true);
                                                    if($new_post==1){
                                                    ?>
                                                        <img src="<?php echo get_template_directory_uri(); ?>/images/tag-new-icon.jpg" alt="tag-new-icon.jpg">
                                                    <?php } ?>
                                                    <?php echo $t_post->post_title; ?></a>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-md-12 onlineFirst">
                                                    <?php
                                                    $authors = get_post_meta($t_post->ID, 'authors', true);
                                                    $authors_array = array();
                                                    if (is_array($authors)) {
                                                    foreach($authors as $author) $authors_array[] = $author['first_name'].' '.$author['middle_name'].' '.$author['last_name'];
                                                    echo implode(', ',$authors_array);
                                                    }
                                                    ?>
                                                </div>
                                            </div>
                                             <!-- Peer Review
                                             <div class="row">
                                                <div class="col-md-12 onlineFirst">
                                                    <?php
                                                    $peers = get_post_meta($t_post->ID, 'peers', true);
                                                    $peers_array = array();
                                                    //print_r($authors);
                                                    if (is_array($peers)) {
                                                    foreach($peers as $peer) $peers_array[] = $peer['first_name'].' '.$peer['middle_name'].' '.$author['last_name'];
                                                    echo implode(', ',$peers_array);
                                                    }
                                                    ?>
                                                </div>
                                            </div> -->
                                            <!-- End Peer Review -->
                                            <div class="row">
                                                <div class="col-md-12">
                                                <?php $uri = $_SERVER['REQUEST_URI'];
                                                if (strpos($uri, 'online-first') !== false) { ?>
                                                    <p class="online-first-date"><?php
                                                    $publish_date = get_post_meta($t_post->ID, 'article_pub_date', true);
                                                    echo date("F j, Y",strtotime($publish_date));
                                                    ?></p>

                                                <?php }else  { } ?>

                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-4 col-sm-4 article-galley-file">
                                            <a class="tocPages-pg"><?php echo get_post_meta($t_post->ID, 'page_range', true); ?></a>

                                            <?php $uri = $_SERVER['REQUEST_URI'];
                                            if (strpos($uri, 'opportunities') !== false || strpos($uri, 'issues/fmes') !== false) {

                                            }else  { ?>

                                            <a class="tocAbstract" href="<?php echo get_permalink($t_post->ID); ?>">Abstract</a>
                                            <?php } ?>
                                            <?php
                                            $pdfUrl = add_query_arg( 'galley', 'pdf', get_permalink($t_post->ID));
                                            $htmlUrl = add_query_arg( 'galley', 'html', get_permalink($t_post->ID));
                                            ?>
                                            <a class="tocGalleyFile" onclick="showSupportModal('<?php echo $htmlUrl ?>')" href="#">Full text</a>
                                            <?php if(get_post_meta($t_post->ID,'pdf_file',true)) { ?>
                                            <a class="tocGalleyFile" onclick="showSupportModal('<?php echo $pdfUrl?>')" href="#">PDF</a>
                                            <?php } ?>
                                        </div>
                                    </div>
                                    <?php
                                }
                            }
                        }


                        // Code for current issue
                        if(get_post_type() == 'issues' && !is_archive() && get_the_ID() != 4) {

                            $category_array = array();
                            //echo get_the_ID(); /**/
                           // $articles_id = get_post_meta(get_the_ID(), 'articles', true);
                            $articles_id = get_post_meta(get_the_ID(), 'articles', true);

                            foreach($articles_id as $id) {
                                $t_post = get_post($id);
                                $category = get_the_category($t_post->ID);
                                if($category){
                                if(!isset($category_array[$category[0]->cat_name]))
                                $category_array[$category[0]->cat_name] = array();

                                $category_array[$category[0]->cat_name][] = $t_post;
                                }
                            }


                            foreach($category_array as $category_name=>$t_post_array) {
                                ?>
                                <h4 class="tocSectionTitle"><?php echo $category_name; ?></h4>
                                <?php
                                foreach($t_post_array as $t_post) {
                                    if($t_post->post_status != "trash") {
                                    ?>
                                    <div class="row">
                                        <div class="col-md-8 col-sm-8 article-section-title-author">
                                            <div class="row">
                                                <div class="col-md-12">
                                                    <a class="section-article-title" href="<?php echo get_permalink($t_post->ID); ?>">
                                                    <?php $new_post=get_post_meta($t_post->ID, 'show_new_button', true);
                                                    if($new_post==1){
                                                    ?>
                                                        <img src="<?php echo get_template_directory_uri(); ?>/images/tag-new-icon.jpg" alt="tag-new-icon.jpg">
                                                    <?php } ?>
                                                    <?php echo $t_post->post_title; ?></a>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-md-12">
                                                    <?php
                                                    $authors = get_post_meta($t_post->ID, 'authors', true);
                                                    $authors_array = array();
                                                    //print_r($authors);
                                                    if (is_array($authors)) {
                                                    foreach($authors as $author) $authors_array[] = $author['first_name'].' '.$author['middle_name'].' '.$author['last_name'];
                                                    echo implode(', ',$authors_array);
                                                    }
                                                    ?>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-md-12">
                                                <?php $uri = $_SERVER['REQUEST_URI'];
                                                if (strpos($uri, 'online-first') !== false) { ?>
                                                    <p class="online-first-date"><?php
                                                    $publish_date = get_post_meta($t_post->ID, 'article_pub_date', true);
                                                    echo date("F j, Y",strtotime($publish_date));
                                                    ?></p>

                                                <?php }else  { } ?>

                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-4 col-sm-4 article-galley-file">
                                            <a class="tocPages-pg"><?php echo get_post_meta($t_post->ID, 'page_range', true); ?></a>

                                            <?php $uri = $_SERVER['REQUEST_URI'];
                                            if (strpos($uri, 'opportunities') !== false || strpos($uri, 'issues/fmes') !== false) {

                                            }else  { ?>

                                            <a class="tocAbstract" href="<?php echo get_permalink($t_post->ID); ?>">Abstract</a>
                                            <?php } ?>
                                        <?php
                                        $pdfUrl = add_query_arg( 'galley', 'pdf', get_permalink($t_post->ID));
                                        $htmlUrl = add_query_arg( 'galley', 'html', get_permalink($t_post->ID));
                                        ?>
                                        <a class="tocGalleyFile" onclick="showSupportModal('<?php echo $htmlUrl ?>')" href="#">Full text</a>
                                        <?php if(get_post_meta($t_post->ID,'pdf_file',true)) { ?>
                                            <a class="tocGalleyFile" onclick="showSupportModal('<?php echo $pdfUrl?>')" href="#">PDF</a>
                                        <?php } ?>
                                            <?php } ?>
                                        </div>
                                    </div>
                                    <?php
                                    }
                                }
                            }
                        }






                        if(get_post_type() == 'articles') {

                            if(isset($_GET['galley']) && $_GET['galley'] == 'pdf') {
                                $pdf_file = get_post_meta(get_the_ID(),'pdf_file',true);
                                if( $pdf_file ) {
                                ?>
                                <div id="pdf-wrap"></div>
                                <script>PDFObject.embed('<?php echo $pdf_file; ?>', "#pdf-wrap");</script>
                                <?php
                                }
                            }
                            elseif(isset($_GET['galley']) && $_GET['galley'] == 'html') {
                                ?>
                                <script>
                                    jQuery(document).ready(function($){$(".section").first().prepend($(".about-author-content").html());});
                                </script>
                                <div class="about-author-content" style="display: none;">
                                    <div class="block" id="articleToolsInContent" style="float: right; border-bottom: 0; border: 1px solid #ddd;">
                                        <h4 class="blockTitle">Article Tools</h4>
                                        <?php if( get_post_meta(get_the_ID(),'pdf_file',true) ) { ?>
                                        <div class="articleToolItem">
                                            <img src="../plugins/blocks/readingTools/icons/abstract.png" class="articleToolIcon">
                                            <a target="_blank" href="<?php echo add_query_arg( 'galley', 'pdf', get_permalink(get_the_ID()) ); ?>" class="file" target="_parent">PDF</a><br>
                                        </div>
                                        <?php } ?>
                                        <div class="articleToolItem">
                                            <img src="../plugins/blocks/readingTools/icons/printArticle.png" class="articleToolIcon"> <a target="_blank" href="javascript:void(0);">Print this article</a>
                                        </div>
                                        <div class="articleToolItem">
                                            <img src="../plugins/blocks/readingTools/icons/metadata.png" class="articleToolIcon"> <a target="_blank" href="javascript:void(0);">Indexing metadata</a><br>
                                        </div>
                                        <div class="articleToolItem">
                                            <img src="../plugins/blocks/readingTools/icons/citeArticle.png" class="articleToolIcon"> <a target="_blank" href="javascript:void(0);">How to cite item</a><br>
                                        </div>
                                        <div class="articleToolItem">
                                            <img src="../plugins/blocks/readingTools/icons/findingReferences.png" class="articleToolIcon"> <a target="_blank" href="javascript:void(0);">Finding References</a>
                                        </div>
                                        <div class="articleToolItem">
                                            <img src="../plugins/blocks/readingTools/icons/emailArticle.png" class="articleToolIcon">
                                            Email this article <span style="font-size: 0.8em">(Login required)</span>
                                        </div>
                                        <div class="articleToolItem">
                                            <img src="../plugins/blocks/readingTools/icons/emailArticle.png" class="articleToolIcon">
                                            Email the author <span style="font-size: 0.8em">(Login required)</span>
                                        </div>
                                        <div class="articleToolItem">
                                            <img src="../plugins/blocks/readingTools/icons/postComment.png" class="articleToolIcon">
                                            <a target="_blank" href="javascript:void(0);">Post a Comment</a>
                                        </div>
                                    </div>
                                </div>
                                <?php
                                the_content();
                            }
                            else {
                                ?>
                                <div id="authorString">
                                    <em>
                                        <?php
                                        $authors = get_post_meta(get_the_ID(), 'authors', true);
                                        foreach($authors as $author) {
                                            if($author['primary_contact']) {
                                                echo $author['first_name'].' '.$author['middle_name'].' '.$author['last_name'];
                                                break;
                                            }
                                        }
                                        ?>
                                    </em>
                                </div>
                                <br/>
                                <div id="articleAbstract">
                                    <h4>Abstract</h4>
                                    <div><?php the_excerpt(); ?></div>
                                </div>
                                <div id="articleFullText">
                                    <h4>Full Text:</h4>
                                    <a class="file" href="<?php echo add_query_arg( 'galley', 'html', get_permalink(get_the_ID()) ); ?>">Full text</a>
                                    <a class="file" href="<?php echo add_query_arg( 'galley', 'pdf', get_permalink(get_the_ID()) ); ?>">PDF</a>
                                </div>
                                <?php

                            }
                        }
                        ?>

                        <?php if(get_post_type() == 'page') the_content(); ?>
                    </div>
                    <?php


                // end while
            } // end if
            ?>
        </div>
        <div class="col-md-3 blocks">
            <?php get_sidebar(); ?>
        </div>
    </div>
</div>


<?php get_footer(); ?>