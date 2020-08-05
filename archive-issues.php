<?php get_header(); ?>
<div class="issue-archive-container">
    <div id="issue-archive-header">
        <div id="issue-archive-title">Archives</div>
        <div id="issue-archive-description">
            [Text to Replace]
            Lorem ipsum dolor sit amet, consectetur adipiscing elit. In nulla augue, volutpat eu ornare sed,
            fermentum eu neque. Suspendisse pellentesque ac est in sodales. Cras odio lectus, dictum eleifend
            fermentum ut, malesuada at nibh. Proin nisl velit, tempus volutpat sem placerat, mattis suscipit quam.
            Cras fermentum luctus dolor, nec tincidunt orci gravida vel. Vivamus volutpat aliquet orci sit amet
            lacinia. Fusce in cursus odio. Proin ut ultrices neque. Phasellus efficitur neque nunc, a sodales nisl
            scelerisque at. Sed vel velit vitae sem venenatis tempor vel eget orci.
        </div>
    </div>

    <div id="issue-archive-search">
        <div id="search-box">
            <input type="text" class="input-group-text tag-search-input" placeholder="Search a Volume...">
            <button class="button tag-search-button">Search</button>
        </div>
        <div id="issue-search-tags">
            <ul id="tag-list">
                <li class="tag-item tag-selected">All Years</li>
                <li class="tag-item">IJME - New Series (2016 Onwards)</li>
                <li class="tag-item">IJME - Old Series (2004 - 2015)</li>
            </ul>
        </div>
    </div>

    <div id="issue-archive-content-container">

        <div class="issue-archive-year">
            <div class="year-section-title">Indian Journal of Medical Ethics (New Series 2016 – onwards)</div>
            <div class="year-content">
                <div class="year-title">2020: Volume 5 <span class="year-subtitle">(Cumulative Vol.28)</span></div>
                <div class="issue-archive-card">
                    <div class="issue-archive-thumbnail"></div>
                    <div class="issue-archive-details">
                        <div class="issue-archive-number">No. 1</div>
                        <div class="issue-archive-title">Real life research, real life dilemmas</div>
                    </div>
                </div>
            </div>
        </div>


    </div>


    ---------------------------------------------
        <div class="content blocks">
            <div class="col-md-9">
                <div class="row">
                    <div class="dropdown pull-right"><span>Select Year</span>
                        <button class="btn btn-default dropdown-toggle dropdown-width" type="button" id="year-drop-down-menu"
                                data-toggle="dropdown" aria-haspopup="true" aria-expanded="true">
                            Choose Year<span class="caret"></span>
                        </button>
                        <ul class="dropdown-menu" id="year-dropdown" aria-labelledby="dropdownMenu1">
                            <?php populateDropdown(); ?>
                        </ul>
                    </div>
                </div>
                <!--    <div class="clearfix"></div>-->
                <div class="row">
                    <div class="issues-wrapper">
                        <div class="">
                            <div class="row">
                                <div class="issue-box" id="issue-box">

                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="loader" id="loader"></div>
    </div>

<?php get_footer(); ?>


<script type="text/javascript">
    jQuery(function($) {

        $(document).ready(function(){
            $("#current-year").trigger("click");
        });

        $('#year-dropdown li a').on('click', function(e) {
            e.preventDefault();
            showLoader();
            let selected_year = $(this).data('value');

            let ajaxUrl = '<?php echo admin_url( 'admin-ajax.php' );?>';
            $.ajax({
                type:"POST",
                url: ajaxUrl,
                data: {
                    action: "display_year_issues",
                    selected_year: selected_year
                },
                success:function(data){
                    hideLoader();
                    removeOldData();
                    jQuery("#issue-box").html(data);
                },
                error: function(errorThrown){
                    alert(errorThrown);
                }
            });

        });

        $('#year-dropdown a').click(function(){
            $('#year-drop-down-menu').html($(this).text()+'<span class="caret caret-white"></span>');
        });


    });
    
    function removeOldData() {
        jQuery(".issue").remove();
    }

    function showLoader() {
        document.getElementById("loader").style.display = "block";
    }

    function hideLoader() {
        document.getElementById("loader").style.display = "none";
    }



</script>

<?php
function populateDropdown() {
    $currentYear = date("Y");
    $lastyear    =   $currentYear-1;

    $dropDownHtml = '<li><a href="#" data-value="'.$currentYear.'" id="current-year">Current Year</a></li>';
    $dropDownHtml .= '<li><a href="#" data-value="'.$lastyear.'" id="current-year">Last Year</a></li>';
    $dropDownHtml .= '<li role="separator" class="divider"></li>';

    $year = $currentYear;
    while ($year>$currentYear-10){
        $dropDownHtml .= '<li><a href="#" data-value="'.$year.'">'.$year.'</a></li>';
        $year--;
    }

    echo $dropDownHtml;
}

?>
