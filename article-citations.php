<?php
if ( have_posts() ) {
    while ( have_posts() ) {
        the_post();
        
        $citation_format_selected = 'AbntCitationPlugin';
        
        $allowed_citation_formats = array(
                                    "AbntCitationPlugin",
                                    "ApaCitationPlugin",
                                    "BibtexCitationPlugin", 
                                    "CbeCitationPlugin",
                                    "EndNoteCitationPlugin",
                                    "MlaCitationPlugin",
                                    "ProCiteCitationPlugin",
                                    "RefWorksCitationPlugin",
                                    "RefManCitationPlugin",
                                    "TurabianCitationPlugin",
                                    );
        
        if(!empty($_GET['format']) && in_array($_GET['format'], $allowed_citation_formats)) {
            $citation_format_selected = $_GET['format'];
        }
        
        if($citation_format_selected == 'EndNoteCitationPlugin') {
            $file_name = get_the_ID().'-endNote.enw';
            header('Content-Type: application/octet-stream');
            header("Content-Transfer-Encoding: Binary"); 
            header("Content-disposition: attachment; filename=\"" . $file_name . "\"");
            $issue_id = get_post_meta(get_the_ID(),'issue_post_id',true);
            $authors = get_post_meta(get_the_ID(), 'authors', true);
            $authors_array = array();
            foreach($authors as $author)
            $authors_array[] = '%A '.$author['last_name'].', '.$author['first_name'];
            echo PHP_EOL.implode('\n', $authors_array);
            ?>
%D <?php echo get_the_date('Y'); ?><?php echo PHP_EOL; ?>
%T <?php echo get_the_title(); ?><?php echo PHP_EOL; ?>
%B <?php echo get_the_date('Y'); ?><?php echo PHP_EOL; ?>
%9 <?php echo PHP_EOL; ?>
%! <?php echo get_the_title(); ?><?php echo PHP_EOL; ?>
%K <?php echo PHP_EOL; ?>
%X <?php echo get_the_excerpt(); ?><?php echo PHP_EOL; ?>
%U <?php echo get_permalink(get_the_ID()); ?><?php echo PHP_EOL; ?>
%J <?php echo get_bloginfo('name'); ?><?php echo PHP_EOL; ?>
%V <?php echo get_post_meta($issue_id,'volume',true); ?><?php echo PHP_EOL; ?>
%N <?php echo get_post_meta($issue_id,'number',true); ?><?php echo PHP_EOL; ?>
%@ <?php echo ISSN; ?><?php echo PHP_EOL; ?>
            <?php
            die;
        }
        elseif($citation_format_selected == 'ProCiteCitationPlugin') {
            $file_name = get_the_ID().'-proCite.ris';
            header('Content-Type: application/octet-stream');
            header("Content-Transfer-Encoding: Binary"); 
            header("Content-disposition: attachment; filename=\"" . $file_name . "\"");
            $issue_id = get_post_meta(get_the_ID(),'issue_post_id',true);
            ?>                
TY  - JOUR<?php echo PHP_EOL; ?>
<?php
$authors = get_post_meta(get_the_ID(), 'authors', true);
$authors_array = array();
foreach($authors as $author)
echo 'AU - '.$author['last_name'].', '.$author['first_name'];
?><?php echo PHP_EOL; ?>
PY  - <?php echo get_the_date('Y'); ?><?php echo PHP_EOL; ?>
TI  - <?php echo get_the_title(); ?><?php echo PHP_EOL; ?>
JF  - Indian Journal of Medical Ethics; Vol <?php echo get_post_meta($issue_id,'volume',true); ?>, No <?php echo get_post_meta($issue_id,'number',true); ?> (<?php echo get_post_meta($issue_id,'year',true); ?>): <?php echo get_the_title($issue_id); ?><?php echo PHP_EOL; ?>
KW  - <?php echo PHP_EOL; ?>
N2  - <?php echo get_the_excerpt(); ?><?php echo PHP_EOL; ?>
UR  - <?php echo get_permalink(); ?><?php echo PHP_EOL;
            die;
        }
        elseif($citation_format_selected == 'RefManCitationPlugin') {
            $file_name = get_the_ID().'-refMan.ris';
            header('Content-Type: application/octet-stream');
            header("Content-Transfer-Encoding: Binary"); 
            header("Content-disposition: attachment; filename=\"" . $file_name . "\"");
            $issue_id = get_post_meta(get_the_ID(),'issue_post_id',true);
            ?>                
TY  - JOUR<?php echo PHP_EOL; ?>
<?php
$authors = get_post_meta(get_the_ID(), 'authors', true);
$authors_array = array();
foreach($authors as $author)
echo 'AU - '.$author['last_name'].', '.$author['first_name'];
?><?php echo PHP_EOL; ?>
PY  - <?php echo get_the_date('Y/m/d/'); ?><?php echo PHP_EOL; ?>
TI  - <?php echo get_the_title(); ?><?php echo PHP_EOL; ?>
JF  - Indian Journal of Medical Ethics; Vol <?php echo get_post_meta($issue_id,'volume',true); ?>, No <?php echo get_post_meta($issue_id,'number',true); ?> (<?php echo get_post_meta($issue_id,'year',true); ?>): <?php echo get_the_title($issue_id); ?><?php echo PHP_EOL; ?>
KW  - <?php echo PHP_EOL; ?>
N2  - <?php echo get_the_excerpt(); ?><?php echo PHP_EOL; ?>
UR  - <?php echo get_permalink(); echo PHP_EOL;
            die;
        }
        
        get_header('common');
        
        ?>
        <div id="content">
            <div id="captureCite">
                
                <h2 id="section-title">How to cite item</h2>
                
                <h3><?php echo get_the_title(); ?></h3>
                
                <script>
                    jQuery(document).ready(function($){
                        $('#select-citation').change(function() {
                            this.form.submit();
                        });
                    });                    
                </script>
                <form action="#">
                    <label for="citeType">Citation Format</label>&nbsp;&nbsp;
                    <select name="format" id="select-citation">
                        <option <?php echo $citation_format_selected == 'AbntCitationPlugin' ? 'selected' : ''; ?> value="AbntCitationPlugin">ABNT</option>
                        <option <?php echo $citation_format_selected == 'ApaCitationPlugin' ? 'selected' : ''; ?> value="ApaCitationPlugin">APA</option>
                        <option <?php echo $citation_format_selected == 'BibtexCitationPlugin' ? 'selected' : ''; ?> value="BibtexCitationPlugin">BibTeX</option>
                        <option <?php echo $citation_format_selected == 'CbeCitationPlugin' ? 'selected' : ''; ?> value="CbeCitationPlugin">CBE</option>
                        <option <?php echo $citation_format_selected == 'EndNoteCitationPlugin' ? 'selected' : ''; ?> value="EndNoteCitationPlugin">EndNote - EndNote format (Macintosh &amp; Windows)</option>
                        <option <?php echo $citation_format_selected == 'MlaCitationPlugin' ? 'selected' : ''; ?> value="MlaCitationPlugin">MLA</option>
                        <option <?php echo $citation_format_selected == 'ProCiteCitationPlugin' ? 'selected' : ''; ?> value="ProCiteCitationPlugin">ProCite - RIS format (Macintosh &amp; Windows)</option>
                        <option <?php echo $citation_format_selected == 'RefWorksCitationPlugin' ? 'selected' : ''; ?> value="RefWorksCitationPlugin">RefWorks</option>
                        <option <?php echo $citation_format_selected == 'RefManCitationPlugin' ? 'selected' : ''; ?> value="RefManCitationPlugin">Reference Manager - RIS format (Windows only)</option>
                        <option <?php echo $citation_format_selected == 'TurabianCitationPlugin' ? 'selected' : ''; ?> value="TurabianCitationPlugin">Turabian</option>
                    </select>
                    <input type="hidden" name="galley" value="citations" />
                </form>
                
                <div class="separator"></div>
                
                <?php if( $citation_format_selected == 'AbntCitationPlugin' ) { ?>
                <div class="citation-abnt">
                    <?php
                    $authors = get_post_meta(get_the_ID(), 'authors', true);
                    $authors_array = array();
                    foreach($authors as $author) $authors_array[] = strtoupper($author['last_name']).', '.$author['first_name'].' '.$author['middle_name'];
                    ?>
                    <?php echo implode('; ',$authors_array); ?>.
                    <?php echo get_the_title(); ?>.
                    <?php
                    $issue_id = get_post_meta(get_the_ID(),'issue_post_id',true);
                    ?>
                    <strong><?php echo get_bloginfo('name'); ?></strong>, 
                    [S.l.], 
                    v. <?php echo get_post_meta($issue_id,'volume',true); ?>,
                    n. <?php echo get_post_meta($issue_id,'number',true); ?>,
                    p. <?php echo get_post_meta(get_the_ID(),'page_range',true); ?>,
                    <?php echo strtolower(get_the_date('M. Y')); ?>.
                    ISSN <?php echo ISSN; ?>. 
                    Avaialble at: <<strong><?php echo get_permalink(get_the_ID()); ?></strong>>.
                    Date accessed: <?php echo date('d M. Y'); ?>.                
                </div>
                <?php } ?>
                
                <?php if( $citation_format_selected == 'ApaCitationPlugin' ) { ?>
                <div class="citation-apa">
                    <?php
                    $authors = get_post_meta(get_the_ID(), 'authors', true);
                    $authors_array = array();
                    foreach($authors as $author)
                    $authors_array[] = strtoupper($author['last_name']).', '.substr($author['first_name'], 0, 1).'.';
                    ?>
                    <?php echo implode(', ',$authors_array).'   '; ?>.
                    <?php echo get_the_date('(Y)'); ?>.
                    <?php echo get_the_title(); ?>.
                    <?php
                    $issue_id = get_post_meta(get_the_ID(),'issue_post_id',true);
                    ?>
                    <em>
                        <?php echo get_bloginfo('name'); ?>,
                        <?php echo get_post_meta($issue_id,'volume',true); ?>
                    </em>
                    (<?php echo get_post_meta($issue_id,'number',true); ?>), 
                    <?php echo get_post_meta(get_the_ID(),'page_range',true); ?>. 
                    Retrieved from <strong><?php echo get_permalink(get_the_ID()); ?></strong>
                </div>
                <?php } ?>
                
                <?php if( $citation_format_selected == 'BibtexCitationPlugin' ) { ?>
                <div class="citations-bibtext">
                    <?php $issue_id = get_post_meta(get_the_ID(),'issue_post_id',true); ?>
                    <pre style="font-size: 1.5em; white-space: pre-wrap; white-space: -moz-pre-wrap !important; white-space: -pre-wrap; white-space: -o-pre-wrap; word-wrap: break-word;">@article{IJME<?php echo get_the_ID(); ?>,                        
        author = {<?php
        $authors = get_post_meta(get_the_ID(), 'authors', true);
        $authors_array = array();
        foreach($authors as $author)
        $authors_array[] = $author['first_name'].' '.$author['last_name'];
        echo implode(' and ', $authors_array);
        ?>},
        title = {<?php echo get_the_title(); ?>},
        journal = {<?php echo get_bloginfo('name'); ?>},                        
        volume = {<?php echo get_post_meta($issue_id,'volume',true); ?>},
        number = {<?php echo get_post_meta($issue_id,'number',true); ?>},
        year = {<?php echo get_the_date('(Y)'); ?>},
        keywords = {},
        abstract = {<?php echo get_the_excerpt(); ?>},
        issn = {<?php echo ISSN; ?>},
        url = {<?php echo get_permalink(get_the_ID()); ?>}
    }</pre>
                </div>
                <?php } ?>
                
                <?php if( $citation_format_selected == 'CbeCitationPlugin' ) { ?>
                <div class="citations-cbe">
                    <?php
                    $issue_id = get_post_meta(get_the_ID(),'issue_post_id',true);
                    $authors = get_post_meta(get_the_ID(), 'authors', true);
                    $authors_array = array();
                    foreach($authors as $author)
                    $authors_array[] = strtoupper($author['last_name']).', '.substr($author['first_name'], 0, 1).'.';
                    echo implode(', ', $authors_array);
                    ?>
                    <?php echo get_the_date('Y M d'); ?>.
                    <?php echo get_the_title(); ?>
                    <?php echo get_bloginfo('name'); ?>.
                    [Online] <?php echo get_post_meta($issue_id,'volume',true); ?>:<?php echo get_post_meta($issue_id,'number',true); ?>
                </div>
                <?php } ?>
                
                <?php if( $citation_format_selected == 'EndNoteCitationPlugin' ) { ?>
                <div class="citations-endnote">
                    <?php
                    $issue_id = get_post_meta(get_the_ID(),'issue_post_id',true);
                    $authors = get_post_meta(get_the_ID(), 'authors', true);
                    $authors_array = array();
                    foreach($authors as $author)
                    $authors_array[] = '%A '.$author['last_name'].', '.$author['first_name'];
                    echo implode('\n', $authors_array);
                    ?>
                    %D <?php echo get_the_date('Y'); ?>
                    %T <?php echo get_the_title(); ?>
                    %B <?php echo get_the_date('Y'); ?>
                    %9 
                    %! <?php echo get_the_title(); ?>
                    %K 
                    %X <?php echo get_the_excerpt(); ?>
                    %U <?php echo get_permalink(get_the_ID()); ?>
                    %J <?php echo get_bloginfo('name'); ?>
                    %V <?php echo get_post_meta($issue_id,'volume',true); ?>
                    %N <?php echo get_post_meta($issue_id,'number',true); ?>
                    %@ <?php echo ISSN; ?>
                </div>
                <?php } ?>
                
                <?php if( $citation_format_selected == 'MlaCitationPlugin' ) { ?>
                <div class="citations-mla">
                    <?php
                    $issue_id = get_post_meta(get_the_ID(),'issue_post_id',true);
                    $authors = get_post_meta(get_the_ID(), 'authors', true);
                    $authors_array = array();
                    foreach($authors as $author)
                    $authors_array[] = $author['last_name'].' '.$author['first_name'];
                    echo implode(', ', $authors_array);
                    ?>.
                    "<?php echo get_the_title(); ?>."
                    <em><?php echo get_bloginfo('name'); ?></em> [Online],
                    <?php echo get_post_meta($issue_id,'volume',true); ?>.
                    <?php echo get_post_meta($issue_id,'number',true); ?>
                    (<?php echo get_post_meta($issue_id,'year',true); ?>):
                    <?php echo get_post_meta(get_the_ID(),'page_range',true); ?>.
                    Web.
                    <?php echo date('j M. Y'); ?>
                </div>
                <?php } ?>
                
                <?php if( $citation_format_selected == 'ProCiteCitationPlugin' ) { ?>
                <div class="citations-procite">
                    <?php
                    $issue_id = get_post_meta(get_the_ID(),'issue_post_id',true);
                    ?>                
                    TY  - JOUR
                    <?php
                    $authors = get_post_meta(get_the_ID(), 'authors', true);
                    $authors_array = array();
                    foreach($authors as $author)
                    echo 'AU - '.$author['last_name'].', '.$author['first_name'];
                    ?>
                    PY  - <?php echo get_the_date('Y'); ?>
                    TI  - <?php echo get_the_title(); ?>
                    JF  - Indian Journal of Medical Ethics; Vol <?php echo get_post_meta($issue_id,'volume',true); ?>, No <?php echo get_post_meta($issue_id,'number',true); ?> (<?php echo get_post_meta($issue_id,'year',true); ?>): <?php echo get_the_title($issue_id); ?>
                    KW  - 
                    N2  - <?php echo get_the_excerpt(); ?>
                    UR  - <?php echo get_permalink(); ?>
                </div>
                <?php } ?>
                
                <?php if( $citation_format_selected == 'RefWorksCitationPlugin' ) { ?>
                <div class="citations-refworks">
                    <?php
                    $issue_id = get_post_meta(get_the_ID(),'issue_post_id',true);
                    $authors = get_post_meta(get_the_ID(), 'authors', true);
                    $authors_array = array();
                    foreach($authors as $author)
                    $authors_array[] = $author['last_name'].', '.substr($author['first_name'], 0, 1).'.';
                    ?>
                    <form action="http://www.refworks.com/express/expressimport.asp?vendor=Public%20Knowledge%20Project&filter=BibTeX&encoding=65001" method="post" target="RefWorksMain">
                        <textarea name="ImportData" rows=15 cols=70>@article{{IJME}{<?php echo get_the_ID(); ?>},
        author = {<?php echo implode(', ', $authors_array); ?>},
        title = {<?php echo get_the_title(); ?>},
        journal = {<?php echo get_bloginfo('name'); ?>},
        volume = {<?php echo get_post_meta($issue_id,'volume',true); ?>},
        number = {<?php echo get_post_meta($issue_id,'number',true); ?>},
        year = {<?php echo get_post_meta($issue_id,'year',true); ?>},
    
        url = {<?php echo get_permalink(get_the_ID()); ?>}
    }</textarea>
                        <br />
                        <input type="submit" class="button defaultButton" name="Submit" value="Export to RefWorks" />
                    </form>
                </div>
                <?php } ?>
                
                <?php if( $citation_format_selected == 'RefManCitationPlugin' ) { ?>
                <div class="citations-refman">
                    <?php
                    $issue_id = get_post_meta(get_the_ID(),'issue_post_id',true);
                    ?>                
                    TY  - JOUR
                    <?php
                    $authors = get_post_meta(get_the_ID(), 'authors', true);
                    $authors_array = array();
                    foreach($authors as $author)
                    echo 'AU - '.$author['last_name'].', '.$author['first_name'];
                    ?>
                    PY  - <?php echo get_the_date('Y/m/d/'); ?>
                    TI  - <?php echo get_the_title(); ?>
                    JF  - Indian Journal of Medical Ethics; Vol <?php echo get_post_meta($issue_id,'volume',true); ?>, No <?php echo get_post_meta($issue_id,'number',true); ?> (<?php echo get_post_meta($issue_id,'year',true); ?>): <?php echo get_the_title($issue_id); ?>
                    KW  - 
                    N2  - <?php echo get_the_excerpt(); ?>
                    UR  - <?php echo get_permalink(); ?>
                </div>
                <?php } ?>
                
                <?php if( $citation_format_selected == 'TurabianCitationPlugin' ) { ?>
                <div class="citations-turabian">
                    <?php
                    $issue_id = get_post_meta(get_the_ID(),'issue_post_id',true);
                    $authors = get_post_meta(get_the_ID(), 'authors', true);
                    $authors_array = array();
                    foreach($authors as $author)
                    $authors_array[] = $author['last_name'].', '.$author['first_name'];
                    echo implode(', ', $authors_array);
                    ?>.                
                    "<?php echo get_the_title(); ?>"
                    <em>{<?php echo get_bloginfo('name'); ?></em> [Online],
                    Volume <?php echo get_post_meta($issue_id,'volume',true); ?> Number <?php echo get_post_meta($issue_id,'number',true); ?> (<?php echo get_the_date('j F Y'); ?>)
                </div>
                <?php } ?>
                
            </div>
        </div>
        <?php
    }
}
else {
    ?>
    Unknown article
    <?php
}
?>

<div class="separator"></div>
<input type="button" onclick="window.close()" value="Close" class="button defaultButton">
<div class="separator"></div>

<?php get_footer('common'); ?>