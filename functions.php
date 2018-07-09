<?php

define('THEME_URL',get_template_directory_uri());
define('THEME_PATH',get_template_directory());
//define('IJME_URL', get_site_url ().'/submissions'. '/index.php/ijme/user');
define('IJME_URL', get_site_url ().'/submission');
define('ISSN', '0975-5691');

function ijme_theme_setup() {
	add_theme_support( 'post-thumbnails' );	
}
add_action( 'after_setup_theme', 'ijme_theme_setup' );

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
function enqueue_front_end_scripts() {
    
    
    wp_enqueue_style( 'pkp-common', THEME_URL . '/css/pkp-common.css', [], '4.7.0' );
    wp_enqueue_style( 'rt', THEME_URL . '/css/rt.css' );
    
	wp_enqueue_style( 'common-pkp', THEME_URL . '/css/common.css', [], '4.8.1' );
    
    wp_enqueue_style( 'compiled', THEME_URL . '/css/compiled.css' );
    wp_enqueue_style( 'bootstrap', THEME_URL . '/css/bootstrap.min.css' );
    
    wp_enqueue_style( 'sidebar', THEME_URL . '/css/sidebar.css' );
    wp_enqueue_style( 'rightSidebar', THEME_URL . '/css/rightSidebar.css' );
    wp_enqueue_style( 'custom', THEME_URL . '/css/custom.css', [], '4.6.10' );
    
    wp_enqueue_style( 'owl-theme', THEME_URL . '/css/owl.theme.css' );
    wp_enqueue_style( 'owl-css', THEME_URL . '/css/owl.carousel.css' );
    
    
    //wp_enqueue_style( 'bootstrap', "https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" );
    wp_enqueue_style( 'main', get_stylesheet_uri(), [], '3.7.1.0' );
    wp_enqueue_style( 'media-css', THEME_URL . '/css/media.css' );
    
    wp_enqueue_script( 'jquery');
    wp_enqueue_script( 'owl-js', THEME_URL . '/js/owl.carousel.min.js' );
    wp_enqueue_script( 'bootstrap-js', THEME_URL . '/js/bootstrap.min.js' );
    wp_enqueue_script( 'pdf-js', THEME_URL . '/js/pdf.min.js' );
    wp_enqueue_script( 'custom', THEME_URL . '/js/custom.js' );
    //wp_enqueue_script( 'script-name', get_template_directory_uri() . '/js/example.js', array(), '1.0.0', true );
}
add_action( 'wp_enqueue_scripts', 'enqueue_front_end_scripts' );


add_action( 'after_setup_theme', 'register_menus' );
function register_menus() {
    register_nav_menus( array(
        'main' => 'Main menu',
        'header_menu' => 'Header menu',
    ) );
}

