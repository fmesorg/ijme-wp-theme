<div id="search">
    <script type="text/javascript">
        $(function() {
            // Attach the form handler.
            $('#searchForm').pkpHandler('$.pkp.pages.search.SearchFormHandler');
        });
    </script>
    <form method="get" id="searchForm" action="<?php echo site_url(); ?>">
        <table class="data">
            <tbody>
                <tr valign="top">
                    <td class="value" colspan="2">
                        <input type="text" id="query" name="s" size="40" placeholder="Search for" maxlength="255" value="<?php echo !empty($_REQUEST['s']) ? $_REQUEST['s'] : ''; ?>" class="textField searchbox">
                        &nbsp;
                        <input type="submit" value="Search" class="button defaultButton search-btn">
                    </td>
                </tr>
            </tbody>
        </table>
        
        <div class="row">
        <?php
        foreach($_GET as $key=>$value) {
            if(empty($value))
            continue;
        
            if(!in_array($key, array('authors', 'title', 'abstract', 'galleyFullText', 'suppFiles', '')))
            continue;
            ?>
            <div class="col-md-4 mt20">
                <input type="text" value="<?php echo $value; ?>" class="textField"><br/>
                <a href="<?php echo get_removed_search_filter_param_link($key); ?>">Delete</a>
            </div>
            <?php
        }
        ?>
        
        <?php
        if(
		   !empty($_REQUEST['dateToYear'])
		) {
            ?>
            <div class="col-md-4 mt20">
                <select name="dateToMonth" class="selectMenu">
                    <option label="" value=""></option>
                    <?php
                    $month_array = array(
                        "1" => "January", "2" => "February", "3" => "March", "4" => "April",
                        "5" => "May", "6" => "June", "7" => "July", "8" => "August",
                        "9" => "September", "10" => "October", "11" => "November", "12" => "December",
                    );
                    foreach($month_array as $value=>$month) {
                        ?>
                        <option value="<?php echo $value; ?>" <?php if(!empty($_REQUEST['dateToMonth']) && $_REQUEST['dateToMonth'] == $value) echo "selected"; ?>><?php echo $month; ?></option>
                        <?php
                    }
                    ?>
                </select>
                <select name="dateToDay" class="selectMenu">
                    <option label="" value="" selected="selected"></option>
                    <?php
                    for($i=1; $i<32; $i++) {
                        ?>
                        <option value="<?php echo str_pad($i, 2, "0", STR_PAD_LEFT); ?>" <?php if(!empty($_REQUEST['dateToDay']) && $_REQUEST['dateToDay'] == str_pad($i, 2, "0", STR_PAD_LEFT)) echo "selected"; ?> ><?php echo $i; ?></option>
                        <?php
                    }
                    ?>
                </select>
                <select name="dateToYear" class="selectMenu">
                    <option label="" value=""></option>
                    <?php
                    $year_array = range(1995, (int)date('Y') + 5);
                    foreach ($year_array as $year) {
                        ?>
                        <option value="<?php echo $year; ?>" <?php if(!empty($_REQUEST['dateToYear']) && $_REQUEST['dateToYear'] == $year) echo "selected"; ?>><?php echo $year; ?></option>
                        <?php
                    }
                    ?>
                </select>
                <br/>
                <a href="<?php echo get_removed_search_filter_param_link(array('dateToMonth','dateToDay','dateToYear')); ?>">Delete</a>
            </div>
            <?php            
        }
        ?>
        
        <?php
        if(
		   !empty($_REQUEST['dateFromYear'])
		) {
            ?>
            <div class="col-md-4 mt20">
                <select name="dateFromMonth" class="selectMenu">
                    <option label="" value=""></option>
                    <?php
                    $month_array = array(
                        "1" => "January", "2" => "February", "3" => "March", "4" => "April",
                        "5" => "May", "6" => "June", "7" => "July", "8" => "August",
                        "9" => "September", "10" => "October", "11" => "November", "12" => "December",
                    );
                    foreach($month_array as $value=>$month) {
                        ?>
                        <option value="<?php echo $value; ?>" <?php if(!empty($_REQUEST['dateFromMonth']) && $_REQUEST['dateFromMonth'] == $value) echo "selected"; ?>><?php echo $month; ?></option>
                        <?php
                    }
                    ?>
                </select>
                <select name="dateFromDay" class="selectMenu">
                    <option label="" value="" selected="selected"></option>
                    <?php
                    for($i=1; $i<32; $i++) {
                        ?>
                        <option value="<?php echo str_pad($i, 2, "0", STR_PAD_LEFT); ?>" <?php if(!empty($_REQUEST['dateFromDay']) && $_REQUEST['dateFromDay'] == str_pad($i, 2, "0", STR_PAD_LEFT)) echo "selected"; ?> ><?php echo $i; ?></option>
                        <?php
                    }
                    ?>
                </select>
                <select name="dateFromYear" class="selectMenu">
                    <option label="" value=""></option>
                    <?php
                    $year_array = range(1995, (int)date('Y') + 5);
                    foreach ($year_array as $year) {
                        ?>
                        <option value="<?php echo $year; ?>" <?php if(!empty($_REQUEST['dateFromYear']) && $_REQUEST['dateFromYear'] == $year) echo "selected"; ?>><?php echo $year; ?></option>
                        <?php
                    }
                    ?>
                </select>
                <br/>
                <a href="<?php echo get_removed_search_filter_param_link(array('dateFromMonth','dateFromDay','dateFromYear')); ?>">Delete</a>
            </div>
            <?php            
        }
        ?>
        </div>
        <br>
        <script type="text/javascript">
            // Initialise JS handler.
            $(function() {
                $('#emptyFilters').pkpHandler(
                    '$.pkp.controllers.ExtrasOnDemandHandler');
            });
        </script>
        <div class="advance-search-panel" style="padding: 5px 15px;
            background: #575757; text-transform: uppercase; font-size: 16px;
            color: #FFF;">
            Advance Search
        </div>
        <div id="emptyFilters" class="pkp_controllers_extrasOnDemand">
            <div class="toggleExtras">
                <span class="ui-icon"></span>
                <span class="toggleExtras-inactive">Additional Search Options (click to show)</span>
                <span class="toggleExtras-active">Additional Search Options (click to hide)</span>
            </div>
            <div style="clear:both;"></div>
            <div id="extrasContainer" class="extrasContainer">
                <table class="data">
                    <tbody>
                        <tr valign="top">
                            <td colspan="2" class="label">
                                <h4>Search categories</h4>
                            </td>
                        </tr>
                        <tr>
                            <td colspan="2">
                                <div class="row">
                                    
                                    <?php if(empty($_REQUEST['authors'])) { ?>
                                    <div class="col-md-4">
                                        <input type="text" name="authors" id="authors" size="40" maxlength="255" placeholder="authors" value="<?php echo !empty($_REQUEST['authors']) ? $_REQUEST['authors'] : ''; ?>" class="textField">
                                    </div>
                                    <?php } ?>
                                    
                                    <?php if(empty($_REQUEST['title'])) { ?>
                                    <div class="col-md-4">
                                        <input type="text" name="title" id="title" size="40" maxlength="255" placeholder="title" value="<?php echo !empty($_REQUEST['title']) ? $_REQUEST['title'] : ''; ?>" class="textField">
                                    </div>
                                    <?php } ?>
                                    
                                    <?php if(empty($_REQUEST['abstract'])) { ?>
                                    <div class="col-md-4">
                                        <input type="text" name="abstract" id="abstract" size="40" maxlength="255" placeholder="abstract" value="<?php echo !empty($_REQUEST['abstract']) ? $_REQUEST['abstract'] : ''; ?>" class="textField">
                                    </div>
                                    <?php } ?>
                                    
                                    <?php if(empty($_REQUEST['galleyFullText'])) { ?>
                                    <div class="col-md-4">
                                        <input type="text" name="galleyFullText" id="galleyFullText" size="40" maxlength="255" placeholder="galleyFullText" value="<?php echo !empty($_REQUEST['galleyFullText']) ? $_REQUEST['galleyFullText'] : ''; ?>" class="textField">
                                    </div>
                                    <?php } ?>
                                    
                                    <?php if(empty($_REQUEST['suppFiles'])) { ?>
                                    <div class="col-md-4">
                                        <input type="text" name="suppFiles" id="suppFiles" size="40" maxlength="255" placeholder="suppFiles" value="<?php echo !empty($_REQUEST['suppFiles']) ? $_REQUEST['suppFiles'] : ''; ?>" class="textField">
                                    </div>
                                    <?php } ?>
                                    
                                </div>
                            </td>
                        </tr>
                        <tr>
                            <td colspan="2">
                                <div class="row">
                                    <div class="col-md-4 search-pub-date">
                                        <h4>Publication Date</h4>
                                        <div class="row">
                                            
                                            <?php if(empty($_REQUEST['dateToYear'])) { ?>
                                            <div class="col-md-12">                                                
                                                
                                                <select name="dateToMonth" class="selectMenu">
                                                    <option label="" value=""></option>
                                                    <?php
                                                    $month_array = array(
                                                        "1" => "January", "2" => "February", "3" => "March", "4" => "April",
                                                        "5" => "May", "6" => "June", "7" => "July", "8" => "August",
                                                        "9" => "September", "10" => "October", "11" => "November", "12" => "December",
                                                    );
                                                    foreach($month_array as $value=>$month) {
                                                        ?>
                                                        <option value="<?php echo $value; ?>" <?php if(!empty($_REQUEST['dateToMonth']) && $_REQUEST['dateToMonth'] == $value) echo "selected"; ?>><?php echo $month; ?></option>
                                                        <?php
                                                    }
                                                    ?>
                                                </select>
                                                <select name="dateToDay" class="selectMenu">
                                                    <option label="" value="" selected="selected"></option>
                                                    <?php
                                                    for($i=1; $i<32; $i++) {
                                                        ?>
                                                        <option value="<?php echo str_pad($i, 2, "0", STR_PAD_LEFT); ?>" <?php if(!empty($_REQUEST['dateToDay']) && $_REQUEST['dateToDay'] == str_pad($i, 2, "0", STR_PAD_LEFT)) echo "selected"; ?> ><?php echo $i; ?></option>
                                                        <?php
                                                    }
                                                    ?>
                                                </select>
                                                <select name="dateToYear" class="selectMenu">
                                                    <option label="" value=""></option>
                                                    <?php
                                                    $year_array = range(1995, (int)date('Y') + 5);
                                                    foreach ($year_array as $year) {
                                                        ?>
                                                        <option value="<?php echo $year; ?>" <?php if(!empty($_REQUEST['dateToYear']) && $_REQUEST['dateToYear'] == $year) echo "selected"; ?>><?php echo $year; ?></option>
                                                        <?php
                                                    }
                                                    ?>
                                                </select>
                                                <input type="hidden" name="dateToHour" value="23">
                                                <input type="hidden" name="dateToMinute" value="59">
                                                <input type="hidden" name="dateToSecond" value="59">
                                            </div>
                                            <?php } ?>
                                            
                                            <?php if(empty($_REQUEST['dateFromYear'])) { ?>
                                            <div class="col-md-12">                                                
                                                
                                                <select name="dateFromMonth" class="selectMenu">
                                                    <option label="" value=""></option>
                                                    <?php
                                                    $month_array = array(
                                                        "1" => "January", "2" => "February", "3" => "March", "4" => "April",
                                                        "5" => "May", "6" => "June", "7" => "July", "8" => "August",
                                                        "9" => "September", "10" => "October", "11" => "November", "12" => "December",
                                                    );
                                                    foreach($month_array as $value=>$month) {
                                                        ?>
                                                        <option value="<?php echo $value; ?>" <?php if(!empty($_REQUEST['dateFromMonth']) && $_REQUEST['dateFromMonth'] == $value) echo "selected"; ?>><?php echo $month; ?></option>
                                                        <?php
                                                    }
                                                    ?>
                                                </select>
                                                <select name="dateFromDay" class="selectMenu">
                                                    <option label="" value="" selected="selected"></option>
                                                    <?php
                                                    for($i=1; $i<32; $i++) {
                                                        ?>
                                                        <option value="<?php echo str_pad($i, 2, "0", STR_PAD_LEFT); ?>" <?php if(!empty($_REQUEST['dateFromDay']) && $_REQUEST['dateFromDay'] == str_pad($i, 2, "0", STR_PAD_LEFT)) echo "selected"; ?> ><?php echo $i; ?></option>
                                                        <?php
                                                    }
                                                    ?>
                                                </select>
                                                <select name="dateFromYear" class="selectMenu">
                                                    <option label="" value=""></option>
                                                    <?php
                                                    $year_array = range(1995, (int)date('Y') + 5);
                                                    foreach ($year_array as $year) {
                                                        ?>
                                                        <option value="<?php echo $year; ?>" <?php if(!empty($_REQUEST['dateFromYear']) && $_REQUEST['dateFromYear'] == $year) echo "selected"; ?>><?php echo $year; ?></option>
                                                        <?php
                                                    }
                                                    ?>
                                                </select>
                                                <input type="hidden" name="dateFromHour" value="23">
                                                <input type="hidden" name="dateFromMinute" value="59">
                                                <input type="hidden" name="dateFromSecond" value="59">
                                            </div>
                                            <?php } ?>
                                        </div>
                                    </div>
                                    <div class="col-md-8 search-index-terms">
                                        <h4>Index terms</h4>
                                        <div class="row">
                                            
                                            <?php if(empty($_REQUEST['discipline'])) { ?>
                                            <div class="col-md-4">
                                                <input type="text" name="discipline" id="discipline" size="40" maxlength="255" placeholder="discipline" value="<?php echo !empty($_REQUEST['discipline']) ? $_REQUEST['discipline'] : ''; ?>" class="textField">
                                            </div>
                                            <?php } ?>
                                            
                                            <?php if(empty($_REQUEST['subject'])) { ?>
                                            <div class="col-md-4">
                                                <input type="text" name="subject" id="subject" size="40" maxlength="255" placeholder="subject" value="<?php echo !empty($_REQUEST['subject']) ? $_REQUEST['subject'] : ''; ?>" class="textField">
                                            </div>
                                            <?php } ?>
                                            
                                            <?php if(empty($_REQUEST['type'])) { ?>
                                            <div class="col-md-4">
                                                <input type="text" name="type" id="type" size="40" maxlength="255" placeholder="type" value="<?php echo !empty($_REQUEST['type']) ? $_REQUEST['type'] : ''; ?>" class="textField">
                                            </div>
                                            <?php } ?>
                                            
                                            <?php if(empty($_REQUEST['coverage'])) { ?>
                                            <div class="col-md-4">
                                                <input type="text" name="coverage" id="coverage" size="40" maxlength="255" placeholder="coverage" value="<?php echo !empty($_REQUEST['coverage']) ? $_REQUEST['coverage'] : ''; ?>" class="textField">
                                            </div>
                                            <?php } ?>
                                            
                                            <?php if(empty($_REQUEST['indexTerms'])) { ?>
                                            <div class="col-md-4">
                                                <input type="text" name="indexTerms" id="indexTerms" size="40" maxlength="255" placeholder="indexTerms" value="<?php echo !empty($_REQUEST['indexTerms']) ? $_REQUEST['indexTerms'] : ''; ?>" class="textField">
                                            </div>
                                            <?php } ?>
                                            
                                        </div>
                                    </div>
                                </div>
                            </td>
                        </tr>
                    </tbody>
                </table>
                <p><input type="submit" value="Search" style="margin-top: 15px; width: auto;" class="button defaultButton"></p>
            </div>
        </div>
    </form>
</div>