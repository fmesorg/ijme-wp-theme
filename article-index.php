<?php
get_header();
if ( have_posts() ) {
    while ( have_posts() ) {
        the_post();
        ?>
        <table class="listing" width="100%">
            <tr><td colspan="4" class="headseparator">&nbsp;</td></tr>
            <tr valign="top">
                <td class="heading" width="25%" colspan="2">Dublin Core</td>
                <td class="heading" width="25%">PKP Metadata Items</td>
                <td class="heading" width="50%">Metadata for this Document</td>
            </tr>
            <tr><td colspan="4" class="headseparator">&nbsp;</td></tr>
            <tr valign="top">
                <td>1.</td>
                <td>Title</td>
                <td>Title of document</td>
                <td><?php echo get_the_title(); ?></td>
            </tr>
            <tr><td colspan="4" class="separator">&nbsp;</td></tr>
            <tr valign="top">
                <td>2.</td>
                <td width="25%">Creator</td>
                <td>Author's name, affiliation, country</td>
                <td><?php
                $authors = get_post_meta(get_the_ID(), 'authors', true);
                foreach($authors as $author) {
                    if($author['primary_contact']) {
                        echo $author['first_name'].' '.$author['middle_name'].' '.$author['last_name'];
                        if(!empty($author['affiliation']))
                        echo '; '.$author['affiliation'];
                        if(!empty($author['country']))
                        echo '; '.$author['country'];
                        break;
                    }
                }
                ?></td>
            </tr>
            <tr><td colspan="4" class="separator">&nbsp;</td></tr>
            <tr valign="top">
                <td>3.</td>
                <td>Subject</td>
                <td>Discipline(s)</td>
                <td></td>
            </tr>
            <tr><td colspan="4" class="separator">&nbsp;</td></tr>
            <tr valign="top">
                <td>3.</td>
                <td>Subject</td>
                <td>Keyword(s)</td>
                <td></td>
            </tr>
            <tr><td colspan="4" class="separator">&nbsp;</td></tr>
            <tr valign="top">
                <td>4.</td>
                <td>Description</td>
                <td>Abstract</td>
                <td><?php echo get_the_excerpt(); ?></td>
            </tr>
            <tr><td colspan="4" class="separator">&nbsp;</td></tr>
            <tr valign="top">
                <td>5.</td>
                <td>Publisher</td>
                <td>Organizing agency, location</td>
                <td>Forum for Medical Ethics Society</td>
            </tr>
            <tr><td colspan="4" class="separator">&nbsp;</td></tr>
            <tr valign="top">
                <td>6.</td>
                <td>Contributor</td>
                <td>Sponsor(s)</td>
                <td></td>
            </tr>
            <tr><td colspan="4" class="separator">&nbsp;</td></tr>
            <tr valign="top">
                <td>7.</td>
                <td>Date</td>
                <td>(YYYY-MM-DD)</td>
                <td><?php echo get_the_date('Y-m-d'); ?></td><!--FIXME-->
            </tr>
            <tr><td colspan="4" class="separator">&nbsp;</td></tr>
            <tr valign="top">
                <td>8.</td>
                <td>Type</td>
                <td>Status & genre</td>
                <td></td><!--FIXME-->
            </tr>
            <tr><td colspan="4" class="separator">&nbsp;</td></tr>
            <tr valign="top">
                <td>8.</td>
                <td>Type</td>
                <td>Type</td>
                <td></td>
            </tr>
            <tr><td colspan="4" class="separator">&nbsp;</td></tr>
            <tr valign="top">
                <td>9.</td>
                <td>Format</td>
                <td>File format</td>
                <td>HTML <?php if(get_post_meta(get_the_ID(),'pdf_file',true)) { ?>, PDF<?php } ?></td>
            </tr>
            <tr><td colspan="4" class="separator">&nbsp;</td></tr>
            <tr valign="top">
                <td>10.</td>
                <td>Identifier</td>
                <td>Uniform Resource Identifier</td>
                <td><a target="_new" href="<?php echo get_permalink(); ?>"><?php echo get_permalink(); ?></a></td>
            </tr>
            <tr><td colspan="4" class="separator">&nbsp;</td></tr>
            <tr valign="top">
                <td>11.</td>
                <td>Source</td>
                <td>Title; vol., no. (year)</td>
                <td>                    
                    <?php
                    
                    echo get_bloginfo('name').";";
                    $volume = get_post_meta(get_the_ID(),'volume', true);
                    $number = get_post_meta(get_the_ID(),'number', true);
                    $year = get_post_meta(get_the_ID(),'year', true);
                    if($volume || $number || $year) { ?> ,&nbsp; <?php }
                    if($volume) { echo "Vol ".$volume.","; }
                    if($number) { ?>No <?php echo $number; ?> <?php }
                    if($year) { ?>(<?php echo $year; ?>) <?php }
                    echo ": ".get_the_title(get_post_meta(get_the_ID(),'issue_post_id',true));
                    ?>
                </td>
            </tr>
            <tr><td colspan="4" class="separator">&nbsp;</td></tr>
            <tr valign="top">
                <td>12.</td>
                <td>Language</td>
                <td>English=en</td>
                <td>en</td>
            </tr>
            <tr><td colspan="4" class="separator">&nbsp;</td></tr>
            <tr valign="top">
                <td>13.</td>
                <td>Relation</td>
                <td>Supp. Files</td>
                <td></td>
            </tr>
            <tr><td colspan="4" class="separator">&nbsp;</td></tr>
            <tr valign="top">
                <td>14.</td>
                <td>Coverage</td>
                <td>Geo-spatial location, chronological period, research sample (gender, age, etc.)</td>
                <td></td>
            </tr>
            <tr><td colspan="4" class="separator">&nbsp;</td></tr>
            <tr valign="top">
                <td>15.</td>
                <td>Rights</td>
                <td>Copyright and permissions</td>
                <td><p>All articles published in <em>IJME</em> are available on its website free of charge. The copyright for published material belongs to <em>IJME</em>/FMES. <em>IJME</em> freely permits the reprint (or reproduction on a website) of articles from the journal, as long as this is for non-commercial use and appropriate credit is given to the author and the journal and publication details are mentioned. The commercial use of our content can be made only after obtaining permission from and on payment to<em> IJME</em>. This is intended to support production of the journal.</p></td>
            </tr>
        </table>
        <?php
    }
}
else {
    ?>
    Unknown article
    <?php
}