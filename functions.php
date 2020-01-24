<?php

define('THEME_URL', get_template_directory_uri());
define('THEME_PATH', get_template_directory());
//define('IJME_URL', get_site_url ().'/submissions'. '/index.php/ijme/user');
define('IJME_URL', get_site_url() . '/submission');
define('ISSN', '0975-5691');

function ijme_theme_setup()
{
    add_theme_support('post-thumbnails');
}

add_action('after_setup_theme', 'ijme_theme_setup');

$online_issue_id = 4;

$online_only_main_post_ids = array(2189, 2185);

$current_issue_id = 8;
$current_issue_main_article_id = 2152;
$current_issue_sec_article_id = 2153;

$cat_reviews_id = 16;
$cat_reports_id = 23;
$cat_comments_id = 20;
$cat_articles_id = 3;
$cat_editorial_id = 2;

$online_only_section_post_ids = array(2173, 2172);

require_once('wp_bootstrap_navwalker.php');


/**
 * Enqueue scripts and styles for front end
 */
function enqueue_front_end_scripts()
{


    wp_enqueue_style('pkp-common', THEME_URL . '/css/pkp-common.css', [], '4.7.0');
    wp_enqueue_style('rt', THEME_URL . '/css/rt.css');

    wp_enqueue_style('common-pkp', THEME_URL . '/css/common.css', [], '4.8.1');

    wp_enqueue_style('compiled', THEME_URL . '/css/compiled.css');
    wp_enqueue_style('bootstrap', THEME_URL . '/css/bootstrap.min.css');

    wp_enqueue_style('sidebar', THEME_URL . '/css/sidebar.css');
    wp_enqueue_style('rightSidebar', THEME_URL . '/css/rightSidebar.css');
    wp_enqueue_style('custom', THEME_URL . '/css/custom.css', [], '4.6.10');
    wp_enqueue_style('g-font', 'https://fonts.googleapis.com/css?family=Open+Sans|Roboto&display=swap');

    wp_enqueue_style('owl-theme', THEME_URL . '/css/owl.theme.css');
    wp_enqueue_style('owl-css', THEME_URL . '/css/owl.carousel.css');


    //wp_enqueue_style( 'bootstrap', "https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" );
    wp_enqueue_style('main', get_stylesheet_uri(), [], '3.7.1.0');
    wp_enqueue_style('media-css', THEME_URL . '/css/media.css');
    wp_enqueue_style('jBox-css', THEME_URL . '/css/jBox.all.min.css');
    wp_enqueue_style('flickity', THEME_URL . '/css/flickity.min.css');

    wp_enqueue_script('jquery');
    wp_enqueue_script('owl-js', THEME_URL . '/js/owl.carousel.min.js');
    wp_enqueue_script('bootstrap-js', THEME_URL . '/js/bootstrap.min.js');
    wp_enqueue_script('pdf-js', THEME_URL . '/js/pdf.min.js');
    wp_enqueue_script('custom', THEME_URL . '/js/custom.js');
    wp_enqueue_script('jBox-js', THEME_URL . '/js/jBox.all.min.js');
    wp_enqueue_script('flickity', THEME_URL . '/js/flickity.pkgd.min.js');

    //wp_enqueue_script( 'script-name', get_template_directory_uri() . '/js/example.js', array(), '1.0.0', true );
}

add_action('wp_enqueue_scripts', 'enqueue_front_end_scripts');


add_action('after_setup_theme', 'register_menus');
function register_menus()
{
    register_nav_menus(array(
        'main' => 'Main menu',
        'header_menu' => 'Header menu',
        'footer' => 'Footer menu'
    ));
}

function year_archive_table($year_array)
{
    $posts_array = get_posts(array(
        'meta_query' => array(
            array(
                'key' => 'year',
                'value' => $year_array,
                'compare' => 'IN'
            )
        ),
        'post_type' => 'issues',
        'posts_per_page' => -1
    ));

    //var_dump($posts_array); die;

    $year_keyed_posts_array = array();
    $max_posts = 0;

    foreach ($posts_array as $post_obj) {
        $year = get_post_meta($post_obj->ID, 'year', true);

        if (!isset($year_keyed_posts_array[$year])) {
            $year_keyed_posts_array[$year] = array();
        }

        $year_keyed_posts_array[$year][] = $post_obj;

        if (count($year_keyed_posts_array[$year]) > $max_posts) $max_posts = count($year_keyed_posts_array[$year]);
    }

    ?>
    <table class="table table-bordered">
        <tr>
            <?php for ($j = 0; $j < count($year_array); $j++) { ?>
                <th><?php echo $year_array[$j]; ?></th>
            <?php } ?>
        </tr>
        <?php
        for ($i = 0; $i < $max_posts; $i++) {
            ?>
            <tr>
                <?php
                for ($j = 0; $j < count($year_array); $j++) {
                    ?>
                    <td>
                        <?php
                        if (isset($year_keyed_posts_array[$year_array[$j]]) && isset($year_keyed_posts_array[$year_array[$j]][$i])) {
                            $post_obj = $year_keyed_posts_array[$year_array[$j]][$i];
                            //echo $post_obj->post_title;
                            ?>
                            <a href="<?php echo get_permalink($post_obj->ID); ?>">
                            <span class="month">
                                <?php
                                switch ($i) {
                                    case 0:
                                        echo "Jan-Mar";
                                        break;

                                    case 1:
                                        echo "April-June";
                                        break;

                                    case 2:
                                        echo "July-Sept";
                                        break;

                                    case 3:
                                        echo "Oct-Dec";
                                        break;

                                    default:
                                        break;
                                }
                                ?>
                                (<?php echo get_post_meta($post_obj->ID, 'volume', true); ?>-<?php echo get_post_meta($post_obj->ID, 'number', true); ?>)
                                <?php //echo $post_obj->post_title; ?>
                            </span>
                                <span class="page-no">
                                Pg 1 - 64
                            </span>
                            </a>
                            <?php
                        }
                        ?>
                    </td>
                    <?php
                }
                ?>
            </tr>
            <?php
        }
        ?>
    </table>
    <?php
}

remove_filter('the_content', 'wpautop');
remove_filter('the_excerpt', 'wpautop');

add_action('wp_ajax_mail_article', 'mail_article');
add_action('wp_ajax_nopriv_mail_article', 'mail_article');
function mail_article()
{
    if (empty($_POST['to']) || !is_email($_POST['to']))
        die("Invalid email in to");

    if (!empty($_POST['cc']) && !is_email($_POST['cc']))
        die("Invalid email in cc");

    if (!empty($_POST['bcc']) && !is_email($_POST['bcc']))
        die("Invalid email in bcc");

    if (empty($_POST['article_id']))
        die("Invalid request");

    $article_id = $_POST['article_id'];

    if (!get_permalink($article_id))
        die("Invalid request");


    $issue_id = get_post_meta($article_id, 'issue_post_id', true);
    $authors = get_post_meta($article_id, 'authors', true);
    $authors_array = array();

    $peers = get_post_meta($article_id, 'peers', true);
    $peers_array = array();

    if (is_array($authors)) {
        foreach ($authors as $author) $authors_array[] = $author['last_name'] . ' ' . $author['first_name'];
    }

    if (is_array($peers)) {
        foreach ($peers as $peer) $peers_array[] = $peer['name'];
    }

    $message = 'Thought you might be interested in seeing "' . get_the_title($article_id) . '" by ' . implode(',', $authors_array) . ' published in Vol ' . get_post_meta($issue_id, 'volume', true) . ', No ' . get_post_meta($issue_id, 'number', true) . ' (' . get_post_meta($issue_id, 'year', true) . ') of ' . get_bloginfo('name') . ' at "' . get_permalink($article_id) . '".';

    $headers = array();
    $headers[] = "From: admin@ijme.in";

    if (!empty($_POST['cc']))
        $headers[] = "Cc: " . $_POST['cc'];

    if (!empty($_POST['bcc']))
        $headers[] = "Bcc: " . $_POST['bcc'];

    if (wp_mail(
        $_POST['to'],
        htmlentities(get_the_title()), //subject
        htmlentities($message),
        $headers
    )
    )
        die("1");
    else
        die("Unable to send mail");
}

/**
 * enqueue media scripts conditionally for reports admin page
 * media scripts are required for generating the media uploader
 */
add_action('admin_enqueue_scripts', 'enqueue_media_for_reports');
function enqueue_media_for_reports()
{
    //enqueue only for reports CPT
    if (get_post_type() == 'articles') {
        wp_enqueue_media();
    }
}

function load_jquery_sortable()
{
    wp_enqueue_style('jquery-ui-sortable');
}

add_action('admin_enqueue_scripts', 'load_jquery_sortable');

/**
 * Register meta box for article.
 */
function register_issues_meta_box()
{
    add_meta_box('meta-box-id', __('Settings', 'textdomain'), 'render_issues_metabox', 'issues');
}

add_action('add_meta_boxes', 'register_issues_meta_box');

