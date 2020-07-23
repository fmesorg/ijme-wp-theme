<?php get_header(); ?>
<?php
    the_post();
?>
<div id="issue-wrapper">
    <div class="col-md-9">
        <div id="issue-title"><?php the_title(); ?></div>
        <div id="issue-header">
            <?php if (has_post_thumbnail()) { ?>
                <div id="issue-image"><?php the_post_thumbnail('medium'); ?></div>
            <?php } ?>
            <div id="issue-excerpt">
                <?php the_content(); ?>
            </div>
        </div>

        <div id="issue-articles">
            <?php
                if (get_post_type() == 'issues' && !is_archive() && get_the_ID() == 4) {
                    $postArray = array();
                    $postId = get_post_meta(get_the_ID(), 'articles', true);
                    foreach ($postId as $id) {
                        $t_post = get_post($id);
                        $postArray[] = $t_post;
                    }
                    ?>
                    <?php
                    foreach ($postArray as $t_post) {
                        if ($t_post->post_status != "trash" and $t_post->post_status != "inherit") {
                            ?>
                            <div class="row" id="online-<?php echo $t_post->ID; ?>">
                                <div class="col-md-8 col-sm-8 article-section-title-author">
                                    <div class="row">
                                        <div class="col-md-12">
                                            <a class="issue-section-article-title"
                                               href="<?php echo get_permalink($t_post->ID); ?>">
                                                <?php $new_post = get_post_meta($t_post->ID, 'show_new_button', true);
                                                    if ($new_post == 1) { ?>
                                                        <img src="<?php echo get_template_directory_uri(); ?>/images/tag-new-icon.jpg"
                                                             alt="tag-new-icon.jpg">
                                                    <?php } ?>
                                                <?php echo $t_post->post_title; ?>
                                            </a>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-12 issue-article-author">
                                            <?php
                                                $authors = get_post_meta($t_post->ID, 'authors', true);
                                                $authors_array = array();
                                                if (is_array($authors)) {
                                                    foreach ($authors as $author) $authors_array[] = $author['first_name'] . ' ' . $author['middle_name'] . ' ' . $author['last_name'];
                                                    echo implode(', ', $authors_array);
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
                                            foreach ($peers as $peer) $peers_array[] = $peer['first_name'] . ' ' . $peer['middle_name'] . ' ' . $author['last_name'];
                                            echo implode(', ', $peers_array);
                                        }
                                    ?>
                                                </div>
                                            </div> -->
                                    <!-- End Peer Review -->
                                    <div class="row">
                                        <div class="col-md-12">
                                            <?php $uri = $_SERVER['REQUEST_URI'];
                                                if (strpos($uri, 'online-first') !== false) { ?>
                                                    <p class="issue-article-date"><?php
                                                            $publish_date = get_post_meta($t_post->ID, 'article_pub_date', true);
                                                            echo date("F j, Y", strtotime($publish_date));
                                                        ?></p>
                                                
                                                <?php } else {
                                                } ?>

                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-4 col-sm-4 article-galley-file">
                                    <a class="tocPages-pg"><?php echo get_post_meta($t_post->ID, 'page_range', true); ?></a>
                                    <?php
                                        $pdfUrl = add_query_arg('galley', 'pdf', get_permalink($t_post->ID));
                                        $pdf_file = get_post_meta($t_post->ID, 'pdf_file', true);
                                        $htmlUrl = add_query_arg('galley', 'html', get_permalink($t_post->ID));
                                    ?>
                                    <a class="tocGalleyFile" href="<?php echo get_permalink($t_post->ID); ?>">View</a>
                                    <?php if (get_post_meta($t_post->ID, 'pdf_file', true)) { ?>
                                        <a class="tocGalleyFile" href="<?php echo $pdf_file; ?>">Download PDF</a>
                                    <?php } ?>
                                </div>
                            </div>
                            <?php
                        }
                    }
                }
                
                
                // Code for current issue
                
                
                if (get_post_type() == 'issues' && !is_archive() && get_the_ID() != 4) {
                    
                    $category_array = array();
                    $articles_id = get_post_meta(get_the_ID(), 'articles', true);
                    
                    foreach ($articles_id as $id) {
                        $t_post = get_post($id);
                        $category = get_the_category($t_post->ID);
                        if ($category) {
                            if (!isset($category_array[$category[0]->cat_name]))
                                $category_array[$category[0]->cat_name] = array();
                            
                            $category_array[$category[0]->cat_name][] = $t_post;
                        }
                    }
                    
                    foreach ($category_array as $category_name => $t_post_array) {
                        ?>
                        <h4 class="tocSectionTitle"><?php echo $category_name; ?></h4>
                        <?php
                        foreach ($t_post_array as $t_post) {
                            if ($t_post->post_status != "trash") {
                                ?>
                                <div class="row issue-article-row">
                                <div class="col-md-8 col-sm-8 article-section-title-author">
                                    <div class="row">
                                        <div class="col-md-12">
                                            <a class="issue-section-article-title"
                                               href="<?php echo get_permalink($t_post->ID); ?>">
                                                <?php $new_post = get_post_meta($t_post->ID, 'show_new_button', true);
                                                    if ($new_post == 1) {
                                                        ?>
                                                        <img src="<?php echo get_template_directory_uri(); ?>/images/tag-new-icon.jpg"
                                                             alt="tag-new-icon.jpg">
                                                    <?php } ?>
                                                <?php echo $t_post->post_title; ?></a>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-12 issue-article-author">
                                            <?php
                                                $authors = get_post_meta($t_post->ID, 'authors', true);
                                                $authors_array = array();
                                                //print_r($authors);
                                                if (is_array($authors)) {
                                                    foreach ($authors as $author) $authors_array[] = $author['first_name'] . ' ' . $author['middle_name'] . ' ' . $author['last_name'];
                                                    echo implode(', ', $authors_array);
                                                }
                                            ?>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-12">
                                            <p class="issue-article-date"><?php
                                                    $publish_date = get_post_meta($t_post->ID, 'article_pub_date', true);
                                                    echo date("F j, Y", strtotime($publish_date));
                                                ?>
                                            </p>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-4 col-sm-4 article-galley-file">
                                <a class="tocPages-pg"><?php echo get_post_meta($t_post->ID, 'page_range', true); ?></a>
                                <?php
                                $pdfUrl = add_query_arg('galley', 'pdf', get_permalink($t_post->ID));
                                $pdf_file = get_post_meta($t_post->ID, 'pdf_file', true);
                                $htmlUrl = add_query_arg('galley', 'html', get_permalink($t_post->ID));
                                ?>
                                <a class="tocGalleyFile" href="<?php echo get_permalink($t_post->ID); ?>">View</a>
                                <?php if (get_post_meta($t_post->ID, 'pdf_file', true)) { ?>
                                    <a class="tocGalleyFile" href="<?php echo $pdf_file; ?>">Download PDF</a>
                                <?php } ?>
                            <?php } ?>
                            </div>
                            </div>
                            <?php
                        }
                    }
                }
            ?>
        </div>
    </div>
</div>

<?php //get_footer(); ?>