function year_archive_table($year_array) {
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
    
    foreach($posts_array as $post_obj) {
        $year = get_post_meta($post_obj->ID,'year',true);
        
        if(!isset($year_keyed_posts_array[$year])) {        
            $year_keyed_posts_array[$year] = array();
        }
        
        $year_keyed_posts_array[$year][] = $post_obj;
        
        if(count($year_keyed_posts_array[$year]) > $max_posts) $max_posts = count($year_keyed_posts_array[$year]);
    }
    
    ?>
    <table class="table table-bordered">
        <tr>
            <?php for($j=0; $j<count($year_array); $j++) { ?>
            <th><?php echo $year_array[$j]; ?></th>
            <?php } ?>
        </tr>
        <?php    
        for($i=0; $i<$max_posts; $i++) {
            ?>
            <tr>
            <?php
            for($j=0; $j<count($year_array); $j++) {        
                ?>
                <td>
                    <?php
                    if(isset($year_keyed_posts_array[$year_array[$j]]) && isset($year_keyed_posts_array[$year_array[$j]][$i])) {
                        $post_obj = $year_keyed_posts_array[$year_array[$j]][$i];
                        //echo $post_obj->post_title;
                        ?>
                        <a href="<?php echo get_permalink($post_obj->ID); ?>">                            
                            <span class="month">
                                <?php
                                switch($i) {
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

remove_filter( 'the_content', 'wpautop' );
remove_filter( 'the_excerpt', 'wpautop' );

add_action( 'wp_ajax_mail_article', 'mail_article' );
add_action( 'wp_ajax_nopriv_mail_article', 'mail_article' );
function mail_article() {
	if(empty($_POST['to']) || !is_email($_POST['to']))
	die("Invalid email in to");
	
	if(!empty($_POST['cc']) && !is_email($_POST['cc']))
	die("Invalid email in cc");
	
	if(!empty($_POST['bcc']) && !is_email($_POST['bcc']))
	die("Invalid email in bcc");
	
	if(empty($_POST['article_id']))
	die("Invalid request");
	
	$article_id = $_POST['article_id'];
	
	if(!get_permalink($article_id))
	die("Invalid request");
	
	
	$issue_id = get_post_meta($article_id,'issue_post_id',true);
	$authors = get_post_meta($article_id, 'authors', true);
	$authors_array = array();
	
	if(is_array($authors)) {
		foreach($authors as $author) $authors_array[] = $author['last_name'].' '.$author['first_name'];
	}
	$message = 'Thought you might be interested in seeing "'.get_the_title($article_id).'" by '.implode(',',$authors_array).' published in Vol '.get_post_meta($issue_id,'volume',true).', No '.get_post_meta($issue_id,'number',true).' ('.get_post_meta($issue_id,'year',true).') of '.get_bloginfo('name').' at "'.get_permalink($article_id).'".';
	
	$headers = array();
	$headers[] = "From: admin@ijme.in";
	
	if(!empty($_POST['cc']))
	$headers[] = "Cc: ".$_POST['cc'];
	
	if(!empty($_POST['bcc']))
	$headers[] = "Bcc: ".$_POST['bcc'];
	
	if( wp_mail(
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
add_action( 'admin_enqueue_scripts', 'enqueue_media_for_reports' );
function enqueue_media_for_reports() {
    //enqueue only for reports CPT
    if(get_post_type() == 'articles') {
        wp_enqueue_media();
    }
}

function load_jquery_sortable() {
    wp_enqueue_style( 'jquery-ui-sortable' );
}
add_action( 'admin_enqueue_scripts', 'load_jquery_sortable' );

/**
 * Register meta box for article.
 */
function register_issues_meta_box() {
    add_meta_box( 'meta-box-id', __( 'Settings', 'textdomain' ), 'render_issues_metabox', 'issues' );
}
add_action( 'add_meta_boxes', 'register_issues_meta_box' );

function render_issues_metabox($post) {
	
	wp_nonce_field( 'issues_meta_box_nonce', 'meta_box_nonce' );
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
					<input type="text" class="regular-text" name="number" value="<?php echo get_post_meta($post->ID, 'number', true); ?>">
				</td>
			</tr>
			<tr>
				<th scope="row">
					<label>Volume</label>
				</th>
			 
				<td>
					<input type="text" class="regular-text" name="volume" value="<?php echo get_post_meta($post->ID, 'volume', true); ?>">
				</td>
			</tr>
			<tr>
				<th scope="row">
					<label>Year</label>
				</th>
			 
				<td>
					<input type="text" class="regular-text" name="year" value="<?php echo get_post_meta($post->ID, 'year', true); ?>">
				</td>
			</tr>
			<tr>
				<th scope="row">
					<label>Published Date</label>
				</th>			 
				<td>
					<?php
					$issue_pub_date = get_post_meta($post->ID,'issue_publish_date',true);
					?>
					<select name="issue_pub_date[day]">
						<option value="0">Day</option>
						<?php
						for($i=1; $i<32; $i++) {
							?>
							<option value="<?php echo str_pad($i, 2, "0", STR_PAD_LEFT); ?>" <?php if(date('d',strtotime($issue_pub_date)) == $i) echo "selected"; ?> ><?php echo $i; ?></option>
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
						foreach($month_array as $value=>$month) {
							?>
							<option value="<?php echo $value; ?>" <?php if(date('n',strtotime($issue_pub_date)) == $value) echo "selected"; ?>><?php echo $month; ?></option>
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
							<option value="<?php echo $year; ?>" <?php if(date('Y',strtotime($issue_pub_date)) == $year) echo "selected"; ?>><?php echo $year; ?></option>
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
					$strArticalList	= '';
					//print_r($articles_id);exit; 
					if(isset($articles_id[0]) && (!is_numeric($articles_id[0]))){
						$articles_id	= array();
					}
					
					if((isset($articles_id)) && (!empty($articles_id))) { 
						$strArticalList	= implode(',',$articles_id);
						 
						foreach($articles_id as $id) {
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
								foreach($category_array as $t_post) {
									?>
									<li id="<?php echo $t_post->ID; ?>">
										<div class="article-title">
											<?php echo $t_post->post_title; ?>	
										</div>
										<div class="article-page-range">
											<input type="text" name="page_range[<?php echo $t_post->ID ?>]" value="<?php echo get_post_meta($t_post->ID,'page_range', true); ?>" placeholder="Page range">
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
					<input type="hidden" name="category_order" >
					<input type="hidden" name="article_order" value="<?php echo $strArticalList ?>" >
					<script>
						jQuery(document).ready(function($){
							$( ".category-sortable" ).sortable({
								start: function (event, ui) {
									update_index();
									//$(ui.item).data("startindex", ui.item.index());
								},
								stop: function (event, ui) {
									update_index();
									//self.sendUpdatedIndex(ui.item);
								}
							});
							$( ".article-sortable" ).sortable({
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
							jQuery(".article-sortable").each(function(){
								var article_order = jQuery(this).sortable("toArray");
								//all_article_order += article_order.join(",");
								jQuery.merge(all_article_order,article_order)
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

function save_issues_meta_box( $post_id ) {
    if( !isset( $_POST['meta_box_nonce'] ) || !wp_verify_nonce( $_POST['meta_box_nonce'], 'issues_meta_box_nonce' ) ) return;
	
	$articles = explode(",", $_POST["article_order"]);
	$articles = array_unique($articles);
	if(!empty($articles)) {
		update_post_meta($post_id, 'articles', $articles);	
	}
	
	update_post_meta($post_id, 'number', $_POST['number']);
	update_post_meta($post_id, 'volume', $_POST['volume']);
	update_post_meta($post_id, 'year', $_POST['year']);
	
	update_post_meta($post_id, 'issue_publish_date', $_POST['issue_pub_date']['year'].'-'.$_POST['issue_pub_date']['month'].'-'.$_POST['issue_pub_date']['day'].' 00:00:00');
	
	if(!empty($_POST['page_range'])) {
		foreach($_POST['page_range'] as $id=>$value) {
			update_post_meta($id, 'page_range', $value);
		}
	}
	
}
add_action( 'save_post', 'save_issues_meta_box' );

/**
 * Register meta box for article.
 */
function register_articles_meta_box() {
    add_meta_box( 'meta-box-id', __( 'Settings', 'textdomain' ), 'render_articles_metabox', 'articles' );
}
add_action( 'add_meta_boxes', 'register_articles_meta_box' );

function render_articles_metabox($post) {
	wp_nonce_field( 'article_meta_box_nonce', 'meta_box_nonce' );
	?>
	<style>
		.author-section p {margin-bottom: 15px}
	</style>
	<script>
		function add_more_authors(invoker) {
            var caller = jQuery(invoker);
			jQuery(".author-section").append(jQuery(".author-section table").first().clone().find("input:text").val("").end().find('input:checkbox').removeAttr('checked').end());
        }
		
		function remove_author_box(invoker) {
            var caller = jQuery(invoker);
			
			if (caller.closest('.author-section').find('table').length < 2) {
                alert("Atleast one author is required");
				return false;
            }
			
			caller.closest('table').remove();
        }
	</script>
	<script>
        jQuery(document).ready(function(){
            jQuery('.upload-pdf-btn').click(function(e) {
                e.preventDefault();
                var image = wp.media({ 
                    title: 'Upload Image',
                    // mutiple: true if you want to upload multiple files at once
                    multiple: false
                }).open()
                .on('select', function(e){
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
			<!--<tr>
				<th scope="row">
					<label>Author String</label>
				</th>
			 
				<td>
					<input type="text" class="large-text" placeholder="John Doe" name="my-text-field">
				</td>
			</tr>-->
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
									<input type="text" placeholder="First name" name="authors[first_name][]" value="" >
								</td>
								<td>
									<label>Middle Name</label>
									<input type="text" placeholder="Middle name" name="authors[middle_name][]" value="" >
								</td>
								<td>
									<label>Last Name</label>
									<input type="text" placeholder="Last name" name="authors[last_name][]" value="" >
								</td>
								<td>
									<input type="checkbox" name="authors[primary_contact][]" checked value="1" />Primary &nbsp;
									<a href="javascript:void(0);" onclick="return remove_author_box(this);">Delete</a>
								</td>
							</tr>
							<tr>
								<td colspan="4">
									<label>Affiliation</label>
									<input type="text" placeholder="Affiliation" class="large-text" name="authors[affiliation][]" value="" >
								</td>
							</tr>
							<tr>
								<td>
									<label>Country</label>
									<input type="text" placeholder="Eg: IN" name="authors[country][]" value="" >
								</td>
								<td>
									<label>Competing Interest</label>
									<input type="text" name="authors[competing_interests][]" value="" >
								</td>
								<td colspan="2">
									<label>Email</label>
									<input type="text" name="authors[email][]" value="" >
								</td>
							</tr>
							<tr>
								<td colspan="4">
									<label>Biography</label>
									<input type="text" class="large-text" name="authors[biography][]" value="" >
								</td>
							</tr>
                            <tr>
                                <td colspan="4">
                                    <label>Peer Review</label>
                                    <input type="text" placeholder="peer review" class="large-text" name="authors[peer_review][]" value="" >
                                </td>
                            </tr>
                        </table>
						
						
						<?php } else{ 
							$authors_array = array();
							foreach($authors as $author) {
								?>
								<table class="authors-table">
									<tr>
										<td>
											<label>First Name</label>
											<input type="text" placeholder="First name" name="authors[first_name][]" value="<?php echo $author['first_name']; ?>" >
										</td>
										<td>
											<label>Middle Name</label>
											<input type="text" placeholder="Middle name" name="authors[middle_name][]" value="<?php echo $author['middle_name']; ?>" >
										</td>
										<td>
											<label>Last Name</label>
											<input type="text" placeholder="Last name" name="authors[last_name][]" value="<?php echo $author['last_name']; ?>" >
										</td>
										<td>
											<input type="checkbox" name="authors[primary_contact][]" <?php if(!empty($author['primary_contact'])) echo "checked"; ?> value="1" />Primary &nbsp;
											<a href="javascript:void(0);" onclick="return remove_author_box(this);">Delete</a>
										</td>
									</tr>
									<tr>
										<td colspan="4">
											<label>Affiliation</label>
											<input type="text" placeholder="Affiliation" class="large-text" name="authors[affiliation][]" value="<?php echo $author['affiliation']; ?>" >
										</td>
									</tr>
									<tr>
										<td>
											<label>Country</label>
											<input type="text" placeholder="Eg: IN" name="authors[country][]" value="<?php echo $author['country']; ?>" >
										</td>
										<td>
											<label>Competing Interest</label>
											<input type="text" name="authors[competing_interests][]" value="<?php echo $author['competing_interests']; ?>" >
										</td>
										<td colspan="2">
											<label>Email</label>
											<input type="text" name="authors[email][]" value="<?php echo $author['email']; ?>" >
										</td>
									</tr>
									<tr>
										<td colspan="4">
											<label>Biography</label>
											<input type="text" class="large-text" name="authors[biography][]" value="<?php echo $author['biography']; ?>" >
										</td>
									</tr>
									<tr>
										<td colspan="4">
											<label>Peer Review</label>
											<input type="text" placeholder="peer review" class="large-text" name="authors[peer_review][]" value="" >
										</td>
									</tr>
									
								</table>
								<!--<p>
									<input type="text" placeholder="First name" name="authors[first_name][]" value="<?php echo $author['first_name']; ?>" >
									<input type="text" placeholder="Middle name" name="authors[middle_name][]" value="<?php echo $author['middle_name']; ?>" >
									<input type="text" placeholder="Last name" name="authors[last_name][]" value="<?php echo $author['last_name']; ?>" > &nbsp;
									<input type="checkbox" name="authors[primary_contact][]" <?php if(!empty($author['primary_contact'])) echo "checked"; ?> value="1" />Primary &nbsp;
									<a href="javascript:void(0);" onclick="return remove_author_box(this);">Delete</a>
									<br/>
									<input type="text" placeholder="Affiliation" class="large-text" name="authors[affiliation][]" value="<?php echo $author['affiliation']; ?>" >
									<br/>
									<input type="text" placeholder="Country" name="authors[country][]" value="<?php echo $author['country']; ?>" >
									<input type="text" placeholder="Competing Interest" name="authors[competing_interests][]" value="<?php echo $author['competing_interests']; ?>" >								
									<input type="text" placeholder="Email" name="authors[email][]" value="<?php echo $author['email']; ?>" >
									<br/>
									<input type="text" placeholder="Biography" class="large-text" name="authors[biography][]" value="<?php echo $author['biography']; ?>" >
									<input type="text" placeholder="Test" class="large-text" name="authors[test][]" value="<?php echo $author['test']; ?>" >								
								</p>-->							
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
			<tr>
				<th scope="row">
					<label>Parent Issue</label>
				</th>			 
				<td>
					<?php
					$issue_id = get_post_meta($post->ID, 'issue_post_id', true);
					$all_issues = get_posts(array(
										'post_type'=>'issues',
										'post_status'=>'publish',
										'posts_per_page' => -1
									));
					?>
					<select name="issue_post_id">
						<option value="0">Select</option>
						<?php
						foreach($all_issues as $issue) {
							?>
							<option value="<?php echo $issue->ID; ?>" <?php if($issue->ID == $issue_id) echo "selected"; ?>><?php echo $issue->post_title." Vol ".get_post_meta($issue->ID,'volume',true)." No ".get_post_meta($issue->ID,'number',true); ?></option>
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
					<input type="text" name="pdf_file" class="regular-text pdf-file-link" value="<?php echo get_post_meta($post->ID,'pdf_file',true); ?>" readonly=true />
					<a class="button upload-pdf-btn">Upload</a>
				</td>
			</tr>
			<tr>
				<th scope="row">
					<label>Page Range</label>
				</th>			 
				<td>
					<input type="text" placeholder="Eg: 54 or 54-59" name="page_range" value="<?php echo get_post_meta($post->ID,'page_range',true); ?>">
				</td>
			</tr>
			<tr>
				<th scope="row">
					<label>Published Date</label>
				</th>			 
				<td>
					<?php
					$article_pub_date = get_post_meta($post->ID,'article_pub_date',true);
					?>
					<select name="article_pub_date[day]">
						<option value="0">Day</option>
						<?php
						for($i=1; $i<32; $i++) {
							?>
							<option value="<?php echo str_pad($i, 2, "0", STR_PAD_LEFT); ?>" <?php if(date('d',strtotime($article_pub_date)) == $i) echo "selected"; ?> ><?php echo $i; ?></option>
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
						foreach($month_array as $value=>$month) {
							?>
							<option value="<?php echo $value; ?>" <?php if(date('n',strtotime($article_pub_date)) == $value) echo "selected"; ?>><?php echo $month; ?></option>
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
							<option value="<?php echo $year; ?>" <?php if(date('Y',strtotime($article_pub_date)) == $year) echo "selected"; ?>><?php echo $year; ?></option>
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
					<textarea class="large-text" rows="10" cols="50" name="citations"><?php echo get_post_meta($post->ID,'citations',true); ?></textarea>
				</td>
			</tr>
		</tbody>
	</table>
	<?php
}

/**
 * Save meta box content.
 *
 * @param int $post_id Post ID
 */
function wpdocs_save_meta_box( $post_id ) {
    if( !isset( $_POST['meta_box_nonce'] ) || !wp_verify_nonce( $_POST['meta_box_nonce'], 'article_meta_box_nonce' ) ) return;
	
	update_post_meta($post_id, 'page_range', $_POST['page_range']);
	update_post_meta($post_id, 'citations', $_POST['citations']);
	
	$previous_issue_id = get_post_meta($post_id, 'issue_post_id', true);
	if($previous_issue_id != $_POST['issue_post_id'] ) {
		
		//remove from previous one
		$issue_articles_id = get_post_meta($previous_issue_id, 'articles', true);
		if(($key = array_search($post_id, $issue_articles_id)) !== false) {
			unset($issue_articles_id[$key]);
		}
		update_post_meta($previous_issue_id, 'articles', $issue_articles_id);	

		//add to new one
		$issue_articles_id = get_post_meta($_POST['issue_post_id'], 'articles', true);
		if(empty($issue_articles_id))
		$issue_articles_id = array();
		$issue_articles_id[] = $post_id;
		update_post_meta($_POST['issue_post_id'], 'articles', $issue_articles_id);	
		
		update_post_meta($post_id, 'issue_post_id', $_POST['issue_post_id']);	
	}
	
	update_post_meta($post_id, 'pdf_file', $_POST['pdf_file']);
	
	update_post_meta($post_id, 'article_pub_date', $_POST['article_pub_date']['year'].'-'.$_POST['article_pub_date']['month'].'-'.$_POST['article_pub_date']['day'].' 00:00:00');
	
	$author_array = array();
	for($i=0; $i<count($_POST['authors']['first_name']); $i++) {
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
}
add_action( 'save_post', 'wpdocs_save_meta_box' );

function embed_pdf( $atts ) {
	$atts = shortcode_atts(
				array(
					'url' => false
				),
				$atts
			);
	return '<div id="pdf-wrap"></div>
	<script>PDFObject.embed("'.$atts['url'].'", "#pdf-wrap");</script>';
}
add_shortcode( 'embed_pdf', 'embed_pdf' );

/** ============ Advance Search ============== **/
/** https://adambalee.com/search-wordpress-by-custom-fields-without-a-plugin/ **/

/**
 * Join posts and postmeta tables
 *
 * http://codex.wordpress.org/Plugin_API/Filter_Reference/posts_join
 */
function cf_search_join( $join ) {
    global $wp_query, $wpdb;

    if ( is_search() ) {
    //if ( $wp_query->is_search ) {
		
		if( !empty($_REQUEST['authors']) )
        $join .=' LEFT JOIN '.$wpdb->postmeta. ' AS authors ON '. $wpdb->posts . '.ID = authors.post_id ';
		
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
add_filter('posts_join', 'cf_search_join' );

/**
 * Search SQL filter for matching against post title only.
 *
 * @link    http://wordpress.stackexchange.com/a/11826/1685
 *
 * @param   string      $search
 * @param   WP_Query    $wp_query
 */
function wpse_11826_search_by_title( $search, $wp_query ) {
	
		if ( !is_search() )
		return $search;
	
		if( !$wp_query->is_search )
		return $search;
    
        global $wpdb;
		/*
		if(empty($_REQUEST["title"]) && empty($_REQUEST["abstract"]) && empty($_REQUEST["galleyFullText"]))
		return $search;
		*/
		
        $n = ! empty( $q['exact'] ) ? '' : '%';
		
		$advance_search = array();
		
		if(!empty($_REQUEST['title'])) {
			$parts = preg_split('/\s+/', $_REQUEST['galleyFullText']);
			foreach($parts as $str)
			$advance_search[] = $wpdb->prepare( "$wpdb->posts.post_title LIKE %s", $n . $wpdb->esc_like( $str ) . $n );
		}
		
		if(!empty($_REQUEST['abstract'])) {
			$parts = preg_split('/\s+/', $_REQUEST['galleyFullText']);
			foreach($parts as $str)
			$advance_search[] = $wpdb->prepare( "$wpdb->posts.post_excerpt LIKE %s", $n . $wpdb->esc_like( $str ) . $n );
		}
		
		if(!empty($_REQUEST['galleyFullText'])) {
			$parts = preg_split('/\s+/', $_REQUEST['galleyFullText']);
			foreach($parts as $str)
			$advance_search[] = $wpdb->prepare( "$wpdb->posts.post_content LIKE %s", $n . $wpdb->esc_like( $str ) . $n );
		}
		
		if(!empty($_REQUEST['authors'])) {
			$parts = preg_split('/\s+/', $_REQUEST['authors']);
			foreach($parts as $str)
			$advance_search[] = $wpdb->prepare( "authors.meta_value LIKE %s AND authors.meta_key=\"authors\"", '%' . $wpdb->esc_like( $str ) . '%' );
		}

		if ( ! empty( $search ) && ! empty( $wp_query->query_vars['search_terms'] ) ) {
			$search = array();
	
			
	
			$q = $wp_query->query_vars;
			foreach ( ( array ) $q['search_terms'] as $term )
				//$search[] = $wpdb->prepare( "$wpdb->posts.post_title LIKE %s", $n . $wpdb->esc_like( $term ) . $n );
				$search[] = $wpdb->prepare( "($wpdb->posts.post_title LIKE %s OR $wpdb->posts.post_content LIKE %s OR $wpdb->posts.post_excerpt LIKE %s)", array($n . $wpdb->esc_like( $term ) . $n,$n . $wpdb->esc_like( $term ) . $n,$n . $wpdb->esc_like( $term ) . $n) );
	
			if ( ! is_user_logged_in() )
				$search[] = "$wpdb->posts.post_password = ''";
				
			
	
			$search = ' AND ' . implode( ' AND ', $search );
		}
		
		if(!empty($advance_search)) {
			$search .= ' AND '.implode(' AND ', $advance_search);
		}
    

	//var_dump($search);
    return $search;
}

add_filter( 'posts_search', 'wpse_11826_search_by_title', 10, 2 );

/**
 * Modify the search query with posts_where
 *
 * http://codex.wordpress.org/Plugin_API/Filter_Reference/posts_where
 */
function cf_search_where( $where ) {
    global $pagenow, $wpdb;
   
    if ( is_search() ) {
		
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
add_filter( 'posts_where', 'cf_search_where' );

/**
 * Prevent duplicates
 *
 * http://codex.wordpress.org/Plugin_API/Filter_Reference/posts_distinct
 */
function cf_search_distinct( $where ) {
    global $wpdb;

    if ( is_search() ) {
        return "DISTINCT";
    }

    return $where;
}
add_filter( 'posts_distinct', 'cf_search_distinct' );

function searchfilter($query) {
	
	// If 's' request variable is set but empty
	if (isset($_GET['s']) && empty($_GET['s']) && $query->is_main_query()){
		$query->is_search = true;
		$query->is_home = false;
	}

    if ($query->is_search && !is_admin() ) {
        $query->set('post_type',array('articles'));
		
		$meta_query = array();
		
		if(
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
					  'value' => $_REQUEST['dateFromYear'].'-'.$month.'-'.$day.' 00:00:00',
					  'compare' => '>=',
					  'type' => 'numeric'
				);
		}
		
		if(
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
					  'value' => $_REQUEST['dateToYear'].'-'.$month.'-'.$day.' 00:00:00',
					  'compare' => '<=',
					  'type' => 'numeric'
				);
		}
		
		if(!empty($meta_query)) {
			$query->set( 'meta_query', $meta_query);
		}
		
    }

return $query;
}
add_filter('pre_get_posts','searchfilter');


function wpbeginner_numeric_posts_nav() {

	if( is_singular() )
		return;

	global $wp_query;

	/** Stop execution if there's only 1 page */
	if( $wp_query->max_num_pages <= 1 )
		return;

	$paged = get_query_var( 'paged' ) ? absint( get_query_var( 'paged' ) ) : 1;
	$max   = intval( $wp_query->max_num_pages );

	/**	Add current page to the array */
	if ( $paged >= 1 )
		$links[] = $paged;

	/**	Add the pages around the current page to the array */
	if ( $paged >= 3 ) {
		$links[] = $paged - 1;
		$links[] = $paged - 2;
	}

	if ( ( $paged + 2 ) <= $max ) {
		$links[] = $paged + 2;
		$links[] = $paged + 1;
	}

	echo '<div class="navigation pagination"><ul>' . "\n";

	/**	Previous Post Link */
	if ( get_previous_posts_link() )
		//printf( '<li>%s</li>' . "\n", get_previous_posts_link() );
		printf( '%s&nbsp;' . "\n", get_previous_posts_link("Previous") );

	/**	Link to first page, plus ellipses if necessary */
	if ( ! in_array( 1, $links ) ) {
		$class = 1 == $paged ? ' class="nav-pg-link-current"' : ' class="nav-pg-link"';

		//printf( '<li%s><a href="%s">%s</a></li>' . "\n", $class, esc_url( get_pagenum_link( 1 ) ), '1' );
		printf( '<a %s href="%s">%s</a>&nbsp;' . "\n", $class, esc_url( get_pagenum_link( 1 ) ), '1' );

		if ( ! in_array( 2, $links ) )
			//echo '<li>…</li>';
			echo '…&nbsp;';
	}

	/**	Link to current page, plus 2 pages in either direction if necessary */
	sort( $links );
	foreach ( (array) $links as $link ) {
		$class = $paged == $link ? ' class="nav-pg-link-current"' : ' class="nav-pg-link"';
		//printf( '<li%s><a href="%s">%s</a></li>' . "\n", $class, esc_url( get_pagenum_link( $link ) ), $link );
		printf( '<a %s href="%s">%s</a>&nbsp;' . "\n", $class, esc_url( get_pagenum_link( $link ) ), $link );
	}

	/**	Link to last page, plus ellipses if necessary */
	if ( ! in_array( $max, $links ) ) {
		if ( ! in_array( $max - 1, $links ) )
			//echo '<li>…</li>' . "\n";
			echo '…&nbsp;' . "\n";

		$class = $paged == $max ? ' class="nav-pg-link-current"' : ' class="nav-pg-link"';
		//printf( '<li%s><a href="%s">%s</a></li>' . "\n", $class, esc_url( get_pagenum_link( $max ) ), $max );
		printf( '<a %s href="%s">%s</a>&nbsp;' . "\n", $class, esc_url( get_pagenum_link( $max ) ), $max );
	}

	/**	Next Post Link */
	if ( get_next_posts_link() )
		//printf( '<li>%s</li>' . "\n", get_next_posts_link() );
		printf( '%s' . "\n", get_next_posts_link("Next") );

	echo '</ul></div>' . "\n";

}

function get_removed_search_filter_param_link($param_to_remove) {
	$all_search_params = $_GET;
	$return_query_string = '';
	if(is_array($param_to_remove)) {
		foreach($param_to_remove as $param) unset($all_search_params[$param]);
	}
	else
	unset($all_search_params[$param_to_remove]);
	return site_url().'?'.http_build_query($all_search_params);
}

remove_action( 'wp_head', 'rel_canonical' );