function render_issues_metabox($post)
{

    wp_nonce_field('issues_meta_box_nonce', 'meta_box_nonce');
    ?>
    <style>
        .category-sortable > li {
            border: 1px solid #ddd;
            background: #f7f7f7;
            padding: 5px 10px;
        }

        #poststuff .article-section > h3 {
            padding: 5px 0;
        }

        .article-sortable > li {
            border: 1px solid #ccc;
            background: #eee;
            padding: 5px;
        }

        .article-title {
            float: left;
            margin-top: 5px;
        }

        .article-page-range {
            float: right;
        }

        .clearfix {
            clear: both;
        }
    </style>
    <table class="form-table">
        <tbody>
        <tr>
            <th scope="row">
                <label>Number</label>
            </th>

            <td>
                <input type="text" class="regular-text" name="number"
                       value="<?php echo get_post_meta($post->ID, 'number', true); ?>">
            </td>
        </tr>
        <tr>
            <th scope="row">
                <label>Volume</label>
            </th>

            <td>
                <input type="text" class="regular-text" name="volume"
                       value="<?php echo get_post_meta($post->ID, 'volume', true); ?>">
            </td>
        </tr>
        <tr>
            <th scope="row">
                <label>Year</label>
            </th>

            <td>
                <input type="text" class="regular-text" name="year"
                       value="<?php echo get_post_meta($post->ID, 'year', true); ?>">
            </td>
        </tr>
        <tr>
            <th scope="row">
                <label>Published Date</label>
            </th>
            <td>
                <?php
                $issue_pub_date = get_post_meta($post->ID, 'issue_publish_date', true);
                ?>
                <select name="issue_pub_date[day]">
                    <option value="0">Day</option>
                    <?php
                    for ($i = 1; $i < 32; $i++) {
                        ?>
                        <option value="<?php echo str_pad($i, 2, "0", STR_PAD_LEFT); ?>" <?php if (date('d', strtotime($issue_pub_date)) == $i) echo "selected"; ?> ><?php echo $i; ?></option>
                        <?php
                    }
                    ?>
                </select>
                <select name="issue_pub_date[month]">
                    <option value="0">Month</option>
                    <?php
                    $month_array = array(
                        "1" => "January", "2" => "February", "3" => "March", "4" => "April",
                        "5" => "May", "6" => "June", "7" => "July", "8" => "August",
                        "9" => "September", "10" => "October", "11" => "November", "12" => "December",
                    );
                    foreach ($month_array as $value => $month) {
                        ?>
                        <option value="<?php echo $value; ?>" <?php if (date('n', strtotime($issue_pub_date)) == $value) echo "selected"; ?>><?php echo $month; ?></option>
                        <?php
                    }
                    ?>
                </select>
                <select name="issue_pub_date[year]">
                    <option value="0">Year</option>
                    <?php
                    $year_array = range(1995, (int)date('Y') + 5);
                    foreach ($year_array as $year) {
                        ?>
                        <option value="<?php echo $year; ?>" <?php if (date('Y', strtotime($issue_pub_date)) == $year) echo "selected"; ?>><?php echo $year; ?></option>
                        <?php
                    }
                    ?>
                </select>
            </td>
        </tr>
        <tr>
            <th scope="row" colspan="2">
                <label>Sort Articles order</label>
            </th>
        </tr>
        <tr>
            <td colspan="2">
                <?php
                $category_array = array();
                $category_obj_array = array();

                $articles_id = get_post_meta(get_the_ID(), 'articles', true);
                $strArticalList = '';
                //					print_r($articles_id);
                //Why is it checking if the first post is (0th post) is set and not a number,then define the array again. ****Bug****
                if (isset($articles_id[0]) && (!is_numeric($articles_id[0]))) {
                    $articles_id = array();
                }

                if ((isset($articles_id)) && (!empty($articles_id))) {
                $strArticalList = implode(',', $articles_id);

                foreach ($articles_id as $id) {
                    $t_post = get_post($id);

                    /* $category = get_the_category($t_post->ID);
                    if(!isset($category_array[$category[0]->cat_name]))
                    $category_array[$category[0]->cat_name] = array();

                    if(!isset($category_obj_array[$category[0]->cat_name]))
                    $category_obj_array[$category[0]->cat_name] = $category[0]; */

                    $category_array[] = $t_post;
                }
                ?>
                <ul class="category-sortable">
                    <?php
                    //foreach($category_array as $category_name=>$t_post_array) {
                    ?>
                    <li class="article-section" id="<?php //echo $category_obj_array[$category_name]->cat_ID ?>">
                        <h3><?php //echo $category_name; ?></h3>
                        <ul class="article-sortable">
                            <?php
                            foreach ($category_array as $t_post) {
                                ?>
                                <li id="<?php echo $t_post->ID; ?>">
                                    <div class="article-title">
                                        <?php echo $t_post->post_title; ?>
                                    </div>
                                    <div class="article-page-range">
                                        <input type="text" name="page_range[<?php echo $t_post->ID ?>]"
                                               value="<?php echo get_post_meta($t_post->ID, 'page_range', true); ?>"
                                               placeholder="Page range">
                                    </div>
                                    <div class="clearfix"></div>
                                </li>
                                <?php
                            }
                            ?>
                        </ul>
                    </li>
                    <?php
                    //}
                    }
                    ?>
                </ul>
                <input type="hidden" name="category_order">
                <input type="hidden" name="article_order" value="<?php echo $strArticalList ?>">
                <script>
                    jQuery(document).ready(function ($) {
                        $(".category-sortable").sortable({
                            start: function (event, ui) {
                                update_index();
                                //$(ui.item).data("startindex", ui.item.index());
                            },
                            stop: function (event, ui) {
                                update_index();
                                //self.sendUpdatedIndex(ui.item);
                            }
                        });
                        $(".article-sortable").sortable({
                            start: function (event, ui) {
                                update_index();
                                //$(ui.item).data("startindex", ui.item.index());
                            },
                            stop: function (event, ui) {
                                update_index();
                                //self.sendUpdatedIndex(ui.item);
                            }
                        });
                    });

                    function update_index() {

                        var category_order = jQuery(".category-sortable").sortable("toArray");

                        var all_article_order = [];
                        jQuery(".article-sortable").each(function () {
                            var article_order = jQuery(this).sortable("toArray");
                            //all_article_order += article_order.join(",");
                            jQuery.merge(all_article_order, article_order)
                        });
                        var article_order = jQuery(".article-sortable").sortable("toArray");

                        jQuery('input[name="category_order"]').val(category_order.join(","));
                        //jQuery('input[name="article_order"]').val(all_article_order);
                        jQuery('input[name="article_order"]').val(all_article_order.join(","));
                    }
                </script>
            </td>
        </tr>
        </tbody>
    </table>
    <?php
}

//savign the ordered articles for an issue. update the new order for an issue(post) key as "articles"
function save_issues_meta_box($post_id)
{
    if (!isset($_POST['meta_box_nonce']) || !wp_verify_nonce($_POST['meta_box_nonce'], 'issues_meta_box_nonce')) return;

    $articles = explode(",", $_POST["article_order"]);
    $articles = array_unique($articles);
    if ($articles[0] != "") {
        update_post_meta($post_id, 'articles', $articles);
    }

    update_post_meta($post_id, 'number', $_POST['number']);
    update_post_meta($post_id, 'volume', $_POST['volume']);
    update_post_meta($post_id, 'year', $_POST['year']);

    update_post_meta($post_id, 'issue_publish_date', $_POST['issue_pub_date']['year'] . '-' . $_POST['issue_pub_date']['month'] . '-' . $_POST['issue_pub_date']['day'] . ' 00:00:00');

    if (!empty($_POST['page_range'])) {
        foreach ($_POST['page_range'] as $id => $value) {
            update_post_meta($id, 'page_range', $value);
        }
    }

}

add_action('save_post', 'save_issues_meta_box');

/**
 * Register meta box for article.
 */
function register_articles_meta_box()
{
    add_meta_box('meta-box-id', __('Settings', 'textdomain'), 'render_articles_metabox', 'articles');
}

add_action('add_meta_boxes', 'register_articles_meta_box');

