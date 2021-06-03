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
    $postId = get_post_meta(get_the_ID(), 'articles', true);
    $t_post = get_post($postId);
    ?>
    <?php if (isset($_GET['galley']) && $_GET['galley'] == 'html') { ?>
        <div id="html-article" class="col-md-10 col-sm-12">
            <div id="article-header-label">
                <div id="article-header-left-details">
                    <span id="article-volume-label"><?php echo "Vol " . $volume . ", Issue " . $issue; ?></span>
                    <span id="red-oval"></span>
                    <span id="article-date-of-publication">Date of Publication: <?php
                        $publish_date = get_post_meta($t_post->ID, 'article_pub_date', true);
                        echo date("F d, Y", strtotime($publish_date)); ?></span>
                </div>

                <?php if (get_field('doi')) { ?>
                    <span id="article-doi"> DOI: <a href="<?php the_field('doi_link'); ?>" id="article-doi-link"
                        ><?php the_field('doi_link'); ?></a>
                            </span>
                <?php } ?>
            </div>
            <div class="article_count_container">
                <img src="<?php echo THEME_URL; ?>/images/icons/View.svg" class="viewIcon">
                <div class="lds-ellipsis" id="place-holder"><p id="article_count"></p>
                    <div></div>
                </div>
                <div style="margin-left: 3px;">Views</div>
                <div>,&nbsp;PDF Downloads:</div>
                <div class="lds-ellipsis" id="pdf-place-holder"><p id="pdfDownloadCount"></p>
                    <div></div>
                </div>

            </div>

            <!--                                          If article is an old article if id < $articleCutoffId then just put the content and show authors at bottom-->
            <div class="singleContentArticle oldArticles"
                 style="margin-top: 100px"><?php the_content(); ?></div>

            <!--Paynow-->
            <!------------------->
            <div class="article-separator"></div>
            <div class="author-section-bottom">
                <div class="blockTitle"> About the Authors</div>

                <?php
                $authors = get_post_meta(get_the_ID(), 'authors', true);
                if (!empty($authors)) {
                    foreach ($authors as $key => $author) { ?>
                        <div class="authorBio">
                            <div>
                                <div>
                                    <em><?php echo $author['first_name'] . ' ' . $author['middle_name'] . ' ' . $author['last_name'] ?></em>
                                    <?php if (array_key_exists("email", $author)){ ?>
                                    <a href="mailto:<?php echo $author['email']; ?>">
                                        (<?php echo $author['email']; ?>)</a></div>
                                <?php } else echo ""; ?>
                                <div class="author-subtext"><?php echo $author['biography']; ?></div>
                                <div class="author-subtext"><?php echo $author['affiliation']; ?></div>
                            </div>
                        </div>
                        <?php
                    }
                } ?>
            </div>
            <!--Manuscript Editor-->
            <?php
            $peersArray = [];
            $peers = get_post_meta(get_the_ID(), 'peers', true);
            if ($peers) {
                foreach ($peers as $key => $peer) {
                    $peersArray[$key] = $peer['name'];
                }
            }
            $peerNames = implode(', ', $peersArray);
            ?>
            <?php if (get_field('manuscript_editor') || !empty($peerNames)) {
                echo "<div class=\"article-separator\"></div>";
            } ?>

            <?php if (get_field('manuscript_editor')) { ?>
                <div class="manuscript-editor">Manuscript Editor: <span
                            class="manuscript-editor-name"><?php the_field('manuscript_editor'); ?></span></div>

            <?php } ?>

            <?php if (!empty($peerNames)) { ?>
                <div class="peer-reviewer">Peer Reviewers:
                    <span class="peer-reviewer-name"><?php echo $peerNames ?></span>
                </div>

            <?php } ?>
            <div class="article-separator"></div>
            <!--Peer Reviewer-->
            <!------------------->
        </div>
        <!--    End of bottom Author Section-->
    <?php } else { ?>


    <div id="html-article" class="col-md-10 col-sm-12">

        <div id="article-header-label">
            <div id="article-header-left-details">
                <span id="article-volume-label"><?php echo "Vol " . $volume . ", Issue " . $issue; ?></span>
                <span id="red-oval"></span>
                <span id="article-date-of-publication">Date of Publication: <?php
                    $publish_date = get_post_meta($t_post->ID, 'article_pub_date', true);
                    echo date("F d, Y", strtotime($publish_date)); ?></span>
            </div>

            <?php if (get_field('doi')) { ?>
                <span id="article-doi"> DOI: <a href="<?php the_field('doi_link'); ?>" id="article-doi-link"
                    ><?php the_field('doi_link'); ?></a>
                            </span>
            <?php } ?>
        </div>
        <div class="article_count_container">
            <img src="<?php echo THEME_URL; ?>/images/icons/View.svg" class="viewIcon">
            <div class="lds-ellipsis" id="place-holder"><p id="article_count"></p>
                <div></div>
            </div>
            <div style="margin-left: 3px;">Views</div>
            <div>,&nbsp;PDF Downloads:</div>
            <div class="lds-ellipsis" id="pdf-place-holder"><p id="pdfDownloadCount"></p>
                <div></div>
            </div>

        </div>
        <?php $keyword = get_post_meta($post->ID, 'my_keywords'); ?>
        <!--                    <div>Keywords: --><?php //print_r($keyword) ?><!--</div>-->

        <div id="articleTitle"><?php echo get_the_title(); ?></div>
        <div style="display: flex">

        </div>
        <div id="authorString">
            <em>
                <?php
                $authors = get_post_meta(get_the_ID(), 'authors', true);
                $out = array();
                if (!empty($authors)) {
                    foreach ($authors as $key => $author) {
                        $author_name = $author['first_name'] . ' ' . $author['middle_name'] . ' ' . $author['last_name'];
                        ?>
                        <div class="author-name"
                             id="<?php echo $author['first_name'] . "-" . $author['last_name']; ?>">
                            <?php echo $author_name; ?>
                        </div>
                        <script>
                            createAuthorTooltip('<?php echo json_encode($author);?>');
                        </script>
                        <?php
                    }
                }
                ?>
            </em>
        </div>

        <div id="article-abstract-wrapper">
            <div id="abstract-label">Abstract:</div>
            <div id="article-abstract"><?php echo get_the_excerpt(); ?></div>
        </div>
        <div class="article-separator"></div>
        <div id="articleFullText">
            <h4>Full Text</h4>

            <a class="file" href="<?php echo add_query_arg('galley', 'html', get_permalink(get_the_ID())); ?>">HTML</a>
            <?php $pdf_file = get_post_meta(get_the_ID(), 'pdf_file', true); ?>

            <a href="<?php echo $pdf_file ?>"
               class="file" target="_self"
               onclick="ga('send', 'event','pdf', 'downloads', 'pdf downloads', 0,{'nonInteraction': 1});  showSupportModal('<?php echo get_permalink(get_the_ID());?>')  ">
                PDF</a><br>
        </div>

    </div>




<?php } ?>


