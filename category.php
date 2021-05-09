<?php
get_header();
?>

<div class="row dp-flex">
    <div class="col-md-9 blocks  margin-lr-10 margin-r-5">
        <br id="search-main">
        <div id="online-first-section-title">Category: <?php single_cat_title('', true); ?></div>


        <?php
        $categoryName = single_cat_title('', false);
        global $post;
        $articles = get_posts(array(
            'posts_per_page' => -1,
            'post_type' => 'articles',
            'category_name' => $categoryName
        ));


        $limit = 10;
        if (isset($_GET["page"])) {
            $page = $_GET["page"];
        } else {
            $page = 1;
        };
        $start_from = ($page - 1) * $limit;
        $articlesSet = array_slice($articles, $start_from, 10);


        if ($articlesSet) {
            foreach ($articlesSet as $post) :
                setup_postdata($post);
                ?>
                <div class="onlineFirst-article-wrapper dp-flex flex-column">
                    <div class="issue-article-date">
                        <?php echo date('F d, Y', strtotime($post->article_pub_date)); ?>
                    </div>
                    <div class="online-first-article-title">
                        <a href="<?php the_permalink(); ?>">
                            <?php echo wp_trim_words(get_the_title(), 8); ?></a>
                    </div>
                    <div class="online-first-article-abstract">
                        <!--                        --><?php //echo wp_trim_words(get_the_excerpt(), 40);
                        ?>
                        <?php echo mb_strimwidth(get_the_excerpt(), 0, 300, '...'); ?>
                    </div>
                    <div class="online-first-article-author">
                        <?php
                        $authors_list = get_author_list(get_the_ID());
                        echo implode(', ', $authors_list);
                        ?>
                    </div>
                </div>

            <?php
            endforeach;

            wpbeginner_numeric_posts_nav();

            $total_records = count($articles);
            $total_pages = ceil($total_records / 10);
            $pagLink = "<ul class='pagination pagination-sm'>";
            $pagLink = "";
            for ($i = 1; $i <= $total_pages; $i++) {
                if ($i == $page) {
                    $pagLink .= "<strong><a href='?page=" . $i . "' style='color:red;text-decoration:none'>" . $i . "</a></strong>&nbsp;&nbsp;";
                } elseif ($i < $page - 2 && $i != $total_pages && $i != 1 && $i < $page - 3) {
                    $pagLink .= "";
                } elseif ($i > $page + 2 && $i != $total_pages && $i != 1 && $i > $page + 3) {
                    $pagLink .= "";
                } elseif ($i > $page + 2 && $i != $total_pages && $i != 1) {
                    $pagLink .= "... ";
                } else if ($i < $page - 2 && $i != $total_pages && $i != 1) {
                    $pagLink .= "... ";
                } else {
                    $pagLink .= "<a href='?page=" . $i . "'>" . $i . "</a>&nbsp;&nbsp;";
                }

            }
            ?>
            <div class="pagination-row">
                <div align="left"><?php global $wp_query; //echo $total_results = $wp_query->found_posts; ?> </div>
                <div colspan="2" align="right">
                    <?php
                    $nextPage = $page + 1;
                    $prevPage = $page - 1;
                    if ($page != $total_pages && $page != 1) {
                        echo "<a href='?page=" . $prevPage . "'>Previous </a>" . $pagLink . "<a href='?page=" . $nextPage . "'>Next</a>";
                    } else if ($page == $total_pages) {
                        echo "<a href='?page=" . $prevPage . "'>Previous </a>" . $pagLink;
                    } else if ($page == 1) {
                        echo $pagLink . "<a href='?page=" . $nextPage . "'>Next</a>";
                    }
                    ?></div>
            </div>
            <?php
        } else {
            ?>
            <div class="col-sm-12">
                <p>No posts founds</p>
            </div>
            <?php
        }

        ?>
        </br>
        <hr>
    </div>
</div>
</div>

<?php get_footer(); ?>