function render_articles_metabox($post)
{
    wp_nonce_field('article_meta_box_nonce', 'meta_box_nonce');
    ?>
    <style>
        .author-section p {
            margin-bottom: 15px
        }

        ,
        .peers-section p {
            margin-bottom: 15px
        }
    </style>
    <script>
        function add_more_authors(invoker) {
            var caller = jQuery(invoker);
            jQuery(".author-section").append(jQuery(".author-section table").first().clone().find("input:text").val("").end().find('input:checkbox').removeAttr('checked').end());
        }

        function add_more_peers(invoker) {
            var caller = jQuery(invoker);
            jQuery(".peers-section").append(jQuery(".peers-section table").first().clone().find("input:text").val("").end().find('input:checkbox').removeAttr('checked').end());
        }

        function remove_author_box(invoker) {
            var caller = jQuery(invoker);

            if (caller.closest('.author-section').find('table').length < 2) {
                alert("Atleast one author is required");
                return false;
            }

            caller.closest('table').remove();
        }

        function remove_peers_box(invoker) {
            var caller = jQuery(invoker);

            if (caller.closest('.peers-section').find('table').length < 2) {
                alert("Atleast one peer is required");
                return false;
            }

            caller.closest('table').remove();
        }
    </script>
    <script>
        jQuery(document).ready(function () {
            jQuery('.upload-pdf-btn').click(function (e) {
                e.preventDefault();
                var image = wp.media({
                    title: 'Upload Image',
                    // mutiple: true if you want to upload multiple files at once
                    multiple: false
                }).open()
                    .on('select', function (e) {
                        // This will return the selected image from the Media Uploader, the result is an object
                        var uploaded_image = image.state().get('selection').first();
                        // We convert uploaded_image to a JSON object to make accessing it easier
                        // Output to the console uploaded_image
                        var image_url = uploaded_image.toJSON().url;
                        var image_id = uploaded_image.toJSON().id;

                        jQuery('.pdf-file-link').val(image_url);
                        //jQuery('.uploaded-reports-attachment-id').val(image_id);
                    });
            });
        });
    </script>
    <table class="form-table">
        <tbody>

        <?php
        $ojsArticleID = get_post_meta($post->ID, 'ojsArticleId', true); ?>


        <tr>
            <th scope="row">
                <label>Article ID from OJS</label>
            </th>
            <?php if (empty($ojsArticleID)) { ?>
                <td>
                    <input type="text" class="medium-text" placeholder="Article ID" name="ojs_article_id" value="">
                </td>
            <?php } else { ?>

                <td>
                    <input type="text" class="medium-text" placeholder="Article ID" name="ojs_article_id"
                           value="<?php echo $ojsArticleID; ?> ">
                </td>
                <?php
            } ?>
        </tr>


        <tr>
            <th scope="row">
                <label>Authors</label>
            </th>

            <td>
                <div class="author-section">
                    <style>
                        .authors-table {
                            background: #f7f7f7;
                            margin-bottom: 15px;
                            width: 100%;
                        }

                        .authors-table label {
                            display: block;
                            font-weight: 700;
                        }

                        .authors-table td {
                            padding: 5px 10px;
                        }
                    </style>
                    <?php
                    $authors = get_post_meta($post->ID, 'authors', true);

                    if (empty($authors)) { ?>

                        <table class="authors-table">
                            <tr>
                                <td>
                                    <label>First Name</label>
                                    <input type="text" placeholder="First name" name="authors[first_name][]" value="">
                                </td>
                                <td>
                                    <label>Middle Name</label>
                                    <input type="text" placeholder="Middle name" name="authors[middle_name][]" value="">
                                </td>
                                <td>
                                    <label>Last Name</label>
                                    <input type="text" placeholder="Last name" name="authors[last_name][]" value="">
                                </td>
                                <td>
                                    <input type="checkbox" name="authors[primary_contact][]" checked value="1"/>Primary
                                    &nbsp;
                                    <a href="javascript:void(0);" onclick="return remove_author_box(this);">Delete</a>
                                </td>
                            </tr>
                            <tr>
                                <td colspan="4">
                                    <label>Affiliation</label>
                                    <input type="text" placeholder="Affiliation" class="large-text"
                                           name="authors[affiliation][]" value="">
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    <label>Country</label>
                                    <input type="text" placeholder="Eg: IN" name="authors[country][]" value="">
                                </td>
                                <td>
                                    <label>Competing Interest</label>
                                    <input type="text" name="authors[competing_interests][]" value="">
                                </td>
                                <td colspan="2">
                                    <label>Email</label>
                                    <input type="text" name="authors[email][]" value="">
                                </td>
                            </tr>
                            <tr>
                                <td colspan="4">
                                    <label>Biography</label>
                                    <input type="text" class="large-text" name="authors[biography][]" value="">
                                </td>
                            </tr>

                        </table>

                    <?php } else {
                        $authors_array = array();
                        foreach ($authors as $author) {
                            ?>
                            <table class="authors-table">
                                <tr>
                                    <td>
                                        <label>First Name</label>
                                        <input type="text" placeholder="First name" name="authors[first_name][]"
                                               value="<?php echo $author['first_name']; ?>">
                                    </td>
                                    <td>
                                        <label>Middle Name</label>
                                        <input type="text" placeholder="Middle name" name="authors[middle_name][]"
                                               value="<?php echo $author['middle_name']; ?>">
                                    </td>
                                    <td>
                                        <label>Last Name</label>
                                        <input type="text" placeholder="Last name" name="authors[last_name][]"
                                               value="<?php echo $author['last_name']; ?>">
                                    </td>
                                    <td>
                                        <input type="checkbox"
                                               name="authors[primary_contact][]" <?php if (!empty($author['primary_contact'])) echo "checked"; ?>
                                               value="1"/>Primary &nbsp;
                                        <a href="javascript:void(0);"
                                           onclick="return remove_author_box(this);">Delete</a>
                                    </td>
                                </tr>
                                <tr>
                                    <td colspan="4">
                                        <label>Affiliation</label>
                                        <input type="text" placeholder="Affiliation" class="large-text"
                                               name="authors[affiliation][]"
                                               value="<?php echo $author['affiliation']; ?>">
                                    </td>
                                </tr>
                                <tr>
                                    <td>
                                        <label>Country</label>
                                        <input type="text" placeholder="Eg: IN" name="authors[country][]"
                                               value="<?php echo $author['country']; ?>">
                                    </td>
                                    <td>
                                        <label>Competing Interest</label>
                                        <input type="text" name="authors[competing_interests][]"
                                               value="<?php echo $author['competing_interests']; ?>">
                                    </td>
                                    <td colspan="2">
                                        <label>Email</label>
                                        <input type="text" name="authors[email][]"
                                               value="<?php if (array_key_exists("email", $author)) {
                                                   echo $author['email'];
                                               } else echo ""; ?>">
                                    </td>
                                </tr>
                                <tr>
                                    <td colspan="4">
                                        <label>Biography</label>
                                        <input type="text" class="large-text" name="authors[biography][]"
                                               value="<?php echo $author['biography']; ?>">
                                    </td>
                                </tr>
                            </table>


                            <?php
                        }
                    }
                    ?>
                </div>
                <p>
                    <a href="javascript:void(0);" class="button" onclick="return add_more_authors(this);">Add More</a>
                </p>
            </td>
        </tr>
        <!-- Peer Reviewer section -->
        <tr>
            <th scope="row">
                <label>Peer Reviewers</label>
            </th>

            <td>
                <div class="peers-section">
                    <style>
                        .peers-table {
                            background: #f7f7f7;
                            margin-bottom: 15px;
                            width: 100%;
                        }

                        .peers-table label {
                            display: block;
                            font-weight: 700;
                        }

                        .peers-table td {
                            padding: 5px 10px;
                        }
                    </style>
                    <?php
                    $peers = get_post_meta($post->ID, 'peers', true);

                    if (empty($peers)) { ?>

                        <table class="peers-table">
                            <tr>
                                <td>
                                    <label>Name</label>
                                    <input type="text" placeholder="Name" name="peers[name][]" value="">
                                <td>
                                    <a href="javascript:void(0);" onclick="return remove_peers_box(this);">Delete</a>
                                </td>
                            </tr>

                        </table>

                    <?php } else {
                        $peers_array = array();
                        foreach ($peers as $peer) {
                            ?>
                            <table class="peers-table">
                                <tr>
                                    <td>
                                        <label>Name</label>
                                        <input type="text" placeholder="Name" name="peers[name][]"
                                               value="<?php echo $peer['name']; ?>">
                                    </td>
                                    <td>

                                        <a href="javascript:void(0);"
                                           onclick="return remove_peers_box(this);">Delete</a>
                                    </td>
                                </tr>

                            </table>

                            <!-- End of Peer review section-->
                            <?php
                        }
                    }
                    ?>
                </div>
                <p>
                    <a href="javascript:void(0);" class="button" onclick="return add_more_peers(this);">Add More Peer
                        Reviewer</a>
                </p>
            </td>
        </tr>
        <tr>
            <th scope="row">
                <label>Parent Issue</label>
            </th>
            <td>
                <?php
                $issue_id = get_post_meta($post->ID, 'issue_post_id', true);
                $all_issues = get_posts(array(
                    'post_type' => 'issues',
                    'post_status' => 'any',
                    'posts_per_page' => -1
                ));
                ?>
                <select name="issue_post_id">
                    <option value="0">Select</option>
                    <?php
                    foreach ($all_issues as $issue) {
                        ?>
                        <option value="<?php echo $issue->ID; ?>" <?php if ($issue->ID == $issue_id) echo "selected"; ?>><?php echo $issue->post_title . " Vol " . get_post_meta($issue->ID, 'volume', true) . " No " . get_post_meta($issue->ID, 'number', true); ?></option>
                        <?php
                    }
                    ?>
                </select>
            </td>
        </tr>
        <tr>
            <th scope="row">
                <label>PDF file</label>
            </th>
            <td>
                <input type="text" name="pdf_file" class="regular-text pdf-file-link"
                       value="<?php echo get_post_meta($post->ID, 'pdf_file', true); ?>" readonly=true/>
                <a class="button upload-pdf-btn">Upload</a>
            </td>
        </tr>
        <tr>
            <th scope="row">
                <label>Page Range</label>
            </th>
            <td>
                <input type="text" placeholder="Eg: 54 or 54-59" name="page_range"
                       value="<?php echo get_post_meta($post->ID, 'page_range', true); ?>">
            </td>
        </tr>
        <tr>
            <th scope="row">
                <label>Published Date</label>
            </th>
            <td>
                <?php
                $article_pub_date = get_post_meta($post->ID, 'article_pub_date', true);
                ?>
                <select name="article_pub_date[day]">
                    <option value="0">Day</option>
                    <?php
                    for ($i = 1; $i < 32; $i++) {
                        ?>
                        <option value="<?php echo str_pad($i, 2, "0", STR_PAD_LEFT); ?>" <?php if (date('d', strtotime($article_pub_date)) == $i) echo "selected"; ?> ><?php echo $i; ?></option>
                        <?php
                    }
                    ?>
                </select>
                <select name="article_pub_date[month]">
                    <option value="0">Month</option>
                    <?php
                    $month_array = array(
                        "1" => "January", "2" => "February", "3" => "March", "4" => "April",
                        "5" => "May", "6" => "June", "7" => "July", "8" => "August",
                        "9" => "September", "10" => "October", "11" => "November", "12" => "December",
                    );
                    foreach ($month_array as $value => $month) {
                        ?>
                        <option value="<?php echo $value; ?>" <?php if (date('n', strtotime($article_pub_date)) == $value) echo "selected"; ?>><?php echo $month; ?></option>
                        <?php
                    }
                    ?>
                </select>
                <select name="article_pub_date[year]">
                    <option value="0">Year</option>
                    <?php
                    $year_array = range(1995, (int)date('Y') + 5);
                    foreach ($year_array as $year) {
                        ?>
                        <option value="<?php echo $year; ?>" <?php if (date('Y', strtotime($article_pub_date)) == $year) echo "selected"; ?>><?php echo $year; ?></option>
                        <?php
                    }
                    ?>
                </select>
            </td>
        </tr>
        <tr>
            <th scope="row">
                <label>References</label>
            </th>
            <td>
                <textarea class="large-text" rows="10" cols="50"
                          name="citations"><?php echo get_post_meta($post->ID, 'citations', true); ?></textarea>
            </td>
        </tr>
        </tbody>
    </table>
    <?php
}