<?php } ?>
<?php } ?>
<div id="sidebar" class="col-md-2">
    <div class="block" id="articleToolsInContent">
        <div class="addthis_container">

            <!-- Go to www.addthis.com/dashboard to customize your tools -->
            <div class="addthis_inline_share_toolbox"></div>

        </div>

        <div id="article-tools-title">Article Tools:</div>
        <?php
        $pdf_file = get_post_meta(get_the_ID(), 'pdf_file', true);
        if ($pdf_file) { ?>
            <div class="articleToolItem">
                <img src="<?php echo THEME_URL; ?>/images/article-tool-icons/Download_PDF.svg"
                     class="articleToolIcon">
                <a href="<?php echo $pdf_file ?>"
                   class="article-tool-item-name" target="_self"
                   onclick="ga('send', 'event','pdf', 'downloads', 'pdf downloads', 0,{'nonInteraction': 1});   showSupportModal('<?php echo get_permalink(get_the_ID()); ?>') ">
                    Download PDF</a><br>
            </div>
        <?php } ?>
        <div class="articleToolItem">
            <img src="<?php echo THEME_URL; ?>/images/article-tool-icons/Print_article.svg" class="articleToolIcon">
            <a
                    target="_blank"
                    class="article-tool-item-name"
                    href="<?php echo add_query_arg('galley', 'print', get_permalink(get_the_ID())); ?>">Print
                this article</a>
        </div>

        <div class="articleToolItem">
            <img src="<?php echo THEME_URL; ?>/images/article-tool-icons/Indexing_metadata.svg"
                 class="articleToolIcon"> <a href="#"
                                             class="article-tool-item-name"
                                             onclick="window.open('<?php echo add_query_arg('galley', 'index', get_permalink(get_the_ID())); ?>','_blank')">Indexing
                metadata</a><br>
        </div>
        <div class="articleToolItem">
            <img src="<?php echo THEME_URL; ?>/images/article-tool-icons/How_to_cite_item.svg"
                 class="articleToolIcon"> <a
                    class="article-tool-item-name"
                    href="<?php echo add_query_arg('galley', 'citations', get_permalink(get_the_ID())); ?>"
                    target="_blank">How to cite item</a><br>
        </div>
        <div class="articleToolItem">
            <img src="<?php echo THEME_URL; ?>/images/article-tool-icons/Finding_references.svg"
                 class="articleToolIcon"> <a
                    class="article-tool-item-name"
                    href="<?php echo add_query_arg('galley', 'references', get_permalink(get_the_ID())); ?>"
                    target="_blank">Finding References</a>
        </div>

        <div class="articleToolItem">
            <img src="<?php echo THEME_URL; ?>/images/article-tool-icons/Post_comment.svg" class="articleToolIcon">
            <a href="#comments" class="article-tool-item-name">Post a Comment</a>
        </div>
    </div>
</div>
<?php
comments_template();

?>

<?php if (get_post_type() == 'page') the_content(); ?>
</div>
<?php get_footer(); ?>

<script type="text/javascript" src="//s7.addthis.com/js/300/addthis_widget.js#pubid=ra-5d1b0148a07aaf99"></script>

<script>
    jQuery(document).ready(function ($) {
        showSupportModal('<?php echo get_permalink(get_the_ID()); ?>');

        let post_slug = "<?php echo $slug = get_post_field('post_name', get_post()); ?>";
        url = "/ArticleCountAPI/article_count_api.php?article_name=" + post_slug;
        $.get(url, function (data) {
            $(".result").html(data);
            document.getElementById('place-holder').classList.remove('lds-ellipsis');
            document.getElementById('article_count').innerText = JSON.parse(data).pageView;
            document.getElementById('pdf-place-holder').classList.remove('lds-ellipsis');
            document.getElementById('pdfDownloadCount').innerText = JSON.parse(data).pdfView;
        });
    });
</script>