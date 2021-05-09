<div id="results" class="search-result-page">
    <div width="100%" class="listing">
        <hr/>
        <div id="search-result-title">Search Results</div>
            <?php
            while ( have_posts() ) {
                the_post();

                $issue_id = get_post_meta(get_the_ID(),'issue_post_id',true);
                $volume = get_post_meta($issue_id,'volume',true);
                $number = get_post_meta($issue_id,'number',true);
                $year = get_post_meta($issue_id,'year',true);
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
                        <!--                        --><?php //echo wp_trim_words(get_the_excerpt(), 40); ?>
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
            }
            ?>

            <?php
            global $paged;
            if(empty($paged)) $paged = 1;
            ?>

        <div class="pagination-row">
            <div align="left"><?php global $wp_query; //echo $total_results = $wp_query->found_posts; ?> </div>
            <div colspan="2" align="right">
                    <?php wpbeginner_numeric_posts_nav(); ?>
            </div>
        </div>
        </tbody>
    </div>
    <div class="search-instructions">
        <hr/>
        Search tips:
        <ul>
            <li>Search terms are case-insensitive</li>
            <li>Common words are ignored</li>
            <li>By default only articles containing <em>all</em> terms in the query are returned (i.e., <em>AND</em> is implied)</li>
            <li>Combine multiple words with <em>OR</em> to find articles containing either term; e.g., <em>education OR research</em></li>
            <li>Use parentheses to create more complex queries; e.g., <em>archive ((journal OR conference) NOT theses)</em></li>
            <li>Search for an exact phrase by putting it in quotes; e.g., <em>"open access publishing"</em></li>
            <li>Exclude a word by prefixing it with <strong>-</strong> or <em>NOT</em>; e.g. <em>online -politics</em> or <em>online NOT politics</em></li>
            <li>Use <strong>*</strong> in a term as a wildcard to match any sequence of characters; e.g., <em>soci* morality</em> would match documents containing "sociological" or "societal"</li>
        </ul>
    </div>
</div>