//generate array for articles issues
/**
 * Save meta box content.
 *
 * @param int $post_id Post ID
 */
function wpdocs_save_meta_box($post_id)
{
    if (!isset($_POST['meta_box_nonce']) || !wp_verify_nonce($_POST['meta_box_nonce'], 'article_meta_box_nonce')) return;

    update_post_meta($post_id, 'page_range', $_POST['page_range']);
    update_post_meta($post_id, 'citations', $_POST['citations']);

    $previous_issue_id = get_post_meta($post_id, 'issue_post_id', true);
    if ($previous_issue_id != $_POST['issue_post_id']) { //if previous Issue_post_id is different then change else leave it as is. issue_post_id remain for an article in the Db when set initially. Hence it does not go inside this block to add it to articles. ***bug**

        //Get the old Issue's "articles" and search for current article. if found remove from previous one
        $issue_articles_id = get_post_meta($previous_issue_id, 'articles', true);
        if (($key = array_search($post_id, $issue_articles_id)) !== false) {
            unset($issue_articles_id[$key]);
        }
        //no need to update the old post if not found the current article listed in the old Issue(previous_issue_id)
        update_post_meta($previous_issue_id, 'articles', $issue_articles_id);

        //add to new one.
        $issue_articles_id = get_post_meta($_POST['issue_post_id'], 'articles', true);
        if (empty($issue_articles_id)) //check if "articles" field is empty for the issue
            $issue_articles_id = array();
        $issue_articles_id[] = $post_id;
        update_post_meta($_POST['issue_post_id'], 'articles', $issue_articles_id);

        update_post_meta($post_id, 'issue_post_id', $_POST['issue_post_id']);
    }

    update_post_meta($post_id, 'pdf_file', $_POST['pdf_file']);

    update_post_meta($post_id, 'article_pub_date', $_POST['article_pub_date']['year'] . '-' . $_POST['article_pub_date']['month'] . '-' . $_POST['article_pub_date']['day'] . ' 00:00:00');

    $author_array = array();
    for ($i = 0; $i < count($_POST['authors']['first_name']); $i++) {
        $temp_array = array();
        $temp_array['first_name'] = $_POST['authors']['first_name'][$i];
        $temp_array['middle_name'] = $_POST['authors']['middle_name'][$i];
        $temp_array['last_name'] = $_POST['authors']['last_name'][$i];
        $temp_array['affiliation'] = $_POST['authors']['affiliation'][$i];
        $temp_array['country'] = $_POST['authors']['country'][$i];
        $temp_array['email'] = $_POST['authors']['email'][$i];
        $temp_array['competing_interests'] = $_POST['authors']['competing_interests'][$i];
        $temp_array['biography'] = $_POST['authors']['biography'][$i];
        $temp_array['primary_contact'] = !empty($_POST['authors']['primary_contact'][$i]) ? true : false;

        $author_array[] = $temp_array;
    }
    update_post_meta($post_id, 'authors', $author_array);

    $peer_array = array();
    for ($i = 0; $i < count($_POST['peers']['name']); $i++) {
        $temp_array2 = array();
        $temp_array2['name'] = $_POST['peers']['name'][$i];
        $peer_array[] = $temp_array2;
    }
    update_post_meta($post_id, 'peers', $peer_array);


    $ojsArticleId = $_POST['ojs_article_id'];
    update_post_meta($post_id, 'ojsArticleId', $ojsArticleId);

}

add_action('save_post', 'wpdocs_save_meta_box');

function embed_pdf($atts)
{
    $atts = shortcode_atts(
        array(
            'url' => false
        ),
        $atts
    );
    return '<div id="pdf-wrap"></div>
	<script>PDFObject.embed("' . $atts['url'] . '", "#pdf-wrap");</script>';
}

add_shortcode('embed_pdf', 'embed_pdf');

/** ============ Advance Search ============== **/
/** https://adambalee.com/search-wordpress-by-custom-fields-without-a-plugin/ **/

/**
 * Join posts and postmeta tables
 *
 * http://codex.wordpress.org/Plugin_API/Filter_Reference/posts_join
 */
function cf_search_join($join)
{
    global $wp_query, $wpdb;

    if (is_search()) {
        //if ( $wp_query->is_search ) {

        if (!empty($_REQUEST['authors']))
            $join .= ' LEFT JOIN ' . $wpdb->postmeta . ' AS authors ON ' . $wpdb->posts . '.ID = authors.post_id ';

        /*
        if(
           !empty($_REQUEST['dateFromMonth']) ||
           !empty($_REQUEST['dateFromDay']) ||
           !empty($_REQUEST['dateFromYear'])
        )
        $join .=' LEFT JOIN from_date '.$wpdb->postmeta. ' ON '. $wpdb->posts . 'ID = from_date.post_id ';

        if(
           !empty($_REQUEST['dateFromMonth']) ||
           !empty($_REQUEST['dateFromDay']) ||
           !empty($_REQUEST['dateFromYear'])
        )
        $join .=' LEFT JOIN to_date '.$wpdb->postmeta. ' ON '. $wpdb->posts . 'ID = to_date.post_id ';
        */
    }

    return $join;
}

add_filter('posts_join', 'cf_search_join');

/**
 * Search SQL filter for matching against post title only.
 *
 * @link    http://wordpress.stackexchange.com/a/11826/1685
 *
 * @param string $search
 * @param WP_Query $wp_query
 */
function wpse_11826_search_by_title($search, $wp_query)
{

    if (!is_search())
        return $search;

    if (!$wp_query->is_search)
        return $search;

    global $wpdb;
    /*
    if(empty($_REQUEST["title"]) && empty($_REQUEST["abstract"]) && empty($_REQUEST["galleyFullText"]))
    return $search;
    */

    $n = !empty($q['exact']) ? '' : '%';

    $advance_search = array();

    if (!empty($_REQUEST['title'])) {
        $parts = preg_split('/\s+/', $_REQUEST['galleyFullText']);
        foreach ($parts as $str)
            $advance_search[] = $wpdb->prepare("$wpdb->posts.post_title LIKE %s", $n . $wpdb->esc_like($str) . $n);
    }

    if (!empty($_REQUEST['abstract'])) {
        $parts = preg_split('/\s+/', $_REQUEST['galleyFullText']);
        foreach ($parts as $str)
            $advance_search[] = $wpdb->prepare("$wpdb->posts.post_excerpt LIKE %s", $n . $wpdb->esc_like($str) . $n);
    }

    if (!empty($_REQUEST['galleyFullText'])) {
        $parts = preg_split('/\s+/', $_REQUEST['galleyFullText']);
        foreach ($parts as $str)
            $advance_search[] = $wpdb->prepare("$wpdb->posts.post_content LIKE %s", $n . $wpdb->esc_like($str) . $n);
    }

    if (!empty($_REQUEST['authors'])) {
        $parts = preg_split('/\s+/', $_REQUEST['authors']);
        foreach ($parts as $str)
            $advance_search[] = $wpdb->prepare("authors.meta_value LIKE %s AND authors.meta_key=\"authors\"", '%' . $wpdb->esc_like($str) . '%');
    }

    if (!empty($search) && !empty($wp_query->query_vars['search_terms'])) {
        $search = array();


        $q = $wp_query->query_vars;
        foreach (( array )$q['search_terms'] as $term)
            //$search[] = $wpdb->prepare( "$wpdb->posts.post_title LIKE %s", $n . $wpdb->esc_like( $term ) . $n );
            $search[] = $wpdb->prepare("($wpdb->posts.post_title LIKE %s OR $wpdb->posts.post_content LIKE %s OR $wpdb->posts.post_excerpt LIKE %s)", array($n . $wpdb->esc_like($term) . $n, $n . $wpdb->esc_like($term) . $n, $n . $wpdb->esc_like($term) . $n));

        if (!is_user_logged_in())
            $search[] = "$wpdb->posts.post_password = ''";


        $search = ' AND ' . implode(' AND ', $search);
    }

    if (!empty($advance_search)) {
        $search .= ' AND ' . implode(' AND ', $advance_search);
    }


    //var_dump($search);
    return $search;
}

