<?php
global $post;
$articles = get_posts(array(
    'posts_per_page' => 5,
    'post_type' => 'articles',
    'category' => 3,
    'meta_query' => array(
    // meta query takes an array of arrays, watch out for this!
    array(
        'key'     => 'issue_post_id',
        'value'   => array('4'),  //4 is for online first
        'compare' => 'IN'
    )
    )
));

if ($articles) {
    foreach ($articles as $post) :
        setup_postdata($post);
        ?>
        <div class="carousel-cell">
            <div class="carousel-cell-post-type">Online First</div>
            <div class="carousel-cell-post-date"><?php echo date('F d, Y', strtotime($post->post_date)); ?></div>
            <div class="carousel-cell-post-title"><a href="<?php the_permalink(); ?>">
                    <?php echo wp_trim_words(get_the_title(), 8); ?>
                </a>
            </div>
            <div class="carousel-cell-post-author">
                    <?php
                    $authors = get_post_meta(get_the_ID(), 'authors', true);
                    $out = array();
                    foreach ($authors as $key => $author) {
                        $authStr = $author['first_name'] . ' ' . $author['middle_name'] . ' ' . $author['last_name'];
                        array_push($out, $authStr);
                    }
                    echo implode(', ', $out);

                    ?>
            </div>
            <div class="carousel-cell-post-abstract">
                <?php echo wp_trim_words(get_the_excerpt(), 70); ?>
            </div>
            <div class="carousel-cell-post-extra">
                <a href="<?php the_permalink(); ?>">Continue Reading...</a></div>
        </div>
    <?php
    endforeach;
    wp_reset_postdata();
}


global $post;

$articles = get_posts(array(
    'posts_per_page' => 5,
    'post_type' => 'articles',
    'category' => 3,
    'meta_query' => array(
        // meta query takes an array of arrays, watch out for this!
        array(
            'key'     => 'issue_post_id',
            'value'   => array('4',get_current_issue()),  //4 is for online first & remove articles from current issue
            'compare' => 'NOT IN'
        )
    )
));


if ($articles) {
    foreach ($articles as $post) :
        setup_postdata($post);
    ?>
                <div class="carousel-cell">
                    <div class="carousel-cell-post-type">From Archive</div>
                    <div class="carousel-cell-post-date"><?php echo date('F d, Y', strtotime($post->post_date)); ?></div>
                    <div class="carousel-cell-post-title"><a href="<?php the_permalink(); ?>">
                            <?php echo wp_trim_words(get_the_title(), 8);?>
                        </a></div>
                    <div class="carousel-cell-post-abstract">
                        <?php echo wp_trim_words(get_the_excerpt(), 70);?>
                    </div>
                    <div class="carousel-cell-post-extra">
                        <a href="<?php the_permalink();?>">Continue Reading...</a></div>
                </div>

<?php
    endforeach;
    wp_reset_postdata();

}
    ?>

<?php
function get_current_issue(){
    global $post;
    $articles = get_posts(array(
        'posts_per_page' => 1,
        'post_type' => 'issues'
    ));

    $current_issue_id = 0;

    if ($articles) {
        foreach ($articles as $post) :
            setup_postdata($post);
            $current_issue_id = get_the_ID();

        endforeach;
        wp_reset_postdata();
    }

    return $current_issue_id;

}