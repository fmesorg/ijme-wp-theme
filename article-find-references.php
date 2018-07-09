<?php
if ( have_posts() ) {
    while ( have_posts() ) {
        the_post();
        
        get_header('common');
        
        ?>
        <div id="content">
            <script type="text/javascript">            
            function invokeGoogleScholar() {
                var googleScholarForm = document.getElementById('googleScholar');
            
                googleScholarForm.as_q.value = document.getElementById('inputForm').title.value;
                googleScholarForm.as_sauthors.value = document.getElementById('inputForm').author.value;
                googleScholarForm.submit();
            }
            
            function invokeWLA() {
                var wlaForm = document.getElementById('wla');
                wlaForm.q.value = document.getElementById('inputForm').title.value + " " + document.getElementById('inputForm').author.value;
                wlaForm.submit();
            }
            </script>
            
            <h3><?php echo get_the_title(); ?></h3>
            
            <!-- Include the real forms for each of the search engines -->
            <form id="googleScholar" method="get" action="http://scholar.google.com/scholar">
                <input type="hidden" name="as_q" value="" />
                <input type="hidden" name="as_sauthors" value="" />
                <input type="hidden" name="btnG" value="Search Scholar" />
                <input type="hidden" name="as_occt" value="any" />
                <input type="hidden" name="as_allsubj" value="all" />
            </form>
            
            <form id="wla" method="get" action="http://search.live.com/results.aspx">
                <input type="hidden" name="q" value="" />
                <input type="hidden" name="scope" value="academic" />
            </form>
            
            <form id="inputForm" target="#">
            
                <!-- Display the form fields -->
                <table width="100%" class="data">
                    <tr valign="top">
                        <td class="label" width="20%"><label for="author">Author</label></td>
                        <?php
                        $authors = get_post_meta(get_the_ID(), 'authors', true);
                        $authors_array = array();
                        foreach($authors as $author) $authors_array[] = $author['last_name'].' '.$author['first_name'];
                        ?>
                        <td class="value" width="80%"><input name="author" id="author" type="text" size="20" maxlength="40" class="textField" value="<?php echo implode(',', $authors_array) ?>" /></td>
                    </tr>
                    <tr valign="top">
                        <td class="label"><label for="title">Title</label></td>
                        <td class="value"><input type="text" id="title" name="title" size="40" maxlength="40" class="textField" value="<?php echo get_the_title(); ?>" /></td>
                    </tr>
                </table>
                
                <!-- Display the search engine options -->
                <table class="listing" width="100%">
                    <tr valign="top">
                        <td width="10%"><input value="Search" type="button" onclick="invokeGoogleScholar()" class="button" /></td>
                        <td width="2%">1.</td>
                        <td width="88%">Google Scholar</td>
                    </tr>
                    <tr valign="top">
                        <td><input value="Search" type="button" onclick="invokeWLA()" class="button" /></td>
                        <td>2.</td>
                        <td>Windows Live Academic</td>
                    </tr>
                </table>
            
            </form>
                
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