add_filter('posts_search', 'wpse_11826_search_by_title', 10, 2);

/**
 * Modify the search query with posts_where
 *
 * http://codex.wordpress.org/Plugin_API/Filter_Reference/posts_where
 */
function cf_search_where($where)
{
    global $pagenow, $wpdb;

    if (is_search()) {

        //echo $where;
        /*
		$where = preg_replace(
            "/\(\s*".$wpdb->posts.".post_title\s+LIKE\s*(\'[^\']+\')\s*\)/",
            "(".$wpdb->posts.".post_title LIKE $1) OR (".$wpdb->postmeta.".meta_value LIKE $1)", $where );
        */

        /*
        if( !empty($_REQUEST['authors']) )
        $where = preg_replace(
            "/\(\s*".$wpdb->posts.".post_title\s+LIKE\s*(\'[^\']+\')\s*\)/",
            "(authors.meta_value LIKE $1 AND authors.meta_key=\"authors\")", $where );
        */

        /*
        if(!empty($_REQUEST['authors'])) {
            $authors_query = $wpdb->prepare( "authors.meta_value LIKE %s AND authors.meta_key=\"authors\"", '%' . $wpdb->esc_like( $_REQUEST['authors'] ) . '%' );

            $where = preg_replace(
            "/\(\s*".$wpdb->posts.".post_title\s+LIKE\s*(\'[^\']+\')\s*\)/",
            "(".$wpdb->posts.".post_title LIKE $1) OR (".$authors_query.")", $where );
        }
        */
    }

    return $where;
}

add_filter('posts_where', 'cf_search_where');

/**
 * Prevent duplicates
 *
 * http://codex.wordpress.org/Plugin_API/Filter_Reference/posts_distinct
 */
function cf_search_distinct($where)
{
    global $wpdb;

    if (is_search()) {
        return "DISTINCT";
    }

    return $where;
}

add_filter('posts_distinct', 'cf_search_distinct');

function searchfilter($query)
{

    // If 's' request variable is set but empty
    if (isset($_GET['s']) && empty($_GET['s']) && $query->is_main_query()) {
        $query->is_search = true;
        $query->is_home = false;
    }

    if ($query->is_search && !is_admin()) {
        $query->set('post_type', array('articles'));

        $meta_query = array();

        if (
        !empty($_REQUEST['dateFromYear'])
        ) {

            $month = !empty($_REQUEST['dateFromMonth']) ? $_REQUEST['dateFromMonth'] : '01';
            $day = !empty($_REQUEST['dateFromDay']) ? $_REQUEST['dateFromDay'] : '01';
            /*
            $query->set( 'meta_query', array(
                array(
                      'key' => 'article_pub_date',
                      'value' => $_REQUEST['dateFromYear'].'-'.$month.'-'.$day.' 00:00:00',
                      'compare' => '>=',
                      'type' => 'numeric'
                )
            ));
            */
            $meta_query[] = array(
                'key' => 'article_pub_date',
                'value' => $_REQUEST['dateFromYear'] . '-' . $month . '-' . $day . ' 00:00:00',
                'compare' => '>=',
                'type' => 'numeric'
            );
        }

        if (
        !empty($_REQUEST['dateToYear'])
        ) {

            $month = !empty($_REQUEST['dateToMonth']) ? $_REQUEST['dateToMonth'] : '01';
            $day = !empty($_REQUEST['dateToDay']) ? $_REQUEST['dateToDay'] : '01';
            /*
            $query->set( 'meta_query', array(
                array(
                      'key' => 'article_pub_date',
                      'value' => $_REQUEST['dateToYear'].'-'.$month.'-'.$day.' 00:00:00',
                      'compare' => '<=',
                      'type' => 'numeric'
                )
            ));
            */
            $meta_query[] = array(
                'key' => 'article_pub_date',
                'value' => $_REQUEST['dateToYear'] . '-' . $month . '-' . $day . ' 00:00:00',
                'compare' => '<=',
                'type' => 'numeric'
            );
        }

        if (!empty($meta_query)) {
            $query->set('meta_query', $meta_query);
        }

    }

    return $query;
}

add_filter('pre_get_posts', 'searchfilter');


function wpbeginner_numeric_posts_nav()
{

    if (is_singular())
        return;

    global $wp_query;

    /** Stop execution if there's only 1 page */
    if ($wp_query->max_num_pages <= 1)
        return;

    $paged = get_query_var('paged') ? absint(get_query_var('paged')) : 1;
    $max = intval($wp_query->max_num_pages);

    /**    Add current page to the array */
    if ($paged >= 1)
        $links[] = $paged;

    /**    Add the pages around the current page to the array */
    if ($paged >= 3) {
        $links[] = $paged - 1;
        $links[] = $paged - 2;
    }

    if (($paged + 2) <= $max) {
        $links[] = $paged + 2;
        $links[] = $paged + 1;
    }

    echo '<div class="navigation pagination"><ul>' . "\n";

    /**    Previous Post Link */
    if (get_previous_posts_link())
        //printf( '<li>%s</li>' . "\n", get_previous_posts_link() );
        printf('%s&nbsp;' . "\n", get_previous_posts_link("Previous"));

    /**    Link to first page, plus ellipses if necessary */
    if (!in_array(1, $links)) {
        $class = 1 == $paged ? ' class="nav-pg-link-current"' : ' class="nav-pg-link"';

        //printf( '<li%s><a href="%s">%s</a></li>' . "\n", $class, esc_url( get_pagenum_link( 1 ) ), '1' );
        printf('<a %s href="%s">%s</a>&nbsp;' . "\n", $class, esc_url(get_pagenum_link(1)), '1');

        if (!in_array(2, $links))
            //echo '<li>…</li>';
            echo '…&nbsp;';
    }

    /**    Link to current page, plus 2 pages in either direction if necessary */
    sort($links);
    foreach ((array)$links as $link) {
        $class = $paged == $link ? ' class="nav-pg-link-current"' : ' class="nav-pg-link"';
        //printf( '<li%s><a href="%s">%s</a></li>' . "\n", $class, esc_url( get_pagenum_link( $link ) ), $link );
        printf('<a %s href="%s">%s</a>&nbsp;' . "\n", $class, esc_url(get_pagenum_link($link)), $link);
    }

    /**    Link to last page, plus ellipses if necessary */
    if (!in_array($max, $links)) {
        if (!in_array($max - 1, $links))
            //echo '<li>…</li>' . "\n";
            echo '…&nbsp;' . "\n";

        $class = $paged == $max ? ' class="nav-pg-link-current"' : ' class="nav-pg-link"';
        //printf( '<li%s><a href="%s">%s</a></li>' . "\n", $class, esc_url( get_pagenum_link( $max ) ), $max );
        printf('<a %s href="%s">%s</a>&nbsp;' . "\n", $class, esc_url(get_pagenum_link($max)), $max);
    }

    /**    Next Post Link */
    if (get_next_posts_link())
        //printf( '<li>%s</li>' . "\n", get_next_posts_link() );
        printf('%s' . "\n", get_next_posts_link("Next"));

    echo '</ul></div>' . "\n";

}

function get_removed_search_filter_param_link($param_to_remove)
{
    $all_search_params = $_GET;
    $return_query_string = '';
    if (is_array($param_to_remove)) {
        foreach ($param_to_remove as $param) unset($all_search_params[$param]);
    } else
        unset($all_search_params[$param_to_remove]);
    return site_url() . '?' . http_build_query($all_search_params);
}


function get_publication_history($publication_id)
{
    $args = array(
        'method' => 'POST',
        'body' => array(
            'publication_id' => $publication_id)
    );


    $response = wp_remote_post('http://ijme.in/submission/plugins/API/get_article_history.php', $args);
    return wp_remote_retrieve_body($response);
}


function get_submission_date($publication_id)
{
    $response = json_decode(get_publication_history($publication_id));
    echo $response->submission_date;
}


function get_published_date($publication_id)
{
    $response = json_decode(get_publication_history($publication_id));
    echo $response->published_date;
}

