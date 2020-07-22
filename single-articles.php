<?php
    if (isset($_GET['galley']) && $_GET['galley'] == 'print') {
        get_template_part('article', 'print');
        return;
    } elseif (isset($_GET['galley']) && $_GET['galley'] == 'index') {
        get_template_part('article', 'index');
        return;
    } elseif (isset($_GET['galley']) && $_GET['galley'] == 'citations') {
        get_template_part('article', 'citations');
        return;
    } elseif (isset($_GET['galley']) && $_GET['galley'] == 'references') {
        get_template_part('article', 'find-references');
        return;
    } elseif (isset($_GET['galley']) && $_GET['galley'] == 'mail') {
        get_template_part('article', 'mail');
        return;
    }
?>
<?php get_header(); ?>
<!---->
<!--vol date of pub-->
<!--title if not present-->
<!--authors-->
<!--views-->
<!--Abstract-->
<!--Paynow-->
<!--Content-->
<!------------------->
<!--Manuscript Editor-->
<!--Peer Reviewer-->
<!------------------->
<!--Comment box-->
<!--comments-->
<!------------------->
<!--Recommended Articles-->

<div class="row article-wrapper">
    <?php
        if (have_posts()) {
            while (have_posts()) {
                the_post();
                $issue = get_post_meta(get_the_ID(), 'xml_issue', true);
                $volume = get_post_meta(get_the_ID(), 'xml_volume', true);
                ?>
                <div id="html-article" class="col-md-10 col-sm-12">
                    <div id="article-header-label">
                        <div id="article-header-left-details">
                            <span id="article-volume-label"><?php echo "Vol ".$volume.", Issue ".$issue; ?></span>
                            <span id="red-oval"></span>
                            <span id="article-date-of-publication">Date of Publication : <?php echo get_the_date('F d ,Y'); ?></span>
                        </div>
                        
                        <?php if (get_field('doi')) { ?>
                            <span id="article-doi"> DOI: <a href="<?php the_field('doi_link'); ?>" id="article-doi-link"
                                ><?php the_field('doi_link'); ?></a>
                            </span>
                        <?php } ?>
                    </div>
                    <?php
                        if (get_the_ID() >= 20) { //Change this to the current post number, from here the header will be used and removed from the template in article
                            ?>
                            <div id="articleTitle"><h3><?php echo get_the_title(); ?></h3></div>
                            <div id="authorString">
                                <em>
                                    <?php
                                        $authors = get_post_meta(get_the_ID(), 'authors', true);
                                        $out = array();
                                        if (!empty($authors)) {
                                            foreach ($authors as $key => $author) {
                                                $authStr = $author['first_name'] . ' ' . $author['middle_name'] . ' ' . $author['last_name'];
                                                //if($author['primary_contact']) {
                                                array_push($out, $authStr);
                                            }
                                            echo implode(', ', $out);
                                        }
                                    ?>
                                </em>
                            </div>
                            <div class="article_count_container">
                                <img src="<?php echo THEME_URL; ?>/images/icons/View.svg" class="viewIcon">
                                    <div class="lds-ellipsis" id="place-holder"><p id="article_count"></p>
                                        <div></div>
                                    </div>
                                <div style="margin-left: 3px;">Views</div>

                                <script>
                                  jQuery(document).ready(function ($) {
                                    let post_slug = "<?php echo $slug = get_post_field('post_name', get_post()); ?>";
                                    url = "/ArticleCountAPI/article_count_api.php?article_name=" + post_slug;
                                    $.get(url, function (data) {
                                      console.log("Slug", url);
                                      $(".result").html(data);
                                      document.getElementById('place-holder').classList.remove('lds-ellipsis');
                                      document.getElementById('article_count').innerText = JSON.parse(data).pageView;
                                    });
                                  });
                                </script>
                            </div>

                            <div id="article-abstract-wrapper">
                                <div id="abstract-label">Abstract:</div>
                                <div id="article-abstract"><?php echo get_the_excerpt(); ?></div>
                            </div>
                            <div class="singleContentArticle" style="margin-top: 100px"><?php the_content(); ?></div>
                        <?php } else {
                            ?>
                            <div class="singleContentArticle" style="margin-top: 100px"><?php the_content(); ?></div>
                        <?php }
                    ?>
                    <!--Paynow-->
                    <!------------------->
                    <!--Manuscript Editor-->
                    <!--Peer Reviewer-->
                    <!------------------->
                </div>
                <div id="sidebar" class="col-md-2">
                    <div class="block" id="articleToolsInContent">
                        <div id="article-tools-title">Article Tools:</div>
                        <?php
                            $pdf_file = get_post_meta(get_the_ID(), 'pdf_file', true);
                            if ($pdf_file) { ?>
                                <div class="articleToolItem">
                                    <img src="<?php echo THEME_URL; ?>/images/article-tool-icons/Download_PDF.svg" class="articleToolIcon">
                                    <a href="<?php echo $pdf_file ?>"
                                       class="article-tool-item-name" target="_blank"
                                       onclick="ga('send', 'event','pdf', 'downloads', 'pdf downloads', 0,{'nonInteraction': 1})">
                                        Download PDF</a><br>
                                </div>
                            <?php } ?>
                        <div class="articleToolItem">
                            <img src="<?php echo THEME_URL; ?>/images/article-tool-icons/Print_article.svg" class="articleToolIcon"> <a
                                    class="article-tool-item-name"
                                    href="<?php echo add_query_arg('galley', 'print', get_permalink(get_the_ID())); ?>">Print
                                this article</a>
                        </div>
                        
                        <div class="articleToolItem">
                            <img src="<?php echo THEME_URL; ?>/images/article-tool-icons/Indexing_metadata.svg" class="articleToolIcon"> <a href="#"
                                                                                                                class="article-tool-item-name"
                                                                                                                onclick="window.open('<?php echo add_query_arg('galley', 'index', get_permalink(get_the_ID())); ?>','_blank')">Indexing
                                metadata</a><br>
                        </div>
                        <div class="articleToolItem">
                            <img src="<?php echo THEME_URL; ?>/images/article-tool-icons/How_to_cite_item.svg" class="articleToolIcon"> <a
                                    class="article-tool-item-name"
                                    href="<?php echo add_query_arg('galley', 'citations', get_permalink(get_the_ID())); ?>"
                                    target="_blank">How to cite item</a><br>
                        </div>
                        <div class="articleToolItem">
                            <img src="<?php echo THEME_URL; ?>/images/article-tool-icons/Finding_references.svg" class="articleToolIcon"> <a
                                    class="article-tool-item-name"
                                    href="<?php echo add_query_arg('galley', 'references', get_permalink(get_the_ID())); ?>"
                                    target="_blank">Finding References</a>
                        </div>
                        <div class="articleToolItem">
                            <img src="<?php echo THEME_URL; ?>/images/article-tool-icons/Email_the_author.svg" class="articleToolIcon"> <a
                                    class="article-tool-item-name"
                                    href="<?php echo add_query_arg('galley', 'mail', get_permalink(get_the_ID())) . '&to=author'; ?>"
                                    target="_blank">Email the author</a>
                        </div>
                        <div class="articleToolItem">
                            <img src="<?php echo THEME_URL; ?>/images/article-tool-icons/Post_comment.svg" class="articleToolIcon">
                            <a href="#comments" class="article-tool-item-name">Post a Comment</a>
                        </div>
                    </div>
                </div>
                <?php
                comments_template();
            }
        } ?>
    
    <?php if (get_post_type() == 'page') the_content(); ?>
</div>
<?php get_footer(); ?>


