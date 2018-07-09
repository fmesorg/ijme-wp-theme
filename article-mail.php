<?php
if ( have_posts() ) {
    while ( have_posts() ) {
        the_post();
        
        get_header('common');
        $errors = '';
        ?>
        <script type="text/javascript" >
            function ajax_submit_email_article(invoker) {
                var ajaxurl = '<?php echo admin_url( 'admin-ajax.php' ); ?>';
                var caller = jQuery(invoker);
                var form = caller.closest('form');
                
                if (form.find('.alert').length) {
                    form.find('.alert').remove();
                }
                
                var data = {
                    'to': jQuery('#to').val(),
                    'cc': jQuery('#cc').val(),
                    'bcc': jQuery('#bcc').val(),
                    'article_id': <?php echo get_the_ID(); ?>,
                    'action': 'mail_article'
                };
        
                // since 2.8 ajaxurl is always defined in the admin header and points to admin-ajax.php
                jQuery.post(ajaxurl, data, function(response) {
                    if (response == '1') {
                        form.prepend("<div class='alert alert-success'>Mail sent</div>");
                    }
                    else {
                        form.prepend("<div class='alert alert-danger'>"+response+"</div>");
                    }
                    jQuery("html, body").animate({ scrollTop: 0 }, "slow");
                });
                
                return false;
                
            }
        jQuery(document).ready(function($) {
    
            
        });
        </script>
        <div id="content">
            <div id="rtEmail">
                
                <?php
                if(!empty($_GET['to']) && $_GET['to'] == 'author')
                    $mail_author = true;
                else
                    $mail_author = false;
                ?>
                
                <h2 id="section-title">
                    <?php if($mail_author) { ?>
                    Email the author
                    <?php } else { ?>
                    Notify colleague
                    <?php } ?>
                </h2>
                
                <form method="post" id="emailForm">
                    <table class="data" width="100%">
                        <?php if(!$mail_author) {
                        ?>
                        <tr valign="top">
                            <td class="label" width="20%">To</td>
                            <td width="80%" class="value">
                                <input type="text" name="to" id="to" size="40" maxlength="120" class="textField" />
                            </td>
                        </tr>
                        <tr valign="top">
                            <td class="label">CC</td>
                            <td class="value">
                                <input type="text" name="cc" id="cc" size="40" maxlength="120" class="textField" />
                            </td>
                        </tr>
                        <tr valign="top">
                            <td class="label">BCC</td>
                            <td class="value">
                                <input type="text" name="bcc" id="bcc" size="40" maxlength="120" class="textField" />
                            </td>
                        </tr>
                        <?php } ?>
                        <!--<tr valign="top">-->
                        <!--    <td colspan="2">&nbsp;</td>-->
                        <!--</tr>-->
                        <tr valign="top">
                            <td colspan="2">&nbsp;</td>
                        </tr>
                        <tr valign="top">
                            <td class="label">From</td>
                            <td class="value">admin@ijme.in</td>
                        </tr>
                        <tr valign="top">
                            <td width="20%" class="label">Subject</td>
                            <td width="80%" class="value">
                                <input type="text" id="subject" name="subject" value="[IJME] <?php echo htmlentities(get_the_title()); ?>" size="50" maxlength="120" class="textField" />
                            </td>
                        </tr>
                        <tr valign="top">
                            <td class="label">Body</td>
                            <?php
                            $issue_id = get_post_meta(get_the_ID(),'issue_post_id',true);
                            $authors = get_post_meta(get_the_ID(), 'authors', true);
                            $authors_array = array();
                            foreach($authors as $author) $authors_array[] = $author['last_name'].' '.$author['first_name'];
                            $message = 'Thought you might be interested in seeing "'.get_the_title().'" by '.implode(',',$authors_array).' published in Vol '.get_post_meta($issue_id,'volume',true).', No '.get_post_meta($issue_id,'number',true).' ('.get_post_meta($issue_id,'year',true).') of '.get_bloginfo('name').' at "'.get_permalink().'".';
                            ?>
                            <td class="value"><textarea name="body" cols="50" rows="15" class="textArea"><?php echo htmlentities($message); ?></textarea></td>
                        </tr>
                    </table>
                
                    <!--<p><input name="send" type="submit" value="Send" class="button defaultButton" onclick="ajax_submit_email_article(this);" /></p>-->
                    <p><a class="button defaultButton" href="javascript:void(0);" onclick="ajax_submit_email_article(this);" >Send</a></p>
                    
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