function get_ojs_article_ID($article_ID)
{
    return get_post_meta($article_ID, 'ojsArticleId', true);
}

remove_action('wp_head', 'rel_canonical');


//adding rest XML API
add_action('rest_api_init', function () {
    register_rest_route('xmlGenerator/v1', '/xml/(?P<id>\d+)', array(
        'methods' => 'GET',
        'callback' => 'post_xml_generator',
    ), false);
});


function post_xml_generator($data)
{

    $post_id = $data['id'];
    $post = get_post($data['id']);
    //return get_post_meta($post_id);

    $publisher_name = get_post_meta($post_id, 'xml_publisher_name', true);
    $journal_title = get_post_meta($post_id, 'xml_journal_title', true);
    $issn = get_post_meta($post_id, 'xml_issn', true);

    $pubdate = get_post_meta($post_id, 'xml_pub_date', true);
    $article_title = $post->post_title;
    $pdf_first_page = get_post_meta($post_id, 'xml_pdf_first_page', true);
    $pdf_last_page = get_post_meta($post_id, 'xml_pdf_last_page', true);
    $ELocationID = get_post_meta($post_id, 'xml_elocation_id', true);
    $language = get_post_meta($post_id, 'xml_language', true);
    $pii_id = get_post_meta($post_id, 'xml_pii_id', true);
    $doi_id = get_post_meta($post_id, 'xml_doi_id', true);
    $abstract = get_post_meta($post_id, 'xml_abstract', true);

    if (!empty(get_post_meta($post_id, 'xml_issue', true))) {

    } else {
        $issue = "-";
    }

    if (!empty(get_post_meta($post_id, 'xml_volume', true))) {
        $volume = get_post_meta($post_id, 'xml_volume', true);
    } else {
        $volume = "-";
    }


    $domImpl = new DOMImplementation();
    $dtd = $domImpl->createDocumentType("ArticleSet", "-//NLM//DTD PubMed 2.0//EN", 'http://www.ncbi.nlm.nih.gov:80/entrez/query/static/PubMed.dtd');


    $xml = $domImpl->createDocument("", "", $dtd);
    $xml->formatOutput = true;
    $xml->encoding = 'UTF-8';
    $articleSet = $xml->createElement("ArticleSet");
    $xml->appendChild($articleSet);

    $article = $xml->createElement("Article");
    $articleSet->appendChild($article);


    $journal = $xml->createElement("Journal");
    $article->appendChild($journal);

    $PublisherName = $xml->createElement("PublisherName", $publisher_name);
    $JournalTitle = $xml->createElement("JournalTitle", $journal_title);
    $Issn = $xml->createElement("Issn", $issn); //this value need to be added to wordpress so that we can fetch from the db
    $Volume = $xml->createElement("Volume", $volume);
    $Issue = $xml->createElement("Issue", $issue);
    $journal->appendChild($PublisherName);
    $journal->appendChild($JournalTitle);
    $journal->appendChild($Issn);
    $journal->appendChild($Volume);
    $journal->appendChild($Issue);


    $PubDate = $xml->createElement("PubDate");
    $PubDate->setAttribute("PubStatus", "aheadofprint");
    $journal->appendChild($PubDate);

    $pub_year = "";
    $pub_month = "";
    $pub_day = "";

    if (!empty($pubdate)) {

        $date = explode("-", $pubdate);
        $pub_year = $date[0];
        $pub_month = $date[1];
        $pub_day = $date[2];

    }

    $PubDate->appendChild($xml->createElement("Year", $pub_year));
    $PubDate->appendChild($xml->createElement("Month", $pub_month));
    $PubDate->appendChild($xml->createElement("Day", $pub_day));

    $article->appendChild($xml->createElement("ArticleTitle", htmlentities($article_title, ENT_COMPAT, 'UTF-8')));
    $article->appendChild($xml->createElement("FirstPage", $pdf_first_page)); // Page numeber is from pdff, need to add a field for these
    $article->appendChild($xml->createElement("LastPage", $pdf_last_page));
    $ELocationID = $xml->createElement("ELocationID", $ELocationID);
    $ELocationID->setAttribute("EIdType", "doi");
    $article->appendChild($ELocationID);

    $article->appendChild($xml->createElement("Language", $language));
    $AuthorList = $article->appendChild($xml->createElement("AuthorList"));

    $no_authors = get_post_meta($post_id, 'xml_authors', true);

    if ($no_authors != 0) {
        for ($i = 0; $i < $no_authors; $i++) {
            $Author = $xml->createElement("Author");
            $AuthorList->appendChild($Author);


            $firstname = get_post_meta($post_id, "xml_authors_" . $i . "_xml_author_first_name", true);
            $lastname = get_post_meta($post_id, "xml_authors_" . $i . "_xml_author_last_name", true);
            $middleName = get_post_meta($post_id, "xml_authors_" . $i . "_xml_author_middle_name", true);
            $affilitation = get_post_meta($post_id, "xml_authors_" . $i . "_xml_author_affiliation", true);


            $Author->appendChild($xml->createElement("FirstName", $firstname));
            $Author->appendChild($xml->createElement("MiddleName", $middleName));
            $Author->appendChild($xml->createElement("LastName", $lastname));
            $Author->appendChild($xml->createElement("Affiliation", htmlentities($affilitation, ENT_COMPAT, 'UTF-8')));

        }
    }


    $ArticleIdList = $article->appendChild($xml->createElement("ArticleIdList"));
    $ArticleIdpii = $xml->createElement("ArticleId", $pii_id);
    $ArticleIddoi = $xml->createElement("ArticleId", $doi_id);
    $ArticleIdpii->setAttribute("IdType", "pii"); //ocs website - //add as field to wordpress
    $ArticleIddoi->setAttribute("IdType", "doi");

    $ArticleIdList->appendChild($ArticleIdpii);
    $ArticleIdList->appendChild($ArticleIddoi); //fetch from the wordpress

    $Abstract = $xml->createElement("Abstract", htmlentities($abstract, ENT_COMPAT, 'UTF-8'));
    $article->appendChild($Abstract);


    echo $xml->saveXML(); //print xml


    return "<--------------------------------XML ENDS HERE, copy till above------------------------------------>";

}


//adding rest XML API
add_action('rest_api_init', function () {
    register_rest_route('xmlGeneratorIssue/v1', '/xml/(?P<id>\d+)', array(
        'methods' => 'GET',
        'callback' => 'issue_xml_generator',
    ), false);
});


