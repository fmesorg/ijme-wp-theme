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

<div class="row">
    <div class="col-md-9">

        <?php
        if (have_posts()) {
        while (have_posts()) {
        the_post();

        $issue_id = get_post_meta(get_the_ID(), 'issue_post_id', true);
        $volume = get_post_meta($issue_id, 'volume', true);
        ?>
        <div id="main">
            <?php if (get_the_ID() == '2177') { ?>

                <div id="breadcrumb">
                    <a href="<?php echo site_url(); ?>">Home</a> &gt;
                    <a href="javascript:void(0)">About us</a> &gt;
                    <a href="javascript:void(0)">FMES</a> &gt;
                    <a href="javascript:void(0)">FMES Brochure</a>
                </div>

            <?php } elseif (get_the_ID() == '2176' || get_the_ID() == '16745' || get_the_ID() == '17727') { ?>
                <div id="breadcrumb">
                    <a href="<?php echo site_url(); ?>">Home</a> &gt;
                    <a href="javascript:void(0)">About us</a> &gt;
                    <a href="javascript:void(0)">FMES</a> &gt;
                    <a href="javascript:void(0)">Annual Report</a>
                </div>
            <?php } else { ?>

                <div id="breadcrumb">
                    <a href="<?php echo site_url(); ?>" target="_parent">Home</a>
                    <?php if ($volume) { ?>
                        &gt;<a href="<?php echo get_permalink($issue_id); ?>" target="_parent">
                            Vol <?php echo get_post_meta($issue_id, 'volume', true); ?>,
                            No <?php echo get_post_meta($issue_id, 'number', true); ?>
                            (<?php echo get_post_meta($issue_id, 'year', true); ?>)</a>
                    <?php } elseif (get_post_type() == 'articles') {
                        $categories = get_the_category();
                        if (!empty($categories)) {
                            $cat = esc_html($categories[0]->name);
                            if ($cat == "Opportunities") { ?>
                                &gt; <a href="<?php echo site_url(); ?>/issues/opportunities/">Opportunities</a>

                            <?php }
                        } else {
                            ?>
                            &gt; <a href="<?php echo site_url(); ?>/issues/online-first/">Online First</a>
                            <?php
                        }
                    } ?>

                    <?php $authors = get_post_meta(get_the_ID(), 'authors', true); ?>
                    &gt; <a href="<?php echo get_permalink(); ?>"><?php echo $authors[0]['last_name'] ?></a>
                    <?php ?>

                </div>

            <?php } ?>

            <?php //if(isset($_GET['galley']) && ($_GET['galley'] == 'html' || $_GET['galley'] == 'pdf') ) { ?>
            <!-- <div id="breadcrumb">
                        <a href="<?php echo site_url(); ?>" target="_parent">Home</a> &gt;
                        <?php if ($volume) { ?>
                        <a href="<?php echo get_permalink($issue_id); ?>" target="_parent">Vol <?php echo get_post_meta($issue_id, 'volume', true); ?>, No <?php echo get_post_meta($issue_id, 'number', true); ?> (NS) (<?php echo get_post_meta($issue_id, 'year', true); ?>)</a> &gt;
                        <?php } ?>
                        <a href="<?php echo get_permalink(); ?>" class="current" target="_parent">Mariaselvam</a>
                    </div> -->
            <?php //} ?>

            <div id="content">
                <div class="addthis_container">
                    <a href="http://www.addthis.com/bookmark.php"
                       onmouseover="return addthis_open(this, '', '', '<?php echo get_the_title(); ?>')"
                       onmouseout="addthis_close()" onclick="return addthis_sendto()"> <img
                                src="https://s7.addthis.com/static/btn/lg-share-en.gif" width="125" height="16"
                                border="0" alt="Bookmark and Share" style="border:0;padding:0"> </a>
                    <script type="text/javascript" src="https://s7.addthis.com/js/200/addthis_widget.js"></script>
                </div>
                <?php
                if (isset($_GET['galley']) && $_GET['galley'] == 'pdf') {
                    $pdf_file = get_post_meta(get_the_ID(), 'pdf_file', true);
                    if ($pdf_file) {
                        ?>

                        <div id="pdfDownloadLinkContainer">
                            <!-- <a class="action pdf" id="pdfDownloadLink" target="_parent" onclick="_gaq.push([‘_trackEvent’,’Download’,’PDF’,this.href]);" href="<?php echo $pdf_file; ?>">Download this PDF file</a> -->
                            <a class="action pdf" id="pdfDownloadLink" target="_parent"
                               onclick="ga('send', 'event','pdf', 'downloads', 'pdf downloads', 0,{'nonInteraction': 1})"
                               href="<?php echo $pdf_file; ?>">Download this PDF file</a>
                        </div>
                        <div>
                            <p><?php if (get_field('doi')) { ?>
                                    DOI: <a href="<?php the_field('doi_link'); ?>"
                                            class="doi"><?php the_field('doi'); ?></a>
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
                        //print_r($authors);exit;
                        ?>

                        <div class="separator"><br></div>
                        <div class="visible-xs visible-sm">
                            <iframe id="pdfviewer"
                                    src="https://docs.google.com/gview?embedded=true&url=<?php echo $pdf_file; ?>&amp;embedded=true"
                                    frameborder="0" width="100%" height="400px"></iframe>
                        </div>
                        <?php if (get_the_ID() == '2176' || get_the_ID() == '16745' || get_the_ID() == '17727') {

                        } else { ?>
                            <div class="author-section-bottom">
                                <div class="blockTitle"> About the Authors</div>

                                <?php
                                $authors = get_post_meta(get_the_ID(), 'authors', true);
                                $out = array();
                                //print_r($authors);exit;
                                foreach ($authors as $key => $author) { ?>
                                    <div id="authorBio">
                                        <div>
                                            <p>
                                                <em><?php echo $author['first_name'] . ' ' . $author['middle_name'] . ' ' . $author['last_name'] ?></em>
                                                <?php if (array_key_exists("email", $author)){ ?>
                                                <a href="mailto:<?php echo $author['email']; ?>">
                                                    (<?php echo $author['email']; ?>)</a></p>
                                            <?php } else echo ""; ?>
                                            <p><?php echo $author['biography']; ?></p>
                                            <p><?php echo $author['affiliation']; ?></p>
                                        </div>
                                    </div>
                                    <div class="separator"></div>

                                <?php } ?>


                                <?php if (get_field('manuscript_editor')) { ?>
                                    <p style="color:#595959"><b>Manuscript
                                            Editor: </b> <?php the_field('manuscript_editor'); ?> </p>

                                <?php } ?>
                                <?php
                                //                                        Peer section for pdf
                                $peers = get_post_meta(get_the_ID(), 'peers', true);
                                ?>
                                <?php if (!empty($peers[0]['name'])) { ?>
                                    <p style="color:#595959"><b>Peer Reviewers: </b> <em>
                                            <?php foreach ($peers as $key => $peer) { ?>
                                                <?php echo $peer['name'] . ', '; ?>
                                            <?php } ?>
                                        </em></p>

                                <?php } ?>

                                <h3>Keywords</h3>
                                <?php
                                $articleTags = wp_get_post_tags(get_the_ID());
                                if ($articleTags) {
                                    $keywords = '';
                                    foreach ($articleTags as $articleTag) {
                                        if ($articleTag) {
                                            $keywords .= $articleTag->name . ', ';
                                        } else {
                                            $keywords .= "N/A";
                                        }
                                    }
                                    ?>

                                    <p><?php echo substr(trim($keywords), 0, -1); ?></p>
                                    <?php
                                } else {
                                    echo "<p>N/A</p>";
                                }

                                ?>

                                <h3>Refbacks</h3>
                                <?php
                                $citations = get_post_meta(get_the_ID(), 'citations', true);
                                if ($citations) {
                                    echo $citations;
                                } else { ?>
                                    <p>There are currently no refbacks.</p>
                                <?php } ?>
                                <h3>Article Views</h3>  <!-- pdf -->
                                <div class="lds-ellipsis" id="place-holder"><p id="article_count"></p>
                                    <div></div>
                                    <div></div>
                                    <div></div>
                                    <div></div>
                                </div>
                                <h3>PDF Downloads</h3>  <!-- pdf -->
                                <div class="lds-ellipsis" id="pdf-place-holder"><p id="pdfDownloadCount"></p>
                                    <div></div>
                                    <div></div>
                                    <div></div>
                                    <div></div>
                                </div>


                            </div>


                        <?php } ?>
                        <?php
                    }
                } elseif (isset($_GET['galley']) && $_GET['galley'] == 'html') {
                    ?>

                    <script>
                        jQuery(document).ready(function ($) {
                            $(".section").first().prepend($(".about-author-content").html());
                        });
                    </script>
                    <div class="about-author-content" style="display: none;">
                        <div class="block" id="articleToolsInContent"
                             style="float: right; border-bottom: 0; border: 1px solid #ddd;">
                            <h4 class="blockTitle">Article Tools</h4>
                            <?php if (get_post_meta(get_the_ID(), 'pdf_file', true)) { ?>
                                <div class="articleToolItem">
                                    <img src="<?php echo THEME_URL; ?>/images/abstract.png" class="articleToolIcon">
                                    <a href="<?php echo add_query_arg('galley', 'pdf', get_permalink(get_the_ID())); ?>"
                                       class="file" target="_parent">PDF</a><br>
                                </div>
                            <?php } ?>

                            <script>
                                jQuery(document).ready(function ($) {
                                    $('a.new-window').click(function () {
                                        window.open($(this).attr('href'), 'title', 'width=700, height=400');
                                        return false;
                                    });

                                    $.get("ijmewp/ArticleCountAPI/article_count_api.php", function (data) {
                                        $(".result").html(data);
                                    })
                                });
                            </script>
                            <div class="articleToolItem">
                                <img src="<?php echo THEME_URL; ?>/images/printArticle.png" class="articleToolIcon"> <a
                                        href="<?php echo add_query_arg('galley', 'print', get_permalink(get_the_ID())); ?>">Print
                                    this article</a>
                            </div>
                            <div class="articleToolItem">
                                <img src="<?php echo THEME_URL; ?>/images/metadata.png" class="articleToolIcon"> <a
                                        href="<?php echo add_query_arg('galley', 'index', get_permalink(get_the_ID())); ?>"
                                        onclick="window.open('<?php echo add_query_arg('galley', 'index', get_permalink(get_the_ID())); ?>')">Indexing
                                    metadata</a><br>
                            </div>
                            <div class="articleToolItem">
                                <img src="<?php echo THEME_URL; ?>/images/citeArticle.png" class="articleToolIcon"> <a
                                        href="<?php echo add_query_arg('galley', 'citations', get_permalink(get_the_ID())); ?>"
                                        class="new-window">How to cite item</a><br>
                            </div>
                            <div class="articleToolItem">
                                <img src="<?php echo THEME_URL; ?>/images/findingReferences.png"
                                     class="articleToolIcon"> <a
                                        href="<?php echo add_query_arg('galley', 'references', get_permalink(get_the_ID())); ?>"
                                        class="new-window">Finding References</a>
                            </div>
                            <div class="articleToolItem">
                                <img src="<?php echo THEME_URL; ?>/images/emailArticle.png" class="articleToolIcon"> <a
                                        href="<?php echo add_query_arg('galley', 'mail', get_permalink(get_the_ID())); ?>"
                                        class="new-window">Email this article</a>
                                <!--Email the author <span style="font-size: 0.8em">(Login required)</span> -->
                            </div>
                            <div class="articleToolItem">
                                <img src="<?php echo THEME_URL; ?>/images/emailArticle.png" class="articleToolIcon"> <a
                                        href="<?php echo add_query_arg('galley', 'mail', get_permalink(get_the_ID())) . '&to=author'; ?>"
                                        class="new-window">Email the author</a>
                                <!--Email the author <span style="font-size: 0.8em">(Login required)</span> -->
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
                if (empty($authors)){
                    echo '<div class="author-section-bottom">';
                    echo '<div class="blockTitle"> </div>';
                }else{
                ?>
                    <div class="author-section-bottom">
                        <div class="blockTitle"> About the Authors</div>

                        <?php }
                        $authors = get_post_meta(get_the_ID(), 'authors', true);
                        $out = array();
                        if (!empty($authors)) {
                            foreach ($authors as $key => $author) { ?>
                                <div id="authorBio">
                                    <div>
                                        <p>
                                            <em><?php echo $author['first_name'] . ' ' . $author['middle_name'] . ' ' . $author['last_name'] ?></em>
                                            <?php if (array_key_exists("email", $author)){ ?>
                                            <a href="mailto:<?php echo $author['email']; ?>">
                                                (<?php echo $author['email']; ?>)</a></p>
                                        <?php } else echo ""; ?>
                                        <p><?php echo $author['biography']; ?></p>
                                        <p><?php echo $author['affiliation']; ?></p>
                                    </div>
                                </div>
                                <div class="separator"></div>

                            <?php }
                        } ?>


                        <?php if (get_field('manuscript_editor')) { ?>
                            <p style="color:#595959"><b>Manuscript Editor: </b> <?php the_field('manuscript_editor'); ?>
                            </p>

                        <?php } ?>
                        <?php
                        $peers = get_post_meta(get_the_ID(), 'peers', true);
                        ?>
                        <?php if (!empty($peers[0]['name'])) { ?>
                            <p style="color:#595959"><b>Peer Reviewers: </b> <em>
                                    <?php foreach ($peers as $key => $peer) { ?>
                                        <?php echo $peer['name'] . ', '; ?>
                                    <?php } ?>
                                </em></p>

                        <?php } ?>


                        <h3>Keywords</h3>
                        <?php
                        $articleTags = wp_get_post_tags(get_the_ID());
                        if ($articleTags) {
                            $keywords = '';
                            foreach ($articleTags as $articleTag) {
                                if ($articleTag) {
                                    $keywords .= $articleTag->name . ', ';
                                } else {
                                    $keywords .= "N/A";
                                }
                            }
                            ?>

                            <p><?php echo substr(trim($keywords), 0, -1); ?></p>
                            <?php
                        } else {
                            echo "<p>N/A</p>";
                        }

                        ?>

                        <h3>Refbacks</h3>
                        <?php
                        $citations = get_post_meta(get_the_ID(), 'citations', true);
                        if ($citations) {
                            echo $citations;
                        } else { ?>
                            <p>There are currently no refbacks.</p>
                        <?php } ?>

                        <h3>Article Views</h3>  <!-- html -->
                        <p id="article_count"></p>
                        <div class="lds-ellipsis" id="place-holder">
                            <div></div>
                            <div></div>
                            <div></div>
                            <div></div>
                        </div>

                        <h3>PDF Downloads</h3>  <!-- pdf -->
                        <div class="lds-ellipsis" id="pdf-place-holder"><p id="pdfDownloadCount"></p>
                            <div></div>
                            <div></div>
                            <div></div>
                            <div></div>
                        </div>


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
                        if (!empty($authors)) {
                            foreach ($authors as $key => $author) {
                                $authStr = $author['first_name'] . ' ' . $author['middle_name'] . ' ' . $author['last_name'];
                                //if($author['primary_contact']) {
                                array_push($out, $authStr);
                                //$author['first_name'].' '.$author['middle_name'].' '.$author['last_name']
                                // break;
                                //}
                            }
                            echo implode(', ', $out);
                        }
                        ?>
                    </em>
                    <p><?php if (get_field('doi')) { ?>
                            DOI: <a href="<?php the_field('doi_link'); ?>" class="doi"><?php the_field('doi'); ?></a>
                        <?php } else { ?>
                        <?php } ?>
                    </p>


                </div>
                <br/>
                <?php if (get_the_ID() == '16706' && !is_front_page()){ ?>
                <div id="articleAbstract1" style="padding: 30px 0 0px !important;">

                    <?php }else{ ?>
                    <div id="articleAbstract">
                        <h4>Abstract</h4>
                        <?php } ?>
                        <div><?php the_excerpt(); ?></div>
                    </div>
                    <?php if (get_the_ID() != '16706' && !is_front_page()) { ?>
                        <div class="suppport_box_wrapper">
                            <div id="articleFullText">
                                <h4>Full Text</h4>
                                <?php
                                $htmlUrl = add_query_arg('galley', 'html', get_permalink(get_the_ID()));
                                $pdfUrl =  add_query_arg('galley', 'pdf', get_permalink(get_the_ID()));

                                ?>
                                <?php if($htmlUrl){?>
                                <a class="file" id="htmlBtn" onclick="showSupportModal('<?php echo $htmlUrl; ?>');"  href="#">HTML</a>
                            <?php } if(get_post_meta(get_the_ID(),'pdf_file',true)){?>
                                <a class="file" onclick="showSupportModal('<?php echo $pdfUrl; ?>');"  href="#">PDF</a>
                                <?php } ?>
                            </div>

                        </div>
                        <!-- Modal -->
                        <div id="myModal" class="modal fade" role="dialog">
                            <div class="modal-dialog">

                                <!-- Modal content-->
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                                        <h4 class="modal-title">Support Us</h4>
                                    </div>
                                    <div class="modal-body">
                                        <p>Request to pay what you want.</p>
                                        <a href="/IjmeFeesCollectionApp/index.php" target="_blank"
                                           class="btn btn-warning">Support</a>

                                    </div>
                                    <div class="modal-footer">
                                        <a type="button" class="btn btn-default pull-left"
                                           data-dismiss="modal">Cancel</a>
                                        <a type="button" class="btn btn-default"
                                           href="<?php echo add_query_arg('galley', 'html', get_permalink(get_the_ID())); ?>">HTML</a>
                                        <a type="button" class="btn btn-default"
                                           href="<?php echo add_query_arg('galley', 'pdf', get_permalink(get_the_ID())); ?>">PDF</a>
                                    </div>
                                </div>

                            </div>
                        </div>
                        <?php
                        if (get_ojs_article_ID(get_the_ID()) > 0) {
                            ; ?>
                            <div id="articleHistory">
                                <h4>Article History</h4>
                                <p class="articleHistory-item">Date
                                    Submitted:<?php echo get_submission_date(get_ojs_article_ID(get_the_ID())); ?></p>
                                <p class="articleHistory-item">Date
                                    Published: <?php echo get_published_date(get_ojs_article_ID(get_the_ID())); ?></p>
                            </div>
                        <?php }
                    } ?>
                    <div class="separator"></div>

                    <!--h3>Date of Submission</h3>
							<p><?php //if(get_field('article_submission_date')){ ?> 
								<?php //the_field('article_submission_date'); ?>
								<?php //} 
                    //else { echo "N/A"; }
                    ?>
							</p-->

                    <h3>Keywords</h3>
                    <?php
                    $articleTags = wp_get_post_tags(get_the_ID());
                    if ($articleTags) {
                        $keywords = '';
                        foreach ($articleTags as $articleTag) {
                            if ($articleTag) {
                                $keywords .= $articleTag->name . ', ';
                            } else {
                                $keywords .= "N/A";
                            }
                        }
                        ?>
                        <p><?php echo substr(trim($keywords), 0, -1); ?></p>
                        <?php
                    } else {
                        echo "<p>N/A</p>";
                    }
                    ?>

                    <h3>Refbacks</h3>
                    <?php
                    $citations = get_post_meta(get_the_ID(), 'citations', true);
                    if ($citations) {
                        echo $citations;
                    } else { ?>
                        <p>There are currently no refbacks.</p>
                    <?php } ?>

                    <h3>Article Views</h3>  <!-- html -->
                    <div class="lds-ellipsis" id="place-holder"><p id="article_count"></p>
                        <div></div><div></div><div></div><div></div>
                    </div>
                    <h3>PDF Downloads</h3>  <!-- pdf -->
                    <div class="lds-ellipsis" id="pdf-place-holder"><p id="pdfDownloadCount"></p>
                        <div></div><div></div><div></div><div></div>
                    </div>

                    <?php

                    }

                    ?>

                    <?php if (get_post_type() == 'page') the_content(); ?>
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
                jQuery(document).ready(function ($) {
                    let post_slug = "<?php echo $slug = get_post_field('post_name', get_post()); ?>";
                    url = "/ArticleCountAPI/article_count_api.php?article_name=" + post_slug;
                    $.get(url, function (data) {
                        $(".result").html(data);
                        document.getElementById('place-holder').classList.remove('lds-ellipsis');
                        document.getElementById('article_count').innerText = JSON.parse(data).pageView;
                        document.getElementById('pdf-place-holder').classList.remove('lds-ellipsis');
                        document.getElementById('pdfDownloadCount').innerText = JSON.parse(data).pdfView;
                    })
                });
            </script>
        </div>
        <div class="clearfix visible-xs visible-sm"></div>
        <div class="col-md-3">
            <?php get_sidebar(); ?>
        </div>
    </div>


    <?php get_footer(); ?>


        
