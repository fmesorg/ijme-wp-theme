<?php
    /*
    Plugin Name: Remove Website and Email Field
    Description: Removes the website field and email Field from the comments form
    */
    add_filter('comment_form_default_fields', 'url_filtered');
    function url_filtered($fields)
    {
        if(isset($fields['url']))
            unset($fields['url']);
        return $fields;
    }
    
    add_filter('comment_form_default_fields', 'email_filtered');
    function email_filtered($fields)
    {
        if(isset($fields['email']))
            unset($fields['email']);
        return $fields;
    }
    
    add_filter('comment_form_default_fields', 'author_filtered');
    function author_filtered($fields)
    {
        if(isset($fields['author']))
            unset($fields['author']);
        return $fields;
    }

?>