function issue_xml_generator($data)
{

    $issue_id = $data['id'];


    $args = array(
        'numberposts' => -1,
        'posts_per_page' => '-1',
        'post_type' => 'articles',
        'meta_key' => 'issue_post_id',
        'meta_value' => $issue_id
    );


//initialize xml dom

    $domImpl = new DOMImplementation();
    $dtd = $domImpl->createDocumentType("ArticleSet", "-//NLM//DTD PubMed 2.0//EN", 'http://www.ncbi.nlm.nih.gov:80/entrez/query/static/PubMed.dtd');


    $xml = $domImpl->createDocument("", "", $dtd);
    $xml->formatOutput = true;
    $xml->encoding = 'UTF-8';
    $articleSet = $xml->createElement("ArticleSet");
    $xml->appendChild($articleSet);

    $PubYear = get_post_meta($issue_id, 'pubYear', true);  //add in wp issue
    $PubMonth = get_post_meta($issue_id, 'pubMonth', true); // add in wp issue
    $Issue_volume = get_post_meta($issue_id, 'issue_volume', true); // add in wp issue
    $Issue_number = get_post_meta($issue_id, 'issue_number', true); // add in wp issue


// query
    $query = new WP_Query($args);

    while ($query->have_posts()) {
        $query->the_post();
        $post_id = get_the_ID();
        $post = get_post($post_id);

        $publisher_name = get_post_meta($post_id, 'xml_publisher_name', true);
        $journal_title = get_post_meta($post_id, 'xml_journal_title', true);
        $issn = get_post_meta($post_id, 'xml_issn', true);

        $article_pubdate = get_post_meta($post_id, 'xml_pub_date', true);
        $article_title = $post->post_title;
//            $pdf_first_page     =   get_post_meta($post_id, 'xml_pdf_first_page', true); //these are for Online first xml file
//            $pdf_last_page      =   get_post_meta($post_id, 'xml_pdf_last_page', true);
        $pdf_first_page = get_post_meta($post_id, 'issue_xml_pdf_first_page', true);
        $pdf_last_page = get_post_meta($post_id, 'issue_xml_pdf_last_page', true);
        $ELocationID = get_post_meta($post_id, 'xml_elocation_id', true);
        $language = get_post_meta($post_id, 'xml_language', true);
        $pii_id = get_post_meta($post_id, 'xml_pii_id', true);
        $doi_id = get_post_meta($post_id, 'xml_doi_id', true);
        $abstract = get_post_meta($post_id, 'xml_abstract', true);
        $pubmedId = get_post_meta($post_id, 'issue_xml_pubmed_id', true);

//        if(!empty(get_post_meta($issue_id, 'issue_id',true))){
//            $issue =   get_post_meta($issue_id, 'issue_id', true);
//
//        }else{
//            $issue = "-";
//        }
//
//        if(!empty(get_post_meta($issue_id, 'volume', true))){
//            $volume =   get_post_meta($issue_id, 'volume', true);
//        }else{
//            $volume             =   "-";
//        }


        $article = $xml->createElement("Article");
        $articleSet->appendChild($article);


        $journal = $xml->createElement("Journal");
        $article->appendChild($journal);

        $PublisherName = $xml->createElement("PublisherName", $publisher_name);
        $JournalTitle = $xml->createElement("JournalTitle", $journal_title);
        $Issn = $xml->createElement("Issn", $issn); //this value need to be added to wordpress so that we can fetch from the db
        $Volume = $xml->createElement("Volume", $Issue_volume);
        $Issue = $xml->createElement("Issue", $Issue_number);
        $journal->appendChild($PublisherName);
        $journal->appendChild($JournalTitle);
        $journal->appendChild($Issn);
        $journal->appendChild($Volume);
        $journal->appendChild($Issue);


        $PubDate = $xml->createElement("PubDate");
        $PubDate->setAttribute("PubStatus", "ppublish");
        $journal->appendChild($PubDate);


        $PubDate->appendChild($xml->createElement("Year", $PubYear));
        $PubDate->appendChild($xml->createElement("Month", $PubMonth));


        if (!empty($pubmedId)) {
            $Replaces = $xml->createElement("Replaces", $pubmedId);
            $Replaces->setAttribute("IdType", "pubmed");
            $article->appendChild($Replaces);
        }

        $article->appendChild($xml->createElement("ArticleTitle", htmlentities($article_title, ENT_COMPAT, 'UTF-8')));

        $issue_pdf_firt_page = $xml->createElement("FirstPage", $pdf_first_page);
//        $issue_pdf_firt_page->setAttribute("LZero","delete");
        $article->appendChild($issue_pdf_firt_page);

        $article->appendChild($xml->createElement("LastPage", $pdf_last_page));
        $ELocationID = $xml->createElement("ELocationID", $ELocationID);
        $ELocationID->setAttribute("EIdType", "doi");
        $article->appendChild($ELocationID);

        $article->appendChild($xml->createElement("Language", $language));
        $AuthorList = $article->appendChild($xml->createElement("AuthorList"));

        $no_authors = get_post_meta($post_id, 'xml_authors', true);

        if ($no_authors != 0) {
            for ($i = 0; $i < $no_authors; $i++) {
                $Author = $xml->createElement("Author");
                $AuthorList->appendChild($Author);


                $firstname = get_post_meta($post_id, "xml_authors_" . $i . "_xml_author_first_name", true);
                $lastname = get_post_meta($post_id, "xml_authors_" . $i . "_xml_author_last_name", true);
                $middleName = get_post_meta($post_id, "xml_authors_" . $i . "_xml_author_middle_name", true);
                $affilitation = get_post_meta($post_id, "xml_authors_" . $i . "_xml_author_affiliation", true);


                $Author->appendChild($xml->createElement("FirstName", $firstname));
                $Author->appendChild($xml->createElement("MiddleName", $middleName));
                $Author->appendChild($xml->createElement("LastName", $lastname));
                $Author->appendChild($xml->createElement("Affiliation", htmlentities($affilitation, ENT_COMPAT, 'UTF-8')));
            }
        }

        $ArticleIdList = $article->appendChild($xml->createElement("ArticleIdList"));
        $ArticleIdpii = $xml->createElement("ArticleId", $pii_id);
        $ArticleIddoi = $xml->createElement("ArticleId", $doi_id);
        $ArticleIdpii->setAttribute("IdType", "pii"); //ocs website - //add as field to wordpress
        $ArticleIddoi->setAttribute("IdType", "doi");

        $ArticleIdList->appendChild($ArticleIdpii);
        $ArticleIdList->appendChild($ArticleIddoi); //fetch from the wordpress

        if (!empty($pubmedId)) {
            $history = $xml->createElement("History");
            $article->appendChild($history);
            $hist_PubDate = $xml->createElement("PubDate");
            $hist_PubDate->setAttribute("PubStatus", "aheadofprint");
            $history->appendChild($hist_PubDate);

            $article_pub_year = "";
            $article_pub_month = "";
            $article_pub_day = "";

            if (!empty($article_pubdate)) {

                $date = explode("-", $article_pubdate);
                $article_pub_year = $date[0];
                $article_pub_month = $date[1];
                $article_pub_day = $date[2];

            }
            $hist_PubDate->appendChild($xml->createElement("Year", $article_pub_year));
            $hist_PubDate->appendChild($xml->createElement("Month", $article_pub_month));
            $hist_PubDate->appendChild($xml->createElement("Day", $article_pub_day));
        }

        $Abstract = $xml->createElement("Abstract", htmlentities($abstract, ENT_COMPAT, 'UTF-8'));
        $article->appendChild($Abstract);
    } //End of while
    echo $xml->saveXML(); //print xml
    return "<--------------------------------XML ENDS HERE, copy till above------------------------------------>";

}

//code for html creation

//adding rest toc-table
add_action('rest_api_init', function () {
    register_rest_route('htmlgenerator/v1', '(?P<id>\d+)', array(
        'methods' => 'GET',
        'callback' => 'html_generator',
    ), false);
});

