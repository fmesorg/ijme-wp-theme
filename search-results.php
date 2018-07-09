<div id="results" class="search-result-page">
    <table width="100%" class="listing">
        <tbody>
            <tr>
                <td colspan="3" class="headseparator">&nbsp;</td>
            </tr>
            <tr class="heading" valign="bottom">
                <!--td width="40%">Issue</td-->
                <td width="60%" colspan="2">Title</td>
            </tr>
            <tr>
                <td colspan="3" class="headseparator">&nbsp;</td>
            </tr>
            
            <?php
            while ( have_posts() ) {
                the_post();
                
                $issue_id = get_post_meta(get_the_ID(),'issue_post_id',true);
                $volume = get_post_meta($issue_id,'volume',true);
                $number = get_post_meta($issue_id,'number',true);
                $year = get_post_meta($issue_id,'year',true);
                ?>
                
                <tr valign="top">
                    <!--td>
                        <a href="<?php //echo get_permalink($issue_id); ?>">
                            <?php //if($volume || $number || $year) { ?>
                                Vol <?php //echo $volume ? $volume : '-'; ?>, 
                                No <?php //echo $number ? $number : '-'; ?>,
                                <?php //echo $year ? '('.$year.')' : ''; ?>:
                            <?php //} ?>
                            <?php //echo get_the_title($issue_id); ?>
                        </a>
                    </td-->
                    <td width="30%"><a href="<?php echo add_query_arg( 'galley', 'html', get_permalink(get_the_ID()) ); ?>">
						<?php echo get_the_title(); ?>
					</a></td>
                    <td width="30%" align="right">
                        <a href="<?php echo get_permalink(get_the_ID()); ?>" class="file">Abstract</a>
                        &nbsp;<a class="file" href="<?php echo add_query_arg( 'galley', 'html', get_permalink(get_the_ID()) ); ?>">Full text</a>
                        <?php
                        $pdf_file = get_post_meta(get_the_ID(),'pdf_file',true);
                        if( $pdf_file ) {
                            ?>
                            &nbsp;<a class="file" href="<?php echo add_query_arg( 'galley', 'pdf', get_permalink(get_the_ID()) ); ?>">PDF</a>
                            <?php
                        }
                        ?>
                    </td>
                </tr>
                <tr>
                    <td colspan="3" class="author-name" style="font-style: italic;">-
                        <?php
                        $authors = get_post_meta(get_the_ID(), 'authors', true);
                        $authors_array = array();
                        foreach($authors as $author) {
                            $authors_array[] = $author['first_name'].' '.$author['middle_name'].' '.$author['last_name'];
                            /*
                            if($author['primary_contact']) {
                                echo $author['first_name'].' '.$author['middle_name'].' '.$author['last_name'];
                                break;
                            }
                            */
                        }
                        echo implode(', ', $authors_array);
                        ?>
                    </td>
                </tr>
                <tr>
                    <td colspan="3" class="separator">&nbsp;</td>
                </tr>
                <?php
            }
            ?>
            
            <?php
            global $paged;
            if(empty($paged)) $paged = 1;
            ?>
            
            <tr>
                <td colspan="3" class="endseparator">&nbsp;</td>
            </tr>
            <tr class="pagination-row">
                <td align="left"><?php global $wp_query; //echo $total_results = $wp_query->found_posts; ?> </td>
                <td colspan="2" align="right">
                    <?php wpbeginner_numeric_posts_nav(); ?>        
                </td>
            </tr>
        </tbody>
    </table>    
    <div class="search-instructions">
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