error_reporting(E_ALL ^ E_WARNING);
function html_generator($data)
{
    $issue_id = $data['id'];
    $args = array(
        'numberposts' => -1,
        'posts_per_page' => '-1',
        'post_type' => 'articles',
        'meta_key' => 'issue_post_id',
        'meta_value' => $issue_id
    );


    $query = new WP_Query($args);
    $catArrayMulti = (array)null;
    while ($query->have_posts()) {
        $query->the_post();
        $post_id = get_the_ID();
        $post = get_post($post_id);


        $article_category = get_the_category($post_id);


        $catname = $article_category[0]->name;
        if (!isset($catArrayMulti[$catname[0]])) {

            $catArrayMulti[$catname][] = $post;
        }


    }


    $issue_id = $data['id'];
    $pstInfo = get_post($issue_id);
//  print_r($pstInfo);
    $pstAbstract = $pstInfo->post_content;
    $pstAbst = str_replace("<p>", "  <p  style=\"font-size:18px;padding-left:5px;\">", $pstAbstract);
    $pstTitle = $pstInfo->post_title;
    $pstPubDate = $pstInfo->post_date;
//    $pstImage=  wp_get_attachment_url(get_the_post_thumbnail_id($pstInfo));
    $pstImage = wp_get_attachment_image_src(get_post_thumbnail_id($pstInfo->ID), 'single-post-thumbnail');


    echo '<table width="100%" align="center" style=" padding-bottom: 0px; background-color: white;margin-top: 0px; padding-top: 0px; padding-left: 0px;padding-right: 0px">
                <tbody style="background-color: white;padding-left: 30px;">
                 <tr>
        <td>    
            <center><a href="http://test.ijme.in"><img src="http://test.ijme.in/wp-content/themes/ijme/images/logo.jpg"  width="90%" style="padding: 20  10 10 10"></a></center>
        </td>

    </tr>
                <tr  style=" "><td>               <span ><h3 style="font-weight: 500;font-family: Times New Roman, Times, serif; font-size:17px;padding-top:10px ; padding-bottom: 20px; margin-top:0px; margin-bottom:0px; background: white;padding-left:30px"> IJME ISSUE<br/> 
               <span style="font-size: 15px;padding-top: 5px;">Pub: ' . $pstPubDate . '</span></h3></span></td></tr>
                ';

    //for the thumbnail,title and abstract

    echo '
         <tr style="position:relative; 
          width: 98%; background: white; padding-left: 10px; padding-top: 10px; "> 
            <td style="position:relative;
                background: white; ">
               <center> <img align="center" src=" ' . $pstImage[0] . '"  width="50%" ></center>
            
            </td>
         </tr>
         <tr>
            <td style=" padding-left: 5px; position:relative; float: right;
                width: 98%; background: white; ">
                <h2 align="center" style="font-weight: 500;font-family: Times New Roman, Times, serif; font-size:27px; margin-top: 10px">' . $pstTitle . '</h2>
                <p  >' . $pstAbst . '</p>
            
            </td>
            
          </tr>
        ';

    $allCategories = array_keys($catArrayMulti);
foreach ($allCategories

         as $category) {

    ?>
    <tr>
        <td style=" position:relative; float: left;
          width:96%; background: white; padding-left: 10px;padding-right: 10px;"><h4
                    style="text-decoration:none; background-color: #404040; color: white; padding-right: 10px;padding-left: 10px;  line-height: 20px; font-size: 18px; padding-top:3px; padding-bottom:3px; font-family: Times New Roman, Times, serif;"><?php echo $category; ?></h4>
        </td>
        <?php
        foreach ($catArrayMulti[$category] as $key => $post) {
            $pdf = add_query_arg('galley', 'pdf', get_permalink($post));
            $html = add_query_arg('galley', 'html', get_permalink($post));

            $authors = get_post_meta($post->ID, 'authors', true);
            $authors_array = array();
            $pstName = $post->post_title;
            $pstAbstract = get_permalink($post->ID);
            echo '<td style=" width: 94.5%;float: left;position:relative;margin-bottom: 0px;padding-left: 25px;background: white;">  
            <a href="' . $html . '" style="text-decoration: none;color: #1a1a1a;
                            font-family: Times New Roman, Times, serif;
                            font-size: 18px;
                            font-weight: normal;vertical-align: text-top;line-height: normal;position: relative;min-height: 1px; width: 66.66666666666666%;" >' . $pstName . '</a><br/>';
            if (is_array($authors)) {
                foreach ($authors as $author) $authors_array[] = $author['first_name'] . ' ' . $author['middle_name'] . ' ' . $author['last_name'];
                echo '  <p  style=" text-decoration:none;
                            color: #999999;
                            font-family: Helvetica, Arial, sans-serif;
                            font-size: 14px;
                            font-weight: normal;
                            font-weight: normal;
                            padding-bottom:0px;
                            padding-top:2px;
                            margin-top:0px;
                            margin-bottom: 0px">' . implode(', ', $authors_array) . ' </p>';
            }
            echo '<br><a style="
                   padding: 1px 1px;text-align: right; 
                   color: #1a1a1a;
                   font-family: Helvetica, Arial, sans-serif;
                   font-size: 14px;
                   vertical-align: text-top;
                   text-decoration: none;
                   padding-top: 0px;
                   padding-bottom: 0px;
                   margin: 0 0 0 0;
                   " href="' . $pstAbstract . '">Abstract &nbsp; | &nbsp; </a>
                   
                   
                <a style="
                   padding: 1px 1px; 
                   text-align: right;
                   color: #1a1a1a;
                   font-family: Helvetica, Arial, sans-serif;
                   font-size: 14px;
                   vertical-align: text-top;
                   text-decoration: none;
                   padding-top: 0px;
                   padding-bottom: 0px;
                   margin: 0 0 0 0;
                   " href="' . $html . '"> HTML &nbsp; | &nbsp;</a>
                   
                   
                <a style=" 
                   padding: 1px 1px;
                   text-align: right; 
                   color: #1a1a1a;
                   font-family: Helvetica, Arial, sans-serif;
                   font-size: 14px;
                   vertical-align: text-top;
                   text-decoration: none;
                   padding-top: 0px;
                   padding-bottom: 0px;
                   margin: 0 0 0 0;
                   " href="' . $pdf . '">PDF &nbsp;  </a> ';
            ?><?php
            $len = count($catArrayMulti[$category]);
            if ($len != $key + 1) {
                echo "<hr>";
            }

            echo "</td></tr>";
            ?><?php


        }


        }
        echo "<br>
        <tr>
        <td style=\"margin-bottom: 50px;padding-top: 90px\">
            <span><br> <a href='{sp-browser-url}'>View it in your browser</a><br><br><a
                    href='{sp-unsubscribe-url}'>unsubscribe from this list</a></span>

                       <a style=\"color: white; background-color: red; padding: 13px; text-decoration: none;float: right;font-size: small\" href=\"/IjmeSubscriptionForm/subscribe.php\" target=\"_blank\">SUBSCRIBE</a>

        </td>

        </tr>

</tbody></table> 


";
        exit();


        }


        add_action('post_submitbox_start', 'generate_xml_btn');

        function generate_xml_btn()
        {
            $article_id = get_the_ID();
            $post_type = get_post_type();

            if ($post_type == 'articles') {
                ?>
                <div>
                    <input name="save" type="button" class="button-large button-primary" style="margin-bottom: 10px"
                           value="Generate XML"
                           onclick="window.open('<?php echo "/wp-json/xmlGenerator/v1/xml/" . $article_id; ?>','_blank');"/>
                </div>
            <?php } elseif ($post_type == 'issues') { ?>
                <div>
                    <input name="save" type="button" class="button-large button-primary" style="margin-bottom: 10px"
                           value="Generate ISSUE XML"
                           onclick="window.open('<?php echo "/wp-json/xmlGeneratorIssue/v1/xml/" . $article_id; ?>','_blank');"/>
                </div>
                <?php
            }
        }

        add_action('post_submitbox_start', 'generate_html_btn');

        function generate_html_btn()
        {
            $article_id = get_the_ID();
            $post_type = get_post_type();

            if ($post_type == 'articles') {
                ?>
                <div>
                    <input name="save" type="button" class="button-large button-primary" value="Generate HTML"
                           onclick="window.open('<?php echo "/wp-json/HTMLGenerator/v1/" . $article_id; ?>','_blank');"/>
                </div>
            <?php } elseif ($post_type == 'issues') { ?>
                <div>
                    <input name="save" type="button" class="button-large button-primary" value="Generate HTML"
                           onclick="window.open('<?php echo "/wp-json/htmlgenerator/v1/" . $article_id; ?>','_blank');"/>
                </div>
                <?php
            }
        }


        function display_year_issues()
        {
        if (isset($_POST['selected_year'])) {
            $selected_year = $_POST['selected_year'];
        } else {
            $selected_year = date("Y");
        }
        global $post;
        $articles = get_posts(array(
            'posts_per_page' => 4,
            'post_type' => 'issues',
            'year' => $selected_year
        ));
        if ($articles) {
            foreach ($articles as $post) :
                setup_postdata($post);
                if (has_post_thumbnail()):
                    ?>
                    <div class="issue">
                        <div class="issue-image">
                            <a href="<?php the_permalink(); ?>"><?php the_post_thumbnail('medium'); ?></a>
                        </div>
                        <div class="issue-content">
                            <div class="issue-title"><h3 class="home-title-1"><a
                                            href="<?php the_permalink(); ?>"><?php echo get_the_title(); ?></a>
                                </h3>
                                <span class="issue-tag">Volume:<?php echo get_post_meta(get_the_ID(), 'volume', true); ?> Issue:&nbsp;<?php get_issue_quarter(get_post_meta(get_the_ID(), 'number', true)); ?></span>
                                <p>
                                    <span class="issue-tag">Published Date: <?php echo date('Y-m-d', strtotime(get_post_meta(get_the_ID(), 'issue_publish_date', true))); ?></span>
                                </p>
                            </div>
                            <div class="issue-detail"><?php echo wp_trim_words(get_the_excerpt(), 500); ?></div>
                        </div>
                    </div>
                <?php
                endif;
            endforeach;
            wp_reset_postdata();

        } else { ?>
        <div class="issue">
            <div class="issue-content">
                <div class="issue-title"><h3 class="home-title-1">No Issue Available for Selected Year
                    </h3>
                </div>
                <div class="issue-detail">Please select some other issue.</div>
            </div>
        </div>
<?php }

    die();
}

add_action('wp_ajax_display_year_issues', 'display_year_issues');
add_action('wp_ajax_nopriv_display_year_issues', 'display_year_issues');

function get_issue_quarter($i)
{
    switch ($i) {
        case 1:
            echo $i . " Jan-Mar";
            break;

        case 2:
            echo $i . " April-June";
            break;

        case 3:
            echo $i . " July-Sept";
            break;

        case 4:
            echo $i . " Oct-Dec";
            break;

        default:
            echo $i;
            break;
    }
}

// Product Custom Post Type
function blog_init()
{
    // set up product labels
    $labels = array(
        'name' => 'Blogs',
        'singular_name' => 'Blog',
        'add_new' => 'Add New Blog Post',
        'add_new_item' => 'Add New Blog Post',
        'edit_item' => 'Edit Blog',
        'new_item' => 'New Post',
        'all_items' => 'All Blog Posts',
        'view_item' => 'View Blog Post',
        'search_items' => 'Search Posts',
        'not_found' => 'No Blog Post Found',
        'not_found_in_trash' => 'No Post found in Trash',
        'parent_item_colon' => '',
        'menu_name' => 'Blogs',
    );

    // register post type
    $args = array(
        'labels' => $labels,
        'public' => true,
        'has_archive' => true,
        'show_ui' => true,
        'capability_type' => 'post',
        'hierarchical' => false,
        'rewrite' => array('slug' => 'blog'),
        'query_var' => true,
        'menu_icon' => 'dashicons-randomize',
        'supports' => array(
            'title',
            'editor',
            'excerpt',
            'custom-fields',
            'comments',
            'revisions',
            'thumbnail',
            'author',
            'page-attributes'
        )
    );
    register_post_type('blog', $args);

    // register taxonomy
    register_taxonomy('blog_category', 'blog', array('hierarchical' => true, 'label' => 'Category', 'query_var' => true, 'rewrite' => array('slug' => 'blog-category')));
}


////For Custom SEO (Adding the Keywords)
//add_action('wp_head','keywords_and_desc');
//function keywords_and_desc(){
//    global $post;
//    if (is_single()||is_page()){
//        if(get_post_meta($post->ID,'my_keywords',true) != '')
//            echo    '<meta content="'.get_post_meta($post->ID,'my_keywords',true).'" name="keywords">';
//        if(get_post_meta($post->ID,'my_description',true) != '')
//            echo    '<meta content="'.get_post_meta($post->ID,'my_description',true).'" name="description">';
//    }
//}


add_action('init', 'blog_